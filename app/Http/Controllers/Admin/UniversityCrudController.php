<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UniversityRequest;
use App\Models\Survey;
use App\Models\University;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UniversityCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UniversityCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\University::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/university');
        CRUD::setEntityNameStrings('university', 'universities');

        CRUD::setListView('admin.university.list');
    }

    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('name');
        CRUD::column('slug');
        CRUD::column('enabled')->type('check');
        CRUD::column('url')->type('view')->view('admin.university.columns.url');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(UniversityRequest::class);

        CRUD::field('name');
        CRUD::field('slug');
        CRUD::field('enabled')->type('toggle');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function surveys()
    {
        $surveys = Survey::all();
        return view('admin.university.select-survey', compact('surveys'));
    }
}
