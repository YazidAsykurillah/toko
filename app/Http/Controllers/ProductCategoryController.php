<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;


class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product-category.index');
    }

    //Return datatables response
    public function datatables(Request $request)
    {
        $data = ProductCategory::select([
            'id',
            'name',
            'description',
        ]);
        
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
        return view('product-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCategoryRequest $request)
    {
        ProductCategory::create($request->all());
        return redirect()->route('product-category.index')
            ->with('successMessage','ProductCategory has been created');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        return view('product-category.show')
            ->with('productCategory', $productCategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        return view('product-category.edit')
            ->with('productCategory', $productCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCategoryRequest $request, $id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        $productCategory->name = $request->name;
        $productCategory->description = $request->description;
        $productCategory->save();
        return redirect('product-category/'.$id)
            ->with('successMessage', "Product category has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        
        if($productCategory->delete()){
            return TRUE;
        }
        return FALSE;

    }

    public function deleteMultiple(Request $request)
    {
        $deleted = 0;
        foreach($request->id_to_delete as $id){
            if($this->destroy($id) == TRUE){
                $deleted++;
            }
        }
        return redirect()->back()
            ->with('successMessage', "$deleted product category has been deleted");

    }

    public function select2(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = \DB::table("product_categories")
                ->select("id","name")
                ->where('name','LIKE',"%$search%")
                ->get();
        }
        else{
            $data = \DB::table("product_categories")
                    ->select("id","name")
                    ->get();
            
        }
        return response()->json($data);
    }
}
