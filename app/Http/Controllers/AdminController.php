<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $users = User::all();
        $staffs = Staff::all();
        return view('admin', ['products' => $products,'users' => $users,'staffs' => $staffs]);
    }

}