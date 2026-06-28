<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة التحكم المؤشرات الذكية - Soft UI Dashboard</title>

    <!-- Google Fonts: Outfit & Tajawal for Arabic/English harmony -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (compiled via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ApexCharts CDN for advanced charts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Lucide Icons CDN for sleek icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Tajawal', 'Outfit', sans-serif;
            background-color: #eef2f7;
            color: #2e3e5c;
        }
        /* Custom scrollbar matching soft UI */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #eef2f7;
            box-shadow: inset 2px 2px 5px rgba(163, 177, 198, 0.5), inset -2px -2px 5px rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #d1d9e6;
            border-radius: 10px;
            box-shadow: 1px 1px 3px rgba(163, 177, 198, 0.8), -1px -1px 3px rgba(255, 255, 255, 0.9);
        }
        /* Extra Neumorphic animations */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 12px 12px 24px rgba(163, 177, 198, 0.7), -12px -12px 24px rgba(255, 255, 255, 0.9);
        }
        .hover-press {
            transition: all 0.2s ease;
        }
        .hover-press:active {
            box-shadow: inset 4px 4px 8px rgba(163, 177, 198, 0.6), inset -4px -4px 8px rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body class="min-h-screen p-6 md:p-12">

    <!-- Container -->
    <div class="max-w-7xl mx-auto">

        <!-- Top Header Navigation -->
        <header class="flex justify-between items-center mb-10">
            <!-- Left Dots Control Window mimic -->
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-red-400 shadow-soft-out-sm"></div>
                <div class="w-4 h-4 rounded-full bg-yellow-400 shadow-soft-out-sm"></div>
                <div class="w-4 h-4 rounded-full bg-green-400 shadow-soft-out-sm"></div>
            </div>

            <!-- Title -->
            <h1 class="text-3xl font-bold tracking-tight text-slate-800 font-['Outfit']">KPI Dashboard</h1>

            <!-- Right Circular Badge -->
            <div class="w-16 h-16 rounded-full bg-soft-bg shadow-soft-out flex items-center justify-center font-bold text-xl text-slate-700 font-['Outfit']">
                19
            </div>
        </header>

        <!-- main Grid -->
        <main class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Card 1: Overview and Vertical Bars -->
            <section class="bg-soft-bg rounded-[24px] shadow-soft-out p-6 hover-lift">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-slate-800">Overview</h2>
                    <button class="w-8 h-8 rounded-full bg-soft-bg shadow-soft-out-sm flex items-center justify-center hover-press text-slate-500">
                        <i data-lucide="more-horizontal" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Custom Bar representation -->
                <div class="flex justify-between items-end h-44 px-4 mb-6">
                    <!-- Bar 1 -->
                    <div class="flex flex-col items-center gap-2 w-8">
                        <div class="w-full bg-soft-bg shadow-soft-in rounded-full h-36 flex items-end p-[3px]">
                            <div class="w-full bg-gradient-to-t from-pink-500 to-pink-300 rounded-full" style="height: 80%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400 font-['Outfit']">Class 1</span>
                    </div>
                    <!-- Bar 2 -->
                    <div class="flex flex-col items-center gap-2 w-8">
                        <div class="w-full bg-soft-bg shadow-soft-in rounded-full h-36 flex items-end p-[3px]">
                            <div class="w-full bg-gradient-to-t from-amber-500 to-amber-300 rounded-full" style="height: 65%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400 font-['Outfit']">Class 2</span>
                    </div>
                    <!-- Bar 3 -->
                    <div class="flex flex-col items-center gap-2 w-8">
                        <div class="w-full bg-soft-bg shadow-soft-in rounded-full h-36 flex items-end p-[3px]">
                            <div class="w-full bg-gradient-to-t from-emerald-500 to-emerald-300 rounded-full" style="height: 90%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400 font-['Outfit']">Class 3</span>
                    </div>
                    <!-- Bar 4 -->
                    <div class="flex flex-col items-center gap-2 w-8">
                        <div class="w-full bg-soft-bg shadow-soft-in rounded-full h-36 flex items-end p-[3px]">
                            <div class="w-full bg-gradient-to-t from-sky-500 to-sky-300 rounded-full" style="height: 50%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400 font-['Outfit']">Class 4</span>
                    </div>
                </div>

                <div class="border-t border-slate-200/50 pt-4 flex justify-between">
                    <div>
                        <div class="text-xs text-slate-400 font-medium">Sales Analysis</div>
                        <div class="text-xl font-bold text-pink-500 font-['Outfit']">23K</div>
                    </div>
                    <div class="text-left">
                        <div class="text-xs text-slate-400 font-medium">Revenue</div>
                        <div class="text-xl font-bold text-sky-500 font-['Outfit']">12K</div>
                    </div>
                </div>
            </section>


            <!-- Card 2: 4 circular progress metrics -->
            <section class="bg-soft-bg rounded-[24px] shadow-soft-out p-6 hover-lift">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-slate-800">KPI Dashboard</h2>
                    <button class="w-8 h-8 rounded-full bg-soft-bg shadow-soft-out-sm flex items-center justify-center hover-press text-slate-500">
                        <i data-lucide="sliders" class="w-4 h-4"></i>
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <!-- Radial 1 -->
                    <div class="flex flex-col items-center p-2 rounded-2xl bg-soft-bg shadow-soft-in">
                        <div id="chart-radial-1"></div>
                        <span class="text-xs text-slate-500 font-medium">Data Analysis #1</span>
                    </div>
                    <!-- Radial 2 -->
                    <div class="flex flex-col items-center p-2 rounded-2xl bg-soft-bg shadow-soft-in">
                        <div id="chart-radial-2"></div>
                        <span class="text-xs text-slate-500 font-medium">Data Analysis #2</span>
                    </div>
                    <!-- Radial 3 -->
                    <div class="flex flex-col items-center p-2 rounded-2xl bg-soft-bg shadow-soft-in">
                        <div id="chart-radial-3"></div>
                        <span class="text-xs text-slate-500 font-medium">Data Analysis #3</span>
                    </div>
                    <!-- Radial 4 -->
                    <div class="flex flex-col items-center p-2 rounded-2xl bg-soft-bg shadow-soft-in">
                        <div id="chart-radial-4"></div>
                        <span class="text-xs text-slate-500 font-medium">Data Analysis #4</span>
                    </div>
                </div>

                <div class="text-center bg-soft-bg shadow-soft-out-sm rounded-xl py-2">
                    <span class="text-xs text-slate-400">Total volume:</span>
                    <span class="text-sm font-bold text-slate-700 font-['Outfit']">277,2M</span>
                </div>
            </section>


            <!-- Card 3: Wave/Area Chart Sales -->
            <section class="bg-soft-bg rounded-[24px] shadow-soft-out p-6 hover-lift">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-slate-800">KPI Dashboard Sales</h2>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-600 shadow-soft-out-sm font-['Outfit']">96%</span>
                </div>

                <!-- Apex Area Chart -->
                <div class="w-full bg-soft-bg shadow-soft-in rounded-2xl p-2 mb-4">
                    <div id="chart-area-sales"></div>
                </div>

                <p class="text-xs text-slate-400 text-center leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aeneam commodo ligula eget.
                </p>
            </section>


            <!-- Card 4: Strategy and Development Gauge -->
            <section class="bg-soft-bg rounded-[24px] shadow-soft-out p-6 hover-lift md:col-span-2 lg:col-span-1">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Strategy & Development</h2>
                        <span class="text-xs text-slate-400 font-['Outfit']">Q 277,2M</span>
                    </div>
                    <button class="w-8 h-8 rounded-full bg-soft-bg shadow-soft-out-sm flex items-center justify-center text-emerald-500">
                        <i data-lucide="trending-up" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Semi circle donut -->
                <div class="flex justify-center items-start h-36 overflow-hidden bg-soft-bg shadow-soft-in rounded-2xl mb-4">
                    <div id="chart-gauge-strategy" class="w-full"></div>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-2 rounded-xl bg-soft-bg shadow-soft-out-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-pink-500 shadow-soft-out-sm"></span>
                            <span class="text-xs text-slate-600 font-medium">Value Title</span>
                        </div>
                        <span class="text-xs font-bold text-slate-700 font-['Outfit']">16.2M</span>
                    </div>
                    <div class="flex items-center justify-between p-2 rounded-xl bg-soft-bg shadow-soft-out-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-soft-out-sm"></span>
                            <span class="text-xs text-slate-600 font-medium">Value Title</span>
                        </div>
                        <span class="text-xs font-bold text-slate-700 font-['Outfit']">10.8M</span>
                    </div>
                    <div class="flex items-center justify-between p-2 rounded-xl bg-soft-bg shadow-soft-out-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-sky-500 shadow-soft-out-sm"></span>
                            <span class="text-xs text-slate-600 font-medium">Value Title</span>
                        </div>
                        <span class="text-xs font-bold text-slate-700 font-['Outfit']">18.2M</span>
                    </div>
                </div>
            </section>


            <!-- Card 5: Speedometer Dials & Bar -->
            <section class="bg-soft-bg rounded-[24px] shadow-soft-out p-6 hover-lift md:col-span-2">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-slate-800">Analysis & Speedometer Dials</h2>
                    <span class="text-xs text-slate-400 font-medium">مستشعرات أداء حية</span>
                </div>

                <!-- 3 Speedometers Row -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                    <!-- Dial 1 -->
                    <div class="flex flex-col items-center bg-soft-bg shadow-soft-in p-4 rounded-[20px]">
                        <div id="chart-dial-pink"></div>
                        <div class="text-xs font-bold text-slate-700 mt-2">مستوى الطلبات</div>
                    </div>
                    <!-- Dial 2 -->
                    <div class="flex flex-col items-center bg-soft-bg shadow-soft-in p-4 rounded-[20px]">
                        <div id="chart-dial-orange"></div>
                        <div class="text-xs font-bold text-slate-700 mt-2">معدل التحويل</div>
                    </div>
                    <!-- Dial 3 -->
                    <div class="flex flex-col items-center bg-soft-bg shadow-soft-in p-4 rounded-[20px]">
                        <div id="chart-dial-green"></div>
                        <div class="text-xs font-bold text-slate-700 mt-2">نسبة الاستبقاء</div>
                    </div>
                </div>

                <!-- Multi-bar Chart at the bottom of card -->
                <div class="bg-soft-bg shadow-soft-in rounded-2xl p-4">
                    <div id="chart-multi-bar"></div>
                </div>
            </section>


            <!-- Card 6: Interactive Neumorphic Component Demos (Form controls) -->
            <section class="bg-soft-bg rounded-[24px] shadow-soft-out p-6 hover-lift lg:col-span-3">
                <h2 class="text-lg font-bold text-slate-800 mb-6">مكونات تفاعلية بنمط Soft UI</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Column 1: Buttons and Knobs -->
                    <div class="space-y-6">
                        <h3 class="text-sm font-semibold text-slate-500 border-b border-slate-200/50 pb-2">الأزرار وتأثيرات الضغط</h3>
                        
                        <div class="flex gap-4">
                            <button class="flex-1 py-3 px-4 bg-soft-bg shadow-soft-out rounded-xl text-xs font-bold text-pink-500 hover:shadow-soft-out-sm hover-press active:text-pink-600">
                                زر بارز (Raised)
                            </button>
                            <button class="flex-1 py-3 px-4 bg-soft-bg shadow-soft-in rounded-xl text-xs font-bold text-emerald-600 hover-press">
                                زر غائر (Sunken)
                            </button>
                        </div>

                        <div class="flex justify-between items-center bg-soft-bg shadow-soft-in p-3 rounded-xl">
                            <span class="text-xs font-bold text-slate-600">مفتاح تفعيل ذكي</span>
                            <!-- Custom Switch Toggle -->
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer" checked>
                                <div class="w-12 h-6 bg-soft-bg shadow-soft-in rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gradient-to-r after:from-emerald-500 after:to-emerald-400 after:rounded-full after:h-5 after:w-5 after:transition-all after:shadow-soft-out-sm peer-checked:shadow-inner"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Column 2: Form Inputs -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-slate-500 border-b border-slate-200/50 pb-2">حقول الإدخال والبحث</h3>
                        
                        <div class="relative">
                            <input type="text" placeholder="ابحث عن مريض..." class="w-full bg-soft-bg shadow-soft-in border-none focus:outline-none focus:ring-0 rounded-xl py-3 px-4 text-xs font-medium text-slate-700 placeholder-slate-400">
                            <div class="absolute left-3 top-3.5 text-slate-400">
                                <i data-lucide="search" class="w-4 h-4"></i>
                            </div>
                        </div>

                        <div class="relative">
                            <select class="w-full bg-soft-bg shadow-soft-in border-none focus:outline-none focus:ring-0 rounded-xl py-3 px-4 text-xs font-medium text-slate-700">
                                <option>اختر الطبيب المعالج...</option>
                                <option>د. أحمد سليمان - العيادة الباطنية</option>
                                <option>د. سارة العلي - عيادة الأطفال</option>
                            </select>
                        </div>
                    </div>

                    <!-- Column 3: Indicators and values -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-slate-500 border-b border-slate-200/50 pb-2">حالة الدفع وحجز الطابور</h3>
                        
                        <div class="flex items-center justify-between p-3 bg-soft-bg shadow-soft-out rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-soft-bg shadow-soft-in flex items-center justify-center text-emerald-500 text-xs font-bold font-['Outfit']">01</div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-700">رقم الدور الحالي</h4>
                                    <span class="text-[10px] text-slate-400">المريض: محمد خالد</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 shadow-soft-out-sm">قيد الانتظار</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-soft-bg shadow-soft-out rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-soft-bg shadow-soft-in flex items-center justify-center text-pink-500 text-xs font-bold font-['Outfit']">02</div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-700">الكشفية والتكلفة</h4>
                                    <span class="text-[10px] text-slate-400">سعر كشفية الطبيب</span>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-pink-600 font-['Outfit']">$120.00</span>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <!-- Script to render Neumorphic ApexCharts -->
    <script>
        // Init Lucide Icons
        lucide.createIcons();

        // Color Palette from Design
        const pinkGrad = ['#ff4d7e', '#ff85a7'];
        const orangeGrad = ['#ff9f43', '#ffc085'];
        const greenGrad = ['#28c76f', '#48da89'];
        const blueGrad = ['#00cfe8', '#33e0f4'];

        // Helper to generate circular radial config
        function getRadialConfig(percentage, mainColor, gradColor) {
            return {
                chart: {
                    type: 'radialBar',
                    width: 100,
                    height: 100,
                    sparkline: { enabled: true }
                },
                series: [percentage],
                colors: [mainColor],
                plotOptions: {
                    radialBar: {
                        hollow: { size: '60%' },
                        track: {
                            background: '#eef2f7',
                            strokeWidth: '100%',
                        },
                        dataLabels: {
                            name: { show: false },
                            value: {
                                offsetY: 5,
                                fontSize: '13px',
                                fontWeight: '700',
                                color: '#2e3e5c'
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

        // Render 4 Circular Radial Charts
        new ApexCharts(document.querySelector("#chart-radial-1"), getRadialConfig(96, pinkGrad[0], pinkGrad[1])).render();
        new ApexCharts(document.querySelector("#chart-radial-2"), getRadialConfig(75, orangeGrad[0], orangeGrad[1])).render();
        new ApexCharts(document.querySelector("#chart-radial-3"), getRadialConfig(50, greenGrad[0], greenGrad[1])).render();
        new ApexCharts(document.querySelector("#chart-radial-4"), getRadialConfig(85, blueGrad[0], blueGrad[1])).render();

        // Area Sales Chart
        new ApexCharts(document.querySelector("#chart-area-sales"), {
            chart: {
                type: 'area',
                height: 160,
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
        }).render();

        // Gauge Chart Strategy
        new ApexCharts(document.querySelector("#chart-gauge-strategy"), {
            chart: {
                type: 'radialBar',
                height: 280,
                offsetY: -10,
                sparkline: { enabled: true }
            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    hollow: { size: '65%' },
                    track: {
                        background: '#eef2f7',
                        strokeWidth: '97%',
                        margin: 5,
                    },
                    dataLabels: {
                        name: { show: false },
                        value: {
                            offsetY: -10,
                            fontSize: '22px',
                            fontWeight: '700',
                            color: '#2e3e5c'
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
        }).render();

        // Speedometers (Dial charts) Helper
        function getDialConfig(percentage, color, gradColor) {
            return {
                chart: {
                    type: 'radialBar',
                    height: 120,
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
                            background: '#eef2f7',
                            strokeWidth: '100%'
                        },
                        dataLabels: {
                            name: { show: false },
                            value: {
                                offsetY: 4,
                                fontSize: '14px',
                                fontWeight: '700',
                                color: '#2e3e5c'
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

        new ApexCharts(document.querySelector("#chart-dial-pink"), getDialConfig(65, pinkGrad[0], pinkGrad[1])).render();
        new ApexCharts(document.querySelector("#chart-dial-orange"), getDialConfig(80, orangeGrad[0], orangeGrad[1])).render();
        new ApexCharts(document.querySelector("#chart-dial-green"), getDialConfig(45, greenGrad[0], greenGrad[1])).render();

        // Multi-bar Chart
        new ApexCharts(document.querySelector("#chart-multi-bar"), {
            chart: {
                type: 'bar',
                height: 150,
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
        }).render();
    </script>
</body>
</html>
