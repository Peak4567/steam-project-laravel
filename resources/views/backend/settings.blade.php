@extends('backend.layout')
@section('content')

{{-- 🛠️ ปรับปรุง: เพิ่มระบบดักจับสถานะ activeSection ด้วย Alpine.js เพื่อทำ Scrollspy --}}
<section x-data="{ activeSection: 'general' }" class="w-full min-h-screen p-4 md:p-8 font-mitr bg-slate-50/50 text-slate-700 overflow-y-visible">
    <div class="max-w-6xl mx-auto h-auto">
        
        {{-- 🔝 1. ส่วนหัวข้อของหน้าการตั้งค่าชั้นสูง (Header Section) --}}
        <div class="mb-8 border-b border-slate-100 pb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                    <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Advanced System Configuration</h2>
                </div>
                <p class="text-xs md:text-sm text-slate-400 font-medium mt-1">การปรับแต่งตัวแปรแกนกลางระบบฐานข้อมูล STEAM Project (ตาราง settings) โปรดระมัดระวังการแก้ไขค่าตัวแปรระดับลึก</p>
            </div>
            
            <div class="flex items-center gap-2 bg-amber-50 border border-amber-200 text-amber-600 px-3 py-2 rounded-xl text-[11px] font-bold shadow-sm">
                <i class="fa-solid fa-triangle-exclamation text-xs"></i> Mode: Expert Developer Only
            </div>
        </div>

        {{-- 🎛️ 2. เมนูควบคุมแยกหมวดหมู่และฟอร์มย่อย (Deep Detail Control Layout) --}}
        <form action="{{ route('backend.settings.update') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start h-auto">
            @csrf @method('PUT')

            {{-- ซ้าย: แท็บเมนูย่อยระดับลึก (lg:col-span-3) บังคับสติกกี้ลอยตามหน้าจอเวลาเลื่อน --}}
            <div class="lg:col-span-3 space-y-2 sticky top-6 z-30">
                <div class="bg-white p-3 rounded-2xl border border-slate-100 shadow-sm text-[11px] font-bold space-y-1">
                    <div class="text-slate-400 uppercase tracking-wider px-3 py-1.5 text-[9px]">กลุ่มการตั้งค่า</div>
                    
                    {{-- 🛠️ ปรับปรุง: ใช้คำสั่งตรวจสอบ :class เพื่อสลับเปลี่ยนไฮไลต์ปุ่มสีดำตามสปาย --}}
                    <a href="#general" @click="activeSection = 'general'"
                       :class="activeSection === 'general' ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50'"
                       class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl transition-all duration-200">
                        <i class="fa-solid fa-sliders text-[11px]" :class="activeSection === 'general' ? 'text-[#5EBEE6]' : ''"></i> 1. General Settings
                    </a>
                    
                    <a href="#meta" @click="activeSection = 'meta'"
                       :class="activeSection === 'meta' ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50'"
                       class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl transition-all duration-200">
                        <i class="fa-solid fa-globe text-[11px]" :class="activeSection === 'meta' ? 'text-[#5EBEE6]' : ''"></i> 2. Metadata & SEO
                    </a>
                    
                    <a href="#security" @click="activeSection = 'security'"
                       :class="activeSection === 'security' ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50'"
                       class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl transition-all duration-200">
                        <i class="fa-solid fa-cookie-bite text-[11px]" :class="activeSection === 'security' ? 'text-[#5EBEE6]' : ''"></i> 3. Cookie Consent
                    </a>
                </div>

                {{-- กล่องสถิติ System Status --}}
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm text-[11px] space-y-2.5">
                    <span class="block font-black text-slate-800 uppercase tracking-wider text-[10px] border-b border-slate-50 pb-1.5">Database Snapshot</span>
                    <div class="space-y-1 font-medium text-slate-400">
                        <div class="flex justify-between"><span>Engine:</span> <span class="font-bold text-slate-700">InnoDB (MySQL)</span></div>
                        <div class="flex justify-between"><span>Collation:</span> <span class="font-bold text-slate-700">utf8mb4_unicode_ci</span></div>
                        <div class="flex justify-between"><span>Settings Row:</span> <span class="font-bold text-[#5EBEE6]">{{ count($settings) }} Rows Active</span></div>
                    </div>
                </div>
            </div>

            {{-- ขวา: แผงกรอกข้อมูลยิบย่อย ซับซ้อน (lg:col-span-9) --}}
            <div class="lg:col-span-9 space-y-6 h-auto">

                {{-- กล่องที่ 1: General Platform Information --}}
                {{-- 🛠️ ปรับปรุง: ใช้ Intersection Observer ดักจับหน้าต่างเมาส์เพื่อสปายเมนูทางซ้ายอัตโนมัติ --}}
                <div id="general" 
                     x-intersect:enter="activeSection = 'general'"
                     class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4 scroll-mt-6">
                    <h3 class="text-sm font-black text-slate-800 border-b border-slate-50 pb-2.5 uppercase tracking-wide flex items-center gap-2">
                        <i class="fa-solid fa-laptop-code text-[#5EBEE6]"></i> 1. การตั้งค่าระบบทั่วไป (General Core Settings)
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                        <div class="sm:col-span-8 space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500">ชื่อแพลตฟอร์มระบบหลัก (site_name)</label>
                            <input type="text" name="settings[site_name]" value="{{ $settings['site_name'] ?? 'ศูนย์โครงการสตรีม | STEAM' }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:border-[#5EBEE6] transition-all">
                        </div>
                        <div class="sm:col-span-4 space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500">โหมดปรับปรุงระบบ (is_maintenance)</label>
                            <div class="relative">
                                <select name="settings[is_maintenance]" class="appearance-none w-full px-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold text-slate-600 outline-none focus:border-[#5EBEE6] cursor-pointer">
                                    <option value="0" {{ ($settings['is_maintenance'] ?? '0') == '0' ? 'selected' : '' }}>0 - เปิดใช้งานปกติ (Production Active)</option>
                                    <option value="1" {{ ($settings['is_maintenance'] ?? '0') == '1' ? 'selected' : '' }}>1 - ปิดปรับปรุงระบบ (Maintenance Active)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500">คำอธิบายส่วนท้ายเว็บหลัก (footer_description)</label>
                        <textarea name="settings[footer_description]" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:border-[#5EBEE6] transition-all resize-none">{{ $settings['footer_description'] ?? 'แพลตฟอร์มเพื่อการเรียนรู้และสร้างสรรค์โครงงาน' }}</textarea>
                    </div>
                </div>

                {{-- กล่องที่ 2: Advanced Search Engine Optimization --}}
                <div id="meta" 
                     x-intersect:enter="activeSection = 'meta'"
                     class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4 scroll-mt-6">
                    <h3 class="text-sm font-black text-slate-800 border-b border-slate-50 pb-2.5 uppercase tracking-wide flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass-plus text-purple-500"></i> 2. ข้อมูลการดักค้นหาและเครดิต (SEO & Indexing Properties)
                    </h3>
                    
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500">คำค้นหาสำหรับสืบค้นอินเทอร์เน็ต (seo_keywords)</label>
                        <input type="text" name="settings[seo_keywords]" value="{{ $settings['seo_keywords'] ?? 'โครงงาน, STEAM, การศึกษา' }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:border-[#5EBEE6] transition-all">
                        <span class="text-[10px] text-slate-400 font-medium block pl-1">คั่นแต่ละคำด้วยเครื่องหมายจุลภาค ( , ) เท่านั้น</span>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500">รายละเอียดขนาดยาวกำกับเซิร์ฟเวอร์ (seo_description)</label>
                        <textarea name="settings[seo_description]" rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:border-[#5EBEE6] transition-all resize-none">{{ $settings['seo_description'] ?? 'แหล่งเรียนรู้และรวบรวมโครงงาน STEAM สำหรับนักเรียน' }}</textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500">ข้อความลิขสิทธิ์ท้ายหน้าเว็บ (footer_credit)</label>
                        <input type="text" name="settings[footer_credit]" value="{{ $settings['footer_credit'] ?? '© 2026 STEAM Project. All rights reserved.' }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:border-[#5EBEE6] transition-all">
                    </div>
                </div>

                {{-- กล่องที่ 3: Cookie Consent --}}
                <div id="security"
                     x-intersect:enter="activeSection = 'security'"
                     class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4 scroll-mt-6">
                    <h3 class="text-sm font-black text-slate-800 border-b border-slate-50 pb-2.5 uppercase tracking-wide flex items-center gap-2">
                        <i class="fa-solid fa-cookie-bite text-amber-500"></i> 3. การตั้งค่าคุกกี้ (Cookie Consent)
                    </h3>

                    <div class="grid grid-cols-1 gap-4 text-xs font-medium text-slate-600">
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-100/70">
                            <div>
                                <p class="font-bold text-slate-700">เปิดใช้งานป๊อปอัปขออนุญาตใช้คุกกี้ (Cookie Consent Banner)</p>
                                <span class="text-[10px] text-slate-400">แสดงข้อความขออนุญาตใช้คุกกี้แก่ผู้เข้าชมเว็บไซต์เมื่อเข้าเว็บครั้งแรก</span>
                            </div>
                            <input type="hidden" name="settings[cookie_consent_enabled]" value="0">
                            <input type="checkbox" name="settings[cookie_consent_enabled]" value="1" {{ ($settings['cookie_consent_enabled'] ?? '1') == '1' ? 'checked' : '' }} class="w-4 h-4 rounded text-[#5EBEE6] focus:ring-0">
                        </div>
                    </div>
                </div>

                {{-- ⚠️ แถบปุ่มบันทึกการตั้งค่า (Action Footer) --}}
                <div class="bg-slate-900 p-4 rounded-2xl border border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-md">
                    <div class="flex items-center gap-2 text-white">
                        <i class="fa-solid fa-circle-info text-[#5EBEE6] text-sm"></i>
                        <p class="text-[11px] font-medium text-slate-400">ตรวจสอบความเรียบร้อยของพารามิเตอร์ทุกตัวแปร ข้อมูลจะอัปเดตลงตาราง <code class="text-white font-mono bg-slate-800 px-1.5 py-0.5 rounded">settings</code> ทันที</p>
                    </div>
                    <div class="flex gap-2 w-full sm:w-auto">
                        <button type="submit" class="w-full sm:w-auto bg-[#5EBEE6] hover:bg-sky-400 text-white px-6 py-2 rounded-xl text-xs font-bold transition-all shadow-sm active:scale-95">
                            <i class="fa-regular fa-floppy-disk mr-1"></i> Save Global Settings
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>

{{-- 🛠️ ปรับปรุง: เพิ่มสคริปต์เพื่อให้ระบบประมวลผล Intersect และ Scroll Scroll ได้อย่างเสถียรที่สุด --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ตั้งค่าระบบ Smooth Scroll เมื่อผู้ใช้คลิกลิงก์เมนูย่อยให้เลื่อนนุ่มนวล
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>

@endsection