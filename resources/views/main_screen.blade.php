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
<body class="min-h-screen p-4 md:p-6" data-theme="soft">

    <!-- Background blobs for Glassmorphism theme -->
    <div class="fixed top-10 left-10 w-80 h-80 rounded-full bg-pink-400/30 blur-3xl glass-blob pointer-events-none z-[-1]"></div>
    <div class="fixed bottom-20 right-10 w-96 h-96 rounded-full bg-sky-400/30 blur-3xl glass-blob pointer-events-none z-[-1]"></div>
    <div class="fixed top-1/2 left-1/3 w-80 h-80 rounded-full bg-emerald-400/25 blur-3xl glass-blob pointer-events-none z-[-1]"></div>

    <!-- Main Responsive Widescreen Flex Grid Layout -->
    <div class="flex min-h-[calc(100vh-2rem)] flex-col md:flex-row gap-6 w-full max-w-full">
        
        <!-- RIGHT SIDEBAR (الشريط الجانبي الأيمن للملاحة) -->
        <aside id="sidebar" class="sidebar-container w-64 shrink-0 flex flex-col p-6 fixed inset-y-0 right-0 z-40 transform translate-x-full transition-transform duration-300 md:static md:translate-x-0 md:h-auto">
            <!-- Logo & App Name -->
            <div class="flex items-center gap-3 mb-8 border-b border-slate-200/20 pb-4">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-pink-500 to-pink-400 flex items-center justify-center text-white shadow-soft-out-sm font-bold text-lg">
                    <i data-lucide="activity" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-text-main leading-tight">عيادتنا الذكية</h2>
                    <span class="text-[10px] text-text-main opacity-60 font-semibold">نظام إدارة العيادات</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 space-y-3">
                <button onclick="navigateToPage('dashboard')" class="nav-link w-full py-3 px-4 rounded-xl text-xs font-bold flex items-center gap-3 text-text-main hover:bg-slate-200/10 hover-press active text-pink-500" id="nav-dashboard">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0"></i>
                    <span>لوحة التحكم</span>
                </button>
                <button onclick="navigateToPage('reports')" class="nav-link w-full py-3 px-4 rounded-xl text-xs font-bold flex items-center gap-3 text-text-main hover:bg-slate-200/10 hover-press" id="nav-reports">
                    <i data-lucide="bar-chart-3" class="w-4 h-4 shrink-0"></i>
                    <span>التقارير والإحصائيات</span>
                </button>
                <button onclick="navigateToPage('doctors')" class="nav-link w-full py-3 px-4 rounded-xl text-xs font-bold flex items-center gap-3 text-text-main hover:bg-slate-200/10 hover-press" id="nav-doctors">
                    <i data-lucide="users" class="w-4 h-4 shrink-0"></i>
                    <span>إدارة الأطباء</span>
                </button>
                <button onclick="navigateToPage('settings')" class="nav-link w-full py-3 px-4 rounded-xl text-xs font-bold flex items-center gap-3 text-text-main hover:bg-slate-200/10 hover-press" id="nav-settings">
                    <i data-lucide="settings" class="w-4 h-4 shrink-0"></i>
                    <span>الإعدادات العامة</span>
                </button>
            </nav>

            <!-- Sidebar Footer -->
            <div class="border-t border-slate-200/20 pt-4 text-center">
                <span class="text-[10px] text-text-main opacity-50 font-bold font-['Outfit']">V 1.0.0 (SPA)</span>
            </div>
        </aside>

        <!-- Sidebar Backdrop for Mobile -->
        <div id="sidebar-backdrop" onclick="toggleSidebar(false)" class="fixed inset-0 bg-black/40 z-30 hidden"></div>

        <!-- LEFT MAIN CONTENT (منطقة المحتوى الرئيسية - كامل العرض المتاح) -->
        <div class="flex-1 flex flex-col min-w-0 w-full">
            
            <!-- Shared Header Navigation -->
            <header class="flex justify-between items-center mb-6 p-4 rounded-2xl custom-card w-full">
                <div class="flex items-center gap-3">
                    <!-- Mobile Hamburger Menu -->
                    <button onclick="toggleSidebar(true)" class="md:hidden w-10 h-10 rounded-xl custom-card flex items-center justify-center text-text-main hover-press border border-slate-200/20">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                     </button>
                     <!-- Dynamic Header Titles -->
                     <div>
                         <h1 id="page-title" class="text-xl font-bold text-text-main">لوحة التحكم والمؤشرات</h1>
                         <span id="page-subtitle" class="text-[10px] text-text-main opacity-60">نظرة عامة على كفاءة أداء العيادات الخارجية</span>
                     </div>
                </div>

                <!-- Right elements: active daily cashbox + profile badge -->
                <div class="flex items-center gap-4">
                     <div class="hidden sm:flex items-center gap-2 py-1.5 px-3 rounded-lg custom-inset">
                         <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                         <span class="text-[10px] text-text-main font-bold">صندوق الكاش اليومي:</span>
                         <span class="text-xs font-bold text-theme-emerald font-['Outfit']">$1,240.00</span>
                     </div>
                     <div class="flex items-center gap-3">
                         <div class="w-10 h-10 rounded-full custom-card flex items-center justify-center font-bold text-md text-text-main font-['Outfit'] shadow-soft-out-sm">
                             {{ strtoupper(substr(auth()->user()->username ?? 'U', 0, 2)) }}
                         </div>
                         <div class="hidden sm:block">
                             <h3 class="text-xs font-bold text-text-main leading-none">{{ auth()->user()->name ?? 'مستخدم' }}</h3>
                             <span class="text-[10px] text-text-main opacity-60 font-semibold">{{ auth()->user()->role ?? 'visitor' }}</span>
                         </div>
                         <form method="POST" action="{{ route('logout') }}" class="ml-2">
                             @csrf
                             <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-text-main opacity-60 hover:opacity-100 hover:text-theme-pink hover-press transition-colors" title="تسجيل الخروج">
                                 <i data-lucide="log-out" class="w-4 h-4"></i>
                             </button>
                         </form>
                     </div>
                </div>
            </header>

            <!-- Separated Pages Inclusions -->
            <div class="w-full flex-1">
                @include('pages.dashboard')
                @include('pages.reports')
                @include('pages.doctors')
                @include('pages.settings')
            </div>

            <!-- SHARED FOOTER -->
            <footer class="mt-8 py-6 border-t border-slate-200/20 text-center flex flex-col sm:flex-row justify-between items-center gap-4 w-full">
                 <span class="text-[11px] text-text-main opacity-60 font-medium">
                     حقوق الطبع محفوظة © 2026 عيادتنا الذكية - Clinic Management System
                 </span>
                 <div class="flex items-center gap-3 text-[10px] text-text-main opacity-70 font-semibold">
                     <span class="flex items-center gap-1">
                         <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                         النظام متصل وآمن
                     </span>
                     <span>|</span>
                     <span class="font-['Outfit']">Session ID: CMS-5542</span>
                 </div>
            </footer>
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
                    <label class="block text-[11px] font-bold text-text-main opacity-80 mb-2">الطبيب المعالج والعيادة</label>
                    <select class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-2.5 px-4 text-xs font-medium text-text-main" id="modal-doctor">
                        <option value="د. أحمد سليمان - العيادة الباطنية">د. أحمد سليمان - العيادة الباطنية ($120)</option>
                        <option value="د. سارة العلي - عيادة الأطفال">د. سارة العلي - عيادة الأطفال ($90)</option>
                        <option value="د. سمر الياسين - عيادة النساء">د. سمر الياسين - عيادة النساء ($150)</option>
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

            // Adjust buttons & controls dynamically to match active theme styles
            const cancelBtn = document.getElementById('modal-cancel-btn');
            const submitBtn = document.getElementById('modal-submit-btn');
            const addTrigger = document.getElementById('add-trans-trigger');

            if (themeName === 'excel') {
                cancelBtn.className = 'excel-btn-secondary';
                submitBtn.className = 'excel-btn-primary';
                if (addTrigger) addTrigger.className = 'py-2 px-4 border border-[#107c41] bg-[#107c41] text-white text-xs font-bold hover:bg-[#0b592e]';
            } else if (themeName === 'brutal') {
                cancelBtn.className = 'py-2.5 px-6 border-2 border-black text-xs font-bold bg-white text-black hover-press';
                submitBtn.className = 'py-2.5 px-6 border-2 border-black text-xs font-bold bg-[#ffde43] text-black hover-press';
                if (addTrigger) addTrigger.className = 'py-2.5 px-4 border-3 border-black text-xs font-bold bg-[#ec4899] text-black hover-press shadow-[4px_4px_0px_#000000]';
            } else if (themeName === 'minimalist') {
                cancelBtn.className = 'py-2 px-5 border border-slate-200 rounded-lg text-xs font-medium text-slate-700 bg-white hover:bg-slate-50';
                submitBtn.className = 'py-2 px-5 rounded-lg text-xs font-medium text-white bg-slate-900 hover:bg-slate-800';
                if (addTrigger) addTrigger.className = 'py-2 px-4 rounded-lg text-xs font-medium text-white bg-slate-900 hover:bg-slate-800';
            } else { // soft & glass
                cancelBtn.className = 'py-2.5 px-6 rounded-xl text-xs font-bold text-text-main custom-card hover-press';
                submitBtn.className = 'py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-400 hover-press';
                if (addTrigger) addTrigger.className = 'py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-pink-400 hover-press flex items-center gap-2 shadow-soft-out-sm font-["Outfit"]';
            }

            // Update standard dynamic grid active classes and re-draw SVG elements
            setTimeout(() => {
                updateChartThemes(themeName);
                renderTable(); 
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

            // Update Dynamic header titles
            const pageTitleEl = document.getElementById('page-title');
            const pageSubtitleEl = document.getElementById('page-subtitle');

            if (pageTitleEl && pageSubtitleEl) {
                if (pageId === 'dashboard') {
                    pageTitleEl.innerText = "لوحة التحكم والمؤشرات";
                    pageSubtitleEl.innerText = "نظرة عامة على كفاءة أداء العيادات الخارجية";
                } else if (pageId === 'reports') {
                    pageTitleEl.innerText = "التقارير والإحصائيات الشاملة";
                    pageSubtitleEl.innerText = "التقارير المالية والتحاليل الإحصائية للمبيعات والعيادات";
                } else if (pageId === 'doctors') {
                    pageTitleEl.innerText = "إدارة حسابات وأطباء العيادات";
                    pageSubtitleEl.innerText = "تحديد كشفيات الأطباء، ومتابعة سجل مرضاهم ومستحقاتهم";
                } else if (pageId === 'settings') {
                    pageTitleEl.innerText = "الإعدادات العامة للنظام";
                    pageSubtitleEl.innerText = "تغيير هوية التصميم، وضبط مواقيت العمل وتفاصيل المركز";
                }
            }

            // Close mobile sidebar menu
            toggleSidebar(false);
        }

        // Mobile sidebar navigation menu toggles
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

        // Restore saved theme on load
        window.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'soft';
            changeTheme(savedTheme);
            attachGridListeners();
        });
    </script>
</body>
</html>
