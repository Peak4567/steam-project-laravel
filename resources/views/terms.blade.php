@extends('layout')
@section('content')

<section class="max-w-4xl mx-auto py-12 px-4 md:px-6 font-mitr min-h-screen">

    <!-- ปุ่มย้อนกลับ & Header -->
    <div class="mb-10 text-center relative">
        <a href="{{ url('/') }}" class="absolute left-0 top-1/2 -translate-y-1/2 text-sm font-medium text-gray-400 hover:text-[#5EBEE6] transition-colors hidden md:flex items-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> กลับหน้าหลัก
        </a>
        <h1 class="text-3xl md:text-4xl font-bold text-slate-800 mb-3">ข้อกำหนดและเงื่อนไข</h1>
        <p class="text-sm text-gray-500">Terms of Service • ปรับปรุงล่าสุดเมื่อ: 8 พฤษภาคม 2026</p>
    </div>

    <!-- ส่วนเนื้อหา -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
        
        <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
            <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-600 border border-gray-100">
                <i class="fa-solid fa-file-contract text-xl"></i>
            </div>
            <h2 class="text-xl md:text-2xl font-bold text-slate-800">ข้อตกลงในการใช้งานเว็บไซต์</h2>
        </div>

        <div class="space-y-8 text-sm md:text-base text-gray-600 leading-relaxed">
            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">1. การยอมรับข้อตกลง</h3>
                <p>การเข้าใช้งาน สร้างบัญชี และอัปโหลดข้อมูลลงบนแพลตฟอร์มนี้ ถือว่าคุณได้อ่าน ทำความเข้าใจ และยอมรับข้อกำหนดและเงื่อนไขการใช้งานเหล่านี้อย่างครบถ้วน หากคุณไม่ยอมรับข้อตกลง กรุณายุติการใช้งานเว็บไซต์</p>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">2. กฎและข้อควรปฏิบัติในการอัปโหลดผลงาน</h3>
                <p>ผู้ใช้งานตกลงที่จะไม่อัปโหลดหรือเผยแพร่เนื้อหาที่มีลักษณะดังต่อไปนี้:</p>
                <ul class="list-disc pl-5 mt-2 space-y-1 text-gray-500">
                    <li>เนื้อหาที่ละเมิดลิขสิทธิ์ เครื่องหมายการค้า หรือทรัพย์สินทางปัญญาของบุคคลภายนอก</li>
                    <li>เนื้อหาที่มีลักษณะลามกอนาจาร รุนแรง หรือขัดต่อศีลธรรมอันดีงาม</li>
                    <li>เนื้อหาที่แอบอ้างเป็นบุคคลอื่น สถาบันอื่น หรือให้ข้อมูลที่เป็นเท็จ</li>
                    <li>ไฟล์ที่แฝงไวรัส มัลแวร์ หรือโค้ดที่เป็นอันตรายต่อระบบคอมพิวเตอร์</li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">3. สิทธิในผลงาน (Copyright)</h3>
                <p>ลิขสิทธิ์ในแฟ้มสะสมผลงาน (Portfolio) และรูปภาพทั้งหมด ยังคงเป็นของผู้ใช้งานโดยสมบูรณ์ อย่างไรก็ตาม การที่คุณอัปโหลดผลงานลงบนระบบ ถือเป็นการอนุญาตให้เว็บไซต์ของเราแสดงผล แจกจ่าย และนำเสนอผลงานของคุณผ่านแพลตฟอร์ม เพื่อให้บรรลุวัตถุประสงค์ในการจัดแสดงผลงาน</p>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">4. การลบเนื้อหาและระงับบัญชี</h3>
                <p>ทีมงานขอสงวนสิทธิ์ในการตรวจสอบ อนุมัติ ปฏิเสธ หรือลบแฟ้มสะสมผลงานใดๆ ที่พิจารณาแล้วว่าทำผิดข้อตกลง โดยไม่ต้องแจ้งให้ทราบล่วงหน้า รวมถึงมีสิทธิในการระงับการใช้งานบัญชีผู้ที่จงใจละเมิดกฎกติกาของเว็บไซต์ซ้ำซาก</p>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 mt-8 text-sm">
                <p class="font-bold text-slate-700 mb-1">การสนับสนุนและช่วยเหลือ</p>
                <p>หากมีข้อสงสัยเกี่ยวกับข้อกำหนดการใช้งาน สามารถติดต่อเราได้ที่ <a href="mailto:support@yourdomain.com" class="text-[#5EBEE6] hover:underline">support@yourdomain.com</a></p>
            </div>
        </div>

    </div>
</section>

@endsection