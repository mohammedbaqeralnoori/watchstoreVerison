<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function index()
    {
        $title = 'ليست برند ها';
        return view('admin.brand.list', compact('title'));
    }


    public function create()
    {
        $title = 'ايجاد برند';
        return view('admin.brand.create', compact('title'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|image|mimes:jpg,jpeg,png,webp,gif',
        ]);

        Brand::createBrand($request);
        return redirect()->route('brands.index')->with('message', 'برند با موفقيت ايجام شد');
    }



    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $brand = Brand::query()->find($id);
        $title = 'ويرايش برند';
        return view('admin.brand.edit', compact('title', 'brand'));
    }


    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif',
        ]);
        $brand = Brand::findOrFail($id);
        if ($request->hasFile('file')) {
            $image = Brand::saveImage($request->file('file'));
        } else {
            $image = $brand->image;
        }
        $brand->update([
            'title' => $validated['title'],
            'image' => $image,
        ]);
        return redirect()
            ->route('brands.index')
            ->with('message', 'برند با موفقیت ویرایش شد');
    }

    public function destroy(string $id)
    {
        //
    }
}
