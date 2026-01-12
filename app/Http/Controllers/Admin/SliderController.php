<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'ليست اسلايدر ها';
        return view('admin.slider.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ايجاد اسلايدر ها';
        return view('admin.slider.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|nullable|url|max:255',
            'file' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);
        $image = Slider::saveImage($request->file('file'));
        Slider::query()->create([
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'image' => $image,
        ]);
        return redirect()->route('sliders.index')->with('message', 'اسلايدر با موفقيت ايجام شد');
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
        $slider = Slider::query()->find($id);
        $title = 'ويرايش اسلايدر ها';
        return view('admin.slider.edit', compact('title', 'slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);
        $slider = Slider::findOrFail($id);
        if ($request->hasFile('file')) {
            $image = Slider::saveImage($request->file('file'));
        } else {
            $image = $slider->image;
        }
        $slider->update([
            'title' => $validated['title'],
            'url' => $validated['url'] ?? null,
            'image' => $image,
        ]);

        // ✅ Redirect back with success message
        return redirect()
            ->route('sliders.index')
            ->with('message', 'اسلایدر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
