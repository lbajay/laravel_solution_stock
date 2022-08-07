<?php

namespace App\Http\Controllers;
use App\Models\Machines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\QueryException;

class createmachinetable extends Controller
{
    protected $data;
    protected $db;
    protected $other;
    public function store(Request $request){
        $this->data = $request->all();
        try{
                $fields = [];
                $col = ['name' => 'machinetype', 'type' => 'string'];
                array_push($fields,$col);
// call createTable function
             return $this->createTable($table_name, $fields);

        }
        catch(QueryException $error){
            return response(array("status"=>"error","message"=>"technical issues!"),404)->header("Content-Type","application/json");
        
            }

    }

 //===================================================
 // createTable function define here
 public function createTable($table_name, $fields = [])
 {
     // laravel check if table is not already exists
     if (!Schema::hasTable($table_name)) {
         Schema::create($table_name, function (Blueprint $table) use ($fields, $table_name) {
             $table->increments('id');
             if (count($fields) > 0) {
                 foreach ($fields as $field) {
                     $table->{$field['type']}($field['name']);
                 }
             }
             $table->timestamps();
         });
 
         return response(array("status"=>"success","message"=>"machine addeed."),201)->header("Content-Type","application/json");
     }
 
     return response(array("status"=>"error","message"=>"technical issues."),404)->header("Content-Type","application/json");
 }   

}