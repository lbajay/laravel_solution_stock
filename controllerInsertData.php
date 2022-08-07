<?php

namespace App\Http\Controllers;

use App\Models\Machinetypes; // this is model import
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class insertdata extends Controller
{
    protected $data;
    protected $db;
    protected $other;
 // start store data by model
    public function store(Request $request){
        $this->data = $request->all();

        $this->db = new Machinetypes();
        $this->db->name = $this->data["name"];
        $this->db->save();

    }
// end store data by model
// start store data by database( DB class)

public function storedata(Request $request){
    $this->data = $request->all();
    $table = "tablenames";
    $values = array("colname" => "values");
    $valarr = array("column2" => "value2");
    $values = array_merge($values, $valarr);
    DB::table($table)->insert($values);
}

}