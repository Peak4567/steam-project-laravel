<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $globalSettings['site_name'] ?? 'STEAM Project' }} - อยู่ระหว่างปรับปรุงระบบ</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/all.min.css') }}" rel="stylesheet">

    <style>
        body { font-family: 'Kanit', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-[#0f172a] text-white flex items-center justify-center px-4">
    <div class="max-w-md w-full text-center">
        <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-[#5EBEE6]/10 border border-[#5EBEE6]/30 flex items-center justify-center">
            <i class="fa-solid fa-screwdriver-wrench text-3xl text-[#5EBEE6]"></i>
        </div>
        <h1 class="text-2xl font-bold mb-3">{{ $globalSettings['site_name'] ?? 'STEAM Project' }}</h1>
        <p class="text-slate-400 text-sm leading-relaxed mb-1">
            ระบบกำลังอยู่ระหว่างการปรับปรุงชั่วคราว
        </p>
        <p class="text-slate-500 text-xs">
            ขออภัยในความไม่สะดวก โปรดกลับมาใหม่อีกครั้งในภายหลัง
        </p>
    </div>
</body>

</html>
