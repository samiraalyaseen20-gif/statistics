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
        <div class="mb-10 p-4 rounded-[20px] custom-card flex flex-wrap items-center justify-between gap-4">
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


            <!-- Card 6: Interactive Component Demos -->
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

        // Theme Switcher Logic
        function changeTheme(themeName) {
            document.body.setAttribute('data-theme', themeName);
            localStorage.setItem('theme', themeName);
            setActiveButton(themeName);
            
            // Wait slightly for transition to complete, then update charts
            setTimeout(() => {
                updateChartThemes(themeName);
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

            // Update tooltips theme and background transparency
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

        // Restore saved theme on load
        window.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'soft';
            changeTheme(savedTheme);
        });
    </script>
</body>
</html>
