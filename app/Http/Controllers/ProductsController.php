<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductImage;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
	 private $image_folder_path = 'product_images';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		 $data = array();
		 $data['products'] = Product::all();
		 $data['title'] = 'Products';

		 return view('products.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$data = array(
			"title" => 'Add Product',
			"product_categories" => ProductCategory::all()
		);

		return view('products.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$validated_data = $request->validate([
			'title' => 'required',
			'model' => 'required',
			'price' => 'required',
			'quantity' => 'required',
			'description' => 'required',
			'category_id' => 'required',
			'image_uri' => 'image|required|max:1999'
		]);

		// Handle file upload
		if($request->hasFile('image_uri')){
			// Get filename with extension
			$filenameWithExt = $request->file('image_uri')->getClientOriginalName();
			// Get just file name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			// Get just extension
			$extension = $request->file('image_uri')->getClientOriginalExtension();
			// File name to store
			$fileNameToStore = $filename . '_' . time() . '.' . $extension;
			// Upload image
			$request->file('image_uri')->storeAs('public/'.$this->image_folder_path, $fileNameToStore);
		} 

		$product = new Product;
		$product->category_id = $request->category_id;
		$product->title = $request->title;
		$product->model = $request->model;
		$product->description = $request->description;
		$product->price = $request->price;
		$product->quantity = $request->quantity;
		$product->save();

		$product_image = new ProductImage;
		$product_image->product_id = $product->id;
		$product_image->image_uri = $fileNameToStore;

		$product_image->save();

		return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$data = array(
			'title' => "Edit Product",
			'product' => Product::find($id),
			'product_categories' => ProductCategory::all()
		);
		//return $data['product']->images[0]->image_uri;
		return view('products.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		 $count = Product::destroy($id);
		 if($count > 0) {
			 return response()->json(['message' => 'Product deleted successfully']);
		 }
		 return response()->json(['message' => 'Something went wrong']);
    }
}
