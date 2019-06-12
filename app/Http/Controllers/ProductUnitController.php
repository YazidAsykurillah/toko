<?php

namespace App\Http\Controllers;

use App\ProductUnit;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

//Form requests
use App\Http\Requests\StoreProductUnit;
use App\Http\Requests\UpdateProductUnit;

class ProductUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product-unit.index');
    }

    //Return datatables response
    public function datatables(Request $request)
    {
        $data = ProductUnit::select([
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
        return view('product-unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductUnit $request)
    {
        ProductUnit::create($request->all());
        return redirect('product-unit')
            ->with('successMessage', "Product unit has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productUnit = ProductUnit::findOrFail($id);
        return view('product-unit.show')
            ->with('productUnit', $productUnit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productUnit = ProductUnit::findOrFail($id);
        return view('product-unit.edit')
            ->with('productUnit', $productUnit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductUnit $request, $id)
    {
        $productUnit = ProductUnit::findOrFail($id);
        $productUnit->name = $request->name;
        $productUnit->description = $request->description;
        $productUnit->save();
        return redirect('product-unit/'.$id)
            ->with('successMessage', "Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productUnit = ProductUnit::findOrFail($id);
        
        if($productUnit->delete()){
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
            ->with('successMessage', "$deleted product unit has been deleted");

    }

    public function select2(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = \DB::table("product_units")
                ->select("id","name")
                ->where('name','LIKE',"%$search%")
                ->get();
        }
        else{
            $data = \DB::table("product_units")
                    ->select("id","name")
                    ->get();
            
        }
        return response()->json($data);
    }
}
