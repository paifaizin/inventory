<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InventoryLocation;

class InventoryLocationController extends Controller
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
            $location = InventoryLocation::orderBy('id','DESC')->where('title', 'like', "$search%")->paginate(5);
        }else{
            $location = InventoryLocation::orderBy('id','DESC')->paginate(5);    
        }
        
        return view('InventoryLocation.index',compact('location'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('InventoryLocation.create');
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
            'title' => 'required|unique:inventory_locations',
            'address' => 'required',
            'status' => 'required',
        ]);

        InventoryLocation::create($request->all());
        return redirect()->route('location.index')
                        ->with('success','Location created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = InventoryLocation::find($id);
        return view('InventoryLocation.show',compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = InventoryLocation::find($id);
        return view('InventoryLocation.edit',compact('location'));
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

        InventoryLocation::find($id)->update($request->all());
        return redirect()->route('location.index')
                        ->with('success','Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InventoryLocation::find($id)->delete();
        return redirect()->route('location.index')
                        ->with('success','Location deleted successfully');
    }
}
