<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use App\Models\ActivityRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->paginate(10);
        return view('backend.activity', compact('activities'));
    }

    public function create()
    {
        $lecturers = User::orderBy('first_name')->get(); 
        return view('backend.activity_create', compact('lecturers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time_range' => 'required|string',
            'location' => 'required|string',
            'max_participants' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'lecturer_ids' => 'nullable|array'
        ]);

        $activity = new Activity($request->except(['image', 'lecturer_ids']));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('assets/img/activities');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $file->move($path, $filename);
            $activity->image_path = 'assets/img/activities/' . $filename;
        }

        $activity->save();

        if ($request->has('lecturer_ids')) {
            $activity->lecturers()->sync($request->lecturer_ids);
        }

        return redirect()->route('backend.activity')->with('success', 'เพิ่มกิจกรรมเรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        $activity = Activity::with('lecturers')->findOrFail($id);
        $lecturers = User::orderBy('first_name')->get(); 
        return view('backend.activity_create', compact('activity', 'lecturers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time_range' => 'required|string',
            'location' => 'required|string',
            'max_participants' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'lecturer_ids' => 'nullable|array'
        ]);

        $activity = Activity::findOrFail($id);
        $activity->fill($request->except(['image', 'lecturer_ids']));

        if ($request->hasFile('image')) {
            if ($activity->image_path && file_exists(public_path($activity->image_path))) {
                unlink(public_path($activity->image_path));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/activities'), $filename);
            $activity->image_path = 'assets/img/activities/' . $filename;
        }

        $activity->save();

        if ($request->has('lecturer_ids')) {
            $activity->lecturers()->sync($request->lecturer_ids);
        } else {
            $activity->lecturers()->detach();
        }

        return redirect()->route('backend.activity')->with('success', 'อัปเดตกิจกรรมสำเร็จ!');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        if ($activity->image_path && file_exists(public_path($activity->image_path))) {
            unlink(public_path($activity->image_path));
        }
        $activity->delete();
        return back()->with('success', 'ลบกิจกรรมเรียบร้อยแล้ว');
    }

    public function participants($id)
    {
        $activity = Activity::findOrFail($id);

        $participants = ActivityRegister::with('user')
            ->where('activity_id', $id)
            ->orderBy('student_no', 'asc')
            ->get();

        return view('backend.activity_participants', compact('activity', 'participants'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $register = ActivityRegister::findOrFail($id);
        $register->status = $request->status;
        $register->save();

        return back()->with('success', 'อัปเดตสถานะผู้สมัครเรียบร้อยแล้ว');
    }

    public function print($id)
    {
        $activity = Activity::with('lecturers')->findOrFail($id);
        $participants = ActivityRegister::with('user')
            ->where('activity_id', $id)
            ->where('status', 'approved')
            ->orderBy('student_no', 'asc')
            ->get();

        return view('backend.activity_print', compact('activity', 'participants'));
    }
}