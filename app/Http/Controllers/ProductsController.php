<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index ()
    {

        $productsAll = Product::latest('created_at')->get();
        return view('products.index', compact('productsAll'));
    }

    public function create()
    {

        return view('products.add');
    }

    public function store (ProductsRequest $request)
    {

        Product::create($request->all());
        return redirect("/market");
    }

    public function show ($id)
    {

        $chosenProduct = Product::findOrFail($id);
        return view('products.view',compact('chosenProduct'));
    }
    

    public function edit ($id)
    {
        
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    
    
    public function update($id, ProductsRequest $request)
    {

        $productUpdate = Product::findOrFail($id);
        $productUpdate->update($request->all());
        Session::flash('update', 'Product successfully updated!');
        return redirect("/market/$id");
    }

    public function destroy ($id)
    {
        
        $productDelete = Product::findOrFail($id);
        $delete = $productDelete->delete();
        return response()->json(['success' => $delete]);
    }
}
