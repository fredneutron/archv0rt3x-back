<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BioRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BioCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BioCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Bio::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bio');
        CRUD::setEntityNameStrings('bio', 'bio');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BioRequest::class);

        // CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
        CRUD::addField( [
            'name' => 'first_name',
            'label' => 'First name',
            'type' => 'text'
        ]);

        CRUD::addField( [
            'name' => 'other_name',
            'label' => 'Other name',
            'type' => 'text'
        ]);

        CRUD::addField( [
            'name' => 'last_name',
            'label' => 'Last name',
            'type' => 'text'
        ]);

        CRUD::addField( [
            'name' => 'objective',
            'label' => 'Objective',
            'type' => 'summernote'
        ]);

        CRUD::addField( [
            'name' => 'gender',
            'label' => 'Gender',
            'type' => 'radio',
            'options' => [
                'Male' => 'Male',
                'Female' => 'Female'
            ]
        ]);

        CRUD::addField( [
            'name' => 'date_of_birth',
            'label' => 'Birthday',
            'type' => 'date_picker',
            'date_picker_options' => [
                'format' => 'dd-mm-yyyy',
                'language' => 'en'
            ]
        ]);

        CRUD::addField( [
            'name' => 'residential_address',
            'label' => 'Home Address',
            'type' => 'address'
        ]);

        CRUD::addField( [
            'name' => 'current_location',
            'label' => 'Current location',
            'type' => 'address'
        ]);

        CRUD::addField( [
            'name' => 'state_of_origin',
            'label' => 'State Of Origin',
            'type' => 'address'
        ]);

        CRUD::addField( [
            'name' => 'nationality',
            'label' => 'Nationality',
            'type' => 'text',
        ]);
        
        CRUD::addField( [
            'name' => 'profile_picture',
            'label' => 'Profile Picture',
            'type' => 'image',
            'upload' => true,
            'crop' => true,
            'prefix' => env('Storage_Prefix'),
        ]);

        CRUD::addField( [
            'name' => 'email',
            'label' => 'Email address',
            'type' => 'email'
        ]);

        CRUD::addField( [
            'name' => 'phone_number',
            'label' => 'Phone number',
            'type' => 'number'
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
