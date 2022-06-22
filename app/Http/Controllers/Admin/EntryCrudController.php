<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EntryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class EntryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Entry::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/entry');
        CRUD::setEntityNameStrings('entry', 'entries');
    }

    protected function setupListOperation()
    {
        CRUD::column('survey_id');
        CRUD::column('participant_id');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(EntryRequest::class);

        CRUD::field('survey_id');
        CRUD::field('participant_id');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
