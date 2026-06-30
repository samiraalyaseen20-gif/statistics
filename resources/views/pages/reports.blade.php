<!-- PAGE 2: REPORTS PAGE SECTION (Unified Scrollable Dashboard with 3D Arrow Infographics) -->
<section id="page-reports" class="page-section space-y-6 hidden">

    <!-- Filter & Action Bar -->
    <div class="custom-card p-4 rounded-2xl flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-pink-500/10 flex items-center justify-center text-pink-500">
                <i data-lucide="file-bar-chart-2" class="w-4 h-4"></i>
            </div>
            <h2 class="text-xs font-bold text-text-main">الإحصاءات والتقارير الطبية</h2>
        </div>
        <div class="flex items-center gap-3">
            <input type="month" value="2026-05" class="custom-inset border-none focus:outline-none rounded-xl py-2 px-4 text-xs font-bold text-text-main custom-date-input">
            <button onclick="window.print()" class="py-2 px-5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-pink-400 hover-press flex items-center gap-2">
                <i data-lucide="printer" class="w-3.5 h-3.5"></i><span>طباعة PDF</span>
            </button>
        </div>
    </div>

    <!-- 1. الاستشاريات العامة والتخصصية (جدول 1) -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="stethoscope" class="w-4 h-4 text-pink-500"></i>
            جدول (1): أعداد المراجعين في الاستشاريات
        </h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- 3D Isometric Arrows SVG Infographic -->
            <div class="flex justify-center">
                <svg viewBox="0 0 350 200" class="w-full max-w-[320px] h-auto overflow-visible">
                    <defs>
                        <linearGradient id="g1-teal" x1="0%" y1="100%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#0284c7" /><stop offset="100%" stop-color="#38bdf8" />
                        </linearGradient>
                        <linearGradient id="g1-pink" x1="0%" y1="100%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#db2777" /><stop offset="100%" stop-color="#f472b6" />
                        </linearGradient>
                    </defs>
                    <polygon points="50,190 150,220 310,130 210,100" fill="#e2e8f0" opacity="0.4" />
                    <!-- Arrow 1 (General: 3375 - 76%) -->
                    <g class="hover:opacity-90 cursor-pointer transition-opacity duration-300">
                        <line x1="140" y1="110" x2="140" y2="75" stroke="#0284c7" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                        <circle cx="140" cy="60" r="14" fill="#0284c7" />
                        <text x="140" y="63" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">3375</text>
                        <path d="M 90 190 L 150 150 L 150 110 L 170 115 L 140 70 L 110 115 L 130 110 L 130 135 L 90 160 Z" fill="url(#g1-teal)" />
                        <path d="M 130 110 L 150 110 L 150 150 L 130 135 Z" fill="#0369a1" opacity="0.3" />
                        <text x="140" y="205" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">العيون العامة (76%)</text>
                    </g>
                    <!-- Arrow 2 (Special: 1091 - 24%) -->
                    <g class="hover:opacity-90 cursor-pointer transition-opacity duration-300">
                        <line x1="240" y1="130" x2="240" y2="95" stroke="#db2777" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                        <circle cx="240" cy="80" r="14" fill="#db2777" />
                        <text x="240" y="83" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">1091</text>
                        <path d="M 190 190 L 250 150 L 250 130 L 270 135 L 240 90 L 210 135 L 230 130 L 230 135 L 190 160 Z" fill="url(#g1-pink)" />
                        <path d="M 230 130 L 250 130 L 250 150 L 230 135 Z" fill="#be185d" opacity="0.3" />
                        <text x="240" y="205" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">التخصصات الدقيقة (24%)</text>
                    </g>
                </svg>
            </div>
            <!-- Data Table -->
            <div>
                <table class="custom-table text-xs">
                    <thead><tr><th class="w-12 text-center">ت</th><th>الوحدة الطبية</th><th class="text-center">المجموع</th></tr></thead>
                    <tbody>
                        <tr class="table-row"><td class="text-center">1</td><td>استشارية العيون العامة</td><td class="text-center font-bold">3,375</td></tr>
                        <tr class="table-row"><td class="text-center">2</td><td>استشارية التخصصات الدقيقة</td><td class="text-center font-bold">1,091</td></tr>
                        <tr class="table-row font-extrabold text-theme-pink"><td colspan="2" class="text-center">المجموع الكلي</td><td class="text-center text-sm">4,566</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 2. مراجعو كل طبيب اختصاص (جدول 2) -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="users" class="w-4 h-4 text-emerald-500"></i>
            جدول (2): أعداد مراجعي الاستشارية لكل طبيب اختصاص
        </h3>
        <div class="w-full overflow-x-auto py-2">
            <svg id="svg-report-2" class="w-full min-w-[850px] h-[260px] overflow-visible"></svg>
        </div>
    </div>

    <!-- 3. التوزيع الديمغرافي لمراجعي الاستشاريات (جدول 3 و 4) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Inside Iraq -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="flag" class="w-4 h-4 text-sky-500"></i>
                جدول (3): التوزيع الجغرافي داخل العراق
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-3" class="w-full min-w-[450px] h-[220px] overflow-visible"></svg>
            </div>
        </div>
        <!-- Outside Iraq -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="globe" class="w-4 h-4 text-pink-500"></i>
                جدول (4): المراجعون من خارج العراق
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-4" class="w-full min-w-[400px] h-[220px] overflow-visible"></svg>
            </div>
        </div>
    </div>

    <!-- 4. الفحوصات البصرية والتحاليل المختبرية (جدول 5 و 6) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Visual Tests -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                جدول (5): الفحوصات البصرية والساندة
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-5" class="w-full min-w-[450px] h-[220px] overflow-visible"></svg>
            </div>
        </div>
        <!-- Lab Tests -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="test-tube" class="w-4 h-4 text-purple-500"></i>
                جدول (6): الفحوصات والتحاليل المختبرية المنجزة
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-6" class="w-full min-w-[450px] h-[220px] overflow-visible"></svg>
            </div>
        </div>
    </div>

    <!-- 5. تصنيف العمليات الجراحية (جدول 7) -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="scissors" class="w-4 h-4 text-rose-500"></i>
            جدول (7): أعداد وتصنيف العمليات الجراحية للعيون
        </h3>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
            <!-- 3D Infographic Column (Takes 2 cols on LG) -->
            <div class="lg:col-span-2 flex justify-center overflow-visible">
                <svg viewBox="0 0 520 250" class="w-full max-w-[480px] h-auto overflow-visible" style="filter: drop-shadow(0 15px 25px rgba(0,0,0,0.06))">
                    <defs>
                        <linearGradient id="ar-f-cyan" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#0ea5e9" /><stop offset="100%" stop-color="#38bdf8" /></linearGradient>
                        <linearGradient id="ar-f-pink" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#db2777" /><stop offset="100%" stop-color="#f472b6" /></linearGradient>
                        <linearGradient id="ar-f-amber" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#d97706" /><stop offset="100%" stop-color="#fbbf24" /></linearGradient>
                        <linearGradient id="ar-f-slate" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#475569" /><stop offset="100%" stop-color="#94a3b8" /></linearGradient>
                        <linearGradient id="ar-f-violet" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#6d28d9" /><stop offset="100%" stop-color="#c084fc" /></linearGradient>
                        <linearGradient id="ar-f-rose" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#e11d48" /><stop offset="100%" stop-color="#fda4af" /></linearGradient>

                        <linearGradient id="ar-s-cyan" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#0369a1" /><stop offset="100%" stop-color="#0284c7" /></linearGradient>
                        <linearGradient id="ar-s-pink" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#9d174d" /><stop offset="100%" stop-color="#c2185b" /></linearGradient>
                        <linearGradient id="ar-s-amber" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#92400e" /><stop offset="100%" stop-color="#b45309" /></linearGradient>
                        <linearGradient id="ar-s-slate" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#1e293b" /><stop offset="100%" stop-color="#334155" /></linearGradient>
                        <linearGradient id="ar-s-violet" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#4c1d95" /><stop offset="100%" stop-color="#5b21b6" /></linearGradient>
                        <linearGradient id="ar-s-rose" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#9f1239" /><stop offset="100%" stop-color="#be123c" /></linearGradient>
                    </defs>

                    <polygon points="30,220 480,220 440,205 70,205" fill="#cbd5e1" opacity="0.25" />
                    
                    <!-- 1. صغرى -->
                    <g class="cursor-pointer">
                        <line x1="60" y1="130" x2="60" y2="85" stroke="#0ea5e9" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                        <circle cx="60" cy="70" r="14" fill="#0ea5e9" />
                        <text x="60" y="73" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">1%</text>
                        <polygon points="40,220 60,230 60,170 40,160" fill="url(#ar-f-cyan)" />
                        <polygon points="60,230 80,220 80,160 60,170" fill="url(#ar-s-cyan)" />
                        <polygon points="40,160 60,170 60,140" fill="#38bdf8" />
                        <polygon points="60,170 80,160 60,140" fill="#0284c7" />
                        <text x="60" y="245" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">صغرى</text>
                    </g>
                    <!-- 2. ليزر -->
                    <g class="cursor-pointer">
                        <line x1="130" y1="100" x2="130" y2="65" stroke="#db2777" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                        <circle cx="130" cy="50" r="14" fill="#db2777" />
                        <text x="130" y="53" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">5%</text>
                        <polygon points="110,220 130,230 130,140 110,130" fill="url(#ar-f-pink)" />
                        <polygon points="130,230 150,220 150,130 130,140" fill="url(#ar-s-pink)" />
                        <polygon points="110,130 130,140 130,110" fill="#f472b6" />
                        <polygon points="130,140 150,130 130,110" fill="#c2185b" />
                        <text x="130" y="245" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">ليزر</text>
                    </g>
                    <!-- 3. كبرى -->
                    <g class="cursor-pointer">
                        <line x1="200" y1="110" x2="200" y2="75" stroke="#d97706" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                        <circle cx="200" cy="60" r="14" fill="#d97706" />
                        <text x="200" y="63" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">4%</text>
                        <polygon points="180,220 200,230 200,150 180,140" fill="url(#ar-f-amber)" />
                        <polygon points="200,230 220,220 220,140 200,150" fill="url(#ar-s-amber)" />
                        <polygon points="180,140 200,150 200,120" fill="#fbbf24" />
                        <polygon points="200,150 220,140 200,120" fill="#b45309" />
                        <text x="200" y="245" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">كبرى</text>
                    </g>
                    <!-- 4. خاصة -->
                    <g class="cursor-pointer">
                        <line x1="270" y1="105" x2="270" y2="70" stroke="#475569" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                        <circle cx="270" cy="55" r="14" fill="#475569" />
                        <text x="270" y="58" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">4%</text>
                        <polygon points="250,220 270,230 270,145 250,135" fill="url(#ar-f-slate)" />
                        <polygon points="270,230 290,220 290,135 270,145" fill="url(#ar-s-slate)" />
                        <polygon points="250,135 270,145 270,115" fill="#94a3b8" />
                        <polygon points="270,145 290,135 270,115" fill="#334155" />
                        <text x="270" y="245" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">خاصة</text>
                    </g>
                    <!-- 5. فوق الكبرى -->
                    <g class="cursor-pointer">
                        <line x1="340" y1="40" x2="340" y2="25" stroke="#6d28d9" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                        <circle cx="340" cy="10" r="14" fill="#6d28d9" />
                        <text x="340" y="13" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">22%</text>
                        <polygon points="320,220 340,230 340,80 320,70" fill="url(#ar-f-violet)" />
                        <polygon points="340,230 360,220 360,70 340,80" fill="url(#ar-s-violet)" />
                        <polygon points="320,70 340,80 340,50" fill="#c084fc" />
                        <polygon points="340,80 360,70 340,50" fill="#5b21b6" />
                        <text x="340" y="245" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">فوق كبرى</text>
                    </g>
                    <!-- 6. حقن العين -->
                    <g class="cursor-pointer">
                        <line x1="410" y1="-10" x2="410" y2="-20" stroke="#e11d48" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                        <circle cx="410" cy="-35" r="14" fill="#e11d48" />
                        <text x="410" y="-32" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">63%</text>
                        <polygon points="390,220 410,230 410,20 390,10" fill="url(#ar-f-rose)" />
                        <polygon points="410,230 430,220 430,10 410,20" fill="url(#ar-s-rose)" />
                        <polygon points="390,10 410,20 410,-10" fill="#fda4af" />
                        <polygon points="410,20 430,10 410,-10" fill="#be123c" />
                        <text x="410" y="245" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">حقن العين</text>
                    </g>
                </svg>
            </div>
            <!-- Legend / Stats Table -->
            <div class="lg:col-span-1">
                <table class="custom-table text-xs">
                    <thead><tr><th>التصنيف</th><th class="text-center">العدد</th></tr></thead>
                    <tbody>
                        <tr class="table-row"><td>وسطى (حقن العين)</td><td class="text-center font-bold text-rose-600">1,257</td></tr>
                        <tr class="table-row"><td>فوق الكبرى</td><td class="text-center font-bold text-violet-600">434</td></tr>
                        <tr class="table-row"><td>وسطى (ليزر)</td><td class="text-center font-bold text-pink-600">103</td></tr>
                        <tr class="table-row"><td>الخاصة</td><td class="text-center font-bold text-slate-600">90</td></tr>
                        <tr class="table-row font-extrabold text-rose-600"><td class="text-sm">المجموع الكلي</td><td class="text-center text-sm font-extrabold">2,002</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 6. العمليات الجراحية لكل طبيب اختصاص (جدول 10) -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="award" class="w-4 h-4 text-violet-500"></i>
            جدول (10): إجمالي العمليات الجراحية المنجزة لكل طبيب اختصاص
        </h3>
        <div class="w-full overflow-x-auto py-2 mb-4">
            <svg id="svg-report-10" class="w-full min-w-[850px] h-[280px] overflow-visible"></svg>
        </div>
        <div class="overflow-x-auto">
            <table class="custom-table text-center" style="font-size:10px; min-width:850px">
                <thead>
                    <tr>
                        <th rowspan="2" class="w-6">ت</th>
                        <th rowspan="2" class="text-right pr-2">اسم الطبيب</th>
                        <th colspan="3" class="bg-yellow-400/20">صغرى</th>
                        <th colspan="3" class="bg-blue-400/20">وسطى</th>
                        <th colspan="3" class="bg-orange-400/20">كبرى</th>
                        <th colspan="3" class="bg-rose-400/20">فوق الكبرى</th>
                        <th colspan="3" class="bg-purple-400/20">خاصة</th>
                        <th rowspan="2" class="text-theme-pink font-extrabold">المجموع</th>
                    </tr>
                    <tr>
                        <th>ص</th><th>خ</th><th>ع</th>
                        <th>ص</th><th>خ</th><th>ع</th>
                        <th>ص</th><th>خ</th><th>ع</th>
                        <th>ص</th><th>خ</th><th>ع</th>
                        <th>ص</th><th>خ</th><th>ع</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $d10=[
                        [1,'د. غياث الدين ثجيل نعمه',[2,1,0,31,0,0,3,6,0,3,10,0,1,28,0],85],
                        [2,'د. حمزة صادق علوان الشريفي',[0,1,0,0,11,4,0,27,9,0,55,8,0,50,0],165],
                        [3,'د. ذو الفقار غني عبد',[0,0,0,0,2,1,0,4,0,0,5,0,0,10,0],22],
                        [4,'د. منتصر محمد عرب',[1,1,0,101,0,0,1,0,0,15,1,0,0,0,0],120],
                        [5,'د. افراح عبدالزهرة القصير',[0,0,0,0,2,0,0,0,0,0,7,0,0,1,0],10],
                        [6,'د. مؤيد عبد اللطيف صبار',[3,4,0,86,1,0,4,9,0,27,12,0,0,0,0],146],
                        [7,'د. بشرى سليمان علي الصقر',[0,2,7,0,1,11,0,0,6,0,28,107,0,0,0],162],
                        [8,'د. علاء صبري الغانمي',[1,0,0,128,0,0,1,0,0,13,4,0,0,0,0],147],
                        [9,'د. نور رعد كريم',[0,0,0,151,3,0,2,5,0,11,17,0,0,0,0],189],
                        [10,'د. حيدر حسين علي الموسوي',[3,1,0,751,14,0,4,0,0,29,37,0,0,0,0],839],
                        [11,'د. حذيفه سامي جواد العبايجي',[0,0,0,31,6,0,2,0,0,10,8,0,0,0,0],57],
                        [12,'د. اريج هادي كريم',[0,1,0,1,0,0,0,0,0,8,2,0,0,0,0],12],
                        [13,'د. خلدون خليل نايف',[0,0,0,1,0,0,0,0,0,4,1,0,0,0,0],6],
                        [14,'د. ايات معتز محمد',[1,2,0,22,0,0,2,0,0,6,2,0,0,0,0],35],
                        [15,'د. محمد بدر الجريان',[0,0,0,0,0,0,0,0,0,0,0,2,0,0,0],2],
                        [16,'د. زهراء علوان الحمداني',[2,0,0,0,1,0,0,0,0,2,0,0,0,0,0],5],
                    ];
                    @endphp
                    @foreach($d10 as [$num,$name,$vals,$total])
                    <tr class="table-row">
                        <td>{{ $num }}</td>
                        <td class="text-right pr-2 font-bold whitespace-nowrap">{{ $name }}</td>
                        @foreach($vals as $v)
                        <td class="{{ $v==0?'opacity-20':'' }}">{{ $v }}</td>
                        @endforeach
                        <td class="font-extrabold text-theme-pink text-xs">{{ $total }}</td>
                    </tr>
                    @endforeach
                    <tr class="table-row font-extrabold text-rose-600 text-xs">
                        <td colspan="2" class="text-right pr-2">المجموع</td>
                        <td>13</td><td>13</td><td>7</td>
                        <td>1303</td><td>41</td><td>16</td>
                        <td>19</td><td>51</td><td>15</td>
                        <td>128</td><td>189</td><td>117</td>
                        <td>1</td><td>89</td><td>0</td>
                        <td class="text-sm font-black">2,002</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="text-[8px] text-slate-400 mt-2">ص = قطاع الصحة &nbsp;|&nbsp; خ = عتبة الخاص &nbsp;|&nbsp; ع = عتبة العام</p>
    </div>

    <!-- 7. الإحصائية التفصيلية لكل طبيب -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="user-cog" class="w-4 h-4 text-violet-500"></i>
            الإحصائية التفصيلية للعمليات الجراحية لكل طبيب
        </h3>
        
        <div class="flex items-center gap-3 mb-6 bg-slate-200/20 p-3 rounded-xl">
            <span class="text-xs font-bold text-slate-500">اختيار الطبيب:</span>
            @php
            $dnames=[1=>'غياث الدين',2=>'حمزة صادق',3=>'ذوالفقار',4=>'منتصر عرب',5=>'افراح',6=>'مؤيد',7=>'بشرى',8=>'علاء',9=>'نور رعد',10=>'حيدر',11=>'حذيفه',12=>'اريج',13=>'زهراء',14=>'خلدون',15=>'ايات',16=>'محمد بدر'];
            @endphp
            <select id="doc-active-selector" onchange="showDocStats(this.value)" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                @foreach($dnames as $id=>$n)
                <option value="{{ $id }}">{{ $id }}. {{ $n }}</option>
                @endforeach
            </select>
        </div>

        <!-- Details Panel -->
        @php
        $ddetails=[
            1=>['د. غياث الدين ثجيل نعمة',85,[['قص السائل الزجاجي','خاصة',29],['رفع ماء اسود + رفع ساد','خاصة',2],['رفع ساد + زراعة عدسة','فوق الكبرى',3],['رفع سليكون + زرع عدسة','فوق الكبرى',8],['زرع عدسة ثانوية','فوق الكبرى',2],['غسل حجرة','كبرى',3],['رفع سليكون','كبرى',6],['حقن الايليليا','وسطى',18],['حقن الافاستين','وسطى',13]]],
            2=>['د. حمزة صادق علوان الشريفي',165,[['قص السائل الزجاجي','خاصة',50],['رفع ماء اسود + رفع ساد','خاصة',2],['رفع ساد + زراعة عدسة','فوق الكبرى',56],['رفع سليكون + زرع عدسة','فوق الكبرى',5],['زرع عدسة ثانوية','فوق الكبرى',1],['زرع صمام احمد','فوق الكبرى',1],['تعديل هطول الاجفان','كبرى',1],['تصليب القرنية','كبرى',1],['غسل حجرة','كبرى',9],['رفع سليكون','كبرى',25],['الليزر','وسطى',15],['تسليك مجرى الدمع','صغرى',1]]],
            3=>['د. ذوالفقار غني عبد الكندي',22,[['قص السائل الزجاجي','خاصة',10],['رفع ساد + زراعة عدسة','فوق الكبرى',5],['الحول','كبرى',1],['رفع سليكون','كبرى',3],['الليزر','وسطى',3]]],
            4=>['د. منتصر محمد عرب',120,[['رفع ساد + زراعة عدسة','فوق الكبرى',16],['رفع ظفرة','كبرى',1],['حقن الايليا','وسطى',52],['حقن اللوسنتس','وسطى',11],['حقن الافاستين','وسطى',30],['الليزر','وسطى',8],['تسليك مجرى الدمع','صغرى',1],['رفع جسم غريب','صغرى',1]]],
            5=>['د. افراح عبد الزهرة القصير',10,[['زرع صمام + رفع ساد','خاصة',1],['رفع ساد + زراعة عدسة','فوق الكبرى',7],['الليزر','وسطى',2]]],
            6=>['د. مؤيد عبد اللطيف صبار',146,[['رفع ساد + زراعة عدسة','فوق الكبرى',39],['تعديل هطول الاجفان','كبرى',1],['الحول','كبرى',10],['رفع ظفرة','كبرى',2],['حقن الايليا','وسطى',58],['حقن الافاستين','وسطى',26],['الليزر','وسطى',3],['رفع كيس دهني','صغرى',4],['رفع ورم مجرى الدمع','صغرى',1],['فحص تخدير عام','صغرى',1],['رفع جسم غريب','صغرى',1]]],
            7=>['د. بشرى سليمان علي الصقر',162,[['رفع ساد + زراعة عدسة','فوق الكبرى',135],['تعديل هطول الاجفان','كبرى',1],['تصليب القرنية','كبرى',4],['غسل حجرة','كبرى',1],['الليزر','وسطى',21],['رفع كيس دهني','صغرى',3],['رفع ورم درمويد','صغرى',1],['تسليك مجرى الدمع','صغرى',3],['رفع جسم غريب','صغرى',2]]],
            8=>['د. علاء صبري الغانمي',147,[['رفع ساد + زراعة عدسة','فوق الكبرى',17],['رفع ظفرة','كبرى',1],['حقن الفابزمو','وسطى',3],['حقن الايليا','وسطى',82],['حقن اللوسنتس','وسطى',23],['حقن الافاستين','وسطى',18],['حقن الكيناكورت','وسطى',2],['فحص تخدير عام','صغرى',1]]],
            9=>['د. نور رعد كريم',189,[['رفع ساد + زراعة عدسة','فوق الكبرى',27],['زرع عدسة ثانوية','فوق الكبرى',1],['تعديل هطول الاجفان','كبرى',1],['الحول','كبرى',4],['رفع ظفرة','كبرى',2],['حقن الايليا','وسطى',45],['حقن الافاستين','وسطى',101],['حقن الكيناكورت','وسطى',1],['الليزر','وسطى',7]]],
            10=>['د. حيدر حسين علي الموسوي',839,[['رفع ساد + زراعة عدسة','فوق الكبرى',66],['تعديل هطول الاجفان','كبرى',1],['تصليب القرنية','كبرى',2],['رفع ظفرة','كبرى',1],['حقن الايليا','وسطى',148],['حقن الافاستين','وسطى',572],['حقن الكيناكورت','وسطى',15],['حقن الاكتيليس','وسطى',1],['الليزر','وسطى',29],['رفع كيس دهني','صغرى',1],['تسليك مجرى الدمع','صغرى',2],['رفع جسم غريب','صغرى',1]]],
            11=>['د. حذيفه سامي جواد العبايجي',57,[['رفع ساد + زراعة عدسة','فوق الكبرى',18],['الحول','كبرى',1],['رفع ظفرة','كبرى',1],['حقن الافاستين','وسطى',30],['الليزر','وسطى',7]]],
            12=>['د. اريج هادي كريم',12,[['رفع ساد + زراعة عدسة','فوق الكبرى',10],['الليزر','وسطى',1],['رفع كيس دهني','صغرى',1]]],
            13=>['د. زهراء علوان الحمداني',5,[['رفع ساد + زراعة عدسة','فوق الكبرى',2],['الليزر','وسطى',1],['رفع كيس دهني','صغرى',2]]],
            14=>['د. خلدون خليل نايف',6,[['رفع ساد + زراعة عدسة','فوق الكبرى',5],['الليزر','وسطى',1]]],
            15=>['د. ايات معتز محمد',35,[['رفع ساد + زراعة عدسة','فوق الكبرى',8],['تعديل هطول الاجفان','كبرى',1],['تصليب القرنية','كبرى',1],['حقن الايليا','وسطى',1],['حقن الافاستين','وسطى',20],['الليزر','وسطى',1],['رفع كيس دهني','صغرى',3]]],
            16=>['د. محمد بدر محمد الجريان',2,[['رفع ساد + زراعة عدسة','فوق الكبرى',2]]],
        ];
        $bc=['خاصة'=>'bg-purple-100 text-purple-700','فوق الكبرى'=>'bg-rose-100 text-rose-700','كبرى'=>'bg-orange-100 text-orange-700','وسطى'=>'bg-blue-100 text-blue-700','صغرى'=>'bg-yellow-100 text-yellow-700'];
        @endphp

        @foreach($ddetails as $id=>[$docname,$total,$ops])
        <div id="stats-panel-{{ $id }}" class="stats-panel {{ $id==1?'':'hidden' }} transition-opacity duration-300">
            <div class="flex items-center justify-between gap-3 mb-4">
                <h4 class="text-xs font-bold text-slate-800">{{ $docname }}</h4>
                <span class="text-xs font-bold text-white bg-violet-500 px-4 py-1 rounded-full">{{ $total }} عملية</span>
            </div>
            <div class="flex flex-col lg:flex-row gap-6 items-start">
                <div class="w-full lg:w-2/5 flex-shrink-0">
                    <svg id="svg-doc-{{ $id }}" class="w-full h-[250px] overflow-visible"></svg>
                </div>
                <div class="w-full lg:w-3/5">
                    <table class="custom-table text-xs">
                        <thead><tr><th>ت</th><th>اسم العملية</th><th>التصنيف</th><th class="text-center font-bold">العدد</th></tr></thead>
                        <tbody>
                            @foreach($ops as $i=>$op)
                            <tr class="table-row">
                                <td class="w-8 text-center">{{ $i+1 }}</td>
                                <td>{{ $op[0] }}</td>
                                <td><span class="text-[9px] font-bold px-2 py-0.5 rounded-full {{ $bc[$op[1]] ?? '' }}">{{ $op[1] }}</span></td>
                                <td class="text-center font-bold text-violet-600 text-xs">{{ $op[2] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- 8. التواقيع والاعتماد (تذييل الصفحة) -->
    <div class="custom-card p-5 rounded-2xl">
        <div class="grid grid-cols-2 gap-4 text-center text-xs text-text-main">
            <div class="border-l border-slate-200/20 pl-4 space-y-1.5">
                <p class="font-bold opacity-60">المهندسة</p>
                <p class="font-extrabold text-sm">سميره علي ياسين</p>
                <p class="opacity-50 text-[10px]">مسؤول الإحصاء الطبي</p>
            </div>
            <div class="pr-4 space-y-1.5">
                <p class="font-bold opacity-60">الطبيب الاستشاري</p>
                <p class="font-extrabold text-sm">د. عدي عبد الحسين السالمي</p>
                <p class="opacity-50 text-[10px]">مدير مركز السيدة زينب الكبرى (ع)</p>
            </div>
        </div>
    </div>

</section>

<!-- Custom Styles for Print and 3D effects -->
<style>
@media print {
    #sidebar, header, .custom-card:first-child, select, button { display: none !important; }
    #page-reports { display: block !important; overflow: visible !important; }
    .custom-card { border: none !important; box-shadow: none !important; page-break-inside: avoid !important; }
}

/* Entrance Animations */
.arrow-grp {
    opacity: 0;
    transform: scaleY(0);
    transform-origin: bottom;
    transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}
.arrow-grp.show {
    opacity: 1;
    transform: scaleY(1);
}
</style>

<script>
// Toggle Stats panel for active doctor
function showDocStats(id) {
    document.querySelectorAll('.stats-panel').forEach(p => p.classList.add('hidden'));
    const activePanel = document.getElementById('stats-panel-' + id);
    if (activePanel) {
        activePanel.classList.remove('hidden');
    }
    renderSingleDocChart(id);
}

// Adjust colors hex brightness utility
function adjustColorBrightness(hex, percent) {
    let R = parseInt(hex.substring(1, 3), 16);
    let G = parseInt(hex.substring(3, 5), 16);
    let B = parseInt(hex.substring(5, 7), 16);

    R = parseInt(R * (100 + percent) / 100);
    G = parseInt(G * (100 + percent) / 100);
    B = parseInt(B * (100 + percent) / 100);

    R = (R < 255) ? R : 255;
    G = (G < 255) ? G : 255;
    B = (B < 255) ? B : 255;

    R = (R > 0) ? R : 0;
    G = (G > 0) ? G : 0;
    B = (B > 0) ? B : 0;

    const rHex = R.toString(16).padStart(2, '0');
    const gHex = G.toString(16).padStart(2, '0');
    const bHex = B.toString(16).padStart(2, '0');

    return "#" + rHex + gHex + bHex;
}

// Reusable 3D Isometric Arrows Drawing Engine
function draw3DIsometricArrows(svgId, values, labels, presetColors = null) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = ''; // Clear

    const maxVal = Math.max(...values, 1);
    const n = values.length;

    // ViewBox dimensions
    const viewBoxStr = svg.getAttribute('viewBox') || "0 0 900 280";
    const width = parseInt(viewBoxStr.split(' ')[2]);
    const height = parseInt(viewBoxStr.split(' ')[3]);

    const marginL = 40;
    const marginR = 40;
    const availableW = width - marginL - marginR;
    const spacing = n > 1 ? availableW / (n - 1) : availableW;
    const floorY = height - 40;

    // Base Shadow Polygon
    const baseLine = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
    baseLine.setAttribute('points', `${marginL-25},${floorY} ${width-marginR+25},${floorY} ${width-marginR},${floorY-15} ${marginL},${floorY-15}`);
    baseLine.setAttribute('fill', '#cbd5e1');
    baseLine.setAttribute('opacity', '0.2');
    svg.appendChild(baseLine);

    // Definitions for gradients
    const defs = document.createElementNS("http://www.w3.org/2000/svg", "defs");
    svg.appendChild(defs);

    const colors = presetColors || ['#ff4d7e','#10b981','#3b82f6','#f59e0b','#8b5cf6','#06b6d4','#f97316','#64748b','#ec4899','#84cc16','#0ea5e9','#6366f1','#d946ef','#14b8a6','#f43f5e','#a78bfa'];

    // Generate gradients dynamically
    labels.forEach((l, i) => {
        const color = colors[i % colors.length];
        
        // Front gradient
        const gradF = document.createElementNS("http://www.w3.org/2000/svg", "linearGradient");
        gradF.setAttribute('id', `grad-f-${svgId}-${i}`);
        gradF.setAttribute('x1', '0%'); gradF.setAttribute('y1', '100%');
        gradF.setAttribute('x2', '100%'); gradF.setAttribute('y2', '0%');
        gradF.innerHTML = `<stop offset="0%" stop-color="${color}"/><stop offset="100%" stop-color="${adjustColorBrightness(color, 35)}"/>`;
        defs.appendChild(gradF);

        // Side gradient
        const gradS = document.createElementNS("http://www.w3.org/2000/svg", "linearGradient");
        gradS.setAttribute('id', `grad-s-${svgId}-${i}`);
        gradS.setAttribute('x1', '0%'); gradS.setAttribute('y1', '100%');
        gradS.setAttribute('x2', '100%'); gradS.setAttribute('y2', '0%');
        gradS.innerHTML = `<stop offset="0%" stop-color="${adjustColorBrightness(color, -25)}"/><stop offset="100%" stop-color="${color}"/>`;
        defs.appendChild(gradS);
    });

    // Draw individual arrows
    values.forEach((val, i) => {
        const x = marginL + i * spacing;
        const y = floorY;

        // Custom heights scale logic
        const minH = 20;
        const maxH = height - 95;
        const scaleVal = maxVal > 1 ? Math.sqrt(val) / Math.sqrt(maxVal) : 1;
        const H = minH + (maxH - minH) * scaleVal;

        const g = document.createElementNS("http://www.w3.org/2000/svg", "g");
        g.setAttribute('class', 'arrow-grp cursor-pointer');

        // Dashed lines
        const line = document.createElementNS("http://www.w3.org/2000/svg", "line");
        line.setAttribute('x1', x);
        line.setAttribute('y1', y - H - 15);
        line.setAttribute('x2', x);
        line.setAttribute('y2', y - H - 38);
        line.setAttribute('stroke', colors[i % colors.length]);
        line.setAttribute('stroke-width', '1');
        line.setAttribute('stroke-dasharray', '2.5 2.5');
        line.setAttribute('opacity', '0.5');
        g.appendChild(line);

        // Floating Circle badge
        const circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
        circle.setAttribute('cx', x);
        circle.setAttribute('cy', y - H - 48);
        circle.setAttribute('r', '10.5');
        circle.setAttribute('fill', colors[i % colors.length]);
        g.appendChild(circle);

        // Value text
        const tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tVal.setAttribute('x', x);
        tVal.setAttribute('y', y - H - 45);
        tVal.setAttribute('font-family', 'Outfit');
        tVal.setAttribute('font-size', '7.5px');
        tVal.setAttribute('font-weight', 'bold');
        tVal.setAttribute('fill', '#ffffff');
        tVal.setAttribute('text-anchor', 'middle');
        tVal.textContent = val;
        g.appendChild(tVal);

        // Isometric Arrow Sides (Front / Left)
        const front = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
        front.setAttribute('points', `${x-10},${y} ${x},${y+5} ${x},${y+5-H} ${x-10},${y-H}`);
        front.setAttribute('fill', `url(#grad-f-${svgId}-${i})`);
        g.appendChild(front);

        // Side / Right
        const side = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
        side.setAttribute('points', `${x},${y+5} ${x+10},${y} ${x+10},${y-H} ${x},${y+5-H}`);
        side.setAttribute('fill', `url(#grad-s-${svgId}-${i})`);
        g.appendChild(side);

        // Pointed Caps
        const lTip = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
        lTip.setAttribute('points', `${x-10},${y-H} ${x},${y+5-H} ${x},${y+5-H-12}`);
        lTip.setAttribute('fill', adjustColorBrightness(colors[i % colors.length], 45));
        g.appendChild(lTip);

        const rTip = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
        rTip.setAttribute('points', `${x},${y+5-H} ${x+10},${y-H} ${x},${y+5-H-12}`);
        rTip.setAttribute('fill', adjustColorBrightness(colors[i % colors.length], -5));
        g.appendChild(rTip);

        // Label Text under arrows
        const label = document.createElementNS("http://www.w3.org/2000/svg", "text");
        label.setAttribute('x', x);
        label.setAttribute('y', y + 16);
        label.setAttribute('font-family', 'Tajawal');
        label.setAttribute('font-size', '8px');
        label.setAttribute('font-weight', 'bold');
        label.setAttribute('fill', '#64748b');
        label.setAttribute('text-anchor', 'middle');

        let labelText = labels[i];
        if (labelText.length > 7) labelText = labelText.substring(0, 6) + '..';
        label.textContent = labelText;
        g.appendChild(label);

        g.style.transitionDelay = `${i * 35}ms`;
        svg.appendChild(g);

        setTimeout(() => {
            g.classList.add('show');
        }, 50);
    });
}

// Global drawing triggers
function renderAll3DIsometricCharts() {
    // 2. Doctor visits visits (15 doctors)
    const docVisitsData = [177, 562, 120, 212, 120, 346, 1204, 56, 194, 729, 348, 134, 106, 171, 87];
    const docVisitsLabels = ['غياث','حمزة','ذوالفقار','منتصر','افراح','مؤيد','بشرى','علاء','نور','حيدر','حذيفه','اريج','زهراء','ايات','م.بدر'];
    draw3DIsometricArrows('svg-report-2', docVisitsData, docVisitsLabels);

    // 3. Inside Iraq governorates
    const govData = [3455, 521, 127, 120, 76, 46];
    const govLabels = ['كربلاء', 'بابل', 'بغداد', 'ذي قار', 'واسط', 'النجف'];
    draw3DIsometricArrows('svg-report-3', govData, govLabels);

    // 4. Outside Iraq countries
    const countryData = [6, 4, 2, 1, 1, 1];
    const countryLabels = ['إيران', 'أفغانستان', 'سوريا', 'مصر', 'نيجيريا', 'باكستان'];
    draw3DIsometricArrows('svg-report-4', countryData, countryLabels);

    // 5. Visual test types
    const visualData = [4730, 1444, 641, 142, 135, 67];
    const visualLabels = ['فحص البصر', 'OCT', 'قوة العدسة', 'C.T', 'سونار', 'FUNDUS'];
    draw3DIsometricArrows('svg-report-5', visualData, visualLabels);

    // 6. Lab test types
    const labTestData = [120, 95, 85, 70, 40];
    const labTestLabels = ['RBS', 'WBC', 'Hb', 'PCV', 'INR'];
    draw3DIsometricArrows('svg-report-6', labTestData, labTestLabels);

    // 10. Surgeries total (16 doctors)
    const docSurgData = [85, 165, 22, 120, 10, 146, 162, 147, 189, 839, 57, 12, 5, 6, 35, 2];
    const docSurgLabels = ['غياث','حمزة','ذوالفقار','منتصر','افراح','مؤيد','بشرى','علاء','نور','حيدر','حذيفه','اريج','زهراء','خلدون','ايات','م.بدر'];
    draw3DIsometricArrows('svg-report-10', docSurgData, docSurgLabels);

    // Init first doctor switcher details
    renderSingleDocChart(1);
}

// switcher individual doctor operations details
const docOpsData = {
    1:[29,2,3,8,2,3,6,18,13],
    2:[50,2,56,5,1,1,1,1,9,25,15,1],
    3:[10,5,1,3,3],
    4:[16,1,52,11,30,8,1,1],
    5:[1,7,2],
    6:[39,1,10,2,58,26,3,4,1,1,1],
    7:[135,1,4,1,21,3,1,3,2],
    8:[17,1,3,82,23,18,2,1],
    9:[27,1,1,4,2,45,101,1,7],
    10:[66,1,2,1,148,572,15,1,29,1,2,1],
    11:[18,1,1,30,7],
    12:[10,1,1],
    13:[2,1,2],
    14:[5,1],
    15:[8,1,1,1,20,1,3],
    16:[2]
};
const docNamesData = {
    1:['قص سائل','رفع ماء اسود','رفع ساد','سليكون+عدسة','زرع عدسة','غسل حجرة','رفع سليكون','حقن ايليليا','حقن افاستين'],
    2:['قص سائل','ساد خاص','رفع ساد','سليكون+عدسة','زرع عدسة','زرع صمام','هطول اجفان','تصليب قرنية','غسل حجرة','رفع سليكون','ليزر','تسليك'],
    3:['قص سائل','رفع ساد','حول','رفع سليكون','ليزر'],
    4:['رفع ساد','رفع ظفرة','حقن ايليا','لوسنتس','حقن افاستين','ليزر','تسليك','جسم غريب'],
    5:['زرع صمام','رفع ساد','ليزر'],
    6:['رفع ساد','هطول اجفان','حول','رفع ظفرة','حقن ايليا','حقن افاستين','ليزر','كيس دهني','ورم','تخدير','جسم غريب'],
    7:['رفع ساد','هطول اجفان','تصليب قرنية','غسل حجرة','ليزر','كيس دهني','ورم درمويد','تسليك','جسم غريب'],
    8:['رفع ساد','رفع ظفرة','فابزمو','حقن ايليا','لوسنتس','حقن افاستين','كيناكورت','تخدير'],
    9:['رفع ساد','زرع عدسة','هطول اجفان','حول','رفع ظفرة','حقن ايليا','حقن افاستين','كيناكورت','ليزر'],
    10:['رفع ساد','هطول اجفان','تصليب قرنية','رفع ظفرة','حقن ايليا','حقن افاستين','كيناكورت','اكتيليس','ليزر','كيس دهني','تسليك','جسم غريب'],
    11:['رفع ساد','حول','رفع ظفرة','حقن افاستين','ليزر'],
    12:['رفع ساد','ليزر','كيس دهني'],
    13:['رفع ساد','ليزر','كيس دهني'],
    14:['رفع ساد','ليزر'],
    15:['رفع ساد','هطول اجفان','تصليب قرنية','حقن ايليا','حقن افاستين','ليزر','كيس دهني'],
    16:['رفع ساد']
};

function renderSingleDocChart(id) {
    const values = docOpsData[id] || [1];
    const labels = docNamesData[id] || [''];
    draw3DIsometricArrows('svg-doc-' + id, values, labels);
}

// Global page initialization hook
let _chartsInitialized = false;
window.initReportsPage = function() {
    if (!_chartsInitialized) {
        _chartsInitialized = true;
        setTimeout(() => {
            renderAll3DIsometricCharts();
        }, 150);
    }
};
</script>
