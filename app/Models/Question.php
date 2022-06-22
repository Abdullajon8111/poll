<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Answer;
use App\Contracts\Question as QuestionContract;

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
        return $this->hasMany(get_class(app()->make(Answer::class)));
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
