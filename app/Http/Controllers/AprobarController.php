<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AprobarController extends Controller
{
    //
    function check(Request $request)
    {
        if($request->get('email'))
        {
            $email = $request->get('email');
            $data = DB::table("usuarios")
                ->where('email','LIKE',"%$email%")
                ->count();
                if($data > 0)
                {
                    echo 'not_unique';
                }
                else
                {
                    echo 'unique';
                }
        }
    }
}