<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdsController extends Controller
{
    public function index() {
        $ads = DB::table('ads')->latest()->get();
        return view('backend.ads.index', compact('ads'));
    }

    public function store(Request $request) {
        $request->validate(['title' => 'required', 'image' => 'required|image|mimes:jpeg,png,jpg']);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/img/ads'), $imageName);
            $imagePath = 'assets/img/ads/' . $imageName;
        }

        DB::table('ads')->insert([
            'title' => $request->title,
            'image_path' => $imagePath,
            'link_url' => $request->link_url,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'เพิ่มประกาศเรียบร้อย');
    }

    public function updateStatus($id, $status) {
        DB::table('ads')->where('id', $id)->update(['status' => $status, 'updated_at' => now()]);
        return back();
    }

    public function destroy($id) {
        $ad = DB::table('ads')->where('id', $id)->first();
        if ($ad && $ad->image_path) {
            File::delete(public_path($ad->image_path));
        }
        DB::table('ads')->where('id', $id)->delete();
        return back()->with('success', 'ลบประกาศเรียบร้อย');
    }
}