<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    // This method will show all products
    public function index()
    {
        // return view('products.list');
        // Fetch products from the database
        $products = Product::paginate(10);  // Paginate for better user experience
        return view('products.list', compact('products'));
    }

    // This method will show create product page
    public function create()
    {
        return view('products.create');
    }

    // This method will store product in db
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:5',
            'price' => 'required|numeric',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.create')->withErrors($validator)->withInput();
        }

        # here we will insert our product in db
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        // here we will store image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/images/'), $imageName);
            $product->image = $imageName;
            $product->save();
        }



        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    // This method will show edit product page
    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // This method will update product in db
    public function update(Request $request, $id)
    {   
        // Fetch the product from db 
        $product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:5',
            'price' => 'required|numeric',
        ];

        if ($request->hasFile('image')) {
            // $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.edit', $id)->withErrors($validator)->withInput();
        }

        // Update the product
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        // If there's a new image, update it
        if ($request->hasFile('image')) {
            // Delete the old image
            File::delete(public_path('uploads/images/' . $product->image));

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/images/'), $imageName);
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // This method will delete product from db
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // delete image
        if ($product->image) {
            File::delete(public_path('uploads/images/' . $product->image));
        }

        // delete product from db
        $product->delete();
        
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
