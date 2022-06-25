<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SeparatorRequest;
use App\Models\AdminUser;
use App\Models\Separator;
use App\Models\University;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SeparatorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SeparatorCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        CRUD::setModel(Separator::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/separator');
        CRUD::setEntityNameStrings('separator', 'separators');
    }

    protected function setupListOperation()
    {
        CRUD::column('university_id');
        CRUD::column('admin_user_id');

        CRUD::addFilter([
            'name' => 'university',
            'type' => 'dropdown'
        ], University::pluck('name', 'id')->toArray(),
            function ($value) {
               $this->crud->addClause('where', 'university_id', '=', $value);
            });

        CRUD::addFilter([
            'name' => 'admin_user',
            'type' => 'dropdown'
        ], AdminUser::pluck('name', 'id')->toArray(),
            function ($value) {
                $this->crud->addClause('where', 'admin_user_id', '=', $value);
            });
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(SeparatorRequest::class);

        CRUD::field('university_id');
        CRUD::field('admin_user_id');
    }
}
