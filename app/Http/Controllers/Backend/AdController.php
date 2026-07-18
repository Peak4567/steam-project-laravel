<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdController extends Controller
{
    /**
     * 1. หน้าหลัก: แสดงผลรายการโฆษณา/ประชาสัมพันธ์ทั้งหมด พร้อมสถิติภาพรวม
     */
    public function index()
    {
        $ads = DB::table('ads')->orderBy('id', 'desc')->paginate(10);

        $stats = [
            'total'    => DB::table('ads')->count(),
            'active'   => DB::table('ads')->where('status', 'active')->count(),
            'inactive' => DB::table('ads')->where('status', 'inactive')->count(),
        ];

        return view('backend.ads.index', compact('ads', 'stats'));
    }

    /**
     * 2. หน้าแสดงฟอร์มสร้างโฆษณาประชาสัมพันธ์ใหม่
     */
    public function create()
    {
        return view('backend.ads.create');
    }

    /**
     * 3. บันทึกข้อมูลโฆษณาใหม่เข้าสู่ฐานข้อมูล
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'link_url'    => 'nullable|url',
            'status'      => 'required|in:active,inactive',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $imagePathArray = [];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/ads'), $filename);
            $imagePathArray[] = 'assets/img/ads/' . $filename;
        }

        DB::table('ads')->insert([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title) . '-' . Str::random(8),
            'description' => $request->description,
            'image_path'  => json_encode($imagePathArray),
            'link_url'    => $request->link_url,
            'status'      => $request->status,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('backend.ads')->with('success', 'เพิ่มประกาศประชาสัมพันธ์เรียบร้อยแล้ว!');
    }

    /**
     * 4. หน้าฟอร์มแก้ไขข้อมูลป้ายเดิม
     */
    public function edit($id)
    {
        $ad = DB::table('ads')->where('id', $id)->first();
        if (!$ad) {
            return redirect()->route('backend.ads')->with('error', 'ไม่พบข้อมูลป้ายประชาสัมพันธ์ที่ระบุ');
        }

        return view('backend.ads.edit', compact('ad'));
    }

    /**
     * 5. อัปเดตข้อมูลโครงสร้างไฟล์และรายละเอียด
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'link_url'    => 'nullable|url',
            'status'      => 'required|in:active,inactive',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $ad = DB::table('ads')->where('id', $id)->first();
        if (!$ad) {
            return redirect()->route('backend.ads')->with('error', 'ไม่พบข้อมูลป้ายประชาสัมพันธ์ที่ระบุ');
        }
        
        $imagePathArray = json_decode($ad->image_path, true) ?? [];

        if ($request->hasFile('image')) {
            // ลบรูปภาพเก่าออกเพื่อประหยัดพื้นที่เซิร์ฟเวอร์
            if (!empty($imagePathArray)) {
                foreach ($imagePathArray as $oldImg) {
                    if (File::exists(public_path($oldImg))) {
                        File::delete(public_path($oldImg));
                    }
                }
            }

            $imagePathArray = [];
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/ads'), $filename);
            $imagePathArray[] = 'assets/img/ads/' . $filename;
        }

        DB::table('ads')->where('id', $id)->update([
            'title'       => $request->title,
            'description' => $request->description,
            'image_path'  => json_encode($imagePathArray),
            'link_url'    => $request->link_url,
            'status'      => $request->status,
            'updated_at'  => now(),
        ]);

        return redirect()->route('backend.ads')->with('success', 'แก้ไขข้อมูลป้ายประชาสัมพันธ์เรียบร้อยแล้ว!');
    }

    /**
     * 6. ระบบลบข้อมูลถาวรพร้อมทำลายไฟล์รูปภาพจริงบน Storage
     */
    public function destroy($id)
    {
        $ad = DB::table('ads')->where('id', $id)->first();
        if (!$ad) {
            return redirect()->route('backend.ads')->with('error', 'ไม่พบข้อมูลที่ต้องการลบ');
        }

        $imagePathArray = json_decode($ad->image_path, true) ?? [];
        if (!empty($imagePathArray)) {
            foreach ($imagePathArray as $img) {
                if (File::exists(public_path($img))) {
                    File::delete(public_path($img));
                }
            }
        }

        DB::table('ads')->where('id', $id)->delete();

        return redirect()->route('backend.ads')->with('success', 'ลบข้อมูลป้ายประชาสัมพันธ์สำเร็จแล้ว!');
    }
}