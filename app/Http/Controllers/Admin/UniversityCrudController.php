<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UniversityChangeStatusRequest;
use App\Http\Requests\UniversityRequest;
use App\Models\AdminUser;
use App\Models\Survey;
use App\Models\UniverCategory;
use App\Models\University;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use DB;
use Str;
use Throwable;

/**
 * Class UniversityCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class UniversityCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        CRUD::setModel(University::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/university');
        CRUD::setEntityNameStrings('university', 'universities');

        CRUD::setListView('admin.university.list');
    }

    public function surveys()
    {
        $surveys = Survey::all();
        return view('admin.university.select-survey', compact('surveys'));
    }

    public function generateUrl()
    {
        $universities = University::all();

        try {
            DB::beginTransaction();
            foreach ($universities as $university) {
                $university->slug = Str::uuid();
                $university->save();
            }

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
        }

        return back();
    }

    public function changeStatusAll()
    {
        $universities = University::all();

        try {
            DB::beginTransaction();
            foreach ($universities as $university) {
                $status = $status ?? !$university->enabled;
                $university->enabled = $status;
                $university->save();
            }

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
        }

        return back();
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
        $this->crud->query = University::with(['entries', 'entries.participant']);

        CRUD::column('#')->type('row_number');

        CRUD::column('name')->type('view')->view('admin.university.columns.name');
        CRUD::column('category_id');
//        CRUD::column('slug');
        CRUD::column('enabled')->type('view')->view('admin.university.columns.toggle');
        CRUD::column('url')->type('view')->view('admin.university.columns.url');

        CRUD::addButton('top', 'generate_url', 'view', 'university.buttons.generate');
        CRUD::addButton('top', 'all_on_off', 'view', 'university.buttons.all_on_off');

        $this->isOperator();

        session(['surveys' => Survey::all()]);
        CRUD::addFilter([
            'name' => 'survey',
            'type' => 'select2',
            'label' => __('Survey')
        ], Survey::pluck('name', 'id')->toArray(), function ($value) {
            session(['surveys' => Survey::whereId($value)->get()]);
        });

        CRUD::addFilter([
            'name' => 'name',
            'type' => 'text',
            'label' => __('Name')
        ], null, function ($value) {
            $this->crud->addClause('where', 'name', 'like', "%{$value}%");
        });

        CRUD::addFilter([
            'name' => 'category_id',
            'type' => 'select2',
            'label' => __('Category')
        ], UniverCategory::pluck('name', 'id')->toArray(), function ($value) {
            $this->crud->addClause('where', 'univer_category_id', '=', $value);
        });

        CRUD::addColumn(['name' => 'count_table', 'type' => 'view', 'view' => 'university.columns.count_table']);
    }

    private function isOperator()
    {
        /** @var $user AdminUser */
        $user = auth('admin')->user();
        $u_ids = [];

        if ($user->hasRole(AdminUser::OPERATOR_ROLE)) {

            $u_ids = $user->universities->pluck('id')->toArray();
            $this->crud->query = University::whereIn('id', $u_ids);

            CRUD::denyAccess(['update', 'create', 'delete', 'show']);
            CRUD::removeColumn('slug');
            CRUD::removeColumn('url');
            CRUD::removeButton('generate_url');
        }
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
