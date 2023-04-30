<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id','desc')->paginate(5);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'type' => 'required',
            'stock' => 'required',
            'buy_price' => 'required',
            'sell_price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
    
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        
        Product::create($input);

        if(Auth::guard('admin')->check()){
            return redirect()->action([AdminController::class, 'index'])->with('success','Product Has Been updated successfully');
        }else{
            return redirect()->route('products.index')->with('success','Product Has Been updated successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'type' => 'required',
            'stock' => 'required',
            'buy_price' => 'required',
            'sell_price' => 'required',
            'image' => 'required',
        ]);

        $input = $request->all();
    
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
            

        
        $product->update($input);

        if(Auth::guard('admin')->check()){
            return redirect()->action([AdminController::class, 'index'])->with('success','Product Has Been updated successfully');
        }else{
            return redirect()->route('products.index')->with('success','Product Has Been updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        if(Auth::guard('admin')->check()){
            return redirect()->action([AdminController::class, 'index'])->with('success','Product Has Been updated successfully');
        }else{
            return redirect()->route('products.index')->with('success','Product Has Been updated successfully');
        }
    }
}
