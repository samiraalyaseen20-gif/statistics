<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>التقرير الإحصائي الطبي - مركز السيدة زينب(ع)</title>
    <!-- Google Fonts: Tajawal -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        /* ═══════════════════════════════════════════════════════════
           PROFESSIONAL A4 PRINT DESIGN SYSTEM
           ═══════════════════════════════════════════════════════════ */
        @page {
            size: A4 portrait;
            margin: 1.5cm 1.2cm 1.5cm 1.2cm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            margin: 0;
            padding: 0;
            font-size: 9.5pt;
            line-height: 1.4;
            direction: rtl;
        }

        /* ─── الترويسة الرسمية للتقرير ─── */
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #8b5cf6;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }

        .header-logo-text {
            text-align: right;
        }

        .header-logo-text h2 {
            margin: 0;
            font-size: 13pt;
            font-weight: 800;
            color: #1e1b4b;
        }

        .header-logo-text p {
            margin: 2px 0 0 0;
            font-size: 8.5pt;
            color: #64748b;
            font-weight: 700;
        }

        .report-title-block {
            text-align: left;
        }

        .report-title-block h1 {
            margin: 0;
            font-size: 15pt;
            font-weight: 800;
            color: #7c3aed;
        }

        .report-title-block p {
            margin: 3px 0 0 0;
            font-size: 9pt;
            color: #475569;
            font-weight: 500;
        }

        /* ─── تخطيط البطاقات والمجموعات الإحصائية ─── */
        .report-section {
            margin-bottom: 22px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .section-title {
            font-size: 10.5pt;
            font-weight: 700;
            color: #1e1b4b;
            background-color: #f5f3ff;
            border-right: 4px solid #7c3aed;
            padding: 6px 10px;
            margin: 0 0 10px 0;
            border-radius: 2px;
        }

        /* ─── تنسيق الجداول المحكم ─── */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        th {
            background-color: #ede9fe;
            color: #4338ca;
            font-weight: 700;
            font-size: 8.5pt;
            border: 1px solid #c4b5fd;
            padding: 5px 8px;
            text-align: center;
        }

        td {
            border: 1px solid #e2e8f0;
            padding: 5px 8px;
            font-size: 8.5pt;
            color: #334155;
            text-align: center;
        }

        tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        .text-right {
            text-align: right !important;
        }

        .font-bold {
            font-weight: 700;
        }

        .total-row td {
            background-color: #f5f3ff !important;
            font-weight: 800;
            border-top: 1.5px solid #7c3aed;
            color: #4c1d95;
            font-size: 9pt;
        }

        /* ─── تخطيط جنبًا إلى جنب للجداول الثنائية ─── */
        .columns-layout {
            display: flex;
            gap: 15px;
            justify-content: space-between;
        }

        .col-half {
            width: 49%;
        }

        /* ─── بطاقات تفاصيل عمليات الأطباء (جدول 10) ─── */
        .doctor-card {
            border: 1px solid #ddd6fe;
            border-radius: 4px;
            margin-bottom: 12px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .doctor-card-header {
            background-color: #ede9fe;
            padding: 6px 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #c4b5fd;
            font-weight: 700;
            font-size: 9pt;
            color: #1e1b4b;
        }

        .doctor-badge {
            background-color: #7c3aed;
            color: #ffffff;
            padding: 1px 6px;
            border-radius: 10px;
            font-size: 8pt;
            font-weight: 700;
        }

        .badge {
            padding: 1px 5px;
            border-radius: 3px;
            font-size: 7.5pt;
            font-weight: 700;
            border: 1px solid transparent;
            display: inline-block;
        }

        .badge-purple { bg-purple-100; border-color: #d8b4fe; color: #6b21a8; }
        .badge-rose { bg-rose-100; border-color: #fca5a5; color: #9f1239; }
        .badge-orange { bg-orange-100; border-color: #fed7aa; color: #9a3412; }
        .badge-blue { bg-blue-100; border-color: #bfdbfe; color: #1e40af; }
        .badge-sky { bg-sky-100; border-color: #bae6fd; color: #075985; }
        .badge-yellow { bg-yellow-100; border-color: #fef08a; color: #854d0e; }
        .badge-slate { bg-slate-100; border-color: #e2e8f0; color: #334155; }

        .copyright-banner {
            text-align: center;
            padding: 5px;
            border-top: 1px solid #f1f5f9;
            font-size: 7.5pt;
            color: #94a3b8;
            font-style: italic;
        }

        /* ─── ترقيم وتذييل الصفحات ─── */
        .print-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8pt;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 5px;
            display: none; /* يتم التعامل معه تلقائياً بواسطة @page في المتصفحات الداعمة */
        }
    </style>
</head>
<body onload="window.print()">

    <!-- ─── الترويسة ─── -->
    <div class="report-header">
        <div class="header-logo-text">
            <h2>مركز السيدة زينب (عليها السلام) الجراحي التخصصي</h2>
            <p>القسم الإحصائي الطبي والعلاقات العامة</p>
        </div>
        <div class="report-title-block">
            <h1>التقرير الإحصائي الطبي العام</h1>
            <p>
                للفترة: 
                <span class="font-bold">
                    {{ \Carbon\Carbon::parse($start_date)->translatedFormat('M Y') }}
                    @if(substr($start_date,0,7) !== substr($end_date,0,7))
                        — {{ \Carbon\Carbon::parse($end_date)->translatedFormat('M Y') }}
                    @endif
                </span>
            </p>
        </div>
    </div>

    <!-- ─── المجموعات الكلية (بطاقات ملمومة) ─── -->
    <div class="report-section">
        <div class="section-title">ملخص المؤشرات الكلية</div>
        <table>
            <thead>
                <tr>
                    <th>مراجعي الاستشاريات</th>
                    <th>فحوصات البصر</th>
                    <th>العمليات الجراحية</th>
                    <th>مراجعي المختبر</th>
                </tr>
            </thead>
            <tbody>
                <tr class="font-bold" style="font-size: 11pt; height: 35px;">
                    <td>{{ number_format($totalVisits) }}</td>
                    <td>{{ number_format($totalEyeTests) }}</td>
                    <td>{{ number_format($totalSurgeries) }}</td>
                    <td>{{ number_format($labVisitCount) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ─── جدول 1 وجدول 2 ─── -->
    <div class="report-section">
        <div class="columns-layout">
            <!-- جدول 1 -->
            <div class="col-half">
                <div class="section-title">جدول (1): الاستشاريات الطبية</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40px">ت</th>
                            <th>الاستشارية</th>
                            <th>المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consultations as $i => $c)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-right">{{ $c['unit'] }}</td>
                            <td class="font-bold">{{ number_format($c['total']) }}</td>
                        </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="2">المجموع الكلي</td>
                            <td>{{ number_format($consultations->sum('total')) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- جدول 2 -->
            <div class="col-half">
                <div class="section-title">جدول (2): الاستشارية لكل طبيب</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40px">ت</th>
                            <th>الطبيب الاختصاص</th>
                            <th>المرضى</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitsByDoctor as $i => $v)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-right">{{ $v['doctor'] }}</td>
                            <td class="font-bold">{{ number_format($v['total']) }}</td>
                        </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="2">المجموع الكلي</td>
                            <td>{{ number_format($visitsByDoctor->sum('total')) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ─── جدول 3 وجدول 4 ─── -->
    <div class="report-section">
        <div class="columns-layout">
            <!-- جدول 3 -->
            <div class="col-half">
                <div class="section-title">جدول (3): الديمغرافي (داخل العراق)</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40px">ت</th>
                            <th>المحافظة</th>
                            <th>العدد</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visitsByGov as $i => $g)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-right">{{ $g['gov'] }}</td>
                            <td class="font-bold">{{ number_format($g['total']) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3">لا توجد بيانات</td></tr>
                        @endforelse
                        <tr class="total-row">
                            <td colspan="2">المجموع</td>
                            <td>{{ number_format($visitsByGov->sum('total')) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- جدول 4 -->
            <div class="col-half">
                <div class="section-title">جدول (4): الديمغرافي (خارج العراق)</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40px">ت</th>
                            <th>الدولة</th>
                            <th>العدد</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visitsByCountry as $i => $c)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-right">{{ $c['country'] }}</td>
                            <td class="font-bold">{{ number_format($c['total']) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3">لا توجد بيانات</td></tr>
                        @endforelse
                        <tr class="total-row">
                            <td colspan="2">المجموع</td>
                            <td>{{ number_format($visitsByCountry->sum('total')) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div style="page-break-before: always;"></div>

    <!-- ─── جدول 5 وجدول 6 ─── -->
    <div class="report-section">
        <div class="columns-layout">
            <!-- جدول 5 -->
            <div class="col-half">
                <div class="section-title">جدول (5): فحوصات البصر بالنوع</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40px">ت</th>
                            <th>الفحص البصري</th>
                            <th>المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eyeTestsByType as $i => $t)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-right">{{ $t['type'] }}</td>
                            <td class="font-bold">{{ number_format($t['total']) }}</td>
                        </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="2">المجموع الكلي</td>
                            <td>{{ number_format($eyeTestsByType->sum('total')) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- جدول 6 -->
            <div class="col-half">
                <div class="section-title">جدول (6): تحاليل المختبر بالنوع</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40px">ت</th>
                            <th>نوع التحليل</th>
                            <th>المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($labTestsByType as $i => $t)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-right">{{ $t['type'] }}</td>
                            <td class="font-bold">{{ number_format($t['total']) }}</td>
                        </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="2">المجموع الكلي</td>
                            <td>{{ number_format($labTestsByType->sum('total')) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ─── جدول 7 ─── -->
    <div class="report-section">
        <div class="section-title">جدول (7): تصنيف العمليات حسب القطاع (حكومي / خاص / عام)</div>
        <table>
            <thead>
                <tr>
                    <th>توزيع العمليات</th>
                    <th>حكومي (ص)</th>
                    <th>عتبة العام (ع)</th>
                    <th>عتبة الخاص (خ)</th>
                    <th class="font-bold">المجموع الكلي</th>
                </tr>
            </thead>
            <tbody>
                @php
                $catMap = [];
                foreach($surgeriesByCatSector as $s) {
                    $catMap[$s->classification][$s->sector] = $s->total;
                }
                $sectors = ['صحة', 'عام', 'خاص'];
                $classifications = ['خاصة', 'فوق الكبرى', 'كبرى', 'وسطى (حقن)', 'وسطى (ليزر)', 'وسطى', 'صغرى'];
                $totalSec = ['صحة' => 0, 'عام' => 0, 'خاص' => 0];
                @endphp
                @foreach($classifications as $c)
                @php
                $s0 = $catMap[$c]['صحة'] ?? 0;
                $s1 = $catMap[$c]['عام'] ?? 0;
                $s2 = $catMap[$c]['خاص'] ?? 0;
                $rowTot = $s0 + $s1 + $s2;
                $totalSec['صحة'] += $s0;
                $totalSec['عام'] += $s1;
                $totalSec['خاص'] += $s2;
                @endphp
                <tr>
                    <td class="font-bold text-right">{{ $c }}</td>
                    <td>{{ $s0 ?: '—' }}</td>
                    <td>{{ $s1 ?: '—' }}</td>
                    <td>{{ $s2 ?: '—' }}</td>
                    <td class="font-bold">{{ number_format($rowTot) ?: '—' }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td>المجموع الكلي</td>
                    <td>{{ number_format($totalSec['صحة']) }}</td>
                    <td>{{ number_format($totalSec['عام']) }}</td>
                    <td>{{ number_format($totalSec['خاص']) }}</td>
                    <td>{{ number_format(array_sum($totalSec)) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ─── جدول 8 وجدول 9 ─── -->
    <div class="report-section">
        <div class="columns-layout">
            <!-- جدول 8 -->
            <div class="col-half">
                <div class="section-title">جدول (8): ديمغرافي العمليات (داخل العراق)</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40px">ت</th>
                            <th>المحافظة</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($surgeriesByGov as $i => $g)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-right">{{ $g['gov'] }}</td>
                            <td class="font-bold">{{ number_format($g['total']) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3">لا توجد بيانات</td></tr>
                        @endforelse
                        <tr class="total-row">
                            <td colspan="2">المجموع</td>
                            <td>{{ number_format($surgeriesByGov->sum('total')) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- جدول 9 -->
            <div class="col-half">
                <div class="section-title">جدول (9): ديمغرافي العمليات (خارج العراق)</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40px">ت</th>
                            <th>الدولة</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($surgeriesByCountry as $i => $c)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-right">{{ $c['country'] }}</td>
                            <td class="font-bold">{{ number_format($c['total']) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3">لا توجد بيانات</td></tr>
                        @endforelse
                        <tr class="total-row">
                            <td colspan="2">المجموع</td>
                            <td>{{ number_format($surgeriesByCountry->sum('total')) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div style="page-break-before: always;"></div>

    <!-- ─── جدول 10: العمليات التفصيلية لكل طبيب اختصاص حسب النوع ─── -->
    @php
    $detailSource = $doctorOpStatsByDoctor ?? collect();
    $bcMapClasses = [
        'خاصة'       => 'background-color: #f3e8ff; border-color: #d8b4fe; color: #6b21a8;',
        'فوق الكبرى' => 'background-color: #ffe4e6; border-color: #fca5a5; color: #9f1239;',
        'كبرى'        => 'background-color: #ffedd5; border-color: #fed7aa; color: #9a3412;',
        'وسطى (حقن)' => 'background-color: #dbeafe; border-color: #bfdbfe; color: #1e40af;',
        'وسطى (ليزر)'=> 'background-color: #e0f2fe; border-color: #bae6fd; color: #075985;',
        'وسطى'        => 'background-color: #dbeafe; border-color: #bfdbfe; color: #1e40af;',
        'صغرى'        => 'background-color: #fef9c3; border-color: #fef08a; color: #854d0e;',
    ];
    @endphp

    <div class="report-section">
        <div class="section-title">جدول (10): العمليات التفصيلية لكل طبيب اختصاص حسب النوع</div>
        
        @forelse($filterDoctors as $doc)
            @php
            $docOps = $detailSource->get($doc->name) ?? collect();
            $docOps = $docOps->filter(fn($op) => $op->total > 0)->values();
            $docTotal = $docOps->sum('total');
            @endphp
            @if($docOps->count() > 0)
            <div class="doctor-card">
                <div class="doctor-card-header">
                    <span>{{ $doc->name }}</span>
                    <span class="doctor-badge">{{ number_format($docTotal) }} عملية</span>
                </div>
                <table style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="width: 45px">ت</th>
                            <th class="text-right">اسم العملية</th>
                            <th style="width: 140px">التصنيف</th>
                            <th style="width: 90px">العدد</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($docOps as $i => $op)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-right font-bold">{{ $op->op }}</td>
                            <td>
                                <span class="badge" style="{{ $bcMapClasses[$op->classification] ?? 'background-color:#f1f5f9; border-color:#e2e8f0; color:#334155;' }}">
                                    {{ $op->classification }}
                                </span>
                            </td>
                            <td class="font-bold" style="color: #7c3aed;">{{ number_format($op->total) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <td colspan="3" class="text-right" style="padding-right: 15px;">إجمالي عمليات الطبيب</td>
                            <td>{{ number_format($docTotal) }}</td>
                        </tr>
                    </tfoot>
                </table>
                @if($showCopyright)
                <div class="copyright-banner">
                    جميع الحقوق محفوظة لدى المهندسة سميره علي ياسين
                </div>
                @endif
            </div>
            @endif
        @empty
            <div style="text-align: center; padding: 20px; color: #94a3b8; font-weight: bold;">
                لا توجد عمليات تفصيلية مسجلة لهذه الفترة
            </div>
        @endforelse
    </div>

</body>
</html>
