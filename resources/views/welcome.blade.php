<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة التحكم المؤشرات الذكية - Multi-Style Dashboard</title>

    <!-- Google Fonts: Outfit, Tajawal & Rubik for Brutalism -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Tajawal:wght@400;500;700&family=Rubik+Mono+One&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (compiled via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ApexCharts CDN for advanced charts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Lucide Icons CDN for sleek icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Tajawal', 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        /* Custom scrollbar matching active theme */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        body[data-theme="glass"] ::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.15);
        }
        body[data-theme="brutal"] ::-webkit-scrollbar-thumb {
            background: #000000;
            border: 2px solid #000000;
        }
    </style>
</head>
<body class="min-h-screen p-6 md:p-12" data-theme="soft">

    <!-- Background blobs for Glassmorphism theme -->
    <div class="fixed top-10 left-10 w-80 h-80 rounded-full bg-pink-400/30 blur-3xl glass-blob pointer-events-none z-[-1]"></div>
    <div class="fixed bottom-20 right-10 w-96 h-96 rounded-full bg-sky-400/30 blur-3xl glass-blob pointer-events-none z-[-1]"></div>
    <div class="fixed top-1/2 left-1/3 w-80 h-80 rounded-full bg-emerald-400/25 blur-3xl glass-blob pointer-events-none z-[-1]"></div>

    <!-- Container -->
    <div class="max-w-7xl mx-auto">

        <!-- Top Header Navigation -->
        <header class="flex justify-between items-center mb-6">
            <!-- Left Dots Control Window mimic -->
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-red-400 shadow-soft-out-sm"></div>
                <div class="w-4 h-4 rounded-full bg-yellow-400 shadow-soft-out-sm"></div>
                <div class="w-4 h-4 rounded-full bg-green-400 shadow-soft-out-sm"></div>
            </div>

            <!-- Title -->
            <h1 class="text-3xl font-bold tracking-tight text-text-main font-['Outfit']">KPI Dashboard</h1>

            <!-- Right Circular Badge -->
            <div class="w-16 h-16 rounded-full custom-card flex items-center justify-center font-bold text-xl text-text-main font-['Outfit']">
                19
            </div>
        </header>

        <!-- Theme Switcher (Paradigm Switcher) -->
        <div class="mb-6 p-4 rounded-[20px] custom-card flex flex-wrap items-center justify-between gap-4">
            <span class="text-sm font-bold text-text-main flex items-center gap-2">
                <i data-lucide="palette" class="w-5 h-5 text-pink-500"></i>
                نظام تحويل مدارس التصميم والهوية البصرية:
            </span>
            <div class="flex flex-wrap gap-3">
                <!-- Style 1: Soft UI -->
                <button onclick="changeTheme('soft')" class="theme-btn py-2.5 px-4 rounded-xl text-xs font-bold custom-card flex items-center gap-2 text-text-main" data-theme-btn="soft">
                    <span class="w-3.5 h-3.5 rounded-full bg-[#eef2f7] border border-slate-300"></span>
                    ثيم سوفت (Soft UI)
                </button>
                <!-- Style 2: Glassmorphism -->
                <button onclick="changeTheme('glass')" class="theme-btn py-2.5 px-4 rounded-xl text-xs font-bold custom-card flex items-center gap-2 text-text-main" data-theme-btn="glass">
                    <span class="w-3.5 h-3.5 rounded-full bg-gradient-to-r from-pink-500 to-sky-500 border border-slate-300 animate-pulse"></span>
                    ثيم زجاجي (Glassmorphism)
                </button>
                <!-- Style 3: Neo-Brutalism -->
                <button onclick="changeTheme('brutal')" class="theme-btn py-2.5 px-4 rounded-xl text-xs font-bold custom-card flex items-center gap-2 text-text-main" data-theme-btn="brutal">
                    <span class="w-3.5 h-3.5 rounded-full bg-[#ffde43] border-2 border-black"></span>
                    ثيم بروتاليزم (Brutalism)
                </button>
                <!-- Style 4: Minimalist Clean -->
                <button onclick="changeTheme('minimalist')" class="theme-btn py-2.5 px-4 rounded-xl text-xs font-bold custom-card flex items-center gap-2 text-text-main" data-theme-btn="minimalist">
                    <span class="w-3.5 h-3.5 rounded-full bg-[#ffffff] border border-slate-300"></span>
                    ثيم مبسط (Minimalist)
                </button>
                <!-- Style 5: Excel Sheet style -->
                <button onclick="changeTheme('excel')" class="theme-btn py-2.5 px-4 rounded-xl text-xs font-bold custom-card flex items-center gap-2 text-text-main" data-theme-btn="excel">
                    <span class="w-3.5 h-3.5 rounded-full bg-[#107c41] border border-slate-300"></span>
                    ثيم إكسل (Excel)
                </button>
            </div>
        </div>

        <!-- Alerts Demonstration Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="alert-box alert-success">
                <i data-lucide="check-circle-2" class="w-5 h-5 text-theme-emerald shrink-0"></i>
                <div>
                    <span class="font-bold">نجاح العملية:</span> تم تحديث صندوق الكاش اليومي واستلام الدفعة بنجاح.
                </div>
            </div>
            <div class="alert-box alert-warning">
                <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-500 shrink-0"></i>
                <div>
                    <span class="font-bold">تنبيه النظام:</span> يوجد طبيب واحد متاح حالياً في عيادة الباطنية، يرجى تدقيق الطابور.
                </div>
            </div>
        </div>

        <!-- main Grid -->
        <main class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Card 1: Overview and Vertical Bars -->
            <section class="custom-card p-6 hover-lift">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-text-main">Overview</h2>
                    <button class="w-8 h-8 rounded-full custom-card flex items-center justify-center hover-press text-text-main opacity-70">
                        <i data-lucide="more-horizontal" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Custom Bar representation -->
                <div class="flex justify-between items-end h-44 px-4 mb-6">
                    <!-- Bar 1 -->
                    <div class="flex flex-col items-center gap-2 w-8">
                        <div class="w-full custom-inset rounded-full h-36 flex items-end p-[3px]">
                            <div class="w-full bg-gradient-to-t from-pink-500 to-pink-300 rounded-full" style="height: 80%"></div>
                        </div>
                        <span class="text-[10px] text-text-main opacity-60 font-['Outfit']">Class 1</span>
                    </div>
                    <!-- Bar 2 -->
                    <div class="flex flex-col items-center gap-2 w-8">
                        <div class="w-full custom-inset rounded-full h-36 flex items-end p-[3px]">
                            <div class="w-full bg-gradient-to-t from-amber-500 to-amber-300 rounded-full" style="height: 65%"></div>
                        </div>
                        <span class="text-[10px] text-text-main opacity-60 font-['Outfit']">Class 2</span>
                    </div>
                    <!-- Bar 3 -->
                    <div class="flex flex-col items-center gap-2 w-8">
                        <div class="w-full custom-inset rounded-full h-36 flex items-end p-[3px]">
                            <div class="w-full bg-gradient-to-t from-emerald-500 to-emerald-300 rounded-full" style="height: 90%"></div>
                        </div>
                        <span class="text-[10px] text-text-main opacity-60 font-['Outfit']">Class 3</span>
                    </div>
                    <!-- Bar 4 -->
                    <div class="flex flex-col items-center gap-2 w-8">
                        <div class="w-full custom-inset rounded-full h-36 flex items-end p-[3px]">
                            <div class="w-full bg-gradient-to-t from-sky-500 to-sky-300 rounded-full" style="height: 50%"></div>
                        </div>
                        <span class="text-[10px] text-text-main opacity-60 font-['Outfit']">Class 4</span>
                    </div>
                </div>

                <div class="border-t border-slate-200/30 pt-4 flex justify-between">
                    <div>
                        <div class="text-xs text-text-main opacity-70 font-medium">Sales Analysis</div>
                        <div class="text-xl font-bold text-theme-pink font-['Outfit']">23K</div>
                    </div>
                    <div class="text-left">
                        <div class="text-xs text-text-main opacity-70 font-medium">Revenue</div>
                        <div class="text-xl font-bold text-sky-500 font-['Outfit']">12K</div>
                    </div>
                </div>
            </section>


            <!-- Card 2: 4 circular progress metrics -->
            <section class="custom-card p-6 hover-lift">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-text-main">KPI Dashboard</h2>
                    <button class="w-8 h-8 rounded-full custom-card flex items-center justify-center hover-press text-text-main opacity-70">
                        <i data-lucide="sliders" class="w-4 h-4"></i>
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <!-- Radial 1 -->
                    <div class="flex flex-col items-center p-2 rounded-2xl custom-inset">
                        <div id="chart-radial-1"></div>
                        <span class="text-xs text-text-main opacity-80 font-medium">Data Analysis #1</span>
                    </div>
                    <!-- Radial 2 -->
                    <div class="flex flex-col items-center p-2 rounded-2xl custom-inset">
                        <div id="chart-radial-2"></div>
                        <span class="text-xs text-text-main opacity-80 font-medium">Data Analysis #2</span>
                    </div>
                    <!-- Radial 3 -->
                    <div class="flex flex-col items-center p-2 rounded-2xl custom-inset">
                        <div id="chart-radial-3"></div>
                        <span class="text-xs text-text-main opacity-80 font-medium">Data Analysis #3</span>
                    </div>
                    <!-- Radial 4 -->
                    <div class="flex flex-col items-center p-2 rounded-2xl custom-inset">
                        <div id="chart-radial-4"></div>
                        <span class="text-xs text-text-main opacity-80 font-medium">Data Analysis #4</span>
                    </div>
                </div>

                <div class="text-center custom-card rounded-xl py-2">
                    <span class="text-xs text-text-main opacity-70">Total volume:</span>
                    <span class="text-sm font-bold text-text-main font-['Outfit']">277,2M</span>
                </div>
            </section>


            <!-- Card 3: Wave/Area Chart Sales -->
            <section class="custom-card p-6 hover-lift">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-text-main">KPI Dashboard Sales</h2>
                    <span class="badge-success shadow-soft-out-sm font-['Outfit']">96%</span>
                </div>

                <!-- Apex Area Chart -->
                <div class="w-full custom-inset rounded-2xl p-2 mb-4">
                    <div id="chart-area-sales"></div>
                </div>

                <p class="text-xs text-text-main opacity-60 text-center leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aeneam commodo ligula eget.
                </p>
            </section>


            <!-- Card 4: Strategy and Development Gauge -->
            <section class="custom-card p-6 hover-lift md:col-span-2 lg:col-span-1">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-lg font-bold text-text-main">Strategy & Development</h2>
                        <span class="text-xs text-text-main opacity-60 font-['Outfit']">Q 277,2M</span>
                    </div>
                    <button class="w-8 h-8 rounded-full custom-card flex items-center justify-center text-theme-emerald">
                        <i data-lucide="trending-up" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Semi circle donut -->
                <div class="flex justify-center items-start h-36 overflow-hidden custom-inset rounded-2xl mb-4">
                    <div id="chart-gauge-strategy" class="w-full"></div>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-2 rounded-xl custom-card">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-pink-500 shadow-soft-out-sm"></span>
                            <span class="text-xs text-text-main opacity-80 font-medium">Value Title</span>
                        </div>
                        <span class="text-xs font-bold text-text-main font-['Outfit']">16.2M</span>
                    </div>
                    <div class="flex items-center justify-between p-2 rounded-xl custom-card">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-soft-out-sm"></span>
                            <span class="text-xs text-text-main opacity-80 font-medium">Value Title</span>
                        </div>
                        <span class="text-xs font-bold text-text-main font-['Outfit']">10.8M</span>
                    </div>
                    <div class="flex items-center justify-between p-2 rounded-xl custom-card">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-sky-500 shadow-soft-out-sm"></span>
                            <span class="text-xs text-text-main opacity-80 font-medium">Value Title</span>
                        </div>
                        <span class="text-xs font-bold text-text-main font-['Outfit']">18.2M</span>
                    </div>
                </div>
            </section>


            <!-- Card 5: Speedometer Dials & Bar -->
            <section class="custom-card p-6 hover-lift md:col-span-2">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-text-main">Analysis & Speedometer Dials</h2>
                    <span class="text-xs text-text-main opacity-60 font-medium">مستشعرات أداء حية</span>
                </div>

                <!-- 3 Speedometers Row -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                    <!-- Dial 1 -->
                    <div class="flex flex-col items-center custom-inset p-4 rounded-[20px]">
                        <div id="chart-dial-pink"></div>
                        <div class="text-xs font-bold text-text-main mt-2">مستوى الطلبات</div>
                    </div>
                    <!-- Dial 2 -->
                    <div class="flex flex-col items-center custom-inset p-4 rounded-[20px]">
                        <div id="chart-dial-orange"></div>
                        <div class="text-xs font-bold text-text-main mt-2">معدل التحويل</div>
                    </div>
                    <!-- Dial 3 -->
                    <div class="flex flex-col items-center custom-inset p-4 rounded-[20px]">
                        <div id="chart-dial-green"></div>
                        <div class="text-xs font-bold text-text-main mt-2">نسبة الاستبقاء</div>
                    </div>
                </div>

                <!-- Multi-bar Chart at the bottom of card -->
                <div class="custom-inset rounded-2xl p-4">
                    <div id="chart-multi-bar"></div>
                </div>
            </section>

            <!-- Card 6: Donut Chart - Revenue Breakdown -->
            <section class="custom-card p-6 hover-lift">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-text-main">توزيع الإيرادات حسب العيادات</h2>
                    <button class="w-8 h-8 rounded-full custom-card flex items-center justify-center text-text-main opacity-70">
                        <i data-lucide="pie-chart" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="w-full custom-inset rounded-2xl p-4 flex justify-center items-center">
                    <div id="chart-donut-departments" class="w-full"></div>
                </div>
            </section>

            <!-- Card 7: Radar Chart - Clinic Quality Metrics -->
            <section class="custom-card p-6 hover-lift">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-text-main">مؤشر كفاءة وجودة الخدمة</h2>
                    <button class="w-8 h-8 rounded-full custom-card flex items-center justify-center text-text-main opacity-70">
                        <i data-lucide="activity" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="w-full custom-inset rounded-2xl p-2">
                    <div id="chart-radar-quality" class="w-full"></div>
                </div>
            </section>

            <!-- Card 8: Stacked Columns - Consultations vs Extras -->
            <section class="custom-card p-6 hover-lift">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-text-main">الإيرادات المتراكمة (كشفيات vs تحاليل)</h2>
                    <button class="w-8 h-8 rounded-full custom-card flex items-center justify-center text-text-main opacity-70">
                        <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="w-full custom-inset rounded-2xl p-2">
                    <div id="chart-stacked-revenue" class="w-full"></div>
                </div>
            </section>

            <!-- Card 10: Bubble Chart - Patient Demographics & Spending (Spans full row lg:col-span-3) -->
            <section class="custom-card p-6 hover-lift lg:col-span-3">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-text-main">تحليل فئات المرضى وإنفاقهم</h2>
                        <span class="text-xs text-text-main opacity-60">الزيارات والإنفاق حسب العمر والعيادة</span>
                    </div>
                    <button class="w-8 h-8 rounded-full custom-card flex items-center justify-center text-text-main opacity-70">
                        <i data-lucide="scatter-chart" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="w-full custom-inset rounded-2xl p-4">
                    <div id="chart-bubble-spend" class="w-full"></div>
                </div>
            </section>


            <!-- Card 11: Dynamic Data Grid (Table) with Pagination, Date Selector & Filters -->
            <section class="custom-card p-6 hover-lift lg:col-span-3">
                <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-text-main">جدول سجل المعاملات المالية والمرضى (Data Grid)</h2>
                        <span class="text-xs text-text-main opacity-60">تحديث فوري وتصفية ذكية لمعاملات العيادات الخارجية</span>
                    </div>
                    <!-- Trigger Modal Button -->
                    <button onclick="toggleModal(true)" class="py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-pink-400 hover-press flex items-center gap-2 shadow-soft-out-sm font-['Outfit']" id="add-trans-trigger">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        تسجيل كشفية (فتح Modal)
                    </button>
                </div>

                <!-- Filters & Date Selector Bar -->
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6 p-4 rounded-2xl custom-inset">
                    <!-- Search Input -->
                    <div class="flex items-center gap-2 px-2">
                        <i data-lucide="search" class="w-4 h-4 text-text-main opacity-50 shrink-0"></i>
                        <input type="text" placeholder="اسم المريض..." class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main placeholder-text-main opacity-60" id="search-input">
                    </div>
                    <!-- Clinic Dropdown -->
                    <div>
                        <select class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main" id="doctor-select">
                            <option>جميع الأطباء...</option>
                            <option>د. أحمد سليمان</option>
                            <option>د. سارة العلي</option>
                            <option>د. سمر الياسين</option>
                        </select>
                    </div>
                    <!-- Status Filter -->
                    <div>
                        <select class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main" id="status-select">
                            <option>حالة الدفع...</option>
                            <option>مدفوع</option>
                            <option>غير مدفوع</option>
                        </select>
                    </div>
                    <!-- Date Selector (ديت سليكتر) -->
                    <div class="flex items-center gap-2 px-2 border-r border-slate-200/20">
                        <i data-lucide="calendar" class="w-4 h-4 text-text-main opacity-50 shrink-0"></i>
                        <input type="date" value="" class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main custom-date-input" id="date-select">
                    </div>
                </div>

                <!-- Table Wrapper -->
                <div class="overflow-x-auto w-full mb-6">
                    <table class="custom-table">
                        <thead>
                            <tr class="table-header-row">
                                <th>رقم المعاملة</th>
                                <th>اسم المريض</th>
                                <th>الطبيب المعالج</th>
                                <th>سعر الكشفية</th>
                                <th>حالة الدفع</th>
                                <th>تاريخ الزيارة</th>
                            </tr>
                        </thead>
                        <tbody id="table-data-body">
                            <!-- Injected dynamically by JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Container (Default Standard Pagination) -->
                <div id="standard-pagination" class="flex justify-between items-center">
                    <span class="text-xs text-text-main opacity-70" id="pag-label">عرض 1 إلى 4 من أصل 10 قيود</span>
                    <div class="flex gap-2" id="pag-buttons">
                        <!-- Injected dynamically by JS -->
                    </div>
                </div>

                <!-- Excel Tab-style Simulator (Visible ONLY in Excel theme) -->
                <div id="excel-pagination" class="hidden excel-sheet-container -mx-6 -mb-6">
                    <div class="flex items-center gap-2 mr-2" id="excel-tabs-list">
                        <!-- Injected dynamically by JS -->
                    </div>
                    <div class="ml-auto text-[11px] text-slate-600 mr-2 flex items-center gap-1 font-semibold">
                        <i data-lucide="info" class="w-3.5 h-3.5 text-emerald-700"></i>
                        جاهز (Excel Mode)
                    </div>
                </div>
            </section>


            <!-- Card 12: Interactive Component Demos -->
            <section class="custom-card p-6 hover-lift lg:col-span-3">
                <h2 class="text-lg font-bold text-text-main mb-6">مكونات تفاعلية متعددة المدارس البصرية</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Column 1: Buttons and Knobs -->
                    <div class="space-y-6">
                        <h3 class="text-sm font-semibold text-text-main opacity-70 border-b border-slate-200/20 pb-2">الأزرار وتأثيرات الضغط</h3>
                        
                        <div class="flex gap-4">
                            <button class="flex-1 py-3 px-4 custom-card rounded-xl text-xs font-bold text-theme-pink hover-press">
                                زر بارز (Raised)
                            </button>
                            <button class="flex-1 py-3 px-4 custom-inset rounded-xl text-xs font-bold text-theme-emerald hover-press">
                                زر غائر (Sunken)
                            </button>
                        </div>

                        <div class="flex justify-between items-center custom-inset p-3 rounded-xl">
                            <span class="text-xs font-bold text-text-main opacity-80">مفتاح تفعيل ذكي</span>
                            <!-- Custom Switch Toggle -->
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="switch-demo" class="sr-only peer" checked>
                                <div class="w-12 h-6 custom-inset rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gradient-to-r after:from-emerald-500 after:to-emerald-400 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:shadow-inner"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Column 2: Form Inputs -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-text-main opacity-70 border-b border-slate-200/20 pb-2">حقول الإدخال والبحث</h3>
                        
                        <div class="relative">
                            <input type="text" placeholder="ابحث عن مريض..." class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-3 px-4 text-xs font-medium text-text-main placeholder-text-main opacity-40">
                            <div class="absolute left-3 top-3.5 text-text-main opacity-50">
                                <i data-lucide="search" class="w-4 h-4"></i>
                            </div>
                        </div>

                        <div class="relative">
                            <select class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-3 px-4 text-xs font-medium text-text-main">
                                <option>اختر الطبيب المعالج...</option>
                                <option>د. أحمد سليمان - العيادة الباطنية</option>
                                <option>د. سارة العلي - عيادة الأطفال</option>
                            </select>
                        </div>
                    </div>

                    <!-- Column 3: Indicators and values -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-text-main opacity-70 border-b border-slate-200/20 pb-2">حالة الدفع وحجز الطابور</h3>
                        
                        <div class="flex items-center justify-between p-3 custom-card rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full custom-inset flex items-center justify-center text-emerald-500 text-xs font-bold font-['Outfit']">01</div>
                                <div>
                                    <h4 class="text-xs font-bold text-text-main">رقم الدور الحالي</h4>
                                    <span class="text-[10px] text-text-main opacity-60">المريض: محمد خالد</span>
                                </div>
                            </div>
                            <span class="badge-success shadow-soft-out-sm">قيد الانتظار</span>
                        </div>

                        <div class="flex items-center justify-between p-3 custom-card rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full custom-inset flex items-center justify-center text-pink-500 text-xs font-bold font-['Outfit']">02</div>
                                <div>
                                    <h4 class="text-xs font-bold text-text-main">الكشفية والتكلفة</h4>
                                    <span class="text-[10px] text-text-main opacity-60">سعر كشفية الطبيب</span>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-theme-pink font-['Outfit']">$120.00</span>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <!-- Add Transaction Modal Backdrop & Modal Container -->
    <div id="add-transaction-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden custom-modal-backdrop p-4">
        <!-- Modal Card Container -->
        <div class="modal-container">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-md font-bold text-text-main flex items-center gap-2">
                    <i data-lucide="file-plus-2" class="w-5 h-5 text-theme-pink"></i>
                    تسجيل معاملة كشفية جديدة (Modal)
                </h3>
                <button onclick="toggleModal(false)" class="w-8 h-8 rounded-full custom-card flex items-center justify-center hover-press text-text-main opacity-70">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Modal Form Inputs -->
            <div class="space-y-4 mb-6">
                <!-- Patient Name -->
                <div>
                    <label class="block text-[11px] font-bold text-text-main opacity-80 mb-2">اسم المريض الكامل</label>
                    <input type="text" placeholder="أدخل اسم المريض..." class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-2.5 px-4 text-xs font-medium text-text-main placeholder-text-main opacity-70" id="modal-patient-name">
                </div>
                <!-- Doctor Assigned -->
                <div>
                    <label class="block text-[11px] font-bold text-text-main opacity-80 mb-2">الطبيب المعالج والعيادة</label>
                    <select class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-2.5 px-4 text-xs font-medium text-text-main" id="modal-doctor">
                        <option value="د. أحمد سليمان - العيادة الباطنية">د. أحمد سليمان - العيادة الباطنية ($120)</option>
                        <option value="د. سارة العلي - عيادة الأطفال">د. سارة العلي - عيادة الأطفال ($90)</option>
                        <option value="د. سمر الياسين - عيادة النساء">د. سمر الياسين - عيادة النساء ($150)</option>
                    </select>
                </div>
                <!-- Amount / Fee -->
                <div>
                    <label class="block text-[11px] font-bold text-text-main opacity-80 mb-2">قيمة الكشفية</label>
                    <input type="text" value="$120.00" class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-2.5 px-4 text-xs font-bold text-theme-pink" id="modal-fee">
                </div>
                <!-- Date Selector (ديت سليكتر) -->
                <div>
                    <label class="block text-[11px] font-bold text-text-main opacity-80 mb-2">تاريخ المعاملة (Date Picker)</label>
                    <input type="date" value="2026-06-29" class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-2.5 px-4 text-xs font-medium text-text-main custom-date-input" id="modal-date">
                </div>
            </div>

            <!-- Modal Footer Buttons -->
            <div class="flex justify-end gap-3">
                <button onclick="toggleModal(false)" class="py-2.5 px-6 rounded-xl text-xs font-bold text-text-main custom-card hover-press" id="modal-cancel-btn">
                    إلغاء الأمر
                </button>
                <button onclick="saveTransaction()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-400 hover-press" id="modal-submit-btn">
                    تأكيد وحفظ
                </button>
            </div>
        </div>
    </div>

    <!-- Script to render Advanced Visual Styles & ApexCharts -->
    <script>
        // Init Lucide Icons
        lucide.createIcons();

        // Color Palette from Design
        const pinkGrad = ['#ff4d7e', '#ff85a7'];
        const orangeGrad = ['#ff9f43', '#ffc085'];
        const greenGrad = ['#28c76f', '#48da89'];
        const blueGrad = ['#00cfe8', '#33e0f4'];

        // Dynamic properties reader
        function getCardBgColor() {
            const theme = document.body.getAttribute('data-theme');
            if (theme === 'glass') return 'rgba(255, 255, 255, 0.35)';
            if (theme === 'brutal') return '#ffffff';
            if (theme === 'minimalist') return '#f5f5f5';
            if (theme === 'excel') return '#ffffff';
            return '#eef2f7'; // default/soft
        }
        function getTextMainColor() {
            return '#2e3e5c'; // All current themes have dark text
        }

        // Helper to generate circular radial config
        function getRadialConfig(percentage, mainColor, gradColor) {
            return {
                chart: {
                    type: 'radialBar',
                    width: 100,
                    height: 100,
                    sparkline: { enabled: true },
                    background: 'transparent' // Explicit transparent background
                },
                series: [percentage],
                colors: [mainColor],
                plotOptions: {
                    radialBar: {
                        hollow: { size: '60%' },
                        track: {
                            background: getCardBgColor(),
                            strokeWidth: '100%',
                        },
                        dataLabels: {
                            name: { show: false },
                            value: {
                                offsetY: 5,
                                fontSize: '13px',
                                fontWeight: '700',
                                color: getTextMainColor()
                            }
                        }
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'horizontal',
                        gradientToColors: [gradColor],
                        stops: [0, 100]
                    }
                }
            };
        }

        // Keep globally accessible chart instances
        let chartRadial1, chartRadial2, chartRadial3, chartRadial4;
        let chartAreaSales, chartGaugeStrategy;
        let chartDialPink, chartDialOrange, chartDialGreen, chartMultiBar;
        let chartDonutDept, chartRadarQuality, chartStackedRevenue, chartBubbleSpend;

        // Render 4 Circular Radial Charts
        chartRadial1 = new ApexCharts(document.querySelector("#chart-radial-1"), getRadialConfig(96, pinkGrad[0], pinkGrad[1]));
        chartRadial2 = new ApexCharts(document.querySelector("#chart-radial-2"), getRadialConfig(75, orangeGrad[0], orangeGrad[1]));
        chartRadial3 = new ApexCharts(document.querySelector("#chart-radial-3"), getRadialConfig(50, greenGrad[0], greenGrad[1]));
        chartRadial4 = new ApexCharts(document.querySelector("#chart-radial-4"), getRadialConfig(85, blueGrad[0], blueGrad[1]));

        chartRadial1.render();
        chartRadial2.render();
        chartRadial3.render();
        chartRadial4.render();

        // Area Sales Chart
        chartAreaSales = new ApexCharts(document.querySelector("#chart-area-sales"), {
            chart: {
                type: 'area',
                height: 160,
                background: 'transparent', // Explicit transparent background
                toolbar: { show: false },
                sparkline: { enabled: true }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            series: [{
                name: 'Sales',
                data: [31, 40, 28, 51, 42, 109, 100]
            }],
            colors: ['#28c76f'],
            tooltip: {
                theme: 'light'
            }
        });
        chartAreaSales.render();

        // Gauge Chart Strategy
        chartGaugeStrategy = new ApexCharts(document.querySelector("#chart-gauge-strategy"), {
            chart: {
                type: 'radialBar',
                height: 280,
                offsetY: -10,
                background: 'transparent', // Explicit transparent background
                sparkline: { enabled: true }
            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    hollow: { size: '65%' },
                    track: {
                        background: getCardBgColor(),
                        strokeWidth: '97%',
                        margin: 5,
                    },
                    dataLabels: {
                        name: { show: false },
                        value: {
                            offsetY: -10,
                            fontSize: '22px',
                            fontWeight: '700',
                            color: getTextMainColor()
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'horizontal',
                    gradientToColors: ['#00cfe8'],
                    stops: [0, 50, 100]
                }
            },
            series: [76],
            colors: ['#ff4d7e'],
        });
        chartGaugeStrategy.render();

        // Speedometers (Dial charts) Helper
        function getDialConfig(percentage, color, gradColor) {
            return {
                chart: {
                    type: 'radialBar',
                    height: 120,
                    background: 'transparent', // Explicit transparent background
                    sparkline: { enabled: true }
                },
                series: [percentage],
                colors: [color],
                plotOptions: {
                    radialBar: {
                        startAngle: -110,
                        endAngle: 110,
                        hollow: { size: '55%' },
                        track: {
                            background: getCardBgColor(),
                            strokeWidth: '100%'
                        },
                        dataLabels: {
                            name: { show: false },
                            value: {
                                offsetY: 4,
                                fontSize: '14px',
                                fontWeight: '700',
                                color: getTextMainColor()
                            }
                        }
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'horizontal',
                        gradientToColors: [gradColor],
                        stops: [0, 100]
                    }
                }
            };
        }

        chartDialPink = new ApexCharts(document.querySelector("#chart-dial-pink"), getDialConfig(65, pinkGrad[0], pinkGrad[1]));
        chartDialOrange = new ApexCharts(document.querySelector("#chart-dial-orange"), getDialConfig(80, orangeGrad[0], orangeGrad[1]));
        chartDialGreen = new ApexCharts(document.querySelector("#chart-dial-green"), getDialConfig(45, greenGrad[0], greenGrad[1]));

        chartDialPink.render();
        chartDialOrange.render();
        chartDialGreen.render();

        // Multi-bar Chart
        chartMultiBar = new ApexCharts(document.querySelector("#chart-multi-bar"), {
            chart: {
                type: 'bar',
                height: 150,
                background: 'transparent', // Explicit transparent background
                toolbar: { show: false },
                sparkline: { enabled: true }
            },
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    borderRadius: 6,
                    distributed: true
                }
            },
            series: [{
                name: 'أداء التحليل',
                data: [44, 55, 41, 67, 22, 43, 21, 49, 33, 29]
            }],
            colors: [
                '#ff4d7e', '#ff9f43', '#28c76f', '#00cfe8', 
                '#ff4d7e', '#ff9f43', '#28c76f', '#00cfe8',
                '#ff4d7e', '#ff9f43'
            ],
            legend: { show: false },
            tooltip: { theme: 'light' }
        });
        chartMultiBar.render();


        // ================= INITIALIZE NEW ADVANCED CHARTS =================

        // 1. Donut Chart
        chartDonutDept = new ApexCharts(document.querySelector("#chart-donut-departments"), {
            chart: {
                type: 'donut',
                height: 250,
                background: 'transparent'
            },
            series: [44, 32, 24],
            labels: ['الباطنية', 'الأطفال', 'النساء والولادة'],
            colors: ['#28c76f', '#ff9f43', '#ff4d7e'],
            legend: {
                position: 'bottom',
                labels: { colors: getTextMainColor() }
            },
            dataLabels: { enabled: true },
            plotOptions: {
                pie: {
                    donut: {
                        size: '60%',
                        background: 'transparent'
                    }
                }
            }
        });
        chartDonutDept.render();

        // 2. Radar Chart
        chartRadarQuality = new ApexCharts(document.querySelector("#chart-radar-quality"), {
            chart: {
                type: 'radar',
                height: 250,
                background: 'transparent',
                toolbar: { show: false }
            },
            series: [{
                name: 'التقييم العام للخدمات',
                data: [80, 70, 90, 65, 85, 75]
            }],
            labels: ['سرعة الكشف', 'جودة الاستقبال', 'النظافة والتعقيم', 'التنظيم والطابور', 'كفاءة الأطباء', 'سعر الخدمات'],
            colors: ['#ff4d7e'],
            markers: { size: 4 },
            yaxis: {
                show: false
            },
            xaxis: {
                labels: {
                    style: {
                        colors: [
                            getTextMainColor(), getTextMainColor(), getTextMainColor(),
                            getTextMainColor(), getTextMainColor(), getTextMainColor()
                        ],
                        fontSize: '11px'
                    }
                }
            }
        });
        chartRadarQuality.render();

        // 3. Stacked Column Chart
        chartStackedRevenue = new ApexCharts(document.querySelector("#chart-stacked-revenue"), {
            chart: {
                type: 'bar',
                height: 250,
                stacked: true,
                background: 'transparent',
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '40%',
                    borderRadius: 4
                },
            },
            series: [{
                name: 'إيرادات الكشفيات',
                data: [35, 42, 38, 55, 48, 62, 70]
            }, {
                name: 'إيرادات التحاليل والمختبر',
                data: [20, 25, 22, 35, 30, 45, 50]
            }],
            xaxis: {
                categories: ['السبت', 'الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'],
                labels: { show: false }
            },
            colors: ['#00cfe8', '#ff9f43'],
            legend: {
                position: 'bottom',
                labels: { colors: getTextMainColor() }
            },
            dataLabels: { enabled: false }
        });
        chartStackedRevenue.render();

        // 4. Bubble Chart
        chartBubbleSpend = new ApexCharts(document.querySelector("#chart-bubble-spend"), {
            chart: {
                type: 'bubble',
                height: 280,
                background: 'transparent',
                toolbar: { show: false }
            },
            dataLabels: { enabled: false },
            fill: { opacity: 0.8 },
            series: [{
                name: 'عيادة الباطنية',
                data: [
                    [25, 8, 120], [35, 12, 240], [45, 5, 100], [55, 14, 320]
                ]
            }, {
                name: 'عيادة الأطفال',
                data: [
                    [22, 15, 350], [28, 7, 90], [32, 11, 210], [40, 4, 80]
                ]
            }, {
                name: 'عيادة النساء والولادة',
                data: [
                    [26, 6, 180], [34, 10, 300], [42, 13, 390], [50, 8, 240]
                ]
            }],
            xaxis: {
                tickAmount: 5,
                type: 'numeric',
                labels: { show: false }
            },
            yaxis: {
                max: 18
            },
            colors: ['#28c76f', '#ff4d7e', '#00cfe8']
        });
        chartBubbleSpend.render();

        // ================= END INITIALIZE NEW ADVANCED CHARTS =================


        // Theme Switcher Logic
        function changeTheme(themeName) {
            document.body.setAttribute('data-theme', themeName);
            localStorage.setItem('theme', themeName);
            setActiveButton(themeName);
            
            // Handle pagination element switching for Excel theme
            const standardPag = document.getElementById('standard-pagination');
            const excelPag = document.getElementById('excel-pagination');
            if (themeName === 'excel') {
                standardPag.classList.add('hidden');
                excelPag.classList.remove('hidden');
            } else {
                standardPag.classList.remove('hidden');
                excelPag.classList.add('hidden');
            }

            // Adjust modal buttons design to match themes
            const cancelBtn = document.getElementById('modal-cancel-btn');
            const submitBtn = document.getElementById('modal-submit-btn');
            const addTrigger = document.getElementById('add-trans-trigger');

            if (themeName === 'excel') {
                cancelBtn.className = 'excel-btn-secondary';
                submitBtn.className = 'excel-btn-primary';
                addTrigger.className = 'py-2 px-4 border border-[#107c41] bg-[#107c41] text-white text-xs font-bold hover:bg-[#0b592e]';
            } else if (themeName === 'brutal') {
                cancelBtn.className = 'py-2.5 px-6 border-2 border-black text-xs font-bold bg-white text-black hover-press';
                submitBtn.className = 'py-2.5 px-6 border-2 border-black text-xs font-bold bg-[#ffde43] text-black hover-press';
                addTrigger.className = 'py-2.5 px-4 border-3 border-black text-xs font-bold bg-[#ec4899] text-black hover-press shadow-[4px_4px_0px_#000000]';
            } else if (themeName === 'minimalist') {
                cancelBtn.className = 'py-2 px-5 border border-slate-200 rounded-lg text-xs font-medium text-slate-700 bg-white hover:bg-slate-50';
                submitBtn.className = 'py-2 px-5 rounded-lg text-xs font-medium text-white bg-slate-900 hover:bg-slate-800';
                addTrigger.className = 'py-2 px-4 rounded-lg text-xs font-medium text-white bg-slate-900 hover:bg-slate-800';
            } else { // soft & glass
                cancelBtn.className = 'py-2.5 px-6 rounded-xl text-xs font-bold text-text-main custom-card hover-press';
                submitBtn.className = 'py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-400 hover-press';
                addTrigger.className = 'py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-pink-400 hover-press flex items-center gap-2 shadow-soft-out-sm font-["Outfit"]';
            }

            // Wait slightly for transition to complete, then update charts
            setTimeout(() => {
                updateChartThemes(themeName);
                renderTable(); // Re-render table buttons to apply correct theme classes
            }, 100);
        }

        function setActiveButton(themeName) {
            document.querySelectorAll('.theme-btn').forEach(btn => {
                btn.classList.remove('active', 'text-pink-500', 'border-pink-300');
            });
            const activeBtn = document.querySelector(`[data-theme-btn="${themeName}"]`);
            if (activeBtn) {
                activeBtn.classList.add('active', 'text-pink-500', 'border-pink-300');
            }
        }

        function updateChartThemes(themeName) {
            const cardBg = getCardBgColor();
            const textMain = getTextMainColor();

            // Function to update single radial/gauge chart track and value text
            const updateRadial = (chartInstance) => {
                if (chartInstance) {
                    chartInstance.updateOptions({
                        chart: { background: 'transparent' }, // Maintain transparent background
                        theme: { mode: 'light' },
                        plotOptions: {
                            radialBar: {
                                track: { background: cardBg },
                                dataLabels: {
                                    value: { color: textMain }
                                }
                            }
                        }
                    });
                }
            };

            // Update all radial charts
            updateRadial(chartRadial1);
            updateRadial(chartRadial2);
            updateRadial(chartRadial3);
            updateRadial(chartRadial4);
            updateRadial(chartGaugeStrategy);
            updateRadial(chartDialPink);
            updateRadial(chartDialOrange);
            updateRadial(chartDialGreen);

            // Update new advanced charts tooltips & text styles
            if (chartDonutDept) {
                chartDonutDept.updateOptions({
                    chart: { background: 'transparent' },
                    theme: { mode: 'light' },
                    legend: { labels: { colors: textMain } }
                });
            }
            if (chartRadarQuality) {
                chartRadarQuality.updateOptions({
                    chart: { background: 'transparent' },
                    theme: { mode: 'light' },
                    yaxis: { labels: { style: { colors: textMain } } },
                    xaxis: { labels: { style: { colors: [textMain, textMain, textMain, textMain, textMain, textMain] } } }
                });
            }
            if (chartStackedRevenue) {
                chartStackedRevenue.updateOptions({
                    chart: { background: 'transparent' },
                    theme: { mode: 'light' },
                    legend: { labels: { colors: textMain } }
                });
            }
            if (chartBubbleSpend) {
                chartBubbleSpend.updateOptions({
                    chart: { background: 'transparent' },
                    theme: { mode: 'light' }
                });
            }

            // Update tooltips theme
            if (chartAreaSales) {
                chartAreaSales.updateOptions({
                    chart: { background: 'transparent' },
                    theme: { mode: 'light' },
                    tooltip: { theme: 'light' }
                });
            }
            if (chartMultiBar) {
                chartMultiBar.updateOptions({
                    chart: { background: 'transparent' },
                    theme: { mode: 'light' },
                    tooltip: { theme: 'light' }
                });
            }
        }


        // ================= DYNAMIC DATA GRID CLIENT-SIDE CONTROLLER =================

        // Array of Transactions
        const transactions = [
            { id: '#TX-1092', name: 'محمد خالد العتيبي', doctor: 'د. أحمد سليمان - العيادة الباطنية', fee: '$120.00', paid: true, date: '2026-06-29' },
            { id: '#TX-1093', name: 'سارة عبد الرحمن العلي', doctor: 'د. سارة العلي - عيادة الأطفال', fee: '$90.00', paid: true, date: '2026-06-29' },
            { id: '#TX-1094', name: 'عبد الله عمر الفهيد', doctor: 'د. أحمد سليمان - العيادة الباطنية', fee: '$120.00', paid: false, date: '2026-06-28' },
            { id: '#TX-1095', name: 'ريما محمد الشمري', doctor: 'د. سمر الياسين - عيادة النساء', fee: '$150.00', paid: true, date: '2026-06-28' },
            { id: '#TX-1088', name: 'سعدون ناصر الجاسم', doctor: 'د. سمر الياسين - عيادة النساء', fee: '$150.00', paid: true, date: '2026-06-27' },
            { id: '#TX-1089', name: 'فاطمة علي الكواري', doctor: 'د. سارة العلي - عيادة الأطفال', fee: '$90.00', paid: false, date: '2026-06-27' },
            { id: '#TX-1090', name: 'يوسف محمد القحطاني', doctor: 'د. أحمد سليمان - العيادة الباطنية', fee: '$120.00', paid: true, date: '2026-06-26' },
            { id: '#TX-1091', name: 'ليلى أحمد الحربي', doctor: 'د. سمر الياسين - عيادة النساء', fee: '$150.00', paid: true, date: '2026-06-26' },
            { id: '#TX-1084', name: 'فهد فيصل السديري', doctor: 'د. أحمد سليمان - العيادة الباطنية', fee: '$120.00', paid: true, date: '2026-06-25' },
            { id: '#TX-1085', name: 'منى إبراهيم الدوسري', doctor: 'د. سمر الياسين - عيادة النساء', fee: '$150.00', paid: true, date: '2026-06-25' }
        ];

        let currentPage = 1;
        const pageSize = 4;

        // Render Table Rows and Pagination controls
        function renderTable() {
            const searchVal = document.getElementById('search-input').value.trim();
            const doctorVal = document.getElementById('doctor-select').value;
            const statusVal = document.getElementById('status-select').value;
            const dateVal = document.getElementById('date-select').value;

            // Filter transactions
            let filtered = transactions.filter(t => {
                // Search filter (Case insensitive name search)
                if (searchVal && !t.name.includes(searchVal)) return false;
                
                // Doctor filter
                if (doctorVal !== 'جميع الأطباء...') {
                    const cleanDocName = doctorVal.replace('د. ', '');
                    if (!t.doctor.includes(cleanDocName)) return false;
                }

                // Status filter
                if (statusVal !== 'حالة الدفع...') {
                    const isPaid = statusVal === 'مدفوع';
                    if (t.paid !== isPaid) return false;
                }

                // Date filter
                if (dateVal && t.date !== dateVal) return false;

                return true;
            });

            const totalItems = filtered.length;
            const totalPages = Math.ceil(totalItems / pageSize) || 1;

            // Page validation
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            const startIdx = (currentPage - 1) * pageSize;
            const endIdx = Math.min(startIdx + pageSize, totalItems);
            const paginatedItems = filtered.slice(startIdx, endIdx);

            // Render table DOM
            const tbody = document.getElementById('table-data-body');
            tbody.innerHTML = '';

            if (paginatedItems.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center text-xs opacity-50 py-8">لا توجد معاملات تطابق فلاتر البحث المحددة.</td>
                    </tr>
                `;
            } else {
                paginatedItems.forEach(t => {
                    const statusBadge = t.paid 
                        ? '<span class="badge-success">مدفوع</span>' 
                        : '<span class="badge-danger">غير مدفوع</span>';
                    tbody.innerHTML += `
                        <tr class="table-row">
                            <td>${t.id}</td>
                            <td class="font-bold">${t.name}</td>
                            <td>${t.doctor}</td>
                            <td class="font-bold">${t.fee}</td>
                            <td>${statusBadge}</td>
                            <td class="font-['Outfit']">${t.date}</td>
                        </tr>
                    `;
                });
            }

            // Update page range label
            const label = document.getElementById('pag-label');
            if (totalItems === 0) {
                label.innerText = 'عرض 0 إلى 0 من أصل 0 قيود';
            } else {
                label.innerText = `عرض ${startIdx + 1} إلى ${endIdx} من أصل ${totalItems} قيود`;
            }

            // Draw controls
            renderPaginationControls(totalPages);
        }

        // Generate Pagination Buttons dynamically
        function renderPaginationControls(totalPages) {
            const pagContainer = document.getElementById('pag-buttons');
            pagContainer.innerHTML = '';

            const theme = document.body.getAttribute('data-theme') || 'soft';

            for (let i = 1; i <= totalPages; i++) {
                const activeClass = i === currentPage ? 'active' : '';
                const activeColorClass = (i === currentPage && theme === 'soft') ? 'text-pink-500' : '';
                pagContainer.innerHTML += `
                    <button onclick="changePage(${i})" class="pag-btn w-8 h-8 rounded-lg custom-card flex items-center justify-center hover-press text-xs font-bold text-text-main ${activeClass} ${activeColorClass}" data-page-btn="${i}">${i}</button>
                `;
            }

            // Render Excel Sheet Tabs
            const excelTabsContainer = document.getElementById('excel-tabs-list');
            excelTabsContainer.innerHTML = '';
            
            for (let i = 1; i <= totalPages; i++) {
                const activeClass = i === currentPage ? 'active' : '';
                excelTabsContainer.innerHTML += `
                    <div onclick="changePage(${i})" class="excel-tab ${activeClass}" data-excel-tab="${i}">ورقة ${i}</div>
                `;
            }
            // Add '+' sheet tab simulator
            excelTabsContainer.innerHTML += `<div class="excel-tab text-slate-400 font-bold px-2 cursor-pointer" onclick="addNewDemoTab()">+</div>`;
        }

        // Change active page index
        function changePage(pageNum) {
            currentPage = pageNum;
            renderTable();
        }

        // Add a demo sheet tab mock
        function addNewDemoTab() {
            alert("محاكاة: تم إضافة ورقة عمل جديدة في Excel Mode.");
        }

        // Modal Controls
        function toggleModal(show) {
            const modal = document.getElementById('add-transaction-modal');
            if (show) {
                // Populate default today date
                document.getElementById('modal-date').value = new Date().toISOString().substring(0, 10);
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        // Save new transaction dynamically
        function saveTransaction() {
            const patientName = document.getElementById('modal-patient-name').value.trim();
            const doctorAssigned = document.getElementById('modal-doctor').value;
            const feeInput = document.getElementById('modal-fee').value;
            const dateInput = document.getElementById('modal-date').value;

            if (!patientName) {
                alert("يرجى إدخال اسم المريض أولاً.");
                return;
            }

            // Create transaction object
            const newTx = {
                id: '#TX-' + Math.floor(Math.random() * 1000 + 1000),
                name: patientName,
                doctor: doctorAssigned,
                fee: feeInput,
                paid: true, // Defaulting saved transactions as Paid
                date: dateInput
            };

            // Push to data array
            transactions.unshift(newTx);
            
            // Reset modal input
            document.getElementById('modal-patient-name').value = '';

            // Close and re-render
            toggleModal(false);
            currentPage = 1; // Go to first page to see the new item
            renderTable();
        }

        // Attach dynamic filter listeners
        document.getElementById('search-input').addEventListener('input', () => { currentPage = 1; renderTable(); });
        document.getElementById('doctor-select').addEventListener('change', () => { currentPage = 1; renderTable(); });
        document.getElementById('status-select').addEventListener('change', () => { currentPage = 1; renderTable(); });
        document.getElementById('date-select').addEventListener('change', () => { currentPage = 1; renderTable(); });

        // Restore saved theme on load
        window.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'soft';
            changeTheme(savedTheme);
        });
    </script>
</body>
</html>
