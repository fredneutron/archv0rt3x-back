<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WorkRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WorkCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WorkCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Work::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/work');
        CRUD::setEntityNameStrings('work', 'works');
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
        CRUD::setValidation(WorkRequest::class);

        // CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */

        CRUD::addField( [
            'name' => 'position',
            'label' => 'Position',
            'type' => 'text'
        ]);

        CRUD::addField( [
            'name' => 'company',
            'label' => 'Company name',
            'type' => 'text'
        ]);

        CRUD::addField( [
            'name' => 'description',
            'label' => 'Description',
            'type' => 'summernote'
        ]);

        CRUD::addField( [
            'name' => 'start_on',
            'label' => 'Start',
            'type' => 'date_picker',
            'date_picker_options' => [
                'format' => 'mm-yyyy',
                'language' => 'en',
                'viewMode'=> 'months',
                'minViewMode'=> 'months'
            ]
        ]);

        CRUD::addField( [
            'name' => 'end_on',
            'label' => 'End',
            'type' => 'date_picker',
            'date_picker_options' => [
                'format' => 'mm-yyyy',
                'language' => 'en',
                'viewMode'=> 'months',
                'minViewMode'=> 'months'
            ]
        ]);

        CRUD::addField( [
            'name' => 'user_id',
            'label' => 'User',
            'type' => 'select',
            'entity' => 'user',
            'attribute' => 'name',
            'model' => '\App\Models\User'
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
