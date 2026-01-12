<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Livewire\Admin\PropertyGroups;
use App\Models\Property;
use App\Models\PropertyGroup;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "ليست ويزكي ها";
        return view('admin.property.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "ايجاد ويزكي ";
        $property_groups = PropertyGroup::query()->pluck('title', 'id');
        return view('admin.property.create', compact('title', 'property_groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Property::query()->create([
            'title' => $request->input('title'),
            'property_group_id' => $request->input('property_group_id'),
        ]);
        return redirect()->route('properties.index')->with('message', ' وزكي  با موفقيت ايجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = Property::query()->find($id);
        $title = "ويرايش ويزكي ها";
        $property_groups = PropertyGroup::query()->pluck('title', 'id');
        return view('admin.property.edit', compact('title', 'property', 'property_groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $property = Property::query()->find($id);
        $property->update([
            'title' => $request->input('title'),
            'property_group_id' => $request->input('property_group_id'),
        ]);
        return redirect()->route('properties.index')->with('message', ' وزكي  با موفقيت ويرايش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
