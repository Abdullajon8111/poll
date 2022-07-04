<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use App\Models\Organization;
use App\Models\Survey;
use App\Models\University;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

class EntryCrudController extends CrudController
{
    use ListOperation;

//    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use DeleteOperation;

//    use ShowOperation;

    public function setup()
    {
        CRUD::setModel(Entry::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/entry');
        CRUD::setEntityNameStrings('entry', 'entries');

        CRUD::enableExportButtons();
    }

    public function orgOptions(Request $request)
    {
        $term = $request->input('term');

        return Organization::where('name', 'like', '%' . $term . '%')->get()->pluck('name', 'id');
    }

    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('survey_id');
        CRUD::column('university_id');
        CRUD::column('participant_id');
        CRUD::column('created_at');

        CRUD::addColumn([
           'type'      => 'select',
           'name'      => 'expired',
           'entity'    => 'survey',
           'attribute' => 'expired',
           'model'     => \App\Models\Survey::class,
        ]);

        CRUD::addFilter(
            ['name' => 'survey_id', 'type' => 'select2'],
            Survey::pluck('name', 'id')->toArray(),
            function ($value) {
                $this->crud->addClause('where', 'survey_id', '=', $value);
            });

        CRUD::addFilter(
            ['name' => 'university_id', 'type' => 'select2'],
            University::pluck('name', 'id')->toArray(),
            function ($value) {
                $this->crud->addClause('where', 'university_id', '=', $value);
            });

        CRUD::addFilter(
            ['name' => 'participant_id', 'type' => 'select2_ajax'],
            route('admin.entry.options'),
            function ($value) {
                $this->crud->addClause('where', 'participant_id', '=', $value);
            });
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(EntryRequest::class);

        CRUD::field('survey_id');
        CRUD::field('university_id');
        CRUD::field('participant_id');
    }
}
