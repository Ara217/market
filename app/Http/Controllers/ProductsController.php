<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function index ()
    {

        $productsAll = Product::all();
        return view('Market')->with('ProductList', $productsAll);
    }

    public function create()
    {

        return view('Add');
    }

    public function store (ProductsRequest $request)
    {

        Product::create($request->all());
        return redirect("/market");
    }

    public function show ($id)
    {

        $chosenProduct = Product::findOrFail($id);
        return view('ProductPage',compact('chosenProduct'));
    }
    

    public function edit ($id)
    {
        
        $product = Product::findOrFail($id);
        return view('Edit', compact('product'));
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
        $productUpdate = Product::findOrFail($id);
        
    }
}
