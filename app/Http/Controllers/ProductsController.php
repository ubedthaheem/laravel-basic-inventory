<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Rules\ProductCodeRule;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;

class ProductsController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name'  => 'required|min:3',
            'product_code'  => ['required', new ProductCodeRule()],
            'cost'          => 'required|numeric',
            'category_id'   => 'required|numeric',
            'image'         => 'required|image|mimes:jpeg,png,jpg,webp,gif,jpeg',
            'description'   => 'required|min:3'
        ]);

        // upload image
        $image = $this->uploadImage($request->image, $request->product_code); // use product code as image's default prefix

        $data = [
            'product_name'  => $request->product_name,
            'product_code'  => $request->product_code,
            'cost'          => $request->cost,
            'category_id'   => $request->category_id,
            'image'         => $image,
            'description'   => $request->description,
        ];

        // create new row in DB
        Products::create($data);

        return to_route('all.products')->with('message', 'Added new product');
        
    }

     

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $info = Products::findOrFail($id);
        $categories = Categories::all();
        return view('admin.products.edit', compact('categories', 'info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Products::findOrFail($id); // check if product is available

        $request->validate([
            'product_name'  => 'required|min:3',
            'product_code'  => ['required', new ProductCodeRule($product->id)],
            'cost'          => 'required|numeric',
            'category_id'   => 'required|numeric',
            'description'   => 'required|min:3'
        ]);

        
        // check if Image exists
        if($request->has('image') && $request->filled('image'))
        {
            // validate image
            $request->validate(['image'=> 'required|image|mimes:jpeg,png,jpg,webp,gif,jpeg']);
            // update image and remove old image file
            $image = $this->updateImage($request->image, $request->product_code, $product->image);
        }else{
            $image = $product->image;
        }

        // assign input data to the product columns
        $product->product_name  = $request->product_name;
        $product->product_code  = $request->product_code;
        $product->cost          = $request->cost;
        $product->category_id   = $request->category_id;
        $product->image         = $image;
        $product->description   = $request->description;

        // save product
        $product->save();

        return to_route('all.products')->with('message', 'Product updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        $message = [
            'message' => 'Product moved to trash',
            'type' => 'success',
            'icon' => ''
        ];
        return response()->json($message);
    }
}
