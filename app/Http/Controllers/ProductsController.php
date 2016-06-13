<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductsComments;
use App\Http\Requests\ProductsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    protected $originalSizeImagePath = "assets/images/Products_images/original/";
    protected $resize150ImagePath = "assets/images/Products_images/150x150/";

    public function __construct()
    {

        $this->middleware('auth', ['except' => 'index']);
    }

    public function index ()
    {
        
        $original = $this->originalSizeImagePath;
        $productsAll = Product::latest('created_at')->get();
        return view('products.index', compact('productsAll', 'original'));
    }

    public function create()
    {

        return view('products.add');
    }

    public function store (ProductsRequest $request)
    {


        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->count = $request->count;
        if(isset($request->image)) {
            $product->image_path = $request->image->getClientOriginalName();
            $request->image->move($this->originalSizeImagePath, $request->image->getClientOriginalName());
        }
        //$request->image->move($this->resize150ImagePath, $resize);
        $resize = $this->originalSizeImagePath . $request->image->getClientOriginalName();
        /*$resize->resize(150, 150);
        dd($resize);*/
        $product->save();
        return redirect("/market");
    }

    public function show ($id)
    {

        $original = $this->originalSizeImagePath;
        $comments = ProductsComments::latest('created_at')->where('product_id', '=', $id)->get();
        $chosenProduct = Product::findOrFail($id);
        return view('products.view',compact('chosenProduct', 'comments', 'original'));
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
