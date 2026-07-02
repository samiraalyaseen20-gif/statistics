<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>لوحة إحصائيات مركز السيدة زينب(ع) الجراحي التخصصي للعيون</title>

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
        /* Custom slim scrollbar */
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        body[data-theme="glass"] ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.15); }
        body[data-theme="brutal"] ::-webkit-scrollbar-thumb { background: #000000; border: 2px solid #000000; }
        /* Fix sidebar border-radius in app shell mode */
        #sidebar { border-radius: 0 !important; }
    </style>
</head>
<body class="h-screen overflow-hidden" data-theme="soft">

    <!-- Background blobs for Glassmorphism theme -->
    <div class="fixed top-10 left-10 w-80 h-80 rounded-full bg-pink-400/30 blur-3xl glass-blob pointer-events-none z-[-1]"></div>
    <div class="fixed bottom-20 right-10 w-96 h-96 rounded-full bg-sky-400/30 blur-3xl glass-blob pointer-events-none z-[-1]"></div>
    <div class="fixed top-1/2 left-1/3 w-80 h-80 rounded-full bg-emerald-400/25 blur-3xl glass-blob pointer-events-none z-[-1]"></div>

    <!-- APP SHELL -->
    <div class="flex h-screen w-full overflow-hidden">

        <!-- SIDEBAR (ثابت) -->
        <aside id="sidebar" class="sidebar-container w-56 shrink-0 flex flex-col
                                   fixed inset-y-0 right-0 z-40 transform translate-x-full transition-transform duration-300
                                   md:relative md:inset-auto md:translate-x-0 md:z-auto md:self-stretch">
            <!-- Logo -->
            <div class="flex items-center gap-3 px-4 py-5 border-b border-slate-200/20 shrink-0">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-pink-500 to-pink-400 flex items-center justify-center text-white shadow-soft-out-sm">
                    <i data-lucide="activity" class="w-4 h-4"></i>
                </div>
                <span class="text-[9.5px] leading-[1.15] font-black text-text-main text-right">مركز السيدة زينب(ع)<br>الجراحي التخصصي للعيون</span>
            </div>

            <!-- Navigation (يسكرول داخل السايدبار لو طال) -->
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'visitor' || auth()->user()->can_view_reports)
                <button onclick="navigateToPage('reports')" class="nav-link w-full py-2 px-3 rounded-xl text-[11px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press active text-pink-500" id="nav-reports">
                    <i data-lucide="bar-chart-3" class="w-3.5 h-3.5 shrink-0"></i>
                    <span>التقارير</span>
                </button>
                @endif

                <!-- Management Dropdown -->
                @if(auth()->user()->role === 'admin' || auth()->user()->can_manage_lookups)
                <div class="mt-1">
                    <button onclick="toggleMgmtMenu()" id="btn-mgmt" class="w-full py-2 px-3 rounded-xl text-[11px] font-bold flex items-center justify-between text-text-main hover:bg-slate-200/10 hover-press">
                        <span class="flex items-center gap-2">
                            <i data-lucide="database" class="w-3.5 h-3.5 shrink-0"></i>
                            الإدارة
                        </span>
                        <i data-lucide="chevron-down" id="mgmt-chevron" class="w-3.5 h-3.5 transition-transform duration-200"></i>
                    </button>
                    <div id="mgmt-menu" class="hidden mt-1 space-y-0.5 pr-3 border-r-2 border-slate-200/20 mr-3">
                        <button onclick="navigateToPage('doctors')" class="nav-link w-full py-1.5 px-3 rounded-lg text-[10px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-doctors">
                            <i data-lucide="stethoscope" class="w-3 h-3 shrink-0 text-violet-500"></i><span>الأطباء</span>
                        </button>
                        <button onclick="navigateToPage('countries')" class="nav-link w-full py-1.5 px-3 rounded-lg text-[10px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-countries">
                            <i data-lucide="globe" class="w-3 h-3 shrink-0 text-sky-500"></i><span>الدول</span>
                        </button>
                        <button onclick="navigateToPage('governorates')" class="nav-link w-full py-1.5 px-3 rounded-lg text-[10px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-governorates">
                            <i data-lucide="map-pin" class="w-3 h-3 shrink-0 text-emerald-500"></i><span>المحافظات</span>
                        </button>
                        <button onclick="navigateToPage('test_types')" class="nav-link w-full py-1.5 px-3 rounded-lg text-[10px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-test_types">
                            <i data-lucide="eye" class="w-3 h-3 shrink-0 text-orange-500"></i><span>أنواع الفحص</span>
                        </button>
                        <button onclick="navigateToPage('operations')" class="nav-link w-full py-1.5 px-3 rounded-lg text-[10px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-operations">
                            <i data-lucide="scissors" class="w-3 h-3 shrink-0 text-rose-500"></i><span>العمليات</span>
                        </button>
                        <button onclick="navigateToPage('sectors')" class="nav-link w-full py-1.5 px-3 rounded-lg text-[10px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-sectors">
                            <i data-lucide="building-2" class="w-3 h-3 shrink-0 text-amber-500"></i><span>القطاعات</span>
                        </button>
                        <button onclick="navigateToPage('clinic_units')" class="nav-link w-full py-1.5 px-3 rounded-lg text-[10px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-clinic_units">
                            <i data-lucide="layout-list" class="w-3.5 h-3.5 shrink-0 text-indigo-500"></i><span>إدارة الاستشاريات العامة</span>
                        </button>
                        <button onclick="navigateToPage('lab_test_types')" class="nav-link w-full py-1.5 px-3 rounded-lg text-[10px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-lab_test_types">
                            <i data-lucide="test-tube" class="w-3 h-3 shrink-0 text-purple-500"></i><span>التحاليل</span>
                        </button>
                    </div>
                </div>
                @endif

                @if(auth()->user()->role === 'admin' || auth()->user()->can_enter_data)
                <div class="border-t border-slate-200/10 my-2"></div>
                <button onclick="navigateToPage('entry')" class="nav-link w-full py-2 px-3 rounded-xl text-[11px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-entry">
                    <i data-lucide="plus-circle" class="w-3.5 h-3.5 shrink-0 text-pink-500"></i>
                    <span>إدخال البيانات</span>
                </button>
                @endif

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'visitor' || auth()->user()->can_view_reports)
                <div class="border-t border-slate-200/10 my-2"></div>
                <button onclick="navigateToPage('comparison')" class="nav-link w-full py-2 px-3 rounded-xl text-[11px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-comparison">
                    <i data-lucide="git-compare" class="w-3.5 h-3.5 shrink-0 text-violet-500"></i>
                    <span>المفاضلة السريرية</span>
                </button>
                @endif

                @if(auth()->user()->role === 'admin' || auth()->user()->can_manage_users)
                <div class="border-t border-slate-200/10 my-2"></div>
                <button onclick="navigateToPage('users')" class="nav-link w-full py-2 px-3 rounded-xl text-[11px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-users">
                    <i data-lucide="users" class="w-3.5 h-3.5 shrink-0 text-indigo-500"></i>
                    <span>إدارة المستخدمين</span>
                </button>
                @endif

                <div class="border-t border-slate-200/10 my-2"></div>
                <button onclick="navigateToPage('settings')" class="nav-link w-full py-2 px-3 rounded-xl text-[11px] font-bold flex items-center gap-2 text-text-main hover:bg-slate-200/10 hover-press" id="nav-settings">
                    <i data-lucide="settings" class="w-3.5 h-3.5 shrink-0"></i>
                    <span>الإعدادات</span>
                </button>
            </nav>
        </aside>

        <!-- Sidebar Backdrop for Mobile -->
        <div id="sidebar-backdrop" onclick="toggleSidebar(false)" class="fixed inset-0 bg-black/40 z-30 hidden"></div>

        <!-- ═══ MAIN AREA (عمود المحتوى - flex-col ثابت الارتفاع) ═══ -->
        <div class="flex-1 flex flex-col h-full min-w-0 overflow-hidden border-r border-slate-200/20">

            <!-- HEADER -->
            <header class="flex justify-between items-center px-4 py-3 custom-card shrink-0 border-b border-slate-200/20" style="border-radius:0!important">
                <div class="flex items-center gap-3">
                    <button onclick="toggleSidebar(true)" class="md:hidden w-9 h-9 rounded-xl custom-card flex items-center justify-center text-text-main hover-press">
                        <i data-lucide="menu" class="w-4 h-4"></i>
                    </button>
                    <h1 id="page-title" class="text-base font-bold text-text-main">الرئيسية</h1>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full custom-card flex items-center justify-center font-bold text-sm text-text-main shadow-soft-out-sm">
                        {{ strtoupper(substr(auth()->user()->username ?? 'U', 0, 2)) }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-text-main opacity-60 hover:opacity-100 hover:text-theme-pink hover-press transition-colors">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- CONTENT AREA (يسكرول هنا فقط) -->
            <main class="flex-1 overflow-y-auto p-4">
                @include('pages.reports')
                @include('pages.entry')
                @include('pages.comparison')
                @include('pages.doctors')
                @include('pages.countries')
                @include('pages.governorates')
                @include('pages.test_types')
                @include('pages.operations')
                @include('pages.sectors')
                @include('pages.clinic_units')
                @include('pages.lab_test_types')
                @include('pages.users')
                @include('pages.settings')
            </main>

        </div>
    </div>

    <!-- Add Transaction Modal Backdrop & Modal Container -->
    <div id="add-transaction-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden custom-modal-backdrop p-4">
        <div class="modal-container">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-md font-bold text-text-main flex items-center gap-2">
                    <i data-lucide="file-plus-2" class="w-5 h-5 text-theme-pink"></i>
                    تسجيل معاملة كشفية جديدة (Modal)
                </h3>
                <button onclick="toggleModal(false)" class="w-8 h-8 rounded-full custom-card flex items-center justify-center hover-press text-text-main opacity-70">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-[11px] font-bold text-text-main opacity-80 mb-2">اسم المريض الكامل</label>
                    <input type="text" placeholder="أدخل اسم المريض..." class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-2.5 px-4 text-xs font-medium text-text-main placeholder-text-main opacity-70" id="modal-patient-name">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-text-main opacity-80 mb-2">الطبيب المعالج والاستشارية</label>
                    <select class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-2.5 px-4 text-xs font-medium text-text-main" id="modal-doctor">
                        <option value="د. أحمد سليمان - الباطنية">د. أحمد سليمان - الباطنية ($120)</option>
                        <option value="د. سارة العلي - الأطفال">د. سارة العلي - الأطفال ($90)</option>
                        <option value="د. سمر الياسين - النساء">د. سمر الياسين - النساء ($150)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-text-main opacity-80 mb-2">قيمة الكشفية</label>
                    <input type="text" value="$120.00" class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-2.5 px-4 text-xs font-bold text-theme-pink" id="modal-fee">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-text-main opacity-80 mb-2">تاريخ المعاملة (Date Picker)</label>
                    <input type="date" value="2026-06-29" class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-2.5 px-4 text-xs font-medium text-text-main custom-date-input" id="modal-date">
                </div>
            </div>

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

        // --- GLOBAL API HELPERS ---
        const CSRF = document.querySelector('meta[name="csrf-token"]')?.content;
        async function apiFetch(url, method='GET', body=null) {
            const opts = { method, headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'} };
            if(body) opts.body = JSON.stringify(body);
            const res = await fetch(url, opts);
            if(!res.ok) { const e = await res.json().catch(()=>({})); showToast(e.message||'حدث خطأ!','error'); throw e; }
            return res.status===204 ? null : res.json();
        }
        function showToast(msg, type='success') {
            const c = document.createElement('div');
            c.className = `fixed bottom-6 left-1/2 -translate-x-1/2 z-[999] px-5 py-3 rounded-2xl text-xs font-bold text-white shadow-xl transition-all ${type==='error'?'bg-rose-500':'bg-emerald-500'}`;
            c.textContent = msg;
            document.body.appendChild(c);
            setTimeout(()=>c.remove(), 3000);
        }

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

        // Render 4 Circular Radial Charts (Only if dashboard is present)
        if (document.querySelector("#chart-radial-1")) {
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
                name: 'الباطنية',
                data: [
                    [25, 8, 120], [35, 12, 240], [45, 5, 100], [55, 14, 320]
                ]
            }, {
                name: 'الأطفال',
                data: [
                    [22, 15, 350], [28, 7, 90], [32, 11, 210], [40, 4, 80]
                ]
            }, {
                name: 'النساء والولادة',
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
        }

        // ================= END INITIALIZE NEW ADVANCED CHARTS =================


        // Theme Switcher Logic
        function changeTheme(themeName) {
            document.body.setAttribute('data-theme', themeName);
            localStorage.setItem('theme', themeName);
            setActiveButton(themeName);
            
            // Handle pagination element switching for Excel theme safely
            const standardPag = document.getElementById('standard-pagination');
            const excelPag = document.getElementById('excel-pagination');
            if (standardPag && excelPag) {
                if (themeName === 'excel') {
                    standardPag.classList.add('hidden');
                    excelPag.classList.remove('hidden');
                } else {
                    standardPag.classList.remove('hidden');
                    excelPag.classList.add('hidden');
                }
            }

            // Adjust buttons & controls dynamically to match active theme styles safely
            const cancelBtn = document.getElementById('modal-cancel-btn');
            const submitBtn = document.getElementById('modal-submit-btn');
            const addTrigger = document.getElementById('add-trans-trigger');

            if (themeName === 'excel') {
                if (cancelBtn) cancelBtn.className = 'excel-btn-secondary';
                if (submitBtn) submitBtn.className = 'excel-btn-primary';
                if (addTrigger) addTrigger.className = 'py-2 px-4 border border-[#107c41] bg-[#107c41] text-white text-xs font-bold hover:bg-[#0b592e]';
            } else if (themeName === 'brutal') {
                if (cancelBtn) cancelBtn.className = 'py-2.5 px-6 border-2 border-black text-xs font-bold bg-white text-black hover-press';
                if (submitBtn) submitBtn.className = 'py-2.5 px-6 border-2 border-black text-xs font-bold bg-[#ffde43] text-black hover-press';
                if (addTrigger) addTrigger.className = 'py-2.5 px-4 border-3 border-black text-xs font-bold bg-[#ec4899] text-black hover-press shadow-[4px_4px_0px_#000000]';
            } else if (themeName === 'minimalist') {
                if (cancelBtn) cancelBtn.className = 'py-2 px-5 border border-slate-200 rounded-lg text-xs font-medium text-slate-700 bg-white hover:bg-slate-50';
                if (submitBtn) submitBtn.className = 'py-2 px-5 rounded-lg text-xs font-medium text-white bg-slate-900 hover:bg-slate-800';
                if (addTrigger) addTrigger.className = 'py-2 px-4 rounded-lg text-xs font-medium text-white bg-slate-900 hover:bg-slate-800';
            } else { // soft & glass
                if (cancelBtn) cancelBtn.className = 'py-2.5 px-6 rounded-xl text-xs font-bold text-text-main custom-card hover-press';
                if (submitBtn) submitBtn.className = 'py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-400 hover-press';
                if (addTrigger) addTrigger.className = 'py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-pink-400 hover-press flex items-center gap-2 shadow-soft-out-sm font-["Outfit"]';
            }

            // Update standard dynamic grid active classes and re-draw SVG elements safely
            setTimeout(() => {
                updateChartThemes(themeName);
                if (typeof renderTable === 'function') {
                    renderTable(); 
                }
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

            const updateRadial = (chartInstance) => {
                if (chartInstance) {
                    chartInstance.updateOptions({
                        chart: { background: 'transparent' },
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

            updateRadial(chartRadial1);
            updateRadial(chartRadial2);
            updateRadial(chartRadial3);
            updateRadial(chartRadial4);
            updateRadial(chartGaugeStrategy);
            updateRadial(chartDialPink);
            updateRadial(chartDialOrange);
            updateRadial(chartDialGreen);

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

        const transactions = [
            { id: '#TX-1092', name: 'محمد خالد العتيبي', doctor: 'د. أحمد سليمان - الباطنية', fee: '$120.00', paid: true, date: '2026-06-29' },
            { id: '#TX-1093', name: 'سارة عبد الرحمن العلي', doctor: 'د. سارة العلي - الأطفال', fee: '$90.00', paid: true, date: '2026-06-29' },
            { id: '#TX-1094', name: 'عبد الله عمر الفهيد', doctor: 'د. أحمد سليمان - الباطنية', fee: '$120.00', paid: false, date: '2026-06-28' },
            { id: '#TX-1095', name: 'ريما محمد الشمري', doctor: 'د. سمر الياسين - النساء', fee: '$150.00', paid: true, date: '2026-06-28' },
            { id: '#TX-1088', name: 'سعدون ناصر الجاسم', doctor: 'د. سمر الياسين - النساء', fee: '$150.00', paid: true, date: '2026-06-27' },
            { id: '#TX-1089', name: 'فاطمة علي الكواري', doctor: 'د. سارة العلي - الأطفال', fee: '$90.00', paid: false, date: '2026-06-27' },
            { id: '#TX-1090', name: 'يوسف محمد القحطاني', doctor: 'د. أحمد سليمان - الباطنية', fee: '$120.00', paid: true, date: '2026-06-26' },
            { id: '#TX-1091', name: 'ليلى أحمد الحربي', doctor: 'د. سمر الياسين - النساء', fee: '$150.00', paid: true, date: '2026-06-26' },
            { id: '#TX-1084', name: 'فهد فيصل السديري', doctor: 'د. أحمد سليمان - الباطنية', fee: '$120.00', paid: true, date: '2026-06-25' },
            { id: '#TX-1085', name: 'منى إبراهيم الدوسري', doctor: 'د. سمر الياسين - النساء', fee: '$150.00', paid: true, date: '2026-06-25' }
        ];

        let currentPage = 1;
        const pageSize = 4;

        function renderTable() {
            const searchInputEl = document.getElementById('search-input');
            const doctorSelectEl = document.getElementById('doctor-select');
            const statusSelectEl = document.getElementById('status-select');
            const dateSelectEl = document.getElementById('date-select');

            if (!searchInputEl || !doctorSelectEl || !statusSelectEl || !dateSelectEl) return;

            const searchVal = searchInputEl.value.trim();
            const doctorVal = doctorSelectEl.value;
            const statusVal = statusSelectEl.value;
            const dateVal = dateSelectEl.value;

            let filtered = transactions.filter(t => {
                if (searchVal && !t.name.includes(searchVal)) return false;
                if (doctorVal !== 'جميع الأطباء...') {
                    const cleanDocName = doctorVal.replace('د. ', '');
                    if (!t.doctor.includes(cleanDocName)) return false;
                }
                if (statusVal !== 'حالة الدفع...') {
                    const isPaid = statusVal === 'مدفوع';
                    if (t.paid !== isPaid) return false;
                }
                if (dateVal && t.date !== dateVal) return false;
                return true;
            });

            const totalItems = filtered.length;
            const totalPages = Math.ceil(totalItems / pageSize) || 1;

            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            const startIdx = (currentPage - 1) * pageSize;
            const endIdx = Math.min(startIdx + pageSize, totalItems);
            const paginatedItems = filtered.slice(startIdx, endIdx);

            const tbody = document.getElementById('table-data-body');
            if (tbody) {
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
            }

            const label = document.getElementById('pag-label');
            if (label) {
                if (totalItems === 0) {
                    label.innerText = 'عرض 0 إلى 0 من أصل 0 قيود';
                } else {
                    label.innerText = `عرض ${startIdx + 1} إلى ${endIdx} من أصل ${totalItems} قيود`;
                }
            }

            renderPaginationControls(totalPages);
        }

        function renderPaginationControls(totalPages) {
            const pagContainer = document.getElementById('pag-buttons');
            if (pagContainer) {
                pagContainer.innerHTML = '';
                const theme = document.body.getAttribute('data-theme') || 'soft';
                for (let i = 1; i <= totalPages; i++) {
                    const activeClass = i === currentPage ? 'active' : '';
                    const activeColorClass = (i === currentPage && theme === 'soft') ? 'text-pink-500' : '';
                    pagContainer.innerHTML += `
                        <button onclick="changePage(${i})" class="pag-btn w-8 h-8 rounded-lg custom-card flex items-center justify-center hover-press text-xs font-bold text-text-main ${activeClass} ${activeColorClass}" data-page-btn="${i}">${i}</button>
                    `;
                }
            }

            const excelTabsContainer = document.getElementById('excel-tabs-list');
            if (excelTabsContainer) {
                excelTabsContainer.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const activeClass = i === currentPage ? 'active' : '';
                    excelTabsContainer.innerHTML += `
                        <div onclick="changePage(${i})" class="excel-tab ${activeClass}" data-excel-tab="${i}">ورقة ${i}</div>
                    `;
                }
                excelTabsContainer.innerHTML += `<div class="excel-tab text-slate-400 font-bold px-2 cursor-pointer" onclick="addNewDemoTab()">+</div>`;
            }
        }

        function changePage(pageNum) {
            currentPage = pageNum;
            renderTable();
        }

        function addNewDemoTab() {
            alert("محاكاة: تم إضافة ورقة عمل جديدة في Excel Mode.");
        }

        // Modal Controls
        function toggleModal(show) {
            const modal = document.getElementById('add-transaction-modal');
            if (show) {
                document.getElementById('modal-date').value = new Date().toISOString().substring(0, 10);
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        function saveTransaction() {
            const patientName = document.getElementById('modal-patient-name').value.trim();
            const doctorAssigned = document.getElementById('modal-doctor').value;
            const feeInput = document.getElementById('modal-fee').value;
            const dateInput = document.getElementById('modal-date').value;

            if (!patientName) {
                alert("يرجى إدخال اسم المريض أولاً.");
                return;
            }

            const newTx = {
                id: '#TX-' + Math.floor(Math.random() * 1000 + 1000),
                name: patientName,
                doctor: doctorAssigned,
                fee: feeInput,
                paid: true,
                date: dateInput
            };

            transactions.unshift(newTx);
            document.getElementById('modal-patient-name').value = '';

            toggleModal(false);
            currentPage = 1;
            renderTable();
        }

        // Attach filters input events
        const attachGridListeners = () => {
            const searchInput = document.getElementById('search-input');
            const doctorSelect = document.getElementById('doctor-select');
            const statusSelect = document.getElementById('status-select');
            const dateSelect = document.getElementById('date-select');

            if (searchInput) searchInput.addEventListener('input', () => { currentPage = 1; renderTable(); });
            if (doctorSelect) doctorSelect.addEventListener('change', () => { currentPage = 1; renderTable(); });
            if (statusSelect) statusSelect.addEventListener('change', () => { currentPage = 1; renderTable(); });
            if (dateSelect) dateSelect.addEventListener('change', () => { currentPage = 1; renderTable(); });
        };


        // ================= SPA VIEW STATE MANAGER =================

        function navigateToPage(pageId) {
            // تحديث الهاش في الرابط لحفظ حالة الصفحة عند إعادة التحميل (Reload)
            window.location.hash = pageId;

            // Hide all pages
            document.querySelectorAll('.page-section').forEach(sec => {
                sec.classList.add('hidden');
            });
            // Show active page
            const activePageSection = document.getElementById('page-' + pageId);
            if (activePageSection) activePageSection.classList.remove('hidden');

            // Reset navigation active styles
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active', 'text-pink-500');
            });
            
            // Set active class on nav link
            const activeNavLink = document.getElementById('nav-' + pageId);
            if (activeNavLink) {
                activeNavLink.classList.add('active');
                // Apply theme specific highlight color in Soft UI / Glass
                const currentTheme = document.body.getAttribute('data-theme') || 'soft';
                if (currentTheme === 'soft' || currentTheme === 'glass') {
                    activeNavLink.classList.add('text-pink-500');
                }
            }

            // Update page title
            const pageTitleEl = document.getElementById('page-title');
            const titles = {
                dashboard: 'الرئيسية',
                reports: 'التقارير',
                entry: 'إدخال البيانات الإحصائية',
                comparison: 'لوحة المفاضلة السريرية',
                doctors: 'الأطباء',
                countries: 'الدول',
                governorates: 'المحافظات',
                test_types: 'أنواع الفحص',
                operations: 'العمليات',
                sectors: 'القطاعات',
                clinic_units: 'إدارة الاستشاريات العامة',
                lab_test_types: 'التحاليل',
                users: 'إدارة المستخدمين والصلاحيات',
                settings: 'الإعدادات',
            };
            if (pageTitleEl) pageTitleEl.innerText = titles[pageId] || pageId;

            // Close mobile sidebar menu
            toggleSidebar(false);

            // Trigger report page hooks
            if (pageId === 'reports' && typeof window.initReportsPage === 'function') {
                window.initReportsPage();
            }

            // Trigger hooks for each page
            if (pageId === 'entry' && typeof window.initEntryPage === 'function') window.initEntryPage();
            if (pageId === 'doctors' && typeof window.initDoctorsPage === 'function') window.initDoctorsPage();
            if (pageId === 'countries' && typeof window.initCountriesPage === 'function') window.initCountriesPage();
            if (pageId === 'governorates' && typeof window.initGovernoratesPage === 'function') window.initGovernoratesPage();
            if (pageId === 'test_types' && typeof window.initTestTypesPage === 'function') window.initTestTypesPage();
            if (pageId === 'operations' && typeof window.initOperationsPage === 'function') window.initOperationsPage();
            if (pageId === 'sectors' && typeof window.initSectorsPage === 'function') window.initSectorsPage();
            if (pageId === 'clinic_units' && typeof window.initClinicUnitsPage === 'function') window.initClinicUnitsPage();
            if (pageId === 'lab_test_types' && typeof window.initLabTestTypesPage === 'function') window.initLabTestTypesPage();
            if (pageId === 'comparison' && typeof window.initComparisonPage === 'function') window.initComparisonPage();
            if (pageId === 'users' && typeof window.initUsersPage === 'function') window.initUsersPage();

            setTimeout(() => {
                if (window.lucide) lucide.createIcons();
            }, 100);
        }

        // Mobile sidebar toggle
        function toggleSidebar(show) {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (sidebar && backdrop) {
                if (show) {
                    sidebar.classList.remove('translate-x-full');
                    backdrop.classList.remove('hidden');
                } else {
                    sidebar.classList.add('translate-x-full');
                    backdrop.classList.add('hidden');
                }
            }
        }

        // Management dropdown toggle
        function toggleMgmtMenu() {
            const menu = document.getElementById('mgmt-menu');
            const chevron = document.getElementById('mgmt-chevron');
            if (menu) {
                menu.classList.toggle('hidden');
                if (chevron) chevron.style.transform = menu.classList.contains('hidden') ? '' : 'rotate(180deg)';
            }
        }

        // Restore saved theme on load
        window.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'soft';
            changeTheme(savedTheme);
            attachGridListeners();

            // Hash or Query Parameter routing on load
            const hash = window.location.hash.substring(1);
            if (hash && hash !== 'dashboard') {
                setTimeout(() => {
                    navigateToPage(hash);
                }, 100);
            } else {
                setTimeout(() => {
                    navigateToPage('reports');
                }, 100);
            }
        });
    </script>
</body>
</html>
