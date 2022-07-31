<?php

namespace App\Models;

use App\Contracts\Entry as EntryContract;
use App\Exceptions\GuestEntriesNotAllowedException;
use App\Exceptions\MaxEntriesPerUserLimitExceeded;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Entry
 *
 * @property int $id
 * @property int $survey_id
 * @property int|null $participant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Answer[] $answers
 * @property-read int|null $answers_count
 * @property-read Organization|null $participant
 * @property-read Survey|null $survey
 * @method static Builder|Entry newModelQuery()
 * @method static Builder|Entry newQuery()
 * @method static Builder|Entry query()
 * @method static Builder|Entry whereCreatedAt($value)
 * @method static Builder|Entry whereId($value)
 * @method static Builder|Entry whereParticipantId($value)
 * @method static Builder|Entry whereSurveyId($value)
 * @method static Builder|Entry whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int|null $university_id
 * @property-read \App\Models\University|null $university
 * @method static Builder|Entry whereUniversityId($value)
 */
class Entry extends Model implements EntryContract
{
    use CrudTrait;

    protected $fillable = ['survey_id', 'university_id', 'participant_id'];

    public function __construct(array $attributes = [])
    {
        if (!isset($this->table)) {
            $this->setTable(config('survey.database.tables.entries'));
        }

        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        //Prevent submission of entries that don't meet the parent survey's constraints.
        static::creating(function (self $entry) {
            $entry->validateParticipant();
            $entry->validateMaxEntryPerUserRequirement();
        });
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

    /**
     * Set the survey the entry belongs to.
     *
     * @param Survey $survey
     * @return $this
     */
    public function for(Survey $survey)
    {
        $this->survey()->associate($survey);

        return $this;
    }

    /**
     * The survey the entry belongs to.
     *
     * @return BelongsTo
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    /**
     * The university the entry belongs to
     *
     * @return BelongsTo
     */
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Set the participant who the entry belongs to.
     *
     * @param Model|Authenticatable|null $model
     * @return $this
     */
    public function by($model = null): Entry
    {
        $this->participant()->associate($model);

        return $this;
    }

    /**
     * The participant that the entry belongs to.
     *
     * @return BelongsTo
     */
    public function participant()
    {
        return $this->belongsTo(Organization::class, 'participant_id');
    }

    /**
     * Create an entry from an array.
     *
     * @param array $values
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
     * @param Question $question
     * @return mixed|null
     */
    public function answerFor(Question $question)
    {
        $answer = $this->answers()->where('question_id', $question->id)->first();

        return isset($answer) ? $answer->value : null;
    }

    /**
     * The answers within the entry.
     *
     * @return HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
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
}
