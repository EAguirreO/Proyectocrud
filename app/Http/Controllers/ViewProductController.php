<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewProductController extends Controller
{
    public function mostrarVista($id){
        return view('vista-producto', compact('id'));
    }
}
