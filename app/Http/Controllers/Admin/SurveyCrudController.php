<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SurveyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SurveyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SurveyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Survey::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/survey');
        CRUD::setEntityNameStrings('survey', 'surveys');
    }

    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('enabled')->type('boolean');
        CRUD::column('expired')->type('date');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(SurveyRequest::class);

        CRUD::field('name')->type('text');
        CRUD::field('enabled')->type('toggle');
        CRUD::field('expired');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
