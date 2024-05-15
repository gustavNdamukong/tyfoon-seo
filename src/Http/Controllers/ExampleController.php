<?php

namespace GustoCoder\LaravelDatatable\Http\Controllers;


use App\Http\Controllers\Controller;
use Gustocoder\LaravelDatatable\Http\Controllers\DatatableController;
use App\Models\User;


/**
 * I created this class to leave here in the package as an example of how you would use this package.
 * If you are like me, you like to be shown example, not told, so here you go:) 
 * You would use this feature from within any of your controllers like so:
 * 
 *      namespace App\Http\Controllers;
 * 
 *      use Gustocoder\LaravelDatatable\Http\Controllers\DatatableController;
 * 
 *      class AdminController extends Controller
 *      {
 *          $dataTableClass = new DatatableController('ContactFormMessage', 'contactMessages', []); 
 *          ...
 *      }
 * 
 * After installation
 * The configuration file will be created for you in: 
 * 
 *      'config/laravel-datatable.php'
 * 
 * The stylesheets should be created for you in:
 * 
 *      'public/vendor/datatable.css'
 * 
 * If you have issues, make sure that the LaravelDatatableServiceProvider class is registered in
 * /bootstrap/providers.php
 */
class ExampleController extends Controller
{

    /**
     * Notice how at the end of this method we call getTable() on DatatableController 
     *  and then return a view file 'datatable-view' passing it the table data '$usersTable'.
     * See routes/web.php for example routes on this feature 
     * Inside the view file, we display the table in the table using blade like so:
     * 
     *  {!! $usersTable !!}
     * 
     * It is up to you to style the generated table as you wish.
     * The table is wrapped in a panel with the id of: 'datatablePanel' or any id you specified for it when 
     * you called getTable($panelId)
     * The table element itself also has an id generated from the model name like so id='modelname_table'
     * You may use the panelId and table id attributes to customise the styling of your table.
     */
    public function showUsers()
    {
        /*
        -The first argument here is compulsory and it must be the exact spelling of the model to use.
        -the second argument is the route path you have defined in your route file for the view file where 
            the fetched data from the model will be displayed. It is optional because you may choose to have 
            the records not clickable and, or, not sortable-in which case there will be no anchor links generated
            or fetch more data.
        -The third argument is an associative array of specific fields you want to fetch if you do not want to 
            fetch all fields on the model. The keys are the actual DB table field names, while the values which 
            are optional, are strings you want to appear on the generated table as aliases in place of the table
            field name. 
        -By default, the system assumes that your table has a 'date' field, that is a datetime/timestamp field 
            and its data will be converted for you from the 'Y-m-d' format to the 'd-m-Y' format.  
        -If your table's datetime/timestamp field, is named something other than 'date', and you want this date 
            format conversion, you need to pass a config array to the 4th argument here in order to tell the system 
            the name of your date field. For example, if the name of your date field is 'created_at', pass it like 
            so:
                ['date_field' => 'created_at']  

        -If you do not want this conversion, remove the 'date_field' setting entirely from your config file.
        -By default, the system also orders the date by a 'date' field. If you want ordering to be done using a 
            different field, or if your date field is named something else; pass the config entry here in the 
            4th argument to specify the field to be ordered on by default like so: 
                
                ['orderBy' => 'created_at'] 
        
        -Optionally, if you can set the heading for your table in this same config 4th argument like so:

                ['heading' => 'Users data']

            Otherwise, the system is going to generate this heading for you using the model name you passed in
            like in the format: 'Modelname data'. 
         */
        $dataTableClass = new DatatableController(
            'User', 
            'users', 
            [], 
            ['date_field' => 'created_at', 'orderBy' => 'created_at']
        );

        //give the full route path (NOT the route name) as defined in the route file, eg 'admin/contactMessages'
        $deleteRoute = 'deleteUser'; 
        $editRoute = 'editUsers'; 


        //This is optional, & it creates a new column, eg 'Actions'. It accepts the name of the column 
        //and you can call it whatever you want. It only supports adding one column, so only call this once.
        //You can however, add multiple field buttons under that columns, and the column will be expanded 
        //to contain them all  
        // eg Actions.
        //If you do call addColumn, make sure you also call addFieldButton(...) to insert data under the new column
        $dataTableClass->addColumn('Action'); 

        //used to add field data to go under the column you added above. use this for Edit, or Delete buttons.
        $dataTableClass->addFieldButton('Action', 'Delete', 'x', $deleteRoute, ['id'], ['id' => 'deleteUserBtn', 'class' => 'btn btn-danger btn-sm']);
        $dataTableClass->addFieldButton('Action', 'Edit', 'Edit', $editRoute, ['id'], ['id' => 'editUserBtn', 'class' => 'btn btn-warning btn-sm']);
        //add another button if you want & give it relevant attributes
        $dataTableClass->addFieldButton('Action', 'Something', 'something', 'someRoute', ['id'], ['id' => 'doSomethingBtn', 'class' => 'btn btn-primary btn-sm']);
 
        //override the panel id value-the current/default value is 'datatablePanel'. After setting the id, do not 
        //forget to edit your panel styling in public/vendor/laravel-datatable/css/datatable.css - go in there & edit the styling 
        //for 'datatablePanel'. The reason for allowing you to set an id attribute on the panel that wraps around the table is
        //to allow you use CSS and, or JS to customise the look and behaviour of the table.
        //If you do assign a panelId, do not forget to go into the CSS stylesheet in your public directory and change the panelId 
        //from the default one 'datatablePanel' to the one you have added.

        //Also, do not forget to reference datatable stylesheet from the path where it lives 'vendor/laravel-datatable/css/datatable.css' 
        //from your layout file like so:

        //     <link href="{{ asset('vendor/laravel-datatable/css/datatable.css') }}" rel="stylesheet">    
        $panelId = 'usersPanel';
        $usersTable = $dataTableClass->getTable($panelId);
        return view('laravel-datatable::datatable-view', ['usersTable' => $usersTable]);
    }



    /**
     * An example of how you would delete a record from the datatable-see the delete
     * button link and the route that points to this method
    */
    public function deleteUser($userId)
    {
        $userModel = new User();
        $record = $userModel::find($userId);

        if ($record) {
            $record->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        }
        else 
        {
            return redirect()->back()->with('danger', 'User could not be deleted');
        }
    }
}
