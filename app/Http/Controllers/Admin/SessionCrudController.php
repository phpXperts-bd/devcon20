<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SessionRequest;
use App\Support\Utility;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

/**
 * Class SessionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SessionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use Utility;

    public function setup()
    {
        $this->checkAdmin();
        $this->crud->setModel('App\Models\Session');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/session');
        $this->crud->setEntityNameStrings('session', 'sessions');

        $this->crud->enableExportButtons();
    }
   
    protected function setupListOperation()
    {
        $this->crud->enableBulkActions();

        $this->crud->addColumns([
            [
                'name' => 'id',
                'type' => 'text',
                'label' => 'ID #'
            ],
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Title',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('title', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'start_time',
                'type' => 'datetime',
                'label' => 'Start Time'
            ],
            [
                'name' => 'end_time',
                'type' => 'datetime',
                'label' => 'End Time'
            ],
            [
                'name' => 'slug',
                'type' => 'text',
                'label' => 'Slug'
            ],
            [
                'name' => 'speakers',
                'type' => 'text',
                'label' => 'Speakers',
            ],
            [
                'name' => 'active',
                'type' => 'radio',
                'label' => 'Active',
                'options'     => [
                    0 => 'Inactive',
                    1 => 'Active'
                ]
            ]            
        ]);

    }
  
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SessionRequest::class);

        $this->crud->addFields([
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Title'
            ],
            [
                'name' => 'slug',
                'type' => 'text',
                'label' => 'Slug'
            ],
            [
                'name' => 'description',
                'type' => 'text',
                'label' => 'Description'
            ],
            [
                'name' => 'recording_url',
                'type' => 'text',
                'label' => 'Recording Url'
            ],
            [
                'name' => 'speakers',
                'label' => 'Speakers',
                'attribute' => 'name',
                'model' => "\App\Models\Speaker",
                'placeholder' => "Select one or more speakers",
                'stores_in' => 'speakers'
            ],
            [
                'name' => 'start_time',
                'type' => 'datetime',
                'label' => 'Start Time',
                'date_picker_options' => [
                    'todayBtn' => 'linked',
                    'format' => 'dd-mm-yyyy HH:mm',
                    'language' => 'en',
                    'timePicker' => true
                ]
            ],
            [
                'name' => 'end_time',
                'type' => 'datetime',
                'label' => 'End Time',
                'date_picker_options' => [
                    'todayBtn' => 'linked',
                    'format' => 'dd-mm-yyyy HH:mm',
                    'language' => 'en',
                    'timePicker' => true
                ]
            ],
            [
                'name' => 'active',
                'type' => 'checkbox',
                'label' => 'Active',
                'default'=> 1
            ],
            [
                'name' => 'slide_url',
                'type' => 'url',
                'label' => 'Slide Url'
            ],
            [
                'name' => 'codebase_url',
                'type' => 'url',
                'label' => 'Sample Codebase Url'
            ],
            [
                'name' => 'seo_keywords',
                'type' => 'text',
                'label' => 'SEO Keywords'
            ],
            [
                'name' => 'seo_description',
                'type' => 'text',
                'label' => 'SEO Description'
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }    
}
