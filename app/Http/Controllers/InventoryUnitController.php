<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InventoryUnit;

class InventoryUnitController extends Controller
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
            $unit = InventoryUnit::orderBy('id','DESC')->where('title', 'like', "$search%")->paginate(5);
        }else{
            $unit = InventoryUnit::orderBy('id','DESC')->paginate(5);
        }
        
        return view('InventoryUnit.index',compact('unit'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('InventoryUnit.create');
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
            'title' => 'required|unique:inventory_units',
            'status' => 'required',
        ]);

        InventoryUnit::create($request->all());
        return redirect()->route('unit.index')
                        ->with('success','Unit created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = InventoryUnit::find($id);
        return view('InventoryUnit.show',compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = InventoryUnit::find($id);
        return view('InventoryUnit.edit',compact('unit'));
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

        InventoryUnit::find($id)->update($request->all());
        return redirect()->route('unit.index')
                        ->with('success','Unit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InventoryUnit::find($id)->delete();
        return redirect()->route('unit.index')
                        ->with('success','Unit deleted successfully');
    }
}