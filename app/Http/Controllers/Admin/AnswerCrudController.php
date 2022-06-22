<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AnswerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class AnswerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Answer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/answer');
        CRUD::setEntityNameStrings('answer', 'answers');
    }

    protected function setupListOperation()
    {
        CRUD::column('question_id');
        CRUD::column('entry_id');
        CRUD::column('value');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(AnswerRequest::class);

        CRUD::field('question_id');
        CRUD::field('entry_id');
        CRUD::field('value');
    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
