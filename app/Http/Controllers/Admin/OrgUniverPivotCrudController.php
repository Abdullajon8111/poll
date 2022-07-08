<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrgUniverPivotRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OrgUniverPivotCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrgUniverPivotCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\OrgUniverPivot::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/org-univer-pivot');
        CRUD::setEntityNameStrings('', '');
    }

    protected function setupListOperation()
    {
        CRUD::column('univer_category_id');
        CRUD::column('org_category_id');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrgUniverPivotRequest::class);

        CRUD::field('univer_category_id');
        CRUD::field('org_category_id');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
