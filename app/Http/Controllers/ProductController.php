<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProductController extends Controller

{ 

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {
        $this->middleware('permission:list-product');
        $this->middleware('permission:create-product', ['only' => ['create','store']]);
        $this->middleware('permission:edit-product', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-product', ['only' => ['destroy']]);

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()
    {

        $products = Product::latest()->paginate(5);
        return view('product.index',compact('products'));
    }

    //Return datatables response
    public function datatables(Request $request)
    {
        $data = Product::select([
            'id',
            'name',
            'product_category_id',
            'product_unit_id',
            'detail',
        ])
        ->with(['product_category', 'product_unit']);
        
        $datatables = Datatables::of($data)
            ->addColumn('checkbox', function($data){
                return '';
            });
        

        return $datatables->make(true);
    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('product.create');

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'product_category_id' => 'required',
            'product_unit_id' => 'required',
            'detail' => 'required',
        ]);
        Product::create($request->all());
        return redirect()->route('product.index')
                        ->with('success','Product created successfully.');

    }


    /**

     * Display the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function show(Product $product)

    {

        return view('product.show',compact('product'));

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function edit(Product $product)

    {

        return view('product.edit',compact('product'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Product $product)

    {

         request()->validate([

            'name' => 'required',

            'detail' => 'required',

        ]);


        $product->update($request->all());


        return redirect()->route('product.index')

                        ->with('success','Product updated successfully');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function destroy(Product $product)

    {

        $product->delete();


        return redirect()->route('product.index')

                        ->with('success','Product deleted successfully');

    }

}
