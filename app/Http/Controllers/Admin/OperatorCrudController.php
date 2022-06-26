<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OperatorRequest;
use App\Models\AdminUser;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class OperatorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OperatorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(AdminUser::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/operator');
        CRUD::setEntityNameStrings('operator', 'operators');
    }

    protected function setupListOperation()
    {
        $this->crud->query = AdminUser::whereHas('roles', function (Builder $query) {
           $query->where('name', AdminUser::OPERATOR_ROLE);
        });

        CRUD::column('name');
        CRUD::column('email');
        CRUD::column('universities');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OperatorRequest::class);

        CRUD::field('universities');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
