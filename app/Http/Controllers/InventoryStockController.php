<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InventoryProduct;
use App\InventoryCategori;
use App\InventoryUnit;
use App\InventoryLocation;
use App\InventoryStock;
use App\InventoryStockDetail;

class InventoryStockController extends Controller
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
            $stock = InventoryStock::orderBy('id','DESC')->from('inventory_stocks as stocks')->join('inventory_stock_details as det','det.stockId','stocks.id')->where('name', 'like', "$search%")->paginate(5);
        }else{
            $stock = InventoryStock::orderBy('id','DESC')->from('inventory_stocks as stocks')->join('inventory_stock_details as det','det.stockId','stocks.id')->paginate(5);    
        }

        
        return view('InventoryStock.index',compact('stock'))
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
        
        $product = InventoryStock::orderBy('id','DESC')->paginate(5);
        
        return view('InventoryStock.index',compact('product'))
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
        
        $row = InventoryLocation::all('id','title as name');
        $location = array();
        if($row){
            foreach ($row as $key => $value) {

                $location[$value->id] = $value->name;
            }
        }


        // metode 
        $salesmetode = $this->salesmetode;
        
        return view('InventoryStock.create', compact("categori", "location", "salesmetode"));
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
        return view('InventoryProduct.show',compact('product'));
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
}
