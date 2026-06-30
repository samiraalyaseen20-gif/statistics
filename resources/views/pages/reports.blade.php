<!-- PAGE 2: REPORTS PAGE SECTION (PowerPoint Slide Presentation Style) -->
<section id="page-reports" class="page-section hidden h-full flex flex-col overflow-hidden">

    <!-- Top Slide Control Bar -->
    <div class="custom-card p-3 rounded-xl shrink-0 flex flex-wrap items-center justify-between gap-3 mb-4">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-pink-500/10 flex items-center justify-center text-pink-500">
                <i data-lucide="presentation" class="w-4 h-4"></i>
            </div>
            <div>
                <h2 class="text-xs font-bold text-text-main">تقرير إحصاءات العيادات والعمليات</h2>
                <p class="text-[9px] text-text-main opacity-50">أيار 2026 – عرض الشرائح التفاعلي</p>
            </div>
        </div>
        
        <!-- Controls and navigation -->
        <div class="flex items-center gap-2">
            <button onclick="prevSlide()" class="w-8 h-8 rounded-lg bg-slate-200/10 text-text-main hover:bg-slate-200/20 flex items-center justify-center hover-press" title="الشريحة السابقة">
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </button>
            <div class="px-3 text-[10px] font-bold text-text-main">
                <span id="active-slide-num">1</span> / 8
            </div>
            <button onclick="nextSlide()" class="w-8 h-8 rounded-lg bg-slate-200/10 text-text-main hover:bg-slate-200/20 flex items-center justify-center hover-press" title="الشريحة التالية">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
            </button>
            <div class="h-6 w-px bg-slate-200/20 mx-1"></div>
            <select id="slide-selector" onchange="jumpToSlide(this.value)" class="custom-inset border-none focus:outline-none rounded-lg py-1 px-2.5 text-[10px] font-bold text-text-main">
                <option value="1">1. غلاف التقرير الإحصائي</option>
                <option value="2">2. أعداد المراجعين في الاستشاريات</option>
                <option value="3">3. مراجعو الأطباء الاختصاص</option>
                <option value="4">4. التوزيع الديمغرافي للمراجعين</option>
                <option value="5">5. الفحوصات البصرية والتحاليل</option>
                <option value="6">6. تصنيف العمليات الجراحية</option>
                <option value="7">7. العمليات الجراحية لكل طبيب</option>
                <option value="8">8. الإحصائية التفصيلية والختام</option>
            </select>
            <div class="h-6 w-px bg-slate-200/20 mx-1"></div>
            <button onclick="window.print()" class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-600 hover:bg-emerald-500/20 flex items-center justify-center hover-press" title="طباعة العرض">
                <i data-lucide="printer" class="w-4 h-4"></i>
            </button>
        </div>
    </div>

    <!-- MAIN SLIDE CONTAINER (Aspect Ratio like PPT) -->
    <div class="flex-1 min-h-0 flex items-center justify-center p-1">
        <div class="w-full h-full max-w-5xl aspect-[16/9] min-h-[480px] bg-gradient-to-br from-[#fefcf7] via-[#f7f2e9] to-[#ebdcd0] rounded-3xl shadow-2xl border border-slate-200/40 relative overflow-hidden flex flex-col p-8 select-none" id="ppt-slide-card">
            
            <!-- Slide Background Decorative Vectors -->
            <div class="absolute -top-20 -left-20 w-80 h-80 rounded-full bg-orange-200/10 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full bg-pink-200/10 blur-3xl pointer-events-none"></div>

            <!-- Slide Footer (Subtle Branding) -->
            <div class="absolute bottom-4 left-6 right-6 flex justify-between items-center text-[8px] font-bold text-slate-400 shrink-0 border-t border-slate-200/10 pt-2">
                <span>مركز السيدة زينب الكبرى (ع) لعيون وجراحة العيون</span>
                <span class="slide-indicator-dot font-['Outfit']">CMS - MAY 2026</span>
                <span class="font-['Outfit']" id="slide-footer-num">SLIDE 01</span>
            </div>

            <!-- ========================================== -->
            <!-- SLIDE 1: COVER SLIDE                       -->
            <!-- ========================================== -->
            <div class="slide-page flex-1 flex flex-col justify-center items-center text-center p-6" id="slide-1">
                <div class="w-16 h-16 bg-gradient-to-tr from-pink-500 to-orange-400 rounded-2xl flex items-center justify-center text-white shadow-lg mb-6 transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <i data-lucide="activity" class="w-8 h-8"></i>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-800 leading-tight mb-2 tracking-wide font-['Tajawal']">التقرير الإحصائي الشهري</h1>
                <p class="text-sm font-bold text-slate-500 max-w-xl leading-relaxed mb-8">إحصائيات العيادات الاستشارية، الفحوصات الطبية، والعمليات الجراحية المنجزة لجميع أطباء الاختصاص لشهر أيار 2026</p>
                
                <div class="flex items-center gap-3 text-[10px] font-bold text-slate-500 bg-white/40 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/60">
                    <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3.5 h-3.5"></i> أيار 2026</span>
                    <span class="opacity-30">|</span>
                    <span class="flex items-center gap-1"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-500"></i> بيانات معتمدة</span>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- SLIDE 2: CONSULTATIONS (TABLE 1)           -->
            <!-- ========================================== -->
            <div class="slide-page flex-1 flex flex-col justify-between hidden" id="slide-2">
                <div class="flex justify-between items-start shrink-0 mb-4">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800 flex items-center gap-2">
                            <i data-lucide="stethoscope" class="w-4 h-4 text-pink-500"></i>
                            أعداد المراجعين في الاستشاريات
                        </h3>
                        <p class="text-[10px] text-slate-400 font-medium">جدول (1): مقارنة مراجعي العيون العامة والتخصصات الدقيقة</p>
                    </div>
                </div>

                <div class="flex-1 flex flex-col md:flex-row gap-8 items-center justify-center min-h-0">
                    <!-- Left: 3D Isometric Arrows SVG Infographic -->
                    <div class="w-full md:w-1/2 flex justify-center">
                        <svg viewBox="0 0 350 280" class="w-full max-w-[320px] h-auto drop-shadow-md">
                            <defs>
                                <linearGradient id="g1-teal" x1="0%" y1="100%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#0284c7" />
                                    <stop offset="100%" stop-color="#38bdf8" />
                                </linearGradient>
                                <linearGradient id="g1-pink" x1="0%" y1="100%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#db2777" />
                                    <stop offset="100%" stop-color="#f472b6" />
                                </linearGradient>
                            </defs>
                            
                            <!-- Arrow 1 (General: 3375 - 76%) -->
                            <g class="hover:opacity-90 cursor-pointer transition-opacity duration-300">
                                <path d="M 90 240 L 150 200 L 150 80 L 170 85 L 140 40 L 110 85 L 130 80 L 130 185 L 90 210 Z" fill="url(#g1-teal)" />
                                <path d="M 130 80 L 150 80 L 150 200 L 130 185 Z" fill="#0369a1" opacity="0.3" />
                                <text x="140" y="140" font-family="Outfit" font-size="16px" font-weight="900" fill="#ffffff" text-anchor="middle" transform="rotate(-30 140 140)">76%</text>
                            </g>
                            
                            <!-- Arrow 2 (Special: 1091 - 24%) -->
                            <g class="hover:opacity-90 cursor-pointer transition-opacity duration-300">
                                <path d="M 190 240 L 250 200 L 250 140 L 270 145 L 240 100 L 210 145 L 230 140 L 230 185 L 190 210 Z" fill="url(#g1-pink)" />
                                <path d="M 230 140 L 250 140 L 250 200 L 230 185 Z" fill="#be185d" opacity="0.3" />
                                <text x="240" y="170" font-family="Outfit" font-size="14px" font-weight="900" fill="#ffffff" text-anchor="middle" transform="rotate(-30 240 170)">24%</text>
                            </g>
                            
                            <!-- Base Platform -->
                            <polygon points="50,240 150,270 310,180 210,150" fill="#e2e8f0" opacity="0.4" />
                            <polygon points="50,240 150,270 150,275 50,245" fill="#cbd5e1" opacity="0.6" />
                        </svg>
                    </div>

                    <!-- Right: Info cards & Table data -->
                    <div class="w-full md:w-1/2 flex flex-col gap-4">
                        <div class="bg-white/50 backdrop-blur-sm p-4 rounded-2xl border border-white/60">
                            <div class="flex items-center justify-between mb-3 border-b border-slate-200/10 pb-2">
                                <span class="text-xs font-bold text-slate-800">استشارية العيون العامة</span>
                                <span class="text-xs font-bold text-sky-600">3,375 مراجع</span>
                            </div>
                            <div class="w-full bg-slate-200/40 h-2.5 rounded-full overflow-hidden">
                                <div class="bg-sky-500 h-full rounded-full" style="width: 76%"></div>
                            </div>
                        </div>

                        <div class="bg-white/50 backdrop-blur-sm p-4 rounded-2xl border border-white/60">
                            <div class="flex items-center justify-between mb-3 border-b border-slate-200/10 pb-2">
                                <span class="text-xs font-bold text-slate-800">استشارية التخصصات الدقيقة</span>
                                <span class="text-xs font-bold text-pink-600">1,091 مراجع</span>
                            </div>
                            <div class="w-full bg-slate-200/40 h-2.5 rounded-full overflow-hidden">
                                <div class="bg-pink-500 h-full rounded-full" style="width: 24%"></div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 bg-gradient-to-r from-pink-500 to-orange-400 p-4 rounded-2xl text-white shadow-md">
                            <i data-lucide="users" class="w-5 h-5 shrink-0"></i>
                            <div>
                                <p class="text-[9px] font-bold uppercase opacity-85">المجموع الكلي للمراجعين</p>
                                <h4 class="text-lg font-black font-['Outfit']">4,566 مراجع</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- SLIDE 3: DOCTORS VISITS (TABLE 2)          -->
            <!-- ========================================== -->
            <div class="slide-page flex-1 flex flex-col justify-between hidden" id="slide-3">
                <div class="flex justify-between items-start shrink-0 mb-4">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800 flex items-center gap-2">
                            <i data-lucide="users" class="w-4 h-4 text-emerald-500"></i>
                            أعداد مراجعي الاستشارية لكل طبيب اختصاص
                        </h3>
                        <p class="text-[10px] text-slate-400 font-medium">جدول (2): تفصيل زيارات المرضى للعيادات التخصصية الـ 15</p>
                    </div>
                </div>

                <div class="flex-1 flex flex-col min-h-0">
                    <div id="ppt-chart-report-2" class="w-full h-44 mb-3"></div>
                    <div class="overflow-x-auto max-h-[140px] border border-slate-200/20 rounded-xl bg-white/40 backdrop-blur-sm">
                        <table class="w-full text-right text-[10px]">
                            <thead class="bg-slate-200/40 sticky top-0">
                                <tr>
                                    <th class="p-2 font-bold text-slate-700">د. بشرى علي</th>
                                    <th class="p-2 font-bold text-slate-700">د. حيدر حسين</th>
                                    <th class="p-2 font-bold text-slate-700">د. حمزة الشريفي</th>
                                    <th class="p-2 font-bold text-slate-700">د. حذيفه جواد</th>
                                    <th class="p-2 font-bold text-slate-700">د. مؤيد صبار</th>
                                    <th class="p-2 font-bold text-slate-700">د. منتصر عرب</th>
                                    <th class="p-2 font-bold text-slate-700">د. نور رعد</th>
                                    <th class="p-2 font-bold text-slate-700">د. غياث الدين</th>
                                    <th class="p-2 font-bold text-slate-700">البقية</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t border-slate-200/10">
                                    <td class="p-2 font-extrabold text-slate-800">1204</td>
                                    <td class="p-2 font-extrabold text-slate-800">729</td>
                                    <td class="p-2 font-extrabold text-slate-800">562</td>
                                    <td class="p-2 font-extrabold text-slate-800">348</td>
                                    <td class="p-2 font-extrabold text-slate-800">346</td>
                                    <td class="p-2 font-extrabold text-slate-800">212</td>
                                    <td class="p-2 font-extrabold text-slate-800">194</td>
                                    <td class="p-2 font-extrabold text-slate-800">177</td>
                                    <td class="p-2 font-extrabold text-slate-800">794</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- SLIDE 4: DEMOGRAPHICS (TABLE 3 & 4)        -->
            <!-- ========================================== -->
            <div class="slide-page flex-1 flex flex-col justify-between hidden" id="slide-4">
                <div class="flex justify-between items-start shrink-0 mb-4">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800 flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-sky-500"></i>
                            التوزيع الديمغرافي لمراجعي الاستشاريات
                        </h3>
                        <p class="text-[10px] text-slate-400 font-medium">جدول (3) و (4): ديمغرافية المرضى من داخل وخارج العراق</p>
                    </div>
                </div>

                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6 min-h-0 items-center">
                    <!-- Inside Iraq (Top Governorates) -->
                    <div class="bg-white/40 backdrop-blur-sm p-4 rounded-2xl border border-white/60 flex flex-col justify-between h-full max-h-[260px]">
                        <h4 class="text-[11px] font-bold text-slate-700 flex items-center gap-1.5 mb-2">
                            <i data-lucide="flag" class="w-3.5 h-3.5 text-sky-500"></i> داخل العراق – الأعلى مراجعة
                        </h4>
                        <div class="space-y-2">
                            <div>
                                <div class="flex justify-between text-[10px] font-bold text-slate-600 mb-1">
                                    <span>محافظة كربلاء المقدسة</span>
                                    <span>3455 مراجع</span>
                                </div>
                                <div class="w-full bg-slate-200/40 h-2 rounded-full"><div class="bg-sky-500 h-full rounded-full" style="width: 76%"></div></div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-bold text-slate-600 mb-1">
                                    <span>محافظة بابل</span>
                                    <span>521 مراجع</span>
                                </div>
                                <div class="w-full bg-slate-200/40 h-2 rounded-full"><div class="bg-sky-500/80 h-full rounded-full" style="width: 12%"></div></div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-bold text-slate-600 mb-1">
                                    <span>محافظة بغداد</span>
                                    <span>127 مراجع</span>
                                </div>
                                <div class="w-full bg-slate-200/40 h-2 rounded-full"><div class="bg-sky-500/60 h-full rounded-full" style="width: 3%"></div></div>
                            </div>
                        </div>
                    </div>

                    <!-- Outside Iraq -->
                    <div class="bg-white/40 backdrop-blur-sm p-4 rounded-2xl border border-white/60 flex flex-col justify-between h-full max-h-[260px]">
                        <h4 class="text-[11px] font-bold text-slate-700 flex items-center gap-1.5 mb-2">
                            <i data-lucide="globe" class="w-3.5 h-3.5 text-pink-500"></i> مراجعو خارج العراق
                        </h4>
                        <div class="flex-1 flex gap-4 items-center min-h-0">
                            <div id="ppt-chart-report-4" class="w-1/2" style="height:140px"></div>
                            <div class="w-1/2 text-[9px] space-y-1.5">
                                <div class="flex justify-between font-bold text-slate-600"><span>إيران</span><span>6 مراجعين</span></div>
                                <div class="flex justify-between font-bold text-slate-600"><span>أفغانستان</span><span>4 مراجعين</span></div>
                                <div class="flex justify-between font-bold text-slate-600"><span>سوريا</span><span>مراجَعين</span></div>
                                <div class="flex justify-between font-bold text-slate-600"><span>باقي الجنسيات</span><span>3 مراجعين</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- SLIDE 5: VISUAL TESTS & LAB (TABLE 5 & 6)  -->
            <!-- ========================================== -->
            <div class="slide-page flex-1 flex flex-col justify-between hidden" id="slide-5">
                <div class="flex justify-between items-start shrink-0 mb-4">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800 flex items-center gap-2">
                            <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                            الفحوصات البصرية والتحاليل المختبرية المنجزة
                        </h3>
                        <p class="text-[10px] text-slate-400 font-medium">جدول (5) و (6): أعداد الفحوصات ونشاط المختبر الكلي</p>
                    </div>
                </div>

                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6 min-h-0 items-center">
                    <!-- Visual Tests -->
                    <div class="bg-white/40 backdrop-blur-sm p-4 rounded-2xl border border-white/60 h-full max-h-[260px] flex flex-col">
                        <h4 class="text-[11px] font-bold text-slate-700 flex items-center gap-1.5 mb-2">
                            <i data-lucide="eye" class="w-3.5 h-3.5 text-orange-500"></i> الفحوصات البصرية الأعلى طلباً
                        </h4>
                        <div class="flex-1 overflow-y-auto pr-1 text-[10px] space-y-2">
                            <div class="flex justify-between font-bold text-slate-600">
                                <span>فحص البصر</span><span>4,730 فحص</span>
                            </div>
                            <div class="flex justify-between font-bold text-slate-600">
                                <span>فحص الشبكية OCT</span><span>1,444 فحص</span>
                            </div>
                            <div class="flex justify-between font-bold text-slate-600">
                                <span>فحص قوة العدسة</span><span>641 فحص</span>
                            </div>
                            <div class="flex justify-between font-bold text-slate-600 font-extrabold text-orange-600 border-t border-slate-200/25 pt-1.5 mt-1.5">
                                <span>المجموع الإجمالي</span><span>7,240 فحص</span>
                            </div>
                        </div>
                    </div>

                    <!-- Lab stats -->
                    <div class="bg-white/40 backdrop-blur-sm p-4 rounded-2xl border border-white/60 h-full max-h-[260px] flex flex-col justify-between">
                        <h4 class="text-[11px] font-bold text-slate-700 flex items-center gap-1.5 mb-2">
                            <i data-lucide="test-tube" class="w-3.5 h-3.5 text-purple-500"></i> نشاط المختبر
                        </h4>
                        <div class="flex-1 flex flex-col items-center justify-center gap-2">
                            <div id="ppt-chart-report-6" class="w-full max-w-[140px]" style="height:120px"></div>
                            <div class="text-center">
                                <p class="text-[9px] font-bold text-slate-500 uppercase">مراجعو المختبر</p>
                                <h3 class="text-base font-black text-purple-600 font-['Outfit']">4,566 مراجع</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- SLIDE 6: SURGERY CLASSIFICATION (TABLE 7)  -->
            <!-- ========================================== -->
            <div class="slide-page flex-1 flex flex-col justify-between hidden" id="slide-6">
                <div class="flex justify-between items-start shrink-0 mb-2">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800 flex items-center gap-2">
                            <i data-lucide="scissors" class="w-4 h-4 text-rose-500"></i>
                            تصنيف العمليات الجراحية المنجزة للعيون
                        </h3>
                        <p class="text-[10px] text-slate-400 font-medium">جدول (7): إحصائية وتصنيفات العمليات الـ 2002 حسب القطاعات</p>
                    </div>
                    <div class="bg-rose-500/10 text-rose-600 px-3 py-1.5 rounded-xl text-xs font-bold font-['Outfit'] shadow-sm">
                        الإجمالي: 2,002 عملية
                    </div>
                </div>

                <!-- Fully Refactored 3D Isometric PowerPoint Infographic with floating circular badges and dashed lines -->
                <div class="flex-1 flex flex-col md:flex-row gap-6 items-center justify-center min-h-0">
                    
                    <!-- Left: Clean 3D Vector Infographic SVG -->
                    <div class="w-full md:w-3/5 flex justify-center">
                        <svg viewBox="0 0 520 280" class="w-full max-w-[480px] h-auto overflow-visible" style="filter: drop-shadow(0 15px 25px rgba(0,0,0,0.08))">
                            <defs>
                                <!-- Gradients Front Face -->
                                <linearGradient id="ar-f-cyan" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#0ea5e9" /><stop offset="100%" stop-color="#38bdf8" /></linearGradient>
                                <linearGradient id="ar-f-pink" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#db2777" /><stop offset="100%" stop-color="#f472b6" /></linearGradient>
                                <linearGradient id="ar-f-amber" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#d97706" /><stop offset="100%" stop-color="#fbbf24" /></linearGradient>
                                <linearGradient id="ar-f-slate" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#475569" /><stop offset="100%" stop-color="#94a3b8" /></linearGradient>
                                <linearGradient id="ar-f-violet" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#6d28d9" /><stop offset="100%" stop-color="#c084fc" /></linearGradient>
                                <linearGradient id="ar-f-rose" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#e11d48" /><stop offset="100%" stop-color="#fda4af" /></linearGradient>

                                <!-- Gradients Shadow Face -->
                                <linearGradient id="ar-s-cyan" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#0369a1" /><stop offset="100%" stop-color="#0284c7" /></linearGradient>
                                <linearGradient id="ar-s-pink" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#9d174d" /><stop offset="100%" stop-color="#c2185b" /></linearGradient>
                                <linearGradient id="ar-s-amber" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#92400e" /><stop offset="100%" stop-color="#b45309" /></linearGradient>
                                <linearGradient id="ar-s-slate" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#1e293b" /><stop offset="100%" stop-color="#334155" /></linearGradient>
                                <linearGradient id="ar-s-violet" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#4c1d95" /><stop offset="100%" stop-color="#5b21b6" /></linearGradient>
                                <linearGradient id="ar-s-rose" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#9f1239" /><stop offset="100%" stop-color="#be123c" /></linearGradient>
                            </defs>

                            <!-- Isometric grid base plane shadows -->
                            <polygon points="30,240 480,240 440,225 70,225" fill="#cbd5e1" opacity="0.25" />

                            <!-- ARROWS LOGIC (Left face, Right face, Creased pointer top) -->
                            
                            <!-- 1. صغرى (Height: 60) -->
                            <g class="group cursor-pointer">
                                <!-- Dashed line -->
                                <line x1="60" y1="140" x2="60" y2="95" stroke="#0ea5e9" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                                <!-- Circle badge -->
                                <circle cx="60" cy="80" r="14" fill="#0ea5e9" />
                                <text x="60" y="83" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">1%</text>
                                
                                <!-- 3D Arrow Block -->
                                <polygon points="40,240 60,250 60,190 40,180" fill="url(#ar-f-cyan)" />
                                <polygon points="60,250 80,240 80,180 60,190" fill="url(#ar-s-cyan)" />
                                <!-- Pointer top -->
                                <polygon points="40,180 60,190 60,160" fill="#38bdf8" />
                                <polygon points="60,190 80,180 60,160" fill="#0284c7" />
                                <text x="60" y="265" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">صغرى</text>
                            </g>

                            <!-- 2. ليزر (Height: 90) -->
                            <g class="group cursor-pointer">
                                <!-- Dashed line -->
                                <line x1="130" y1="110" x2="130" y2="75" stroke="#db2777" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                                <!-- Circle badge -->
                                <circle cx="130" cy="60" r="14" fill="#db2777" />
                                <text x="130" y="63" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">5%</text>
                                
                                <polygon points="110,240 130,250 130,160 110,150" fill="url(#ar-f-pink)" />
                                <polygon points="130,250 150,240 150,150 130,160" fill="url(#ar-s-pink)" />
                                <polygon points="110,150 130,160 130,130" fill="#f472b6" />
                                <polygon points="130,160 150,150 130,130" fill="#c2185b" />
                                <text x="130" y="265" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">ليزر</text>
                            </g>

                            <!-- 3. كبرى (Height: 80) -->
                            <g class="group cursor-pointer">
                                <!-- Dashed line -->
                                <line x1="200" y1="120" x2="200" y2="85" stroke="#d97706" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                                <!-- Circle badge -->
                                <circle cx="200" cy="70" r="14" fill="#d97706" />
                                <text x="200" y="73" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">4%</text>
                                
                                <polygon points="180,240 200,250 200,170 180,160" fill="url(#ar-f-amber)" />
                                <polygon points="200,250 220,240 220,160 200,170" fill="url(#ar-s-amber)" />
                                <polygon points="180,160 200,170 200,140" fill="#fbbf24" />
                                <polygon points="200,170 220,160 200,140" fill="#b45309" />
                                <text x="200" y="265" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">كبرى</text>
                            </g>

                            <!-- 4. خاصة (Height: 85) -->
                            <g class="group cursor-pointer">
                                <!-- Dashed line -->
                                <line x1="270" y1="115" x2="270" y2="80" stroke="#475569" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                                <!-- Circle badge -->
                                <circle cx="270" cy="65" r="14" fill="#475569" />
                                <text x="270" y="68" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">4%</text>
                                
                                <polygon points="250,240 270,250 270,165 250,155" fill="url(#ar-f-slate)" />
                                <polygon points="270,250 290,240 290,155 270,165" fill="url(#ar-s-slate)" />
                                <polygon points="250,155 270,165 270,135" fill="#94a3b8" />
                                <polygon points="270,165 290,155 270,135" fill="#334155" />
                                <text x="270" y="265" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">خاصة</text>
                            </g>

                            <!-- 5. فوق كبرى (Height: 150) -->
                            <g class="group cursor-pointer">
                                <!-- Dashed line -->
                                <line x1="340" y1="50" x2="340" y2="35" stroke="#6d28d9" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                                <!-- Circle badge -->
                                <circle cx="340" cy="20" r="14" fill="#6d28d9" />
                                <text x="340" y="23" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">22%</text>
                                
                                <polygon points="320,240 340,250 340,100 320,90" fill="url(#ar-f-violet)" />
                                <polygon points="340,250 360,240 360,90 340,100" fill="url(#ar-s-violet)" />
                                <polygon points="320,90 340,100 340,70" fill="#c084fc" />
                                <polygon points="340,100 360,90 340,70" fill="#5b21b6" />
                                <text x="340" y="265" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">فوق الكبرى</text>
                            </g>

                            <!-- 6. حقن العين (Height: 210) -->
                            <g class="group cursor-pointer">
                                <!-- Dashed line -->
                                <line x1="410" y1="10" x2="410" y2="0" stroke="#e11d48" stroke-width="1.5" stroke-dasharray="3 3" opacity="0.6" />
                                <!-- Circle badge placed carefully to avoid clipping -->
                                <circle cx="410" cy="-14" r="14" fill="#e11d48" />
                                <text x="410" y="-11" font-family="Outfit" font-size="9px" font-weight="900" fill="#ffffff" text-anchor="middle">63%</text>
                                
                                <polygon points="390,240 410,250 410,40 390,30" fill="url(#ar-f-rose)" />
                                <polygon points="410,250 430,240 430,30 410,40" fill="url(#ar-s-rose)" />
                                <polygon points="390,30 410,40 410,10" fill="#fda4af" />
                                <polygon points="410,40 430,30 410,10" fill="#be123c" />
                                <text x="410" y="265" font-family="Tajawal" font-size="8px" font-weight="bold" fill="#64748b" text-anchor="middle">حقن العين</text>
                            </g>
                        </svg>
                    </div>

                    <!-- Right: Info Details Legend List -->
                    <div class="w-full md:w-2/5 flex flex-col gap-2">
                        <div class="flex items-center gap-3 bg-white/50 backdrop-blur-sm p-3 rounded-2xl border border-white/60">
                            <span class="w-7 h-7 rounded-xl bg-rose-500/10 text-rose-600 flex items-center justify-center font-bold text-xs"><i data-lucide="syringe" class="w-4 h-4"></i></span>
                            <div class="flex-1 flex justify-between text-[10px] font-bold text-slate-700">
                                <span>وسطى (حقن العين)</span>
                                <span class="text-rose-600 font-extrabold font-['Outfit']">1,257 عملية (62.8%)</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 bg-white/50 backdrop-blur-sm p-3 rounded-2xl border border-white/60">
                            <span class="w-7 h-7 rounded-xl bg-violet-500/10 text-violet-600 flex items-center justify-center font-bold text-xs"><i data-lucide="shield" class="w-4 h-4"></i></span>
                            <div class="flex-1 flex justify-between text-[10px] font-bold text-slate-700">
                                <span>فوق الكبرى</span>
                                <span class="text-violet-600 font-extrabold font-['Outfit']">434 عملية (21.7%)</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 bg-white/50 backdrop-blur-sm p-3 rounded-2xl border border-white/60">
                            <span class="w-7 h-7 rounded-xl bg-pink-500/10 text-pink-600 flex items-center justify-center font-bold text-xs"><i data-lucide="zap" class="w-4 h-4"></i></span>
                            <div class="flex-1 flex justify-between text-[10px] font-bold text-slate-700">
                                <span>وسطى (الليزر)</span>
                                <span class="text-pink-600 font-extrabold font-['Outfit']">103 عملية (5.1%)</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 bg-white/50 backdrop-blur-sm p-3 rounded-2xl border border-white/60">
                            <span class="w-7 h-7 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold text-xs"><i data-lucide="heart" class="w-4 h-4"></i></span>
                            <div class="flex-1 flex justify-between text-[10px] font-bold text-slate-700">
                                <span>العمليات الأخرى</span>
                                <span class="text-amber-600 font-extrabold font-['Outfit']">208 عملية (10.4%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- SLIDE 7: DOCTORS SURGERIES (TABLE 10)      -->
            <!-- ========================================== -->
            <div class="slide-page flex-1 flex flex-col justify-between hidden" id="slide-7">
                <div class="flex justify-between items-start shrink-0 mb-4">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800 flex items-center gap-2">
                            <i data-lucide="award" class="w-4 h-4 text-violet-500"></i>
                            العمليات الجراحية المنجزة لكل طبيب اختصاص
                        </h3>
                        <p class="text-[10px] text-slate-400 font-medium">جدول (10): تفصيل العمليات لـ 16 طبيب في جميع قطاعات المركز</p>
                    </div>
                </div>

                <div class="flex-1 flex flex-col min-h-0">
                    <!-- Taller Chart showing all doctors surgeries -->
                    <div id="ppt-chart-report-10" class="w-full h-48 mb-2"></div>
                    
                    <div class="flex gap-4 items-center justify-between text-[9px] font-bold text-slate-500 bg-white/40 p-2 rounded-xl border border-slate-200/20">
                        <span>المرتبة الأولى: د. حيدر حسين الموسوي (839 عملية)</span>
                        <span>المرتبة الثانية: د. حمزة صادق الشريفي (165 عملية)</span>
                        <span>المرتبة الثالثة: د. بشرى سليمان الصقر (162 عملية)</span>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- SLIDE 8: DETAILED DOC & SIGNATURES         -->
            <!-- ========================================== -->
            <div class="slide-page flex-1 flex flex-col justify-between hidden" id="slide-8">
                <div class="flex justify-between items-start shrink-0 mb-3">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800 flex items-center gap-2">
                            <i data-lucide="user-check" class="w-4 h-4 text-emerald-500"></i>
                            الإحصائية التفصيلية لكل طبيب معتمد
                        </h3>
                        <p class="text-[10px] text-slate-400 font-medium">الملف الثاني: تفصيل العمليات الدقيقة ونسب النجاح</p>
                    </div>
                </div>

                <!-- Live Switcher & Signature layout combined for PowerPoint style -->
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6 min-h-0 items-center">
                    
                    <!-- Mini interactive dropdown for doctors details in Slide -->
                    <div class="bg-white/40 backdrop-blur-sm p-4 rounded-2xl border border-white/60 flex flex-col h-full max-h-[260px] justify-between">
                        <div class="flex items-center justify-between mb-3 border-b border-slate-200/10 pb-2">
                            <span class="text-[10px] font-bold text-slate-700">تصفح إحصائية الطبيب:</span>
                            @php
                            $dnames=[1=>'غياث الدين',2=>'حمزة صادق',3=>'ذوالفقار',4=>'منتصر عرب',5=>'افراح',6=>'مؤيد',7=>'بشرى',8=>'علاء',9=>'نور رعد',10=>'حيدر',11=>'حذيفه',12=>'اريج',13=>'زهراء',14=>'خلدون',15=>'ايات',16=>'محمد بدر'];
                            @endphp
                            <select id="doc-ppt-switcher" onchange="switchPptDoc(this.value)" class="custom-inset border-none focus:outline-none rounded-lg py-1 px-2 text-[10px] font-bold text-text-main">
                                @foreach($dnames as $did=>$dn)
                                <option value="{{ $did }}">{{ $dn }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Content of active doctor -->
                        <div class="flex-1 flex flex-col justify-center text-center py-4">
                            <h4 class="text-sm font-black text-slate-800 mb-1" id="ppt-doc-name">د. غياث الدين ثجيل نعمة</h4>
                            <p class="text-lg font-black text-violet-600 font-['Outfit']" id="ppt-doc-total">85 عملية</p>
                            <p class="text-[9px] text-slate-400 font-medium mt-1">العمليات الأكثر شيوعاً: قص السائل الزجاجي وحقن العين</p>
                        </div>
                    </div>

                    <!-- Signatures panel -->
                    <div class="bg-white/40 backdrop-blur-sm p-5 rounded-2xl border border-white/60 flex flex-col justify-between h-full max-h-[260px]">
                        <h4 class="text-[10px] font-bold text-slate-500 uppercase mb-4 tracking-wider">مراجعة واعتماد التقرير</h4>
                        
                        <div class="grid grid-cols-2 gap-4 text-right text-[9px] font-bold text-slate-600">
                            <div class="border-l border-slate-200/20 pl-3 space-y-1">
                                <p class="opacity-60 text-[8px]">مسؤول الإحصاء الطبي</p>
                                <p class="text-[10px] font-extrabold text-slate-800">سميره علي ياسين</p>
                                <p class="opacity-45 text-[7px]">قسم البرمجة والإحصاء</p>
                            </div>
                            <div class="pr-3 space-y-1">
                                <p class="opacity-60 text-[8px]">مدير مركز السيدة زينب (ع)</p>
                                <p class="text-[10px] font-extrabold text-slate-800">د. عدي السالمي</p>
                                <p class="opacity-45 text-[7px]">الطبيب الاستشاري</p>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">قسم إحصاء العيادات التخصصية</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</section>

<!-- CSS print helper inside page to format PPT view on printing -->
<style>
@media print {
    #sidebar, header, .custom-card, #slide-selector, .slide-indicators, button { display: none !important; }
    #page-reports { display: block !important; height: auto !important; overflow: visible !important; }
    .slide-page { display: flex !important; page-break-after: always !important; opacity: 1 !important; transform: none !important; height: 100vh !important; }
    #ppt-slide-card { aspect-ratio: 16/9 !important; border: none !important; box-shadow: none !important; background: white !important; width: 100% !important; height: 100vh !important; }
}

/* Infographic custom animation styles */
@keyframes pptRise {
    from {
        transform: scaleY(0);
        transform-origin: bottom;
    }
    to {
        transform: scaleY(1);
        transform-origin: bottom;
    }
}

.ppt-animate-rise polygon {
    animation: pptRise 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>

<script>
let currentSlide = 1;
const totalSlides = 8;

function updateSlideView() {
    // Hide all slide pages
    document.querySelectorAll('.slide-page').forEach(page => {
        page.classList.add('hidden');
    });
    
    // Show active slide
    const activeSlide = document.getElementById('slide-' + currentSlide);
    if (activeSlide) {
        activeSlide.classList.remove('hidden');
        
        // Trigger animations on active slide's SVG elements if relevant
        const svgs = activeSlide.querySelectorAll('svg');
        svgs.forEach(svg => {
            const groups = svg.querySelectorAll('g');
            groups.forEach((g, index) => {
                g.classList.remove('ppt-animate-rise');
                // Force reflow
                void g.offsetWidth;
                // Add class with small staggered delay
                g.style.animationDelay = `${index * 80}ms`;
                g.classList.add('ppt-animate-rise');
            });
        });
    }
    
    // Update labels and selectors
    document.getElementById('active-slide-num').innerText = currentSlide;
    document.getElementById('slide-footer-num').innerText = 'SLIDE ' + String(currentSlide).padStart(2, '0');
    document.getElementById('slide-selector').value = currentSlide;
    
    // Trigger charts rendering when entering their respective slides
    if (currentSlide === 3) {
        renderPptDoctorVisitsChart();
    } else if (currentSlide === 4) {
        renderPptCountryChart();
    } else if (currentSlide === 5) {
        renderPptLabChart();
    } else if (currentSlide === 7) {
        renderPptAllDoctorsSurgeriesChart();
    }
}

function nextSlide() {
    if (currentSlide < totalSlides) {
        currentSlide++;
        updateSlideView();
    }
}

// Global scope bindings for navigation functions
window.nextSlide = nextSlide;
window.prevSlide = function() {
    if (currentSlide > 1) {
        currentSlide--;
        updateSlideView();
    }
};
window.jumpToSlide = function(num) {
    currentSlide = parseInt(num);
    updateSlideView();
};
window.switchPptDoc = function(id) {
    const data = pptDocData[id];
    if (data) {
        document.getElementById('ppt-doc-name').innerText = data.name;
        document.getElementById('ppt-doc-total').innerText = data.total;
    }
};

// Interactive Doctor details on slide 8
const pptDocData = {
    1: { name: 'د. غياث الدين ثجيل نعمة', total: '85 عملية' },
    2: { name: 'د. حمزة صادق علوان الشريفي', total: '165 عملية' },
    3: { name: 'د. ذوالفقار غني عبد الكندي', total: '22 عملية' },
    4: { name: 'د. منتصر محمد عرب', total: '120 عملية' },
    5: { name: 'د. افراح عبد الزهرة القصير', total: '10 عملية' },
    6: { name: 'د. مؤيد عبد اللطيف صبار', total: '146 عملية' },
    7: { name: 'د. بشرى سليمان علي الصقر', total: '162 عملية' },
    8: { name: 'د. علاء صبري الغانمي', total: '147 عملية' },
    9: { name: 'د. نور رعد كريم', total: '189 عملية' },
    10: { name: 'د. حيدر حسين علي الموسوي', total: '839 عملية' },
    11: { name: 'د. حذيفه سامي جواد العبايجي', total: '57 عملية' },
    12: { name: 'د. اريج هادي كريم', total: '12 عملية' },
    13: { name: 'د. زهراء علوان الحمداني', total: '5 عملية' },
    14: { name: 'د. خلدون خليل نايف', total: '6 عملية' },
    15: { name: 'د. ايات معتز محمد', total: '35 عملية' },
    16: { name: 'د. محمد بدر محمد الجريان', total: '2 عملية' }
};

// Keyboard shortcuts for PPT slide navigation
document.addEventListener('keydown', (e) => {
    // Only navigate if reports page is active/visible
    const reportsPage = document.getElementById('page-reports');
    if (reportsPage && !reportsPage.classList.contains('hidden')) {
        if (e.key === 'ArrowLeft') {
            nextSlide(); // Left arrow goes next in RTL
        } else if (e.key === 'ArrowRight') {
            window.prevSlide(); // Right arrow goes previous in RTL
        }
    }
});

// ===== Charts Renderers (PPT Version) =====
let pptChartVisitsDone = false;
let pptChartCountryDone = false;
let pptChartLabDone = false;
let pptChartSurgeriesDone = false;

const pptColors = ['#ff4d7e','#10b981','#3b82f6','#f59e0b','#8b5cf6','#06b6d4','#f97316','#64748b','#ec4899','#84cc16','#0ea5e9','#6366f1','#d946ef','#14b8a6','#f43f5e','#a78bfa'];

function renderPptDoctorVisitsChart() {
    if (pptChartVisitsDone) return;
    const el = document.querySelector('#ppt-chart-report-2');
    if (!el) return;
    pptChartVisitsDone = true;
    
    new ApexCharts(el, {
        chart: { type: 'bar', height: 160, background: 'transparent', toolbar: { show: false } },
        series: [{ name: 'المراجعون', data: [177, 562, 120, 212, 120, 346, 1204, 56, 194, 729, 348, 134, 106, 171, 87] }],
        xaxis: { 
            categories: ['غياث','حمزة','ذوالفقار','منتصر','افراح','مؤيد','بشرى','علاء','نور','حيدر','حذيفه','اريج','زهراء','ايات','م.بدر'],
            labels: { style: { fontSize: '8px', colors: '#64748b', fontWeight: 'bold' } } 
        },
        colors: pptColors,
        plotOptions: { bar: { borderRadius: 4, distributed: true, columnWidth: '60%' } },
        legend: { show: false },
        dataLabels: { enabled: true, style: { fontSize: '8px', fontWeight: 'bold' } },
        yaxis: { show: false }
    }).render();
}

function renderPptCountryChart() {
    if (pptChartCountryDone) return;
    const el = document.querySelector('#ppt-chart-report-4');
    if (!el) return;
    pptChartCountryDone = true;

    new ApexCharts(el, {
        chart: { type: 'donut', height: 130, background: 'transparent', toolbar: { show: false } },
        series: [6, 4, 2, 1, 1, 1],
        labels: ['إيران', 'أفغانستان', 'سوريا', 'مصر', 'نيجيريا', 'باكستان'],
        colors: ['#ff4d7e', '#f59e0b', '#10b981', '#3b82f6', '#8b5cf6', '#06b6d4'],
        legend: { show: false },
        dataLabels: { enabled: false }
    }).render();
}

function renderPptLabChart() {
    if (pptChartLabDone) return;
    const el = document.querySelector('#ppt-chart-report-6');
    if (!el) return;
    pptChartLabDone = true;

    new ApexCharts(el, {
        chart: { type: 'radialBar', height: 120, background: 'transparent', sparkline: { enabled: true } },
        series: [100],
        colors: ['#8b5cf6'],
        plotOptions: {
            radialBar: {
                hollow: { size: '55%' },
                dataLabels: {
                    name: { show: false },
                    value: { fontSize: '20px', fontWeight: '800', color: '#6d28d9', offsetY: 6, formatter: () => '4566' }
                }
            }
        }
    }).render();
}

function renderPptAllDoctorsSurgeriesChart() {
    if (pptChartSurgeriesDone) return;
    const el = document.querySelector('#ppt-chart-report-10');
    if (!el) return;
    pptChartSurgeriesDone = true;

    new ApexCharts(el, {
        chart: { type: 'bar', height: 180, background: 'transparent', toolbar: { show: false } },
        series: [{ name: 'إجمالي العمليات', data: [85, 165, 22, 120, 10, 146, 162, 147, 189, 839, 57, 12, 5, 6, 35, 2] }],
        xaxis: { 
            categories: ['غياث','حمزة','ذوالفقار','منتصر','افراح','مؤيد','بشرى','علاء','نور','حيدر','حذيفه','اريج','زهراء','خلدون','ايات','م.بدر'],
            labels: { style: { fontSize: '8px', colors: '#64748b', fontWeight: 'bold' } } 
        },
        colors: pptColors,
        plotOptions: { bar: { borderRadius: 4, distributed: true, columnWidth: '60%' } },
        legend: { show: false },
        dataLabels: { enabled: true, style: { fontSize: '8px', fontWeight: '800' } },
        yaxis: { show: false }
    }).render();
}

// Global page initialization hook
window.initReportsPage = function() {
    currentSlide = 1;
    updateSlideView();
};
</script>
