<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }
    public function update(Request $request)
    {
       $user = User::findOrFail(Auth::id());

        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'nickname'   => 'nullable|string|max:100',
            'student_id' => 'nullable|string|max:20',
            'bio'        => 'nullable|string|max:300',
        ], [
            'max' => 'ข้อมูลมีความยาวเกินกำหนด',
        ]);

        $user->update([
            'prefix'           => $request->prefix,
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'nickname'         => $request->nickname,
            'grade_level'      => $request->grade_level,
            'student_id'       => $request->student_id,
            'favorite_subject' => $request->favorite_subject,
            'bio'              => $request->bio,
            'school_name'      => $request->school_name,
            'dream_university' => $request->dream_university,
        ]);

        return back()->with('success', 'บันทึกข้อมูลส่วนตัวเรียบร้อยแล้วครับคุณพีค!');
    }
}