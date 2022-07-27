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
        CRUD::setEntityNameStrings('', __('Surveys'));

        CRUD::setShowView('admin.survey.show');
    }

    protected function setupListOperation()
    {
        CRUD::column('name')->label(__('Name'));

        CRUD::column('enabled')->type('boolean')->label(__('Enabled'));
        CRUD::column('accept_guest_entries')->type('boolean')->label(__('Accept guest entries'));
        CRUD::column('limit_per_participant')->label(__('Limit per participant'));
        CRUD::column('expired')->type('date')->label(__('Expired'));
    }

    protected function setupCreateOperation()
    {


        CRUD::setValidation(SurveyRequest::class);

        CRUD::field('name')->type('text');

        CRUD::field('enabled')->type('toggle')->size(6);
        CRUD::field('accept_guest_entries')->type('toggle')->size(6);

        CRUD::field('limit_per_participant')->type('number')->size(6);
        CRUD::field('expired')->type('date')->size(6);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
