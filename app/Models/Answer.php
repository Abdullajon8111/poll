<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Answer as AnswerContract;

class Answer extends Model implements AnswerContract
{
    use CrudTrait;

    public function __construct(array $attributes = [])
    {
        if (! isset($this->table)) {
            $this->setTable(config('survey.database.tables.answers'));
        }

        parent::__construct($attributes);
    }

    protected $fillable = ['value', 'question_id', 'entry_id'];


    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }


    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
