<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SectionRequest;
use App\Models\Survey;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class SectionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Section::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/section');
        CRUD::setEntityNameStrings('', __('Sections'));
    }

    protected function setupListOperation()
    {
        CRUD::column('survey_id')->label(__('Survey'));
        CRUD::column('name')->type('text')->label(__('Name'));

        CRUD::addFilter([
            'name' => 'survey',
            'type' => 'dropdown',
            'label' => __('Survey')
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
        CRUD::setValidation(SectionRequest::class);

        CRUD::field('survey_id');
        CRUD::field('name')->type('text');
    }
}
