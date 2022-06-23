<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Question as QuestionContract;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property int|null $survey_id
 * @property int|null $section_id
 * @property array $content
 * @property string $type
 * @property array|null $options
 * @property array|null $rules
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $key
 * @property-read array $translations
 * @property-read \App\Models\Section|null $section
 * @property-read \App\Models\Survey|null $survey
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereSurveyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question withoutSection()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Answer[] $answers
 * @property-read int|null $answers_count
 */
class Question extends Model implements QuestionContract
{
    use CrudTrait;
    use HasTranslations;

    protected $fillable = ['type', 'options', 'content', 'rules', 'survey_id'];
    protected $translatable = ['content'];

    protected $casts = [
        'rules' => 'array',
        'options' => 'array',
    ];

    const TYPES = ['text', 'number', 'radio', 'multiselect'];

    public static function types()
    {
        return [
            'text' => 'text',
            'number' => 'number',
            'radio' => 'radio',
            'multiselect' => 'multiselect'
        ];
    }

    protected static function boot()
    {
        parent::boot();

        //Ensure the question's survey is the same as the section it belongs to.
        static::creating(function (self $question) {
            $question->load('section');

            if ($question->section) {
                $question->survey_id = $question->section->survey_id;
            }
        });
    }


    public function __construct(array $attributes = [])
    {
        if (! isset($this->table)) {
            $this->setTable(config('survey.database.tables.questions'));
        }

        parent::__construct($attributes);
    }


    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }


    public function section()
    {
        return $this->belongsTo(Section::class);
    }


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }


    public function getRulesAttribute($value)
    {
        $value = $this->castAttribute('rules', $value);

        return $value !== null ? $value : [];
    }


    public function getKeyAttribute()
    {
        return "q{$this->id}";
    }


    public function scopeWithoutSection($query)
    {
        return $query->where('section_id', null);
    }
}
