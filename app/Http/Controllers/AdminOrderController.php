<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function update($id){
        return view('orders-details', ['id' => $id]);
    }
}
