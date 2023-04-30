<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'password' => 'required',
            'id_card_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
    
        if ($image = $request->file('id_card_photo')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['id_card_photo'] = "$profileImage";
        }
        
        User::create($input);

        if(Auth::guard('admin')->check()){
            return redirect()->action([AdminController::class, 'index'])->with('success','User Has Been updated successfully');
        }else{
            return redirect()->route('users.index')->with('success','User Has Been updated successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'password' => 'required',
            'id_card_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
    
        if ($image = $request->file('id_card_photo')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['id_card_photo'] = "$profileImage";
        }else{
            unset($input['id_card_photo']);
        }
        
        $user->update($input);

        if(Auth::guard('admin')->check()){
            return redirect()->action([AdminController::class, 'index'])->with('success','User Has Been updated successfully');
        }else{
            return redirect()->route('users.index')->with('success','User Has Been updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        if(Auth::guard('admin')->check()){
            return redirect()->action([AdminController::class, 'index'])->with('success','User Has Been updated successfully');
        }else{
            return redirect()->route('user.index')->with('success','User Has Been updated successfully');
        }
    }
}
