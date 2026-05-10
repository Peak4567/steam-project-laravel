<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('lecturers')->latest()->paginate(6);

        $stats = [
            'total' => Activity::count(),
            'participants' => Activity::sum('current_participants'),
            'categories' => Activity::distinct('category')->count()
        ];

        return view('activity', compact('activities', 'stats'));
    }

    public function apply($id)
    {
        $activity = Activity::with('lecturers')->findOrFail($id);
        $registration = null;

        if (Auth::check()) {
            $registration = ActivityRegister::where('activity_id', $id)
                ->where('user_id', Auth::id())
                ->first();
        }

        $isRegistered = $registration ? true : false;

        return view('activity.apply_activity', compact('activity', 'isRegistered', 'registration'));
    }

    public function submitApply(Request $request, $id)
    {
        $request->validate([
            'phone'      => 'required|string|max:20',
            'class_room' => 'required|string|max:20',
            'student_no' => 'required|string|max:255',
            'note'       => 'required|string|max:2000',
        ], [
            'note.required' => 'กรุณากรอก SOP เพื่อใช้ในการพิจารณา',
            'student_no.required' => 'กรุณากรอกเลขที่',
            'class_room.required' => 'กรุณากรอกชั้นเรียน'
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'กรุณาเข้าสู่ระบบก่อนสมัครกิจกรรม');
        }

        $activity = Activity::findOrFail($id);
        $userId = Auth::id();

        $isAlreadyRegistered = ActivityRegister::where('activity_id', $id)
            ->where('user_id', $userId)
            ->exists();

        if ($isAlreadyRegistered) {
            return back()->with('error', 'คุณได้สมัครเข้าร่วมกิจกรรมนี้ไปแล้ว');
        }

        if ($activity->current_participants < $activity->max_participants) {

            $save = ActivityRegister::create([
                'activity_id' => $activity->id,
                'user_id'     => $userId,
                'class_room'  => $request->class_room,
                'student_no'  => $request->student_no,
                'phone'       => $request->phone,
                'note'        => $request->note,
            ]);

            if ($save) {
                $activity->increment('current_participants');
                return redirect()->route('activity')->with('success', 'สมัครเข้าร่วมกิจกรรมเรียบร้อยแล้ว!');
            }
        }

        return back()->with('error', 'ไม่สามารถสมัครได้เนื่องจากจำนวนเต็ม');
    }
}
