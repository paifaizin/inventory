<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InventoryCategori;

class InventoryCategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = isset($_GET['title']) ? $_GET['title'] : '';
        if($search != ''){
            $categori = InventoryCategori::orderBy('id','DESC')->where('title', 'like', "$search%")->paginate(5);
        }else{
            $categori = InventoryCategori::orderBy('id','DESC')->paginate(5);    
        }
        
        return view('InventoryCategori.index',compact('categori'))
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
        
        $categori = InventoryCategori::orderBy('id','DESC')->paginate(5);
        
        return view('InventoryCategori.index',compact('categori'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('InventoryCategori.create');
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
            'title' => 'required|unique:inventory_categoris',
            'status' => 'required',
        ]);

        InventoryCategori::create($request->all());
        return redirect()->route('kategori.index')
                        ->with('success','InventoryCategori created successfully');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categori = InventoryCategori::find($id);
        return view('InventoryCategori.show',compact('categori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categori = InventoryCategori::find($id);
        return view('InventoryCategori.edit',compact('categori'));
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
            'title' => 'required',
            'status' => 'required',
        ]);

        InventoryCategori::find($id)->update($request->all());
        return redirect()->route('kategori.index')
                        ->with('success','InventoryCategori updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InventoryCategori::find($id)->delete();
        return redirect()->route('kategori.index')
                        ->with('success','InventoryCategori deleted successfully');
    }
}
