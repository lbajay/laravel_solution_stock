<?php

namespace App\Http\Controllers;
use App\Models\Machinetypes;  
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class addmachinetype extends Controller
{
    protected $data;
    protected $db;
    protected $other;
    public function store(Request $request){ 

        $this->data = $request->input();
        $this->data = strtolower($this->data["machinetype"]);
     try{
        $this->db = new Machinetypes();
        $this->other = $this->db->where("machinetype",$this->data)->get();
        if(count($this->other) != 0){
            return response(array("status"=>"error","message"=>"data found!","data"=>$this->other),208)->header("Content-Type","application/json");
        }
    }
    catch(QueryException $error){
       return response(array("status"=>"error","message"=>"technical issues!"),404)->header("Content-Type","application/json");
   
       }
    }