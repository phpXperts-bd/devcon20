<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SpeakerRequest;
use App\Models\Speaker;
use App\Support\Utility;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

/**
 * Class SpeakerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SpeakerCrudController extends CrudController
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
        $this->crud->setModel('App\Models\Speaker');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/speaker');
        $this->crud->setEntityNameStrings('speaker', 'speakers');

        $this->crud->enableExportButtons();
    }

    protected function setupListOperation()
    {
        $this->crud->enableBulkActions();
        
        $this->crud->addColumns([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Name',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('name', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'slug',
                'type' => 'text',
                'label' => 'Slug'
            ],
            [
                'name' => 'about',
                'type' => 'text',
                'label' => 'About'
            ],
            [
                'name' => 'photo_url',
                'type' => 'text',
                'label' => 'Photo Url'
            ],
            [
                'name' => 'designation',
                'type' => 'text',
                'label' => 'Designation',
            ],
            [
                'name' => 'company',
                'type' => 'text',
                'label' => 'Company',
            ],
            [
                'name' => 'active',
                'type' => 'radio',
                'label' => 'Active',
                'options'     => [
                    0 => 'Inactive',
                    1 => 'Active'
                ]
            ],
            [
                'name' => 'email',
                'type' => 'text',
                'label' => 'Email'
            ],
            [
                'name' => 'phone',
                'type' => 'text',
                'label' => 'Phone'
            ],
            [
                'name' => 'twitter',
                'type' => 'text',
                'label' => 'Twitter'
            ],
            [
                'name' => 'facebook',
                'type' => 'text',
                'label' => 'Facebook'
            ],
            [
                'name' => 'linkedin',
                'type' => 'text',
                'label' => 'Linkedin'
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
  
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SpeakerRequest::class);

        $this->crud->addFields([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Name',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('name', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'slug',
                'type' => 'text',
                'label' => 'Slug'
            ],
            [
                'name' => 'about',
                'type' => 'text',
                'label' => 'About'
            ],
            [
                'name' => 'photo_url',
                'type' => 'text',
                'label' => 'Photo Url'
            ],
            [
                'name' => 'designation',
                'type' => 'text',
                'label' => 'Designation',
            ],
            [
                'name' => 'company',
                'type' => 'text',
                'label' => 'Company',
            ],
            [
                'name' => 'active',
                'type' => 'checkbox',
                'label' => 'Active',
                'default'=> 1
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email'
            ],
            [
                'name' => 'phone',
                'type' => 'text',
                'label' => 'Phone'
            ],
            [
                'name' => 'twitter',
                'type' => 'text',
                'label' => 'Twitter'
            ],
            [
                'name' => 'facebook',
                'type' => 'text',
                'label' => 'Facebook'
            ],
            [
                'name' => 'linkedin',
                'type' => 'text',
                'label' => 'Linkedin'
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
