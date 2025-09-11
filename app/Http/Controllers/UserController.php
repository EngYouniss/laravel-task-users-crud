<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // عرض القائمة
    public function index()
    {
        $users = User::latest()->get();
        return view('welcome', compact('users'));
    }
    public function viewCreatePage(){
        return view('users.add');
    }

    // تخزين مستخدم جديد

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'major' => 'required|string|in:IT,CS,IS,SE',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = new User();
        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->major = $validated['major'];
        $user->password = Hash::make('12345678');

        if ($request->hasFile('image')) {
            $imageName = time() . '_'.'.'  . $request->image->extension();
            $request->image->move(public_path('uploads/users'), $imageName);
            $user->image = 'uploads/users/' . $imageName;
        }

        if ($user->save()) {
            return redirect()->route('users.view')->with('success', 'تمت إضافة المستخدم.');
        }

        return redirect()->route('users.view')->with('error', 'حصل خطأ.');
    }

    public function viewUpdatePage(Request $request, $id)
    {
        $user = User::findOrFail($id);

        return view('users.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'major' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
        ]);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->major = $validated['major'];

        if ($request->hasFile('image')) {
            if (!empty($user->image) && file_exists(public_path($user->image))) {
                @unlink(public_path($user->image));
            }
            $imageName = time() . '_'. '.' . $request->image->extension();
            $request->image->move(public_path('uploads/users'), $imageName);
            $user->image = 'uploads/users/' . $imageName;
        }

        $updated = $user->save();

        if ($updated) {
            return redirect()->route('users.view')->with('success', 'تم تحديث المستخدم.');
        }

        return redirect()->route('users.view')->with('error', 'فشل التحديث.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if (!empty($user->image) && file_exists(public_path($user->image))) {
            @unlink(public_path($user->image));
        }

        $deleted = $user->delete();

        if ($deleted) {
            return redirect()->route('users.view')->with('success', 'تم حذف المستخدم.');
        }

        return redirect()->route('users.view')->with('error', 'فشل الحذف.');
    }
}
