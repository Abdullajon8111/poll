<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Survey;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class QuestionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Question::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/question');
        CRUD::setEntityNameStrings('question', 'questions');
    }

    protected function setupListOperation()
    {
        CRUD::column('survey_id')->label(__('Survey'));
        CRUD::column('section_id')->label(__('Section'));
        CRUD::column('content');
        CRUD::column('type');
        CRUD::column('options');
        CRUD::column('rules');

        CRUD::addFilter([
            'name' => 'survey',
            'type' => 'dropdown'
        ],
            Survey::pluck('name', 'id')->toArray(),
            function ($value) {
                $this->crud->addClause('where', 'id', $value);
            });
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(QuestionRequest::class);

        CRUD::field('survey_id')->size(6);
        CRUD::field('section_id')->size(6);
        CRUD::field('content')->type('ckeditor');
        CRUD::field('type')->type('select_from_array')->options(Question::types());

        CRUD::addField([
            'name' => 'options',
            'type' => 'table',
            'entity_singular' => 'option',
            'columns' => [
                'option' => 'option',
            ],
            'max' => 5,
            'min' => 0,
            'wrapper'   => [
                'class'      => 'form-group col-lg-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'rules',
            'type' => 'table',
            'entity_singular' => 'rule',
            'columns' => [
                'rule' => 'rule',
            ],
            'max' => 5,
            'min' => 0,
            'wrapper'   => [
                'class'      => 'form-group col-lg-6'
            ],
        ]);
    }
}
