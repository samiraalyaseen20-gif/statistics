<!-- PAGE 2: REPORTS PAGE SECTION (Unified Scrollable Dashboard with Flat Arrow Infographics) -->
<section id="page-reports" class="page-section space-y-6 hidden">

    <!-- Filter & Action Bar -->
    <div class="custom-card p-4 rounded-2xl space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-pink-500/10 flex items-center justify-center text-pink-500">
                    <i data-lucide="file-bar-chart-2" class="w-4 h-4"></i>
                </div>
                <h2 class="text-xs font-bold text-text-main">الإحصاءات والتقارير الطبية</h2>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <!-- Date range pickers -->
                <div class="flex items-center gap-1.5 bg-slate-200/20 px-3 py-1.5 rounded-xl border border-slate-200/10">
                    <span class="text-[9px] font-bold text-slate-400">من:</span>
                    <input type="date" id="report-date-from" value="{{ $start_date ?? '2026-05-01' }}" class="bg-transparent border-none focus:outline-none text-[10px] font-bold text-text-main custom-date-input">
                    <span class="text-[9px] font-bold text-slate-400">إلى:</span>
                    <input type="date" id="report-date-to" value="{{ $end_date ?? '2026-05-31' }}" class="bg-transparent border-none focus:outline-none text-[10px] font-bold text-text-main custom-date-input">
                </div>
                <!-- Advanced Toggle button -->
                <button onclick="toggleAdvancedFilters()" class="py-2 px-4 rounded-xl text-xs font-bold text-text-main bg-slate-200/20 hover:bg-slate-200/40 border border-slate-200/10 hover-press flex items-center gap-1.5">
                    <i data-lucide="sliders-horizontal" class="w-3.5 h-3.5 text-pink-500"></i>
                    <span>تصفية متقدمة</span>
                    <i data-lucide="chevron-down" id="adv-filters-chevron" class="w-3 h-3 transition-transform"></i>
                </button>
                <button onclick="applyDateRangeFilter()" class="py-2 px-5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-pink-400 hover-press flex items-center gap-2">
                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i><span>تطبيق التصفية</span>
                </button>
                <button onclick="window.print()" class="py-2 px-4 rounded-xl text-xs font-bold bg-slate-200/20 text-slate-400 hover:bg-slate-200/40 hover-press">
                    <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                </button>
            </div>
        </div>

        <!-- Collapsible Advanced Filters Drawer -->
        <div id="advanced-filters-panel" class="hidden border-t border-slate-200/10 pt-4 transition-all duration-300">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3">
                <!-- 1. Doctor Select -->
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400 font-['Tajawal']">الطبيب الاختصاص:</label>
                    <select id="filter-doctor-id" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل الأطباء</option>
                        @foreach($filterDoctors as $doc)
                        <option value="{{ $doc->id }}" {{ isset($doctor_id) && $doctor_id == $doc->id ? 'selected' : '' }}>{{ $doc->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- 2. Clinic Unit Select -->
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400 font-['Tajawal']">العيادة الاستشارية:</label>
                    <select id="filter-clinic-unit-id" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل العيادات</option>
                        @foreach($filterClinicUnits as $unit)
                        <option value="{{ $unit->id }}" {{ isset($clinic_unit_id) && $clinic_unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- 3. Governorate Select -->
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400 font-['Tajawal']">المحافظة:</label>
                    <select id="filter-governorate-id" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل المحافظات</option>
                        @foreach($filterGovernorates as $gov)
                        <option value="{{ $gov->id }}" {{ isset($governorate_id) && $governorate_id == $gov->id ? 'selected' : '' }}>{{ $gov->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- 4. Country Select -->
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400 font-['Tajawal']">الدولة:</label>
                    <select id="filter-country-id" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل الدول</option>
                        @foreach($filterCountries as $c)
                        <option value="{{ $c->id }}" {{ isset($country_id) && $country_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- 5. Sector Select -->
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400 font-['Tajawal']">القطاع:</label>
                    <select id="filter-sector-id" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل القطاعات</option>
                        @foreach($filterSectors as $sec)
                        <option value="{{ $sec->id }}" {{ isset($sector_id) && $sector_id == $sec->id ? 'selected' : '' }}>{{ $sec->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Action buttons -->
            <div class="flex justify-end gap-2 mt-4">
                <button onclick="resetAllFilters()" class="py-1.5 px-4 rounded-xl text-[10px] font-bold bg-slate-200/40 text-slate-500 hover:bg-slate-200/60 hover-press">إعادة تعيين</button>
            </div>
        </div>
    </div>

    <!-- 1. الاستشاريات العامة والتخصصية (جدول 1) -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="stethoscope" class="w-4 h-4 text-pink-500"></i>
            جدول (1): أعداد المراجعين في الاستشاريات
        </h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- Branching/Split Arrow Infographic -->
            <div class="flex justify-center">
                <svg id="svg-report-1" viewBox="0 0 350 200" class="w-full max-w-[320px] h-auto overflow-visible"></svg>
            </div>
            <!-- Data Table -->
            <div>
                <table class="custom-table text-xs">
                    <thead><tr><th class="w-12 text-center">ت</th><th>الوحدة الطبية</th><th class="text-center font-bold">المجموع</th></tr></thead>
                    <tbody>
                        <tr class="table-row"><td class="text-center">1</td><td>استشارية العيون العامة</td><td class="text-center font-bold">3,375</td></tr>
                        <tr class="table-row"><td class="text-center">2</td><td>استشارية التخصصات الدقيقة</td><td class="text-center font-bold">1,091</td></tr>
                        <tr class="table-row font-extrabold text-theme-pink"><td colspan="2" class="text-center">المجموع الكلي</td><td class="text-center text-sm font-extrabold">4,566</td></tr>
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
            <svg id="svg-report-2" viewBox="0 0 900 240" class="w-full min-w-[850px] h-[240px] overflow-visible"></svg>
        </div>
    </div>

    <!-- 3. التوزيع الديمغرافي لمراجعي الاستشاريات (جدول 3 و 4) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Inside Iraq (Vertical Columns) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="flag" class="w-4 h-4 text-sky-500"></i>
                جدول (3): التوزيع الجغرافي داخل العراق
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-3" viewBox="0 0 450 180" class="w-full min-w-[420px] h-[180px] overflow-visible"></svg>
            </div>
        </div>
        <!-- Outside Iraq (Horizontal Chevrons) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="globe" class="w-4 h-4 text-pink-500"></i>
                جدول (4): المراجعون من خارج العراق
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-4" viewBox="0 0 450 180" class="w-full min-w-[400px] h-[180px] overflow-visible"></svg>
            </div>
        </div>
    </div>

    <!-- 4. الفحوصات البصرية والتحاليل المختبرية (جدول 5 و 6) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Visual Tests (Horizontal Chevrons) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                جدول (5): الفحوصات البصرية والساندة
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-5" viewBox="0 0 450 200" class="w-full min-w-[420px] h-[200px] overflow-visible"></svg>
            </div>
        </div>
        <!-- Lab Tests (Flat Arrow Columns) -->
        <div class="custom-card p-6 rounded-2xl flex flex-col justify-between">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="test-tube" class="w-4 h-4 text-purple-500"></i>
                جدول (6): الفحوصات والتحاليل المختبرية المنجزة (المجموع: 4,566 مراجع)
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-6" viewBox="0 0 450 180" class="w-full min-w-[420px] h-[180px] overflow-visible"></svg>
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
            <!-- 2D Arrow Columns -->
            <div class="lg:col-span-2 flex justify-center">
                <svg id="svg-report-7" viewBox="0 0 520 220" class="w-full max-w-[480px] h-[220px] overflow-visible"></svg>
            </div>
            <!-- Legend / Stats Table -->
            <div class="lg:col-span-1">
                <table class="custom-table text-xs">
                    <thead><tr><th>التصنيف</th><th class="text-center font-bold">العدد</th></tr></thead>
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
            <svg id="svg-report-10" viewBox="0 0 900 240" class="w-full min-w-[850px] h-[240px] overflow-visible"></svg>
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
            10=>['د. حيددر حسين علي الموسوي',839,[['رفع ساد + زراعة عدسة','فوق الكبرى',66],['تعديل هطول الاجفان','كبرى',1],['تصليب القرنية','كبرى',2],['رفع ظفرة','كبرى',1],['حقن الايليا','وسطى',148],['حقن الافاستين','وسطى',572],['حقن الكيناكورت','وسطى',15],['حقن الاكتيليس','وسطى',1],['الليزر','وسطى',29],['رفع كيس دهني','صغرى',1],['تسليك مجرى الدمع','صغرى',2],['رفع جسم غريب','صغرى',1]]],
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
                    <svg id="svg-doc-{{ $id }}" viewBox="0 0 450 200" class="w-full h-[200px] overflow-visible"></svg>
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

<!-- Custom Styles for Print and 2D Arrow effects -->
<style>
@media print {
    #sidebar, header, .custom-card:first-child, select, button { display: none !important; }
    #page-reports { display: block !important; overflow: visible !important; }
    .custom-card { border: none !important; box-shadow: none !important; page-break-inside: avoid !important; }
}

/* Arrow Growth Animation */
.arrow-grp {
    opacity: 0;
    transform: scale(0.95);
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}
.arrow-grp.show {
    opacity: 1;
    transform: scale(1);
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

// ─── DYNAMIC GRAPHIC ENGINES (FLAT 2D ARROWS) ───

// 1. Branching/Split Arrow Infographic (Table 1)
function draw2DBranchingArrow(svgId, val1, val2, label1, label2, totalVal) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';
    
    const cx = 175;
    const cy = 180;

    // Draw left branch
    const leftPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    leftPath.setAttribute('d', `M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-50} ${cy-90} ${cx-70} ${cy-105} L ${cx-80} ${cy-97} L ${cx-65} ${cy-125} L ${cx-37} ${cy-107} L ${cx-47} ${cy-112} C ${cx-35} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
    leftPath.setAttribute('fill', '#0284c7');
    svg.appendChild(leftPath);

    // Draw right branch
    const rightPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    rightPath.setAttribute('d', `M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-50} ${cy-90} ${cx-70} ${cy-105} L ${cx-80} ${cy-97} L ${cx-65} ${cy-125} L ${cx-37} ${cy-107} L ${cx-47} ${cy-112} C ${cx-35} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
    rightPath.setAttribute('fill', '#db2777');
    rightPath.setAttribute('transform', `translate(${cx}, 0) scale(-1, 1) translate(-${cx}, 0)`);
    svg.appendChild(rightPath);

    // Total pill at trunk base
    const totalValStr = totalVal.toLocaleString();
    const totalPillW = Math.max(36, totalValStr.length * 6.5 + 10);
    const totalPillH = 16;
    const totalPill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
    totalPill.setAttribute('x', cx - totalPillW / 2);
    totalPill.setAttribute('y', cy - 12);
    totalPill.setAttribute('width', totalPillW);
    totalPill.setAttribute('height', totalPillH);
    totalPill.setAttribute('rx', '8');
    totalPill.setAttribute('fill', '#334155');
    svg.appendChild(totalPill);

    const tTotal = document.createElementNS("http://www.w3.org/2000/svg", "text");
    tTotal.setAttribute('x', cx);
    tTotal.setAttribute('y', cy - 0.5);
    tTotal.setAttribute('font-family', 'Outfit');
    tTotal.setAttribute('font-size', '10px');
    tTotal.setAttribute('font-weight', 'black');
    tTotal.setAttribute('fill', '#ffffff');
    tTotal.setAttribute('text-anchor', 'middle');
    tTotal.textContent = totalValStr;
    svg.appendChild(tTotal);

    // Left branch badge
    const label1Text = `${label1}: ${val1.toLocaleString()}`;
    const badge1W = label1Text.length * 6 + 12;
    const badge1H = 18;
    const badge1 = document.createElementNS("http://www.w3.org/2000/svg", "rect");
    badge1.setAttribute('x', cx - 80 - badge1W / 2);
    badge1.setAttribute('y', cy - 145);
    badge1.setAttribute('width', badge1W);
    badge1.setAttribute('height', badge1H);
    badge1.setAttribute('rx', '9');
    badge1.setAttribute('fill', '#0284c7');
    svg.appendChild(badge1);

    const tVal1 = document.createElementNS("http://www.w3.org/2000/svg", "text");
    tVal1.setAttribute('x', cx - 80);
    tVal1.setAttribute('y', cy - 133);
    tVal1.setAttribute('font-family', 'Tajawal');
    tVal1.setAttribute('font-size', '9px');
    tVal1.setAttribute('font-weight', 'bold');
    tVal1.setAttribute('fill', '#ffffff');
    tVal1.setAttribute('text-anchor', 'middle');
    tVal1.textContent = label1Text;
    svg.appendChild(tVal1);

    // Right branch badge
    const label2Text = `${label2}: ${val2.toLocaleString()}`;
    const badge2W = label2Text.length * 6 + 12;
    const badge2H = 18;
    const badge2 = document.createElementNS("http://www.w3.org/2000/svg", "rect");
    badge2.setAttribute('x', cx + 80 - badge2W / 2);
    badge2.setAttribute('y', cy - 145);
    badge2.setAttribute('width', badge2W);
    badge2.setAttribute('height', badge2H);
    badge2.setAttribute('rx', '9');
    badge2.setAttribute('fill', '#db2777');
    svg.appendChild(badge2);

    const tVal2 = document.createElementNS("http://www.w3.org/2000/svg", "text");
    tVal2.setAttribute('x', cx + 80);
    tVal2.setAttribute('y', cy - 133);
    tVal2.setAttribute('font-family', 'Tajawal');
    tVal2.setAttribute('font-size', '9px');
    tVal2.setAttribute('font-weight', 'bold');
    tVal2.setAttribute('fill', '#ffffff');
    tVal2.setAttribute('text-anchor', 'middle');
    tVal2.textContent = label2Text;
    svg.appendChild(tVal2);
}

// 2. Vertical Flat Arrow Columns
function draw2DFlatVerticalArrows(svgId, values, labels, presetColors = null) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';
    const maxVal = Math.max(...values, 1);
    const n = values.length;
    const viewBoxStr = svg.getAttribute('viewBox') || "0 0 900 240";
    const width = parseInt(viewBoxStr.split(' ')[2]);
    const height = parseInt(viewBoxStr.split(' ')[3]);
    const marginL = 35;
    const marginR = 35;
    const availableW = width - marginL - marginR;
    const spacing = n > 1 ? availableW / (n - 1) : availableW;
    const floorY = height - 30;
    
    // Baseline
    const line = document.createElementNS("http://www.w3.org/2000/svg", "line");
    line.setAttribute('x1', marginL - 15);
    line.setAttribute('y1', floorY);
    line.setAttribute('x2', width - marginR + 15);
    line.setAttribute('y2', floorY);
    line.setAttribute('stroke', '#cbd5e1');
    line.setAttribute('stroke-width', '1.5');
    svg.appendChild(line);

    const colors = presetColors || ['#3b82f6','#ec4899','#f59e0b','#10b981','#8b5cf6','#06b6d4','#f97316','#64748b','#ec4899','#84cc16','#0ea5e9','#6366f1','#d946ef','#14b8a6','#f43f5e','#a78bfa'];

    values.forEach((val, i) => {
        const x = marginL + i * spacing;
        const color = colors[i % colors.length];
        
        const minH = 20;
        const maxH = height - 85;
        const scaleVal = maxVal > 1 ? Math.sqrt(val) / Math.sqrt(maxVal) : 1;
        const H = minH + (maxH - minH) * scaleVal;
        
        const g = document.createElementNS("http://www.w3.org/2000/svg", "g");
        g.setAttribute('class', 'arrow-grp cursor-pointer');

        // Dashed connector
        const dashed = document.createElementNS("http://www.w3.org/2000/svg", "line");
        dashed.setAttribute('x1', x);
        dashed.setAttribute('y1', floorY - H - 12);
        dashed.setAttribute('x2', x);
        dashed.setAttribute('y2', floorY - H - 26);
        dashed.setAttribute('stroke', color);
        dashed.setAttribute('stroke-width', '1');
        dashed.setAttribute('stroke-dasharray', '2 2');
        g.appendChild(dashed);

        // Value dynamic pill
        const valStr = val.toLocaleString();
        const pillW = Math.max(20, valStr.length * 6 + 6);
        const pillH = 14;

        const pill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        pill.setAttribute('x', x - pillW / 2);
        pill.setAttribute('y', floorY - H - 36);
        pill.setAttribute('width', pillW);
        pill.setAttribute('height', pillH);
        pill.setAttribute('rx', '7');
        pill.setAttribute('fill', color);
        g.appendChild(pill);

        const tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tVal.setAttribute('x', x);
        tVal.setAttribute('y', floorY - H - 25.5);
        tVal.setAttribute('font-family', 'Outfit');
        tVal.setAttribute('font-size', '8.5px');
        tVal.setAttribute('font-weight', 'bold');
        tVal.setAttribute('fill', '#ffffff');
        tVal.setAttribute('text-anchor', 'middle');
        tVal.textContent = valStr;
        g.appendChild(tVal);

        // Rect Arrow Body
        const body = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        body.setAttribute('x', x - 8);
        body.setAttribute('y', floorY - H);
        body.setAttribute('width', '16');
        body.setAttribute('height', H);
        body.setAttribute('fill', color);
        body.setAttribute('rx', '1');
        g.appendChild(body);

        // Pointed Cap
        const head = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
        head.setAttribute('points', `${x-12},${floorY-H} ${x+12},${floorY-H} ${x},${floorY-H-10}`);
        head.setAttribute('fill', color);
        g.appendChild(head);

        // Label
        const label = document.createElementNS("http://www.w3.org/2000/svg", "text");
        label.setAttribute('x', x);
        label.setAttribute('y', floorY + 15);
        label.setAttribute('font-family', 'Tajawal');
        label.setAttribute('font-size', '8px');
        label.setAttribute('font-weight', 'bold');
        label.setAttribute('fill', '#64748b');
        label.setAttribute('text-anchor', 'middle');
        
        let labelText = labels[i];
        if (labelText.length > 7) labelText = labelText.substring(0, 6) + '..';
        label.textContent = labelText;
        g.appendChild(label);

        g.style.transitionDelay = `${i * 30}ms`;
        svg.appendChild(g);

        setTimeout(() => {
            g.classList.add('show');
        }, 50);
    });
}

// 3. Horizontal Flat Chevron Lists
function draw2DFlatHorizontalChevrons(svgId, values, labels, presetColors = null) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';
    const maxVal = Math.max(...values, 1);
    const n = values.length;
    const viewBoxStr = svg.getAttribute('viewBox') || "0 0 450 200";
    const width = parseInt(viewBoxStr.split(' ')[2]);
    const height = parseInt(viewBoxStr.split(' ')[3]);
    
    const marginT = 18;
    const marginB = 18;
    const availableH = height - marginT - marginB;
    const spacing = n > 1 ? availableH / (n - 1) : availableH;
    
    const colors = presetColors || ['#db2777', '#d97706', '#10b981', '#475569', '#3b82f6', '#8b5cf6'];
    
    values.forEach((val, i) => {
        const y = marginT + i * spacing;
        const color = colors[i % colors.length];
        
        const startX = width - 20;
        const maxL = width - 130;
        const scaleVal = maxVal > 0 ? val / maxVal : 0;
        const L = 30 + maxL * scaleVal;
        const endX = startX - L;
        
        const g = document.createElementNS("http://www.w3.org/2000/svg", "g");
        g.setAttribute('class', 'arrow-grp cursor-pointer');

        // Draw body of chevron
        const body = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
        body.setAttribute('points', `${startX},${y-8} ${endX+8},${y-8} ${endX},${y} ${endX+8},${y+8} ${startX},${y+8}`);
        body.setAttribute('fill', color);
        g.appendChild(body);

        // Value dynamic pill
        const valStr = val.toLocaleString();
        const pillW = Math.max(18, valStr.length * 6 + 6);
        const pillH = 14;

        const pill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        pill.setAttribute('x', endX - pillW - 6);
        pill.setAttribute('y', y - pillH / 2);
        pill.setAttribute('width', pillW);
        pill.setAttribute('height', pillH);
        pill.setAttribute('rx', '7');
        pill.setAttribute('fill', color);
        g.appendChild(pill);

        const tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tVal.setAttribute('x', endX - pillW / 2 - 6);
        tVal.setAttribute('y', y + 4);
        tVal.setAttribute('font-family', 'Outfit');
        tVal.setAttribute('font-size', '8.5px');
        tVal.setAttribute('font-weight', 'bold');
        tVal.setAttribute('fill', '#ffffff');
        tVal.setAttribute('text-anchor', 'middle');
        tVal.textContent = valStr;
        g.appendChild(tVal);

        // Chevron label
        const label = document.createElementNS("http://www.w3.org/2000/svg", "text");
        label.setAttribute('x', startX - 12);
        label.setAttribute('y', y + 3);
        label.setAttribute('font-family', 'Tajawal');
        label.setAttribute('font-size', '8.5px');
        label.setAttribute('font-weight', 'bold');
        label.setAttribute('fill', '#ffffff');
        label.setAttribute('text-anchor', 'end');
        label.textContent = labels[i];
        g.appendChild(label);

        g.style.transitionDelay = `${i * 30}ms`;
        svg.appendChild(g);

        setTimeout(() => {
            g.classList.add('show');
        }, 50);
    });
}



// Global page initialization hook triggers drawing of all elements
function renderAll2DArrowCharts() {
    // 1. Branching Split Arrow for consultations
    @php
    $cGeneral = $consultations->firstWhere('unit', 'استشارية العيون العامة')['total'] ?? 0;
    $cSpecial = $consultations->firstWhere('unit', 'استشارية التخصصات الدقيقة')['total'] ?? 0;
    @endphp
    draw2DBranchingArrow('svg-report-1', {{ $cGeneral }}, {{ $cSpecial }}, 'العيون العامة', 'التخصصات الدقيقة', {{ $totalVisits }});

    // 2. Doctor visits -> 2D Flat Columns
    const docVisitsData = @json($visitsByDoctor->pluck('total'));
    const docVisitsLabels = @json($visitsByDoctor->pluck('doctor')->map(fn($name) => str_replace('د. ', '', $name)));
    draw2DFlatVerticalArrows('svg-report-2', docVisitsData, docVisitsLabels);

    // 3. Inside Iraq (Governorates) -> 2D Flat Columns
    const govData = @json($visitsByGov->pluck('total'));
    const govLabels = @json($visitsByGov->pluck('gov'));
    draw2DFlatVerticalArrows('svg-report-3', govData, govLabels, ['#0284c7']);

    // 4. Outside Iraq (Countries) -> Horizontal Chevrons
    const countryData = @json($visitsByCountry->pluck('total'));
    const countryLabels = @json($visitsByCountry->pluck('country'));
    draw2DFlatHorizontalChevrons('svg-report-4', countryData, countryLabels);

    // 5. Visual test types -> Horizontal Chevrons
    const visualData = @json($eyeTestsByType->pluck('total'));
    const visualLabels = @json($eyeTestsByType->pluck('type'));
    draw2DFlatHorizontalChevrons('svg-report-5', visualData, visualLabels, ['#f97316','#ea580c','#c2410c','#ea580c','#f97316','#c2410c']);

    // 6. Lab tests -> 2D Flat Columns
    const labTestData = @json($labTestsByType->pluck('total'));
    const labTestLabels = @json($labTestsByType->pluck('type'));
    draw2DFlatVerticalArrows('svg-report-6', labTestData, labTestLabels, ['#8b5cf6','#a855f7','#c084fc','#d8b4fe','#f3e8ff']);

    // 7. Surgery Classification -> 2D Flat Columns
    const surgClassData = [
        {{ $surgeriesByCatSector->where('classification', 'صغرى')->sum('total') }},
        {{ $surgeriesByCatSector->where('classification', 'ليزر')->sum('total') }},
        {{ $surgeriesByCatSector->where('classification', 'كبرى')->sum('total') }},
        {{ $surgeriesByCatSector->where('classification', 'خاصة')->sum('total') }},
        {{ $surgeriesByCatSector->where('classification', 'فوق الكبرى')->sum('total') }},
        {{ $surgeriesByCatSector->where('classification', 'وسطى')->sum('total') }}
    ];
    const surgClassLabels = ['صغرى', 'ليزر', 'كبرى', 'خاصة', 'فوق كبرى', 'حقن/وسطى'];
    draw2DFlatVerticalArrows('svg-report-7', surgClassData, surgClassLabels, ['#0ea5e9','#db2777','#d97706','#475569','#6d28d9','#e11d48']);

    // 10. Surgeries total (16 doctors) -> 2D Flat Columns
    @php
    $docSurgs = $surgeriesByDoctorCatSector->groupBy('doctor')->map(fn($group) => $group->sum('total'));
    @endphp
    const docSurgData = @json($docSurgs->values());
    const docSurgLabels = @json($docSurgs->keys()->map(fn($name) => str_replace('د. ', '', $name)));
    draw2DFlatVerticalArrows('svg-report-10', docSurgData, docSurgLabels);

    // Initialize switcher single doctor stats
    const selector = document.getElementById('doc-active-selector');
    if (selector) {
        renderSingleDocChart(selector.value);
    }
}

// switcher individual doctor operations details -> Horizontal Chevrons
const docOpsData = {
    @foreach($surgeryDetailByDoctor as $docName => $ops)
        @php
        $docModel = $filterDoctors->firstWhere('name', $docName);
        $docId = $docModel ? $docModel->id : 0;
        @endphp
        @if($docId)
        "{{ $docId }}": @json($ops->pluck('total')),
        @endif
    @endforeach
};
const docNamesData = {
    @foreach($surgeryDetailByDoctor as $docName => $ops)
        @php
        $docModel = $filterDoctors->firstWhere('name', $docName);
        $docId = $docModel ? $docModel->id : 0;
        @endphp
        @if($docId)
        "{{ $docId }}": @json($ops->pluck('op')),
        @endif
    @endforeach
};

function renderSingleDocChart(id) {
    const values = docOpsData[id] || [];
    const labels = docNamesData[id] || [];
    if (values.length === 0) {
        const svg = document.getElementById('svg-doc-' + id);
        if (svg) svg.innerHTML = '<text x="225" y="100" font-family="Tajawal" font-size="11" font-weight="bold" fill="#94a3b8" text-anchor="middle">لا توجد عمليات مسجلة لهذا الطبيب</text>';
        return;
    }
    draw2DFlatHorizontalChevrons('svg-doc-' + id, values, labels);
}

function toggleAdvancedFilters() {
    const panel = document.getElementById('advanced-filters-panel');
    const chevron = document.getElementById('adv-filters-chevron');
    if (panel) {
        panel.classList.toggle('hidden');
        if (chevron) {
            chevron.style.transform = panel.classList.contains('hidden') ? '' : 'rotate(180deg)';
        }
    }
}

function applyDateRangeFilter() {
    const fromVal = document.getElementById('report-date-from').value;
    const toVal = document.getElementById('report-date-to').value;
    if (!fromVal || !toVal) return;
    
    const docId = document.getElementById('filter-doctor-id').value;
    const unitId = document.getElementById('filter-clinic-unit-id').value;
    const govId = document.getElementById('filter-governorate-id').value;
    const countryId = document.getElementById('filter-country-id').value;
    const sectorId = document.getElementById('filter-sector-id').value;
    
    let url = `/?start_date=${fromVal}&end_date=${toVal}`;
    if (docId) url += `&doctor_id=${docId}`;
    if (unitId) url += `&clinic_unit_id=${unitId}`;
    if (govId) url += `&governorate_id=${govId}`;
    if (countryId) url += `&country_id=${countryId}`;
    if (sectorId) url += `&sector_id=${sectorId}`;
    
    window.location.href = url + '#reports';
}

function resetAllFilters() {
    window.location.href = '/#reports';
}

// Global page initialization hook
let _chartsInitialized = false;
window.initReportsPage = function() {
    if (!_chartsInitialized) {
        _chartsInitialized = true;
        setTimeout(() => {
            renderAll2DArrowCharts();
        }, 150);
    }
};
</script>
