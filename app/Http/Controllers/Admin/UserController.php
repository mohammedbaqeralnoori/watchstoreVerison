<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Livewire\Admin\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "ليست كاربران";
        return view('admin.user.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "ايجاد كاربر";
        return view('admin.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|nullable|email|unique:users,email',
            'mobile' => 'required|nullable|string|max:15|unique:users,mobile',
            'password' => 'required|string|min:6',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        $image = User::saveImage($request->file('file'));
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
            'photo' => $image
        ]);

        return redirect()->route('users.index')->with('message', 'کاربر جدید با موفقیت ثبت شد');
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
        $title = "ويرايش كاربر";
        $user = User::query()->find($id);
        return view('admin.user.edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'mobile' => 'nullable|string|max:15|unique:users,mobile,' . $id,
            'password' => 'nullable|string|min:6',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $image = $request->hasFile('file')
            ? User::saveImage($request->file('file'))
            : $user->photo;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,
            'photo' => $image,
        ]);

        return redirect()->route('users.index')
            ->with('message', 'کاربر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function createUserRoles($id)
    {
        $user = User::query()->find($id);
        $roles = Role::query()->get();
        return view('admin.user.user_roles', compact('user', 'roles'));
    }
    public function storeUserRoles(Request $request, $id)
    {
        $user = User::query()->find($id);
        $user->syncRoles($request-> roles);
        return redirect()->route('users.index')->with('message', 'نقش ها ى کاربر با موفقیت ويرايش شد');
    }
}
