<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('users');

        // ระบบค้นหาข้อมูลสมาชิก
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('last_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('email', 'LIKE', "%{$request->search}%")
                  ->orWhere('student_id', 'LIKE', "%{$request->search}%");
            });
        }

        $users = $query->latest()->paginate(10);
        return view('backend.users', compact('users'));
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('backend.users_edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nickname' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'level' => 'required|in:member,teacher,admin',
            'is_hall_of_fame' => 'required|in:0,1',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'nickname' => $request->nickname,
            'prefix' => $request->prefix,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'grade_level' => $request->grade_level,
            'student_id' => $request->student_id,
            'favorite_subject' => $request->favorite_subject,
            'school_name' => $request->school_name,
            'dream_university' => $request->dream_university,
            'bio' => $request->bio,
            'email' => $request->email,
            'level' => $request->level,
            'is_hall_of_fame' => (int) $request->is_hall_of_fame,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($data);

        return redirect()->route('backend.users')->with('success', 'updated user successfully');
    }

    public function destroy($id)
    {
        if (Auth::id() == $id) {
            return back()->with('error', 'cannot delete your own account');
        }

        DB::table('users')->where('id', $id)->delete();
        return back()->with('success', 'deleted user successfully');
    }
}