<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print list - {{ strtolower($activity->title) }}</title>
    
    <style>
        @font-face {
            font-family: 'TH Sarabun PSK';
            src: local('TH Sarabun PSK');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'TH Sarabun PSK';
            src: local('TH Sarabun PSK Bold');
            font-weight: bold;
            font-style: normal;
        }

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
            color: #000 !important;
            text-transform: lowercase;
        }

        body { 
            font-family: 'TH Sarabun PSK', sans-serif; 
            font-size: 16px; 
            margin: 0;
            padding: 20px;
            line-height: 1.15;
        }

        .logo-container { text-align: center; margin-bottom: 5px; }
        .logo-container img { height: 60px; }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .header-left { flex: 1; }
        .header-left p { margin: 0; font-size: 16px; }

        .header-right { text-align: right; }
        .stats-box { font-size: 16px; }

        .main-table { 
            width: 100%; 
            border-collapse: collapse; 
            table-layout: fixed; 
        }
        
        .main-table th, .main-table td { 
            border: 1px solid #000; 
            padding: 4px 5px; 
            text-align: center; 
            height: 30px;
            word-wrap: break-word;
            vertical-align: middle;
            font-size: 16px;
        }
        
        .main-table th { 
            background-color: #f2f2f2 !important; /* เปลี่ยนจากสีฟ้าเป็นสีเทาอ่อน */
            font-weight: bold;
        }

        .text-left { text-align: left !important; padding-left: 10px !important; }

        @media print {
            @page { 
                size: A4; 
                margin: 10mm;
            }
            body { padding: 0; }
        }
    </style>
</head>
<body style="background: white;">

    <div class="logo-container">
        <img src="{{ asset('assets/img/cpw.png') }}" alt="school logo">
    </div>

    <div class="header-section">
        <div class="header-left">
            <p style="font-weight: bold;">โรงเรียนชลประทานวิทยา</p>
            <p>รายชื่อผู้สมัครกิจกรรม: {{ strtolower($activity->title) }}</p>
            <p>วันที่จัด: {{ date('d/m/y', strtotime($activity->date)) }} | สถานที่: {{ strtolower($activity->location) }}</p>
            <p>วิทยากร: 
                @forelse($activity->lecturers as $lec)
                    {{ strtolower($lec->first_name) }} {{ strtolower($lec->last_name) }}@if(!$loop->last), @endif
                @empty - @endforelse
            </p>
        </div>

        <div class="header-right">
            <div class="stats-box">
                <p style="margin:0">ชาย: {{ $participants->where('user.gender', 'male')->count() }}</p>
                <p style="margin:0">หญิง: {{ $participants->where('user.gender', 'female')->count() }}</p>
                <p style="margin:0; font-weight:bold;">ทั้งหมด: {{ $participants->count() }}</p>
            </div>
        </div>
    </div>

    <table class="main-table">
        <thead>
            <tr>
                <th width="45">เลขที่</th>
                <th width="90">เลขประจำตัว</th>
                <th width="240">ชื่อ - นามสกุล</th>
                <th width="80">ชั้น/ห้อง</th>
                <th width="120">เบอร์โทรศัพท์</th>
            </tr>
        </thead>
        <tbody>
            @forelse($participants as $index => $reg)
            <tr>
                <td>{{ $reg->student_no ?? ($index + 1) }}</td>
                <td>{{ $reg->user->student_id ?? '-' }}</td>
                <td class="text-left">
                    {{ strtolower($reg->user->prefix) }}{{ strtolower($reg->user->first_name) }} {{ strtolower($reg->user->last_name) }}
                </td>
                <td>{{ strtolower($reg->class_room) ?? '-' }}</td>
                <td>{{ $reg->phone }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 50px;">ไม่พบข้อมูลผู้สมัคร</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>