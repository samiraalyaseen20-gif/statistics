<!-- PAGE 1: DASHBOARD PAGE SECTION -->
<section id="page-dashboard" class="page-section space-y-6">
    <!-- Alerts row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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

    <!-- Main charts grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Card 1: Overview and Vertical Bars -->
        <section class="custom-card p-6 hover-lift">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-text-main">Overview</h2>
                <button class="w-8 h-8 rounded-full custom-card flex items-center justify-center hover-press text-text-main opacity-70">
                    <i data-lucide="more-horizontal" class="w-4 h-4"></i>
                </button>
            </div>
            <div class="flex justify-between items-end h-44 px-4 mb-6">
                <div class="flex flex-col items-center gap-2 w-8">
                    <div class="w-full custom-inset rounded-full h-36 flex items-end p-[3px]">
                        <div class="w-full bg-gradient-to-t from-pink-500 to-pink-300 rounded-full" style="height: 80%"></div>
                    </div>
                    <span class="text-[10px] text-text-main opacity-60 font-['Outfit']">Class 1</span>
                </div>
                <div class="flex flex-col items-center gap-2 w-8">
                    <div class="w-full custom-inset rounded-full h-36 flex items-end p-[3px]">
                        <div class="w-full bg-gradient-to-t from-amber-500 to-amber-300 rounded-full" style="height: 65%"></div>
                    </div>
                    <span class="text-[10px] text-text-main opacity-60 font-['Outfit']">Class 2</span>
                </div>
                <div class="flex flex-col items-center gap-2 w-8">
                    <div class="w-full custom-inset rounded-full h-36 flex items-end p-[3px]">
                        <div class="w-full bg-gradient-to-t from-emerald-500 to-emerald-300 rounded-full" style="height: 90%"></div>
                    </div>
                    <span class="text-[10px] text-text-main opacity-60 font-['Outfit']">Class 3</span>
                </div>
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
                <div class="flex flex-col items-center p-2 rounded-2xl custom-inset">
                    <div id="chart-radial-1"></div>
                    <span class="text-xs text-text-main opacity-80 font-medium">Data Analysis #1</span>
                </div>
                <div class="flex flex-col items-center p-2 rounded-2xl custom-inset">
                    <div id="chart-radial-2"></div>
                    <span class="text-xs text-text-main opacity-80 font-medium">Data Analysis #2</span>
                </div>
                <div class="flex flex-col items-center p-2 rounded-2xl custom-inset">
                    <div id="chart-radial-3"></div>
                    <span class="text-xs text-text-main opacity-80 font-medium">Data Analysis #3</span>
                </div>
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
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                <div class="flex flex-col items-center custom-inset p-4 rounded-[20px]">
                    <div id="chart-dial-pink"></div>
                    <div class="text-xs font-bold text-text-main mt-2">مستوى الطلبات</div>
                </div>
                <div class="flex flex-col items-center custom-inset p-4 rounded-[20px]">
                    <div id="chart-dial-orange"></div>
                    <div class="text-xs font-bold text-text-main mt-2">معدل التحويل</div>
                </div>
                <div class="flex flex-col items-center custom-inset p-4 rounded-[20px]">
                    <div id="chart-dial-green"></div>
                    <div class="text-xs font-bold text-text-main mt-2">نسبة الاستبقاء</div>
                </div>
            </div>
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

        <!-- Card 10: Bubble Chart - Patient Demographics & Spending -->
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

        <!-- Card 11: Dynamic Data Grid (Table) -->
        <section class="custom-card p-6 hover-lift lg:col-span-3">
            <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                <div>
                    <h2 class="text-lg font-bold text-text-main">جدول سجل المعاملات المالية والمرضى (Data Grid)</h2>
                    <span class="text-xs text-text-main opacity-60">تحديث فوري وتصفية ذكية لمعاملات العيادات الخارجية</span>
                </div>
                <button onclick="toggleModal(true)" class="py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-pink-400 hover-press flex items-center gap-2 shadow-soft-out-sm font-['Outfit']" id="add-trans-trigger">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    تسجيل كشفية (فتح Modal)
                </button>
            </div>

            <!-- Filters -->
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6 p-4 rounded-2xl custom-inset">
                <div class="flex items-center gap-2 px-2">
                    <i data-lucide="search" class="w-4 h-4 text-text-main opacity-50 shrink-0"></i>
                    <input type="text" placeholder="اسم المريض..." class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main placeholder-text-main opacity-60" id="search-input">
                </div>
                <div>
                    <select class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main" id="doctor-select">
                        <option>جميع الأطباء...</option>
                        <option>د. أحمد سليمان</option>
                        <option>د. سارة العلي</option>
                        <option>د. سمر الياسين</option>
                    </select>
                </div>
                <div>
                    <select class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main" id="status-select">
                        <option>حالة الدفع...</option>
                        <option>مدفوع</option>
                        <option>غير مدفوع</option>
                    </select>
                </div>
                <div class="flex items-center gap-2 px-2 border-r border-slate-200/20">
                    <i data-lucide="calendar" class="w-4 h-4 text-text-main opacity-50 shrink-0"></i>
                    <input type="date" value="" class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs font-medium text-text-main custom-date-input" id="date-select">
                </div>
            </div>

            <!-- Table -->
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
                        <!-- Dynamic rows -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div id="standard-pagination" class="flex justify-between items-center">
                <span class="text-xs text-text-main opacity-70" id="pag-label"></span>
                <div class="flex gap-2" id="pag-buttons"></div>
            </div>

            <div id="excel-pagination" class="hidden excel-sheet-container -mx-6 -mb-6">
                <div class="flex items-center gap-2 mr-2" id="excel-tabs-list"></div>
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
                <div class="space-y-6">
                    <h3 class="text-sm font-semibold text-text-main opacity-70 border-b border-slate-200/20 pb-2">الأزرار وتأثيرات الضغط</h3>
                    <div class="flex gap-4">
                        <button class="flex-1 py-3 px-4 custom-card rounded-xl text-xs font-bold text-theme-pink hover-press">زر بارز</button>
                        <button class="flex-1 py-3 px-4 custom-inset rounded-xl text-xs font-bold text-theme-emerald hover-press">زر غائر</button>
                    </div>
                    <div class="flex justify-between items-center custom-inset p-3 rounded-xl">
                        <span class="text-xs font-bold text-text-main opacity-80">مفتاح تفعيل ذكي</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="switch-demo" class="sr-only peer" checked>
                            <div class="w-12 h-6 custom-inset rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gradient-to-r after:from-emerald-500 after:to-emerald-400 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:shadow-inner"></div>
                        </label>
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-text-main opacity-70 border-b border-slate-200/20 pb-2">حقول الإدخال والبحث</h3>
                    <div class="relative">
                        <input type="text" placeholder="ابحث عن مريض..." class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-3 px-4 text-xs font-medium text-text-main placeholder-text-main opacity-40">
                        <div class="absolute left-3 top-3.5 text-text-main opacity-50"><i data-lucide="search" class="w-4 h-4"></i></div>
                    </div>
                    <div class="relative">
                        <select class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-3 px-4 text-xs font-medium text-text-main">
                            <option>اختر الطبيب المعالج...</option>
                            <option>د. أحمد سليمان - العيادة الباطنية</option>
                            <option>د. سارة العلي - عيادة الأطفال</option>
                        </select>
                    </div>
                </div>
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
    </div>
</section>
