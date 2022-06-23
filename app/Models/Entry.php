<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Entry as EntryContract;
use App\Exceptions\GuestEntriesNotAllowedException;
use App\Exceptions\MaxEntriesPerUserLimitExceeded;

/**
 * App\Models\Entry
 *
 * @property int $id
 * @property int $survey_id
 * @property int|null $participant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Answer[] $answers
 * @property-read int|null $answers_count
 * @property-read User|null $participant
 * @property-read \App\Models\Survey|null $survey
 * @method static \Illuminate\Database\Eloquent\Builder|Entry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereSurveyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Entry extends Model implements EntryContract
{
    use CrudTrait;

    protected $fillable = ['survey_id', 'participant_id'];

    protected static function boot()
    {
        parent::boot();

        //Prevent submission of entries that don't meet the parent survey's constraints.
        static::creating(function (self $entry) {
            $entry->validateParticipant();
            $entry->validateMaxEntryPerUserRequirement();
        });
    }

    public function __construct(array $attributes = [])
    {
        if (! isset($this->table)) {
            $this->setTable(config('survey.database.tables.entries'));
        }

        parent::__construct($attributes);
    }

    /**
     * The answers within the entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * The survey the entry belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    /**
     * The participant that the entry belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function participant()
    {
        return $this->belongsTo(User::class, 'participant_id');
    }

    /**
     * Set the survey the entry belongs to.
     *
     * @param  Survey  $survey
     * @return $this
     */
    public function for(Survey $survey)
    {
        $this->survey()->associate($survey);

        return $this;
    }

    /**
     * Set the participant who the entry belongs to.
     *
     * @param  Model|Authenticatable|null  $model
     * @return $this
     */
    public function by($model = null): Entry
    {
        $this->participant()->associate($model);

        return $this;
    }

    /**
     * Create an entry from an array.
     *
     * @param  array  $values
     * @return $this
     */
    public function fromArray(array $values): Entry
    {
        foreach ($values as $key => $value) {
            if ($value === null) {
                continue;
            }

            $answer_class = Answer::class;

            if (gettype($value) === 'array') {
                $value = implode(', ', $value);
            }

            $this->answers->add($answer_class::make([
                'question_id' => substr($key, 1),
                'entry_id' => $this->id,
                'value' => $value,
            ]));
        }

        return $this;
    }

    /**
     * The answer for a given question.
     *
     * @param  Question  $question
     * @return mixed|null
     */
    public function answerFor(Question $question)
    {
        $answer = $this->answers()->where('question_id', $question->id)->first();

        return isset($answer) ? $answer->value : null;
    }

    /**
     * Save the model and all of its relationships.
     * Ensure the answers are automatically linked to the entry.
     *
     * @return bool
     */
    public function push(): bool
    {
        $this->save();

        foreach ($this->answers as $answer) {
            $answer->entry_id = $this->id;
        }

        return parent::push();
    }

    /**
     * Validate participant's legibility.
     *
     * @throws GuestEntriesNotAllowedException
     */
    public function validateParticipant()
    {
        if ($this->survey->acceptsGuestEntries()) {
            return;
        }

        if ($this->participant_id !== null) {
            return;
        }

        throw new GuestEntriesNotAllowedException();
    }

    /**
     * Validate if entry exceeds the survey's
     * max entry per participant limit.
     *
     * @throws MaxEntriesPerUserLimitExceeded
     */
    public function validateMaxEntryPerUserRequirement()
    {
        $limit = $this->survey->limitPerParticipant();

        if ($limit === null) {
            return;
        }

        $count = static::where('participant_id', $this->participant_id)
            ->where('survey_id', $this->survey->id)
            ->count();

        if ($count >= $limit) {
            throw new MaxEntriesPerUserLimitExceeded();
        }
    }
}
