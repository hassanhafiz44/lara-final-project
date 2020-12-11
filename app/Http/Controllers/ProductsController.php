<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\Transaction;
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
        $data['products'] = Product::paginate(10);
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
            'retail_price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image_uri' => 'image|max:1999',
        ]);

        $request->request->add(['image_url' => 'default.png']);
        // Handle file upload
        if ($request->hasFile('image_uri')) {
            // Get filename with extension
            $filenameWithExt = $request->file('image_uri')->getClientOriginalName();
            // Get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('image_uri')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload image
            $request->file('image_uri')->storeAs('public/' . $this->image_folder_path, $fileNameToStore);

            $request->request->add(['image_url' => $fileNameToStore]);
        }

        $product = Product::create($request->all());

        $transasction = Transaction::create([
            'type' => 'expense',
            'description' => 'stock_import',
            'amount' => $product->price * $product->quantity,
            'retail_amount' => $product->retail_price * $product->quantity
        ]);

        return redirect(route('admin.products.index'))->with('message', 'Product saved successfully');
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
        abort(404);
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
        $validated_data = $request->validate([
            'title' => 'required',
            'model' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image_uri' => 'image|max:1999',
        ]);

        // Handle file upload
        if ($request->hasFile('image_uri')) {
            // Get filename with extension
            $filenameWithExt = $request->file('image_uri')->getClientOriginalName();
            // Get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('image_uri')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload image
            $request->file('image_uri')->storeAs('public/' . $this->image_folder_path, $fileNameToStore);
        }

        $product = Product::find($id);

        $quantity = $request->input('quantity') - $product->quantity;

        // Transaction logic
        $add_transaction = FALSE;

        if ($quantity < 0) {
            // For stock return, save old price in transaction
            $add_transaction = TRUE;
            $description = 'stock_return';
            $type = 'income';
            $amount = abs($product->price * $quantity); // Notice product->quantity and price
            $retail_amount = abs($product->retail_price * $quantity);
        } else if ($quantity > 0) {
            // For stock import, save new price in transaction
            $add_transaction = TRUE;
            $description = 'stock_import';
            $type = 'expense';
            $amount = $request->price * $quantity;
            $retail_amount = $request->retail_price * $quantity;
        }

        if ($add_transaction === TRUE) {
            $transasction = Transaction::create([
                'type' => $type,
                'description' => $description,
                'amount' => $amount,
                'retail_amount' => $retail_amount
            ]);

            $transasction->save();
        }

        if ($product->image_url !== 'default.png' && isset($fileNameToStore))
            unlink(storage_path('app/public/product_images/' . $product->image_url));
        if (isset($fileNameToStore)) {
            $product->image_url = $fileNameToStore;
        }

        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->model = $request->model;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->retail_price = $request->retail_price;
        $product->quantity = $request->quantity;

        $product->save();

        return redirect(route('admin.products.index'))->with('message', 'Product updated successfully');
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
        $product = Product::find($id);
        $count = Product::destroy($id);
        if ($count > 0) {
            if ($product->image_url !== 'default.png');
            unlink(storage_path('app/public/product_images/' . $product->image_url));
            return response()->json(['message' => 'Product deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong']);
    }
}
