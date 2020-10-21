<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class NotifController extends Controller
{
    
    public function success(){
        Session::flash('success','Ini pesan sukses');
        return redirect('pesan');
    }
    
    public function error(){
        Session::flash('error','Ini pesan gagal');
        return redirect('pesan');
    }
}
