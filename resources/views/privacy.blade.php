@extends('layout')
@section('content')

<section class="max-w-4xl mx-auto py-12 px-4 md:px-6 font-mitr min-h-screen">

    <!-- ปุ่มย้อนกลับ & Header -->
    <div class="mb-10 text-center relative">
        <a href="{{ url('/') }}" class="absolute left-0 top-1/2 -translate-y-1/2 text-sm font-medium text-gray-400 hover:text-[#5EBEE6] transition-colors hidden md:flex items-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> กลับหน้าหลัก
        </a>
        <h1 class="text-3xl md:text-4xl font-bold text-slate-800 mb-3">นโยบายความเป็นส่วนตัว</h1>
        <p class="text-sm text-gray-500">Privacy Policy • ปรับปรุงล่าสุดเมื่อ: 8 พฤษภาคม 2026</p>
    </div>

    <!-- ส่วนเนื้อหา -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
        
        <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
            <div class="w-12 h-12 rounded-full bg-[#eaf6fc] flex items-center justify-center text-[#5EBEE6]">
                <i class="fa-solid fa-shield-halved text-xl"></i>
            </div>
            <h2 class="text-xl md:text-2xl font-bold text-slate-800">นโยบายความเป็นส่วนตัวในการใช้งาน</h2>
        </div>

        <div class="space-y-8 text-sm md:text-base text-gray-600 leading-relaxed">
            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">1. ข้อมูลที่เรารวบรวม</h3>
                <p>เมื่อคุณใช้งานระบบของเรา เราอาจจัดเก็บข้อมูลส่วนบุคคลของคุณ ได้แก่ ชื่อ-นามสกุล, ที่อยู่อีเมล, ข้อมูลสถานศึกษา, ข้อมูลที่ปรากฏในแฟ้มสะสมผลงาน (Portfolio) ที่คุณอัปโหลด รวมถึงข้อมูลการใช้งานเว็บไซต์เบื้องต้น (เช่น ข้อมูลคุกกี้, IP Address)</p>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">2. การใช้ข้อมูลของคุณ</h3>
                <p>เรานำข้อมูลที่คุณให้มาใช้เพื่อจุดประสงค์ต่อไปนี้:</p>
                <ul class="list-disc pl-5 mt-2 space-y-1 text-gray-500">
                    <li>เพื่อแสดงผลแฟ้มสะสมผลงานของคุณบนแพลตฟอร์มให้ผู้ใช้งานอื่นหรือสถาบันการศึกษาเข้าชม</li>
                    <li>เพื่อยืนยันตัวตนและดูแลรักษาความปลอดภัยของบัญชีผู้ใช้</li>
                    <li>เพื่อนำข้อมูลไปวิเคราะห์และพัฒนาประสบการณ์การใช้งานเว็บไซต์ให้ดียิ่งขึ้น</li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">3. การเปิดเผยข้อมูล</h3>
                <p>ข้อมูลแฟ้มสะสมผลงาน (Portfolio) ที่คุณเลือกตั้งค่าและอัปโหลด จะสามารถถูกเข้าถึงและรับชมได้โดยบุคคลทั่วไปบนอินเทอร์เน็ต เราจะไม่นำข้อมูลส่วนตัวเชิงลึกของคุณ (เช่น รหัสผ่าน, อีเมลส่วนตัว) ไปเผยแพร่หรือขายให้กับบุคคลที่สามโดยเด็ดขาด ยกเว้นกรณีที่กฎหมายบังคับ</p>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">4. สิทธิในข้อมูลของคุณ</h3>
                <p>คุณมีสิทธิในการเข้าถึง แก้ไข หรือขอลบข้อมูลส่วนบุคคลและผลงานของคุณออกจากระบบได้ตลอดเวลาผ่านหน้าต่างการจัดการโปรไฟล์ของคุณ หากคุณลบบัญชี ข้อมูลของคุณจะถูกลบออกจากฐานข้อมูลของเราอย่างถาวร</p>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 mt-8 text-sm">
                <p class="font-bold text-slate-700 mb-1">ติดต่อเจ้าหน้าที่ควบคุมข้อมูล</p>
                <p>หากคุณมีข้อสงสัยเกี่ยวกับนโยบายความเป็นส่วนตัวนี้ สามารถติดต่อทีมงานได้ที่ <a href="mailto:privacy@yourdomain.com" class="text-[#5EBEE6] hover:underline">privacy@yourdomain.com</a></p>
            </div>
        </div>

    </div>
</section>

@endsection