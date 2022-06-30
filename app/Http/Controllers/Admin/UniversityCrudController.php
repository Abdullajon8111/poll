<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UniversityChangeStatusRequest;
use App\Http\Requests\UniversityRequest;
use App\Models\AdminUser;
use App\Models\Survey;
use App\Models\University;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
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

    public function surveys()
    {
        $surveys = Survey::all();
        return view('admin.university.select-survey', compact('surveys'));
    }

    public function changeStatus(University $university)
    {
        $status = $university->enabled;
        $university->enabled = !$status;
        $university->save();

        return redirect()->back();
    }

    protected function setupListOperation()
    {
        /** @var $user AdminUser */
        $user = auth('admin')->user();
        $u_ids = [];

        if ($user->hasRole(AdminUser::OPERATOR_ROLE)) {

            $u_ids = $user->universities->pluck('id')->toArray();
            $this->crud->query = University::whereIn('id', $u_ids);
        }

        CRUD::column('id');

        CRUD::column('name')->type('view')->view('admin.university.columns.name');
        CRUD::column('slug');
        CRUD::column('enabled')->type('view')->view('admin.university.columns.toggle');
        CRUD::column('url')->type('view')->view('admin.university.columns.url');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(UniversityRequest::class);

        CRUD::field('name');
        CRUD::field('slug');
        CRUD::field('enabled')->type('toggle');
    }
}
