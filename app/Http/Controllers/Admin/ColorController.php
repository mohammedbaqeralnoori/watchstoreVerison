<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'ليست  رنك';
        return view('admin.color.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ايجاد  رنك';
        return view('admin.color.create', compact('title'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required',
        ]);
        Color::query()->create([
            'title' => $request->input('title'),
            'code' => $request->input('code')
        ]);
        return redirect()->route('colors.index')->with('message', 'رنك با موفقيت ذخيره شد');
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
        $color = Color::query()->find($id);
        $title = 'ويرايش رنك';
        return view('admin.color.edit', compact('title', 'color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Color::query()->find($id)->update([
            'title' => $request->input('title'),
            'code' => $request->input('code')
        ]);
        return redirect()->route('colors.index')->with('message', 'رنك با موفقيت ويرايش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
