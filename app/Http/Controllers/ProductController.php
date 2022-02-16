<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $products = Product::latest()->get();
       return response()->json($products,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=> 'required',
            'price'=> 'required',
            'description'=> 'required',

        ]);
       

        $data = new Product();
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->price= $request->price;
        $data->description= $request->description;
       if ($request->file('image')) 
    	{
    		
    		$file=$request->file('image');
    		$filename=date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('storage/product'),$filename);
    		$data['image']=$filename;
    	}
        $data->save();
        return response()->json('success',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
          if ($product){
           return response()->json($product,200);
       }else {
           return response()->json('failed',404);
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
       
         $this->validate($request, [
            'title' => "required|max:255|unique:products,title, $product->id",
            'price' => 'required|integer',
            'image' => 'sometimes|nullable|image|max:2048',
            'description' => 'required',
            
        ]);

        $product->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'price' => $request->price,
            'description' => $request->description,
            
        ]);

        if ($request->image) {
           $file=$request->file('image');
           @unlink(public_path('storage/product'.$product->image))	;
    		$filename=date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('storage/product'),$filename);
    		$product['image']=$filename;
           
        }
         $product->save();
        return response()->json('success',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
         if ($product){
             $product->delete();
           return response()->json($product,200);
       }else {
           return response()->json('failed',404);
       }
    }
}
