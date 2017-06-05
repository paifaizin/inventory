<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InventoryProduct;
use App\InventoryCategori;
use App\InventoryUnit;

class InventoryProductController extends Controller
{
    public function __construct()
    {
        // parent::__construct();

        $this->salesmetode = array(
            "0" => "Moving Average",
        );

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = isset($_GET['title']) ? $_GET['title'] : '';
        if($search != ''){
            $product = InventoryProduct::orderBy('id','DESC')->where('name', 'like', "$search%")->paginate(5);
        }else{
            $product = InventoryProduct::orderBy('id','DESC')->paginate(5);    
        }
        
        return view('InventoryProduct.index',compact('product'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        
        $product = InventoryProduct::orderBy('id','DESC')->paginate(5);
        
        return view('InventoryProduct.index',compact('product'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = InventoryCategori::all('id','title as name');
        $categori = array();
        if($product){
            foreach ($product as $key => $value) {

                $categori[$value->id] = $value->name;
            }
        }
        
        $satuan = InventoryUnit::all('id','title as name');
        $unit = array();
        if($satuan){
            foreach ($satuan as $key => $value) {

                $unit[$value->id] = $value->name;
            }
        }


        // metode 
        $salesmetode = $this->salesmetode;
        
        return view('InventoryProduct.create', compact("categori", "unit", "salesmetode"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:inventory_products',
            'name' => 'required|unique:inventory_products',
            
        ]);
        // print_r($request->all());die;
        $data = $request->all();
        $data['sellingAutoPercentage'] = ($data['costOfGoodSales'] / $data['sellingManualPrice']) * 100;
        InventoryProduct::create($data);
        return redirect()->route('product.index')
                        ->with('success','Product created successfully');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = InventoryProduct::find($id);
        $kategori = InventoryCategori::find($product->productCategoryId);
        $unit = InventoryUnit::find($product->productUnitId);
        return view('InventoryProduct.show',compact('product', 'kategori','unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = InventoryCategori::all('id','title as name');
        $categori = array();
        if($product){
            foreach ($product as $key => $value) {

                $categori[$value->id] = $value->name;
            }
        }
        
        $satuan = InventoryUnit::all('id','title as name');
        $unit = array();
        if($satuan){
            foreach ($satuan as $key => $value) {

                $unit[$value->id] = $value->name;
            }
        }


        // metode 
        $salesmetode = $this->salesmetode;

        $product = InventoryProduct::find($id);
        return view('InventoryProduct.edit',compact('product',"categori", "unit", "salesmetode"));
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
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            
        ]);

        InventoryProduct::find($id)->update($request->all());
        return redirect()->route('product.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InventoryProduct::find($id)->delete();
        return redirect()->route('product.index')
                        ->with('success','Product deleted successfully');
    }


    public function searchjson(Request $request)
    {
        $results=array();
        $item = $request->input(['product_name']);

        $product = InventoryProduct::orderBy('name','DESC')->where('name', 'like', '%' .$item.'%')->take(10)->get();

        foreach ($product as $data) {

            $results[]=['id'=>$data->id,'value'=>$data->name];
        
        }

        return response()->json($results);
    }
}
