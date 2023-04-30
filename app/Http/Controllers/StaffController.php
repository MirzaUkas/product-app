<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $users = User::all();
        return view('staff', ['products' => $products,'users' => $users]);
    }

    public function create()
    {
        return view('staffs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user' => 'required',
            'gender' => 'required',
            'password' =>  'required',
        ]);
        
        Staff::create([
            'name' => $request->name,
            'user' => $request->user,
            'gender' => $request->gender,
            'password' =>  Hash::make($request['password']),
        ]);

        if(Auth::guard('admin')->check()){
            return redirect()->action([AdminController::class, 'index'])->with('success','Staff Has Been updated successfully');
        }else{
            return redirect()->route('staffs.index')->with('success','Staff Has Been updated successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        return view('staffs.show',compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        return view('staffs.edit',compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $user)
    {
        $request->validate([
            'name' => 'required',
            'user' => 'required',
            'gender' => 'required',
            'password' => 'required',
        ]);

        $input = ([
            'name' => $request->name,
            'user' => $request->user,
            'gender' => $request->gender,
            'password' =>  Hash::make($request['password']),
        ]);
        
        $user->update($input);

        if(Auth::guard('admin')->check()){
            return redirect()->action([AdminController::class, 'index'])->with('success','Staff Has Been updated successfully');
        }else{
            return redirect()->route('staffs.index')->with('success','Staff Has Been updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $user)
    {
        $user->delete();
        if(Auth::guard('admin')->check()){
            return redirect()->action([AdminController::class, 'index'])->with('success','Staff Has Been updated successfully');
        }else{
            return redirect()->route('staff.index')->with('success','Staff Has Been updated successfully');
        }
    }
}
