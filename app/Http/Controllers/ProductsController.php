<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductsComments;
use App\Http\Requests\ProductsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

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

        $comments = ProductsComments::latest('created_at')->where('product_id', '=', $id)->get();
        $chosenProduct = Product::findOrFail($id);
        return view('products.view',compact('chosenProduct', 'comments'));
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
    
    public function comment (Request $request)
    {

        $comment = ProductsComments::create($request->all());
        
        if($comment){
 
            $info = array(
              'name' => $request['name'],
              'email' => $request['email']
            );

              $mail = function($message) use ($request) {
                  $message->from('market@gmail.com', 'Admin');
                  $message->to($request['email']);
              };

            //$result = Mail::send('email._comment', $info, $mail);
            //its work just enter you gmail,password and change configs, allow access for laravel

            $response = ProductsComments::latest('created_at')->where('product_id', '=', $request['product_id'])->first();
            $response = json_encode($response);
            return response()->json(['data' => $response]);
        }
    }
}
