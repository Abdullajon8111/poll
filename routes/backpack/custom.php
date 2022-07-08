<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    Route::middleware(['role:admin,admin'])->group(function () {
        Route::crud('survey', 'SurveyCrudController');
        Route::crud('section', 'SectionCrudController');
        Route::crud('question', 'QuestionCrudController');

        Route::crud('entry', 'EntryCrudController');
        Route::get('entry/ajax-organization-options', 'EntryCrudController@orgOptions')->name('admin.entry.options');

        Route::crud('answer', 'AnswerCrudController');

        Route::crud('operator', 'OperatorCrudController');

        Route::crud('organization', 'OrganizationCrudController');
        Route::crud('separator', 'SeparatorCrudController');
    });

    Route::crud('university', 'UniversityCrudController');

    Route::get('university/generate-url', 'UniversityCrudController@generateUrl')->name('admin.university.generate-url');
    Route::get('university/change-status-all', 'UniversityCrudController@changeStatusAll')->name('change-status-all');

    Route::get('get-university-list', 'UniversityCrudController@surveys')->name('admin.surveys.list');
    Route::get('change-university-enabled-status/{university}', 'UniversityCrudController@changeStatus')->name('admin.university.changeStatus');

    Route::crud('org-category', 'OrgCategoryCrudController');
    Route::crud('univer-category', 'UniverCategoryCrudController');
    Route::crud('org-univer-pivot', 'OrgUniverPivotCrudController');
}); // this should be the absolute last line of this file
