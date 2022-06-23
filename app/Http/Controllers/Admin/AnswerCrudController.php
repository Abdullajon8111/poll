<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use App\Models\Survey;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Database\Eloquent\Builder;

class AnswerCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        CRUD::setModel(Answer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/answer');
        CRUD::setEntityNameStrings('answer', 'answers');

        CRUD::enableExportButtons();
    }

    protected function setupListOperation()
    {
        $lang = app()->getLocale();
        $answerCrudQuery = Answer::query()
            ->leftJoin('entries', 'entries.id', '=', 'answers.entry_id')
            ->leftJoin('users', 'entries.participant_id', '=', 'users.id')
            ->leftJoin('surveys', 'entries.survey_id', '=', 'surveys.id')
            ->select(['answers.*', 'users.name as full_name', "surveys.name->{$lang} as survey"]);

        $this->crud->query = $answerCrudQuery;

        CRUD::column('survey');
        CRUD::column('question_id');
        CRUD::column('full_name');
        CRUD::column('value');

        CRUD::addFilter(
            ['name' => 'survey', 'type' => 'select2'],
            Survey::pluck('name', 'id')->toArray(),
            function ($value) use ($answerCrudQuery) {
                $this->crud->query = $answerCrudQuery->where('surveys.id', $value);
            });

        CRUD::addFilter(
            ['name' => 'user', 'type' => 'select2'],
            User::pluck('name', 'id')->toArray(),
            function ($value) use ($answerCrudQuery) {
                $this->crud->query = $answerCrudQuery->where('entries.participant_id', $value);
            });
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(AnswerRequest::class);

        CRUD::field('question_id');
        CRUD::field('entry_id');
        CRUD::field('value');
    }
}
