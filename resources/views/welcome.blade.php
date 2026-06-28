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

            <!-- Card 9: Isometric Steps Chart (3D Isometric Infographic Steps) -->
            <section class="custom-card p-6 hover-lift lg:col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-lg font-bold text-text-main">مسار المريض الإيزومتري ثلاثي الأبعاد (3D Steps)</h2>
                        <span class="text-xs text-text-main opacity-60">كفاءة الأداء ورحلة المريض المتكاملة داخل عيادات النظام</span>
                    </div>
                    <button class="w-8 h-8 rounded-full custom-card flex items-center justify-center text-text-main opacity-70">
                        <i data-lucide="layers" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Isometric SVG representation container with theme-responsive background transition -->
                <div class="w-full rounded-2xl p-2 flex justify-center items-center overflow-hidden" style="background: var(--iso-chart-bg); transition: background 0.4s ease;">
                    <svg viewBox="0 -180 500 520" class="w-full h-auto" style="overflow: visible;">
                        <defs>
                            <!-- Step 1 Gradient -->
                            <linearGradient id="grad-1" x1="0%" y1="100%" x2="0%" y2="0%">
                                <stop offset="0%" stop-color="var(--iso-color-1)" stop-opacity="var(--iso-opacity-base)" />
                                <stop offset="100%" stop-color="var(--iso-color-1)" stop-opacity="var(--iso-opacity-top)" />
                            </linearGradient>
                            <!-- Step 2 Gradient -->
                            <linearGradient id="grad-2" x1="0%" y1="100%" x2="0%" y2="0%">
                                <stop offset="0%" stop-color="var(--iso-color-2)" stop-opacity="var(--iso-opacity-base)" />
                                <stop offset="100%" stop-color="var(--iso-color-2)" stop-opacity="var(--iso-opacity-top)" />
                            </linearGradient>
                            <!-- Step 3 Gradient -->
                            <linearGradient id="grad-3" x1="0%" y1="100%" x2="0%" y2="0%">
                                <stop offset="0%" stop-color="var(--iso-color-3)" stop-opacity="var(--iso-opacity-base)" />
                                <stop offset="100%" stop-color="var(--iso-color-3)" stop-opacity="var(--iso-opacity-top)" />
                            </linearGradient>
                            <!-- Step 4 Gradient -->
                            <linearGradient id="grad-4" x1="0%" y1="100%" x2="0%" y2="0%">
                                <stop offset="0%" stop-color="var(--iso-color-4)" stop-opacity="var(--iso-opacity-base)" />
                                <stop offset="100%" stop-color="var(--iso-color-4)" stop-opacity="var(--iso-opacity-top)" />
                            </linearGradient>
                            <!-- Step 5 Gradient -->
                            <linearGradient id="grad-5" x1="0%" y1="100%" x2="0%" y2="0%">
                                <stop offset="0%" stop-color="var(--iso-color-5)" stop-opacity="var(--iso-opacity-base)" />
                                <stop offset="100%" stop-color="var(--iso-color-5)" stop-opacity="var(--iso-opacity-top)" />
                            </linearGradient>
                            <!-- Step 6 Gradient -->
                            <linearGradient id="grad-6" x1="0%" y1="100%" x2="0%" y2="0%">
                                <stop offset="0%" stop-color="var(--iso-color-6)" stop-opacity="var(--iso-opacity-base)" />
                                <stop offset="100%" stop-color="var(--iso-color-6)" stop-opacity="var(--iso-opacity-top)" />
                            </linearGradient>
                        </defs>

                        <!-- DRAW FROM BACK TO FRONT (Step 6 to Step 1) -->

                        <!-- Step 6 (Furthest / Tallest) -->
                        <g>
                            <!-- Floor Ribbon (Extends to bottom-left) -->
                            <polygon points="343,175 395,145 326,185 274,215" class="iso-ribbon" fill="var(--iso-color-6)" />
                            <!-- Base Glowing Rim -->
                            <polygon points="395,145 343,175 353,169 405,139" stroke="var(--iso-base-stroke)" stroke-width="1.5" fill="none" class="iso-face" />
                            <!-- Back Wireframe (Visible through glass) -->
                            <line x1="353" y1="169" x2="353" y2="-106" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="353" y1="169" x2="343" y2="175" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="353" y1="169" x2="405" y2="139" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="353" y1="-106" x2="343" y2="-100" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="353" y1="-106" x2="405" y2="-136" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <!-- Front-Left Face (Wide Gradient Panel) -->
                            <polygon points="395,145 343,175 343,-100 395,-130" fill="url(#grad-6)" class="iso-face" />
                            <!-- Front-Right Face (Thin Panel + Shade Overlay) -->
                            <polygon points="395,145 405,139 405,-136 395,-130" fill="url(#grad-6)" class="iso-face" />
                            <polygon points="395,145 405,139 405,-136 395,-130" fill="#000000" opacity="0.15" class="iso-face pointer-events-none" />
                            <!-- Top Face (Cap) -->
                            <polygon points="395,-130 343,-100 353,-106 405,-136" fill="url(#grad-6)" class="iso-face" />
                            <!-- Face Outlines -->
                            <polygon points="395,145 343,175 343,-100 395,-130" class="iso-outline" />
                            <polygon points="395,145 405,139 405,-136 395,-130" class="iso-outline" />
                            <polygon points="395,-130 343,-100 353,-106 405,-136" class="iso-outline" />
                            <!-- Subtitle on Top (Perfect rotation/skew inside top diamond) -->
                            <text transform="translate(374, -118) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="#ffffff" font-family="Outfit" font-size="8" font-weight="bold">SUBTITLE</text>
                            <!-- Label on Ribbon (Centered and aligned bottom-left) -->
                            <text transform="translate(335, 180) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="var(--iso-ribbon-text)" font-family="Tajawal" font-size="8" font-weight="bold">STEP 06: الصيدلية</text>
                        </g>

                        <!-- Step 5 -->
                        <g>
                            <!-- Floor Ribbon -->
                            <polygon points="304,198 356,168 287,208 235,238" class="iso-ribbon" fill="var(--iso-color-5)" />
                            <!-- Base Glowing Rim -->
                            <polygon points="356,168 304,198 314,192 366,162" stroke="var(--iso-base-stroke)" stroke-width="1.5" fill="none" class="iso-face" />
                            <!-- Back Wireframe -->
                            <line x1="314" y1="192" x2="314" y2="-48" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="314" y1="192" x2="304" y2="198" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="314" y1="192" x2="366" y2="162" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="314" y1="-48" x2="304" y2="-42" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="314" y1="-48" x2="366" y2="-78" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <!-- Front-Left Face -->
                            <polygon points="356,168 304,198 304,-42 356,-72" fill="url(#grad-5)" class="iso-face" />
                            <!-- Front-Right Face -->
                            <polygon points="356,168 366,162 366,-78 356,-72" fill="url(#grad-5)" class="iso-face" />
                            <polygon points="356,168 366,162 366,-78 356,-72" fill="#000000" opacity="0.15" class="iso-face pointer-events-none" />
                            <!-- Top Face -->
                            <polygon points="356,-72 304,-42 314,-48 366,-78" fill="url(#grad-5)" class="iso-face" />
                            <!-- Outlines -->
                            <polygon points="356,168 304,198 304,-42 356,-72" class="iso-outline" />
                            <polygon points="356,168 366,162 366,-78 356,-72" class="iso-outline" />
                            <polygon points="356,-72 304,-42 314,-48 366,-78" class="iso-outline" />
                            <!-- Subtitle on Top -->
                            <text transform="translate(335, -60) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="#ffffff" font-family="Outfit" font-size="8" font-weight="bold">SUBTITLE</text>
                            <!-- Label on Ribbon -->
                            <text transform="translate(296, 203) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="var(--iso-ribbon-text)" font-family="Tajawal" font-size="8" font-weight="bold">STEP 05: المختبر</text>
                        </g>

                        <!-- Step 4 -->
                        <g>
                            <!-- Floor Ribbon -->
                            <polygon points="250,221 302,191 233,231 181,261" class="iso-ribbon" fill="var(--iso-color-4)" />
                            <!-- Base Glowing Rim -->
                            <polygon points="302,191 250,221 260,215 312,185" stroke="var(--iso-base-stroke)" stroke-width="1.5" fill="none" class="iso-face" />
                            <!-- Back Wireframe -->
                            <line x1="260" y1="215" x2="260" y2="-10" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="260" y1="215" x2="250" y2="221" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="260" y1="215" x2="312" y2="185" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="260" y1="-10" x2="250" y2="-4" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="260" y1="-10" x2="312" y2="-40" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <!-- Front-Left Face -->
                            <polygon points="302,191 250,221 250,-4 302,-34" fill="url(#grad-4)" class="iso-face" />
                            <!-- Front-Right Face -->
                            <polygon points="302,191 312,185 312,-40 302,-34" fill="url(#grad-4)" class="iso-face" />
                            <polygon points="302,191 312,185 312,-40 302,-34" fill="#000000" opacity="0.15" class="iso-face pointer-events-none" />
                            <!-- Top Face -->
                            <polygon points="302,-34 250,-4 260,-10 312,-40" fill="url(#grad-4)" class="iso-face" />
                            <!-- Outlines -->
                            <polygon points="302,191 250,221 250,-4 302,-34" class="iso-outline" />
                            <polygon points="302,191 312,185 312,-40 302,-34" class="iso-outline" />
                            <polygon points="302,-34 250,-4 260,-10 312,-40" class="iso-outline" />
                            <!-- Subtitle on Top -->
                            <text transform="translate(296, -2) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="#ffffff" font-family="Outfit" font-size="8" font-weight="bold">SUBTITLE</text>
                            <!-- Label on Ribbon -->
                            <text transform="translate(257, 226) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="var(--iso-ribbon-text)" font-family="Tajawal" font-size="8" font-weight="bold">STEP 04: النسائية</text>
                        </g>

                        <!-- Step 3 -->
                        <g>
                            <!-- Floor Ribbon -->
                            <polygon points="189,244 241,214 172,254 120,284" class="iso-ribbon" fill="var(--iso-color-3)" />
                            <!-- Base Glowing Rim -->
                            <polygon points="241,214 189,244 199,238 251,208" stroke="var(--iso-base-stroke)" stroke-width="1.5" fill="none" class="iso-face" />
                            <!-- Back Wireframe -->
                            <line x1="199" y1="238" x2="199" y2="68" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="199" y1="238" x2="189" y2="244" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="199" y1="238" x2="251" y2="208" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="199" y1="68" x2="189" y2="74" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="199" y1="68" x2="251" y2="38" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <!-- Front-Left Face -->
                            <polygon points="241,214 189,244 189,74 241,44" fill="url(#grad-3)" class="iso-face" />
                            <!-- Front-Right Face -->
                            <polygon points="241,214 251,208 251,38 241,44" fill="url(#grad-3)" class="iso-face" />
                            <polygon points="241,214 251,208 251,38 241,44" fill="#000000" opacity="0.15" class="iso-face pointer-events-none" />
                            <!-- Top Face -->
                            <polygon points="241,44 189,74 199,68 251,38" fill="url(#grad-3)" class="iso-face" />
                            <!-- Outlines -->
                            <polygon points="241,214 189,244 189,74 241,44" class="iso-outline" />
                            <polygon points="241,214 251,208 251,38 241,44" class="iso-outline" />
                            <polygon points="241,44 189,74 199,68 251,38" class="iso-outline" />
                            <!-- Subtitle on Top -->
                            <text transform="translate(257, 56) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="#ffffff" font-family="Outfit" font-size="8" font-weight="bold">SUBTITLE</text>
                            <!-- Label on Ribbon -->
                            <text transform="translate(218, 249) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="var(--iso-ribbon-text)" font-family="Tajawal" font-size="8" font-weight="bold">STEP 03: الأطفال</text>
                        </g>

                        <!-- Step 2 -->
                        <g>
                            <!-- Floor Ribbon -->
                            <polygon points="149,267 201,237 132,277 80,307" class="iso-ribbon" fill="var(--iso-color-2)" />
                            <!-- Base Glowing Rim -->
                            <polygon points="201,237 149,267 159,261 211,231" stroke="var(--iso-base-stroke)" stroke-width="1.5" fill="none" class="iso-face" />
                            <!-- Back Wireframe -->
                            <line x1="159" y1="261" x2="159" y2="126" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="159" y1="261" x2="149" y2="267" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="159" y1="261" x2="211" y2="231" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="159" y1="126" x2="149" y2="132" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="159" y1="126" x2="211" y2="96" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <!-- Front-Left Face -->
                            <polygon points="201,237 149,267 149,132 201,102" fill="url(#grad-2)" class="iso-face" />
                            <!-- Front-Right Face -->
                            <polygon points="201,237 211,231 211,96 201,102" fill="url(#grad-2)" class="iso-face" />
                            <polygon points="201,237 211,231 211,96 201,102" fill="#000000" opacity="0.15" class="iso-face pointer-events-none" />
                            <!-- Top Face -->
                            <polygon points="201,102 149,132 159,126 211,96" fill="url(#grad-2)" class="iso-face" />
                            <!-- Outlines -->
                            <polygon points="201,237 149,267 149,132 201,102" class="iso-outline" />
                            <polygon points="201,237 211,231 211,96 201,102" class="iso-outline" />
                            <polygon points="201,102 149,132 159,126 211,96" class="iso-outline" />
                            <!-- Subtitle on Top -->
                            <text transform="translate(218, 114) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="#ffffff" font-family="Outfit" font-size="8" font-weight="bold">SUBTITLE</text>
                            <!-- Label on Ribbon -->
                            <text transform="translate(179, 272) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="var(--iso-ribbon-text)" font-family="Tajawal" font-size="8" font-weight="bold">STEP 02: الباطنية</text>
                        </g>

                        <!-- Step 1 (Closest / Shortest) -->
                        <g>
                            <!-- Floor Ribbon -->
                            <polygon points="148,290 200,260 131,300 79,330" class="iso-ribbon" fill="var(--iso-color-1)" />
                            <!-- Base Glowing Rim -->
                            <polygon points="200,260 148,290 158,284 210,254" stroke="var(--iso-base-stroke)" stroke-width="1.5" fill="none" class="iso-face" />
                            <!-- Back Wireframe -->
                            <line x1="158" y1="284" x2="158" y2="184" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="158" y1="284" x2="148" y2="290" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="158" y1="284" x2="210" y2="254" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="158" y1="184" x2="148" y2="190" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <line x1="158" y1="184" x2="210" y2="154" stroke="var(--iso-stroke-back)" stroke-width="0.75" opacity="var(--iso-back-opacity)" />
                            <!-- Front-Left Face -->
                            <polygon points="200,260 148,290 148,190 200,160" fill="url(#grad-1)" class="iso-face" />
                            <!-- Front-Right Face -->
                            <polygon points="200,260 210,254 210,154 200,160" fill="url(#grad-1)" class="iso-face" />
                            <polygon points="200,260 210,254 210,154 200,160" fill="#000000" opacity="0.15" class="iso-face pointer-events-none" />
                            <!-- Top Face -->
                            <polygon points="200,160 148,190 158,184 210,154" fill="url(#grad-1)" class="iso-face" />
                            <!-- Outlines -->
                            <polygon points="200,260 148,290 148,190 200,160" class="iso-outline" />
                            <polygon points="200,260 210,254 210,154 200,160" class="iso-outline" />
                            <polygon points="200,160 148,190 158,184 210,154" class="iso-outline" />
                            <!-- Subtitle on Top -->
                            <text transform="translate(179, 172) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="#ffffff" font-family="Outfit" font-size="8" font-weight="bold">SUBTITLE</text>
                            <!-- Label on Ribbon -->
                            <text transform="translate(140, 295) rotate(-30) skewX(30)" text-anchor="middle" dominant-baseline="middle" fill="var(--iso-ribbon-text)" font-family="Tajawal" font-size="8" font-weight="bold">STEP 01: الاستقبال</text>
                        </g>
                    </svg>
                </div>
            </section>

            <!-- Card 10: Bubble Chart - Patient Demographics & Spending -->
            <section class="custom-card p-6 hover-lift lg:col-span-1">
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
                        <input type="text" placeholder="اسم المريض..." class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main placeholder-text-main opacity-60">
                    </div>
                    <!-- Clinic Dropdown -->
                    <div>
                        <select class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main">
                            <option>جميع الأطباء...</option>
                            <option>د. أحمد سليمان</option>
                            <option>د. سارة العلي</option>
                            <option>د. سمر الياسين</option>
                        </select>
                    </div>
                    <!-- Status Filter -->
                    <div>
                        <select class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main">
                            <option>حالة الدفع...</option>
                            <option>مدفوع</option>
                            <option>غير مدفوع</option>
                        </select>
                    </div>
                    <!-- Date Selector (ديت سليكتر) -->
                    <div class="flex items-center gap-2 px-2 border-r border-slate-200/20">
                        <i data-lucide="calendar" class="w-4 h-4 text-text-main opacity-50 shrink-0"></i>
                        <input type="date" value="2026-06-29" class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main custom-date-input">
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
                            <!-- Page 1 Rows -->
                            <tr class="table-row page-1">
                                <td>#TX-1092</td>
                                <td class="font-bold">محمد خالد العتيبي</td>
                                <td>د. أحمد سليمان - العيادة الباطنية</td>
                                <td class="font-bold">$120.00</td>
                                <td><span class="badge-success">مدفوع</span></td>
                                <td class="font-['Outfit']">2026-06-29</td>
                            </tr>
                            <tr class="table-row page-1">
                                <td>#TX-1093</td>
                                <td class="font-bold">سارة عبد الرحمن العلي</td>
                                <td>د. سارة العلي - عيادة الأطفال</td>
                                <td class="font-bold">$90.00</td>
                                <td><span class="badge-success">مدفوع</span></td>
                                <td class="font-['Outfit']">2026-06-29</td>
                            </tr>
                            <tr class="table-row page-1">
                                <td>#TX-1094</td>
                                <td class="font-bold">عبد الله عمر الفهيد</td>
                                <td>د. أحمد سليمان - العيادة الباطنية</td>
                                <td class="font-bold">$120.00</td>
                                <td><span class="badge-danger">غير مدفوع</span></td>
                                <td class="font-['Outfit']">2026-06-28</td>
                            </tr>
                            <tr class="table-row page-1">
                                <td>#TX-1095</td>
                                <td class="font-bold">ريما محمد الشمري</td>
                                <td>د. سمر الياسين - عيادة النساء</td>
                                <td class="font-bold">$150.00</td>
                                <td><span class="badge-success">مدفوع</span></td>
                                <td class="font-['Outfit']">2026-06-28</td>
                            </tr>
                            
                            <!-- Page 2 Rows (Hidden by default) -->
                            <tr class="table-row page-2 hidden">
                                <td>#TX-1088</td>
                                <td class="font-bold">سعدون ناصر الجاسم</td>
                                <td>د. سمر الياسين - عيادة النساء</td>
                                <td class="font-bold">$150.00</td>
                                <td><span class="badge-success">مدفوع</span></td>
                                <td class="font-['Outfit']">2026-06-27</td>
                            </tr>
                            <tr class="table-row page-2 hidden">
                                <td>#TX-1089</td>
                                <td class="font-bold">فاطمة علي الكواري</td>
                                <td>د. سارة العلي - عيادة الأطفال</td>
                                <td class="font-bold">$90.00</td>
                                <td><span class="badge-danger">غير مدفوع</span></td>
                                <td class="font-['Outfit']">2026-06-27</td>
                            </tr>
                            <tr class="table-row page-2 hidden">
                                <td>#TX-1090</td>
                                <td class="font-bold">يوسف محمد القحطاني</td>
                                <td>د. أحمد سليمان - العيادة الباطنية</td>
                                <td class="font-bold">$120.00</td>
                                <td><span class="badge-success">مدفوع</span></td>
                                <td class="font-['Outfit']">2026-06-26</td>
                            </tr>
                            <tr class="table-row page-2 hidden">
                                <td>#TX-1091</td>
                                <td class="font-bold">ليلى أحمد الحربي</td>
                                <td>د. سمر الياسين - عيادة النساء</td>
                                <td class="font-bold">$150.00</td>
                                <td><span class="badge-success">مدفوع</span></td>
                                <td class="font-['Outfit']">2026-06-26</td>
                            </tr>

                            <!-- Page 3 Rows (Hidden by default) -->
                            <tr class="table-row page-3 hidden">
                                <td>#TX-1084</td>
                                <td class="font-bold">فهد فيصل السديري</td>
                                <td>د. أحمد سليمان - العيادة الباطنية</td>
                                <td class="font-bold">$120.00</td>
                                <td><span class="badge-success">مدفوع</span></td>
                                <td class="font-['Outfit']">2026-06-25</td>
                            </tr>
                            <tr class="table-row page-3 hidden">
                                <td>#TX-1085</td>
                                <td class="font-bold">منى إبراهيم الدوسري</td>
                                <td>د. سمر الياسين - عيادة النساء</td>
                                <td class="font-bold">$150.00</td>
                                <td><span class="badge-success">مدفوع</span></td>
                                <td class="font-['Outfit']">2026-06-25</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Container (Default Standard Pagination) -->
                <div id="standard-pagination" class="flex justify-between items-center">
                    <span class="text-xs text-text-main opacity-70" id="pag-label">عرض 1 إلى 4 من أصل 10 قيود</span>
                    <div class="flex gap-2">
                        <button onclick="changePage(1)" class="pag-btn w-8 h-8 rounded-lg custom-card flex items-center justify-center hover-press text-xs font-bold text-text-main active" data-page-btn="1">1</button>
                        <button onclick="changePage(2)" class="pag-btn w-8 h-8 rounded-lg custom-card flex items-center justify-center hover-press text-xs font-bold text-text-main" data-page-btn="2">2</button>
                        <button onclick="changePage(3)" class="pag-btn w-8 h-8 rounded-lg custom-card flex items-center justify-center hover-press text-xs font-bold text-text-main" data-page-btn="3">3</button>
                    </div>
                </div>

                <!-- Excel Tab-style Simulator (Visible ONLY in Excel theme) -->
                <div id="excel-pagination" class="hidden excel-sheet-container -mx-6 -mb-6">
                    <div onclick="changePage(1)" class="excel-tab active" data-excel-tab="1">ورقة 1</div>
                    <div onclick="changePage(2)" class="excel-tab" data-excel-tab="2">ورقة 2</div>
                    <div onclick="changePage(3)" class="excel-tab" data-excel-tab="3">ورقة 3</div>
                    <div class="excel-tab text-slate-400 font-bold px-2">+</div>
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
                        <option>د. أحمد سليمان - العيادة الباطنية ($120)</option>
                        <option>د. سارة العلي - عيادة الأطفال ($90)</option>
                        <option>د. سمر الياسين - عيادة النساء ($150)</option>
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
                height: 250,
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

        // Pagination Switching Script
        function changePage(pageNum) {
            // Hide all table rows
            document.querySelectorAll('#table-data-body tr').forEach(row => {
                row.classList.add('hidden');
            });
            
            // Show selected page rows
            document.querySelectorAll(`#table-data-body tr.page-${pageNum}`).forEach(row => {
                row.classList.remove('hidden');
            });
            
            // Update page label
            const label = document.getElementById('pag-label');
            if (pageNum === 1) {
                label.innerText = "عرض 1 إلى 4 من أصل 10 قيود";
            } else if (pageNum === 2) {
                label.innerText = "عرض 5 إلى 8 من أصل 10 قيود";
            } else {
                label.innerText = "عرض 9 إلى 10 من أصل 10 قيود";
            }

            // Set active class on standard pagination buttons
            document.querySelectorAll('.pag-btn').forEach(btn => {
                btn.classList.remove('active', 'text-pink-500');
            });
            const activeBtn = document.querySelector(`[data-page-btn="${pageNum}"]`);
            if (activeBtn) activeBtn.classList.add('active', 'text-pink-500');
            
            // Set active class on Excel sheet tabs
            document.querySelectorAll('.excel-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            const activeTab = document.querySelector(`[data-excel-tab="${pageNum}"]`);
            if (activeTab) activeTab.classList.add('active');
        }

        // Modal Controls
        function toggleModal(show) {
            const modal = document.getElementById('add-transaction-modal');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        function saveTransaction() {
            const patientName = document.getElementById('modal-patient-name').value || "مريض تجريبي";
            alert("تم حفظ معاملة جديدة للمريض: " + patientName);
            toggleModal(false);
        }

        // Restore saved theme on load
        window.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'soft';
            changeTheme(savedTheme);
            changePage(1);
        });
    </script>
</body>
</html>
