<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Mail\sendmail;
use Illuminate\Support\Facades\Mail;
class controllMail extends Controller
{

    protected $email;
    protected $data;
    //  start staff email configration 
    public function staffforget(Request $request){
        $this->data = "password";
        $details = [
           "title" => "Your Password",
           "body" => $this->data
        ];
        Mail::to("lmadesia@gmail.com")->send(new sendmail($details));
       
        return response(array("status"=>"success","data"=>"please check your email we sent password on your email"),200)->header("Content-Type","application/json");
}