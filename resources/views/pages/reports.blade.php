<!-- PAGE 2: REPORTS PAGE SECTION -->
<section id="page-reports" class="page-section space-y-6 hidden">

    <!-- ====== Filter Bar ====== -->
    <div class="custom-card p-4 sm:p-5 rounded-2xl flex flex-col lg:flex-row gap-4 items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-text-main flex items-center gap-2">
                <i data-lucide="file-bar-chart-2" class="w-5 h-5 text-theme-pink"></i>
                الإحصاءات الطبية – مركز السيدة زينب الكبرى (ع)
            </h2>
            <p class="text-[11px] text-text-main opacity-60 mt-0.5">جميع الجداول من 1 إلى 10 + الإحصائية التفصيلية لـ 16 طبيب</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <select class="custom-inset border-none focus:outline-none rounded-xl py-2 px-4 text-xs font-bold text-text-main">
                <option>تقرير شهري</option><option>تقرير يومي</option><option>تقرير سنوي</option>
            </select>
            <input type="month" value="2026-05" class="custom-inset border-none focus:outline-none rounded-xl py-2 px-4 text-xs font-bold text-text-main custom-date-input">
            <button class="py-2 px-5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-400 hover-press flex items-center gap-2">
                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i><span>تحديث</span>
            </button>
            <button class="py-2 px-5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-pink-400 hover-press flex items-center gap-2">
                <i data-lucide="printer" class="w-3.5 h-3.5"></i><span>طباعة PDF</span>
            </button>
        </div>
    </div>

    <!-- ====================================================== -->
    <!-- جدول (1): الاستشاريات — رسم Pie + جدول صغير بجانبه   -->
    <!-- ====================================================== -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="stethoscope" class="w-4 h-4 text-theme-pink"></i>
            جدول (1): أعداد المراجعين في الاستشاريات
        </h3>
        <div class="flex flex-col md:flex-row gap-6 items-center">
            <!-- Chart: takes 40% on wide screens -->
            <div id="chart-report-1" class="w-full md:w-2/5 flex-shrink-0" style="height:220px"></div>
            <!-- Table: takes 60% -->
            <div class="w-full md:w-3/5">
                <table class="custom-table text-sm">
                    <thead><tr>
                        <th class="w-12 text-center">ت</th>
                        <th>الوحدة الطبية</th>
                        <th class="text-center min-w-[90px]">المجموع</th>
                    </tr></thead>
                    <tbody>
                        <tr class="table-row"><td class="text-center">1</td><td>استشارية العيون العامة</td><td class="text-center font-bold text-lg">3375</td></tr>
                        <tr class="table-row"><td class="text-center">2</td><td>استشارية التخصصات الدقيقة</td><td class="text-center font-bold text-lg">1091</td></tr>
                        <tr class="table-row font-extrabold text-theme-pink"><td colspan="2" class="text-center text-sm">المجموع الكلي</td><td class="text-center text-xl">4566</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ====================================================== -->
    <!-- جدول (2): مراجعو كل طبيب — رسم Bar فوق + جدول تحته   -->
    <!-- ====================================================== -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="users" class="w-4 h-4 text-emerald-500"></i>
            جدول (2): أعداد مراجعي الاستشارية لكل طبيب اختصاص
        </h3>
        <!-- Chart full width -->
        <div id="chart-report-2" class="w-full mb-5" style="height:240px"></div>
        <!-- Table below chart -->
        <table class="custom-table text-xs">
            <thead><tr>
                <th class="w-10 text-center">ت</th>
                <th>اسم الطبيب</th>
                <th class="text-center min-w-[110px]">عدد المراجعين</th>
            </tr></thead>
            <tbody>
                <tr class="table-row"><td class="text-center">1</td><td>د. غياث الدين ثجيل نعمة</td><td class="text-center font-bold">177</td></tr>
                <tr class="table-row"><td class="text-center">2</td><td>د. حمزة صادق علوان الشريفي</td><td class="text-center font-bold">562</td></tr>
                <tr class="table-row"><td class="text-center">3</td><td>د. ذوالفقار غني الكندي</td><td class="text-center font-bold">120</td></tr>
                <tr class="table-row"><td class="text-center">4</td><td>د. منتصر محمد عرب</td><td class="text-center font-bold">212</td></tr>
                <tr class="table-row"><td class="text-center">5</td><td>د. افراح عبد الزهرة القصير</td><td class="text-center font-bold">120</td></tr>
                <tr class="table-row"><td class="text-center">6</td><td>د. مؤيد عبد اللطيف صبار</td><td class="text-center font-bold">346</td></tr>
                <tr class="table-row"><td class="text-center">7</td><td>د. بشرى سليمان علي الصقر</td><td class="text-center font-bold">1204</td></tr>
                <tr class="table-row"><td class="text-center">8</td><td>د. عالء صبري الغانمي</td><td class="text-center font-bold">56</td></tr>
                <tr class="table-row"><td class="text-center">9</td><td>د. نور رعد كريم</td><td class="text-center font-bold">194</td></tr>
                <tr class="table-row"><td class="text-center">10</td><td>د. حيدر حسين علي الموسوي</td><td class="text-center font-bold">729</td></tr>
                <tr class="table-row"><td class="text-center">11</td><td>د. حذيفه سامي جواد العبايجي</td><td class="text-center font-bold">348</td></tr>
                <tr class="table-row"><td class="text-center">12</td><td>د. اريج هادي كريم</td><td class="text-center font-bold">134</td></tr>
                <tr class="table-row"><td class="text-center">13</td><td>د. زهراء علوان الحمداني</td><td class="text-center font-bold">106</td></tr>
                <tr class="table-row"><td class="text-center">14</td><td>د. ايات معتز محمد</td><td class="text-center font-bold">171</td></tr>
                <tr class="table-row"><td class="text-center">15</td><td>د. محمد بدر الجريان</td><td class="text-center font-bold">87</td></tr>
                <tr class="table-row font-extrabold text-theme-pink"><td colspan="2" class="text-center">المجموع الكلي</td><td class="text-center text-base">4566</td></tr>
            </tbody>
        </table>
    </div>

    <!-- ====================================================== -->
    <!-- جدول (3) و (4): ديمغرافي الاستشاريات                 -->
    <!-- داخل العراق: Bar فوق + جدول تحته                     -->
    <!-- خارج العراق: Donut + جدول صغير بجانبه                -->
    <!-- ====================================================== -->
    <div class="custom-card p-6 rounded-2xl space-y-8">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 pb-3 border-b border-slate-200/20">
            <i data-lucide="map" class="w-4 h-4 text-sky-500"></i>
            جدول (3) و (4): التوزيع الديمغرافي لمراجعي الاستشاريات
        </h3>

        <!-- (3) Inside Iraq -->
        <div>
            <p class="text-xs font-extrabold text-text-main opacity-70 mb-3 flex items-center gap-1">
                <i data-lucide="flag" class="w-3 h-3"></i> داخل العراق — 18 محافظة
            </p>
            <div id="chart-report-3" class="w-full mb-4" style="height:220px"></div>
            <div class="overflow-x-auto">
                <table class="custom-table text-xs text-center">
                    <thead><tr>
                        <th>كربلاء</th><th>بغداد</th><th>النجف</th><th>بابل</th><th>ذي قار</th><th>واسط</th><th>البصرة</th><th>القادسية</th><th>ميسان</th><th>المثنى</th><th>ديالى</th><th>كركوك</th><th>نينوى</th><th>صالح الدين</th><th>اربيل</th><th>سليمانية</th><th>الانبار</th><th>دهوك</th>
                    </tr></thead>
                    <tbody><tr class="table-row font-bold">
                        <td>3455</td><td>127</td><td>46</td><td>521</td><td>120</td><td>76</td><td>60</td><td>47</td><td>36</td><td>33</td><td>9</td><td>7</td><td>6</td><td>5</td><td>1</td><td>1</td><td>0</td><td>0</td>
                    </tr></tbody>
                </table>
            </div>
        </div>

        <!-- (4) Outside Iraq -->
        <div>
            <p class="text-xs font-extrabold text-text-main opacity-70 mb-3 flex items-center gap-1">
                <i data-lucide="globe" class="w-3 h-3"></i> خارج العراق
            </p>
            <div class="flex flex-col md:flex-row gap-6 items-center">
                <div id="chart-report-4" class="w-full md:w-2/5 flex-shrink-0" style="height:200px"></div>
                <div class="w-full md:w-3/5">
                    <table class="custom-table text-sm">
                        <thead><tr><th>البلد</th><th class="text-center">عدد المراجعين</th></tr></thead>
                        <tbody>
                            <tr class="table-row"><td>ايران</td><td class="text-center font-bold">6</td></tr>
                            <tr class="table-row"><td>افغانستان</td><td class="text-center font-bold">4</td></tr>
                            <tr class="table-row"><td>سوريا</td><td class="text-center font-bold">2</td></tr>
                            <tr class="table-row"><td>مصر</td><td class="text-center font-bold">1</td></tr>
                            <tr class="table-row"><td>نيجيريا</td><td class="text-center font-bold">1</td></tr>
                            <tr class="table-row"><td>باكستان</td><td class="text-center font-bold">1</td></tr>
                            <tr class="table-row font-extrabold text-theme-pink"><td>المجموع</td><td class="text-center text-base">16</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ====================================================== -->
    <!-- جدول (5) و (6): الفحوصات والمختبر — بطاقتان جانبيتان -->
    <!-- ====================================================== -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- TABLE 5: رسم Bar فوق ← جدول تحته -->
        <div class="custom-card p-6 rounded-2xl flex flex-col gap-4">
            <h3 class="text-sm font-bold text-text-main flex items-center gap-2 pb-3 border-b border-slate-200/20">
                <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                جدول (5): الفحوصات البصرية والساندة المنجزة
            </h3>
            <div id="chart-report-5" class="w-full" style="height:220px"></div>
            <table class="custom-table text-xs">
                <thead><tr><th>نوع الفحص</th><th class="text-center min-w-[80px]">العدد</th></tr></thead>
                <tbody>
                    <tr class="table-row"><td>فحص البصر</td><td class="text-center font-bold">4730</td></tr>
                    <tr class="table-row"><td>فحص قوة العدسة</td><td class="text-center font-bold">641</td></tr>
                    <tr class="table-row"><td>فحص الشبكية OCT</td><td class="text-center font-bold">1444</td></tr>
                    <tr class="table-row"><td>فحص سونار العين</td><td class="text-center font-bold">135</td></tr>
                    <tr class="table-row"><td>فحص قاع العين FUNDUS</td><td class="text-center font-bold">67</td></tr>
                    <tr class="table-row"><td>فحص تصوير القرنية C.T</td><td class="text-center font-bold">142</td></tr>
                    <tr class="table-row"><td>فحص خاليا القرنية S.M</td><td class="text-center font-bold">61</td></tr>
                    <tr class="table-row"><td>فحص صبغة الفلورسين</td><td class="text-center font-bold">12</td></tr>
                    <tr class="table-row"><td>فحص الساحة البصرية FDT</td><td class="text-center font-bold">8</td></tr>
                    <tr class="table-row font-extrabold text-orange-500"><td>المجموع الكلي</td><td class="text-center text-sm">7240</td></tr>
                </tbody>
            </table>
        </div>

        <!-- TABLE 6: Radial فوق ← جدول وبادجات تحته -->
        <div class="custom-card p-6 rounded-2xl flex flex-col gap-4">
            <h3 class="text-sm font-bold text-text-main flex items-center gap-2 pb-3 border-b border-slate-200/20">
                <i data-lucide="test-tube" class="w-4 h-4 text-purple-500"></i>
                جدول (6): مراجعو المختبر والتحاليل المختبرية
            </h3>
            <div id="chart-report-6" class="w-full" style="height:220px"></div>
            <table class="custom-table text-sm">
                <thead><tr><th>البيان</th><th class="text-center">العدد</th></tr></thead>
                <tbody>
                    <tr class="table-row"><td>أعداد المراجعين للمختبر</td><td class="text-center font-bold text-theme-pink text-base">4566</td></tr>
                    <tr class="table-row"><td>أعداد التحاليل المنجزة</td><td class="text-center text-text-main opacity-50">—</td></tr>
                </tbody>
            </table>
            <div class="mt-2">
                <p class="text-[10px] font-bold text-text-main opacity-50 mb-2">أنواع التحاليل المختبرية:</p>
                <div class="flex flex-wrap gap-1.5">
                    @foreach(['RBS','WBC','Hp','PCV','HIV','HCV','HBV','PT','PTT','INR'] as $t)
                    <span class="badge-success text-[9px] px-2 py-0.5">{{ $t }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- ====================================================== -->
    <!-- جدول (7): تصنيف العمليات — رسم Stacked فوق + جدول   -->
    <!-- ====================================================== -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="activity" class="w-4 h-4 text-rose-500"></i>
            جدول (7): أعداد وتصنيف العمليات الجراحية للعيون
        </h3>
        <div id="chart-report-7" class="w-full mb-5" style="height:260px"></div>
        <div class="overflow-x-auto">
            <table class="custom-table text-sm text-center">
                <thead><tr>
                    <th class="text-right min-w-[160px]">تصنيف العمليات</th>
                    <th>قطاع الصحة</th>
                    <th>العتبة الخاص</th>
                    <th>العتبة العام</th>
                    <th class="text-theme-pink min-w-[90px]">المجموع</th>
                </tr></thead>
                <tbody>
                    <tr class="table-row"><td class="text-right">العمليات الصغرى</td><td>13</td><td>13</td><td>7</td><td class="font-bold">33</td></tr>
                    <tr class="table-row"><td class="text-right">الوسطى (حقن العين)</td><td>1257</td><td>0</td><td>0</td><td class="font-bold">1257</td></tr>
                    <tr class="table-row"><td class="text-right">الوسطى (الليزر)</td><td>46</td><td>41</td><td>16</td><td class="font-bold">103</td></tr>
                    <tr class="table-row"><td class="text-right">الكبرى</td><td>19</td><td>51</td><td>15</td><td class="font-bold">85</td></tr>
                    <tr class="table-row"><td class="text-right">فوق الكبرى</td><td>128</td><td>189</td><td>117</td><td class="font-bold">434</td></tr>
                    <tr class="table-row"><td class="text-right">الخاصة</td><td>1</td><td>89</td><td>0</td><td class="font-bold">90</td></tr>
                    <tr class="table-row font-extrabold text-rose-500 text-sm"><td class="text-right">المجموع</td><td>1464</td><td>383</td><td>155</td><td>2002</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ====================================================== -->
    <!-- جدول (8) و (9): ديمغرافي العمليات                    -->
    <!-- ====================================================== -->
    <div class="custom-card p-6 rounded-2xl space-y-8">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 pb-3 border-b border-slate-200/20">
            <i data-lucide="map-pin" class="w-4 h-4 text-emerald-500"></i>
            جدول (8) و (9): التوزيع الديمغرافي لمرضى العمليات الجراحية
        </h3>

        <!-- (8) Inside Iraq -->
        <div>
            <p class="text-xs font-extrabold text-text-main opacity-70 mb-3 flex items-center gap-1">
                <i data-lucide="flag" class="w-3 h-3"></i> داخل العراق — 18 محافظة
            </p>
            <div id="chart-report-8" class="w-full mb-4" style="height:220px"></div>
            <div class="overflow-x-auto">
                <table class="custom-table text-xs text-center">
                    <thead><tr>
                        <th>كربلاء</th><th>بغداد</th><th>النجف</th><th>بابل</th><th>ذي قار</th><th>واسط</th><th>القادسية</th><th>البصرة</th><th>ميسان</th><th>المثنى</th><th>ديالى</th><th>نينوى</th><th>صالح الدين</th><th>اربيل</th><th>سليمانية</th><th>الانبار</th><th>كركوك</th><th>دهوك</th>
                    </tr></thead>
                    <tbody><tr class="table-row font-bold">
                        <td>1249</td><td>72</td><td>9</td><td>444</td><td>83</td><td>53</td><td>31</td><td>25</td><td>14</td><td>7</td><td>5</td><td>4</td><td>3</td><td>1</td><td>1</td><td>0</td><td>0</td><td>0</td>
                    </tr></tbody>
                </table>
            </div>
        </div>

        <!-- (9) Outside Iraq -->
        <div>
            <p class="text-xs font-extrabold text-text-main opacity-70 mb-3 flex items-center gap-1">
                <i data-lucide="globe" class="w-3 h-3"></i> خارج العراق
            </p>
            <div class="flex flex-col md:flex-row gap-6 items-center">
                <div id="chart-report-9" class="w-full md:w-2/5 flex-shrink-0" style="height:180px"></div>
                <div class="w-full md:w-3/5">
                    <table class="custom-table text-sm">
                        <thead><tr><th>البلد</th><th class="text-center">عدد المرضى</th></tr></thead>
                        <tbody>
                            <tr class="table-row"><td>افغانستان</td><td class="text-center font-bold">1</td></tr>
                            <tr class="table-row"><td>سوريا</td><td class="text-center font-bold">0</td></tr>
                            <tr class="table-row"><td>لبنان</td><td class="text-center font-bold">0</td></tr>
                            <tr class="table-row font-extrabold text-theme-pink"><td>المجموع</td><td class="text-center text-base">1</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ====================================================== -->
    <!-- جدول (10): الضخم 16 طبيب — Bar فوق + جدول تحته       -->
    <!-- ====================================================== -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="scissors" class="w-4 h-4 text-indigo-500"></i>
            جدول (10): العمليات الجراحية لكل طبيب اختصاص — جميع القطاعات
        </h3>
        <div id="chart-report-10" class="w-full mb-6" style="height:300px"></div>
        <div class="overflow-x-auto">
            <table class="custom-table text-center" style="font-size:10px; min-width:900px">
                <thead>
                    <tr>
                        <th rowspan="2" class="w-6">ت</th>
                        <th rowspan="2" class="text-right min-w-[130px]">الطبيب</th>
                        <th colspan="3" class="bg-yellow-400/20 border-b-0">صغرى</th>
                        <th colspan="3" class="bg-blue-400/20 border-b-0">وسطى</th>
                        <th colspan="3" class="bg-orange-400/20 border-b-0">كبرى</th>
                        <th colspan="3" class="bg-rose-400/20 border-b-0">فوق الكبرى</th>
                        <th colspan="3" class="bg-purple-400/20 border-b-0">خاصة</th>
                        <th rowspan="2" class="text-theme-pink font-extrabold min-w-[60px]">المجموع</th>
                    </tr>
                    <tr>
                        <th class="text-[9px]">ص</th><th class="text-[9px]">خ</th><th class="text-[9px]">ع</th>
                        <th class="text-[9px]">ص</th><th class="text-[9px]">خ</th><th class="text-[9px]">ع</th>
                        <th class="text-[9px]">ص</th><th class="text-[9px]">خ</th><th class="text-[9px]">ع</th>
                        <th class="text-[9px]">ص</th><th class="text-[9px]">خ</th><th class="text-[9px]">ع</th>
                        <th class="text-[9px]">ص</th><th class="text-[9px]">خ</th><th class="text-[9px]">ع</th>
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
                        [8,'د. عالء صبري الغانمي',[1,0,0,128,0,0,1,0,0,13,4,0,0,0,0],147],
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
                        <td class="{{ $v==0?'opacity-25':'' }}">{{ $v }}</td>
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
                        <td>2002</td>
                    </tr>
                </tbody>
            </table>
            <p class="text-[9px] text-text-main opacity-30 mt-1.5">ص = قطاع الصحة &nbsp;|&nbsp; خ = عتبة الخاص &nbsp;|&nbsp; ع = عتبة العام</p>
        </div>
    </div>

    <!-- ====================================================== -->
    <!-- الإحصائية التفصيلية لكل طبيب (الملف الثاني)          -->
    <!-- Tabs + Donut جانب + جدول جانب                         -->
    <!-- ====================================================== -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 pb-3 mb-5 border-b border-slate-200/20">
            <i data-lucide="user-cog" class="w-4 h-4 text-violet-500"></i>
            الإحصائية التفصيلية لكل طبيب — أيار 2026
        </h3>
        <!-- Tabs -->
        <div class="flex flex-wrap gap-2 mb-6">
            @php
            $dnames=[1=>'غياث الدين',2=>'حمزة صادق',3=>'ذوالفقار',4=>'منتصر عرب',5=>'افراح',6=>'مؤيد',7=>'بشرى',8=>'عالء',9=>'نور رعد',10=>'حيدر',11=>'حذيفه',12=>'اريج',13=>'زهراء',14=>'خلدون',15=>'ايات',16=>'محمد بدر'];
            @endphp
            @foreach($dnames as $id=>$n)
            <button onclick="showDoc({{ $id }})" id="dtab-{{ $id }}"
                class="doc-tab custom-inset py-1.5 px-3 rounded-xl text-[10px] font-bold text-text-main hover-press transition-all {{ $id==1?'!bg-violet-100 !text-violet-700':'' }}">
                {{ $id }}. {{ $n }}
            </button>
            @endforeach
        </div>

        <!-- Detail Panels -->
        @php
        $ddetails=[
            1=>['د. غياث الدين ثجيل نعمة',85,[['قص السائل الزجاجي','خاصة',29],['رفع ماء اسود + رفع ساد','خاصة',2],['رفع ساد + زراعة عدسة','فوق الكبرى',3],['رفع سليكون + زرع عدسة','فوق الكبرى',8],['زرع عدسة ثانوية','فوق الكبرى',2],['غسل حجرة','كبرى',3],['رفع سليكون','كبرى',6],['حقن الايليليا','وسطى',18],['حقن الافاستين','وسطى',13]]],
            2=>['د. حمزة صادق علوان الشريفي',165,[['قص السائل الزجاجي','خاصة',50],['رفع ماء اسود + رفع ساد','خاصة',2],['رفع ساد + زراعة عدسة','فوق الكبرى',56],['رفع سليكون + زرع عدسة','فوق الكبرى',5],['زرع عدسة ثانوية','فوق الكبرى',1],['زرع صمام احمد','فوق الكبرى',1],['تعديل هطول الاجفان','كبرى',1],['تصليب القرنية','كبرى',1],['غسل حجرة','كبرى',9],['رفع سليكون','كبرى',25],['الليزر','وسطى',15],['تسليك مجرى الدمع','صغرى',1]]],
            3=>['د. ذوالفقار غني عبد الكندي',22,[['قص السائل الزجاجي','خاصة',10],['رفع ساد + زراعة عدسة','فوق الكبرى',5],['الحول','كبرى',1],['رفع سليكون','كبرى',3],['الليزر','وسطى',3]]],
            4=>['د. منتصر محمد عرب',120,[['رفع ساد + زراعة عدسة','فوق الكبرى',16],['رفع ظفرة','كبرى',1],['حقن الايليا','وسطى',52],['حقن اللوسنتس','وسطى',11],['حقن الافاستين','وسطى',30],['الليزر','وسطى',8],['تسليك مجرى الدمع','صغرى',1],['رفع جسم غريب','صغرى',1]]],
            5=>['د. افراح عبد الزهرة القصير',10,[['زرع صمام + رفع ساد','خاصة',1],['رفع ساد + زراعة عدسة','فوق الكبرى',7],['الليزر','وسطى',2]]],
            6=>['د. مؤيد عبد اللطيف صبار',146,[['رفع ساد + زراعة عدسة','فوق الكبرى',39],['تعديل هطول الاجفان','كبرى',1],['الحول','كبرى',10],['رفع ظفرة','كبرى',2],['حقن الايليا','وسطى',58],['حقن الافاستين','وسطى',26],['الليزر','وسطى',3],['رفع كيس دهني','صغرى',4],['رفع ورم مجرى الدمع','صغرى',1],['فحص تخدير عام','صغرى',1],['رفع جسم غريب','صغرى',1]]],
            7=>['د. بشرى سليمان علي الصقر',162,[['رفع ساد + زراعة عدسة','فوق الكبرى',135],['تعديل هطول الاجفان','كبرى',1],['تصليب القرنية','كبرى',4],['غسل حجرة','كبرى',1],['الليزر','وسطى',21],['رفع كيس دهني','صغرى',3],['رفع ورم درمويد','صغرى',1],['تسليك مجرى الدمع','صغرى',3],['رفع جسم غريب','صغرى',2]]],
            8=>['د. عالء صبري الغانمي',147,[['رفع ساد + زراعة عدسة','فوق الكبرى',17],['رفع ظفرة','كبرى',1],['حقن الفابزمو','وسطى',3],['حقن الايليا','وسطى',82],['حقن اللوسنتس','وسطى',23],['حقن الافاستين','وسطى',18],['حقن الكيناكورت','وسطى',2],['فحص تخدير عام','صغرى',1]]],
            9=>['د. نور رعد كريم',189,[['رفع ساد + زراعة عدسة','فوق الكبرى',27],['زرع عدسة ثانوية','فوق الكبرى',1],['تعديل هطول الاجفان','كبرى',1],['الحول','كبرى',4],['رفع ظفرة','كبرى',2],['حقن الايليا','وسطى',45],['حقن الافاستين','وسطى',101],['حقن الكيناكورت','وسطى',1],['الليزر','وسطى',7]]],
            10=>['د. حيدر حسين علي الموسوي',839,[['رفع ساد + زراعة عدسة','فوق الكبرى',66],['تعديل هطول الاجفان','كبرى',1],['تصليب القرنية','كبرى',2],['رفع ظفرة','كبرى',1],['حقن الايليا','وسطى',148],['حقن الافاستين','وسطى',572],['حقن الكيناكورت','وسطى',15],['حقن الاكتيليس','وسطى',1],['الليزر','وسطى',29],['رفع كيس دهني','صغرى',1],['تسليك مجرى الدمع','صغرى',2],['رفع جسم غريب','صغرى',1]]],
            11=>['د. حذيفه سامي جواد العبايجي',57,[['رفع ساد + زراعة عدسة','فوق الكبرى',18],['الحول','كبرى',1],['رفع ظفرة','كبرى',1],['حقن الافاستين','وسطى',30],['الليزر','وسطى',7]]],
            12=>['د. اريج هادي كريم',12,[['رفع ساد + زراعة عدسة','فوق الكبرى',10],['الليزر','وسطى',1],['رفع كيس دهني','صغرى',1]]],
            13=>['د. زهراء علوان عيدان الحمداني',5,[['رفع ساد + زراعة عدسة','فوق الكبرى',2],['الليزر','وسطى',1],['رفع كيس دهني','صغرى',2]]],
            14=>['د. خلدون خليل نايف',6,[['رفع ساد + زراعة عدسة','فوق الكبرى',5],['الليزر','وسطى',1]]],
            15=>['د. ايات معتز محمد',35,[['رفع ساد + زراعة عدسة','فوق الكبرى',8],['تعديل هطول الاجفان','كبرى',1],['تصليب القرنية','كبرى',1],['حقن الايليا','وسطى',1],['حقن الافاستين','وسطى',20],['الليزر','وسطى',1],['رفع كيس دهني','صغرى',3]]],
            16=>['د. محمد بدر محمد الجريان',2,[['رفع ساد + زراعة عدسة','فوق الكبرى',2]]],
        ];
        $bc=['خاصة'=>'bg-purple-100 text-purple-700','فوق الكبرى'=>'bg-rose-100 text-rose-700','كبرى'=>'bg-orange-100 text-orange-700','وسطى'=>'bg-blue-100 text-blue-700','صغرى'=>'bg-yellow-100 text-yellow-700'];
        @endphp

        @foreach($ddetails as $id=>[$docname,$total,$ops])
        <div id="dpanel-{{ $id }}" class="dpanel {{ $id==1?'':'hidden' }}">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
                <h4 class="text-sm font-extrabold text-text-main">{{ $id }}. {{ $docname }}</h4>
                <span class="text-xs font-bold text-white bg-violet-500 px-4 py-1.5 rounded-full w-fit">{{ $total }} عملية إجمالاً</span>
            </div>
            <!-- Chart + Table side by side -->
            <div class="flex flex-col lg:flex-row gap-6 items-start">
                <!-- Donut Chart -->
                <div id="chart-doc-{{ $id }}" class="w-full lg:w-2/5 flex-shrink-0" style="height:260px"></div>
                <!-- Table -->
                <div class="w-full lg:w-3/5">
                    <table class="custom-table text-xs">
                        <thead><tr>
                            <th class="w-8 text-center">ت</th>
                            <th>اسم العملية</th>
                            <th class="text-center min-w-[100px]">التصنيف</th>
                            <th class="text-center min-w-[60px]">العدد</th>
                        </tr></thead>
                        <tbody>
                            @foreach($ops as $i=>$op)
                            <tr class="table-row">
                                <td class="text-center">{{ $i+1 }}</td>
                                <td>{{ $op[0] }}</td>
                                <td class="text-center"><span class="text-[9px] font-bold px-2 py-0.5 rounded-full {{ $bc[$op[1]] ?? '' }}">{{ $op[1] }}</span></td>
                                <td class="text-center font-bold text-violet-600 text-sm">{{ $op[2] }}</td>
                            </tr>
                            @endforeach
                            <tr class="table-row font-extrabold text-violet-700">
                                <td colspan="3" class="text-center">المجموع</td>
                                <td class="text-center text-base">{{ $total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Signature -->
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

<script>
// ===== DOC TAB SWITCHER =====
function showDoc(id) {
    document.querySelectorAll('.dpanel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.doc-tab').forEach(t => {
        t.classList.remove('!bg-violet-100', '!text-violet-700');
    });
    document.getElementById('dpanel-' + id)?.classList.remove('hidden');
    const tab = document.getElementById('dtab-' + id);
    if (tab) { tab.classList.add('!bg-violet-100', '!text-violet-700'); }
    if (!window['chartDocDone' + id]) renderDocChart(id);
}

// ===== THEME COLORS =====
function getTC() {
    const t = document.body.getAttribute('data-theme') || 'soft';
    const texts = { soft:'#2e3e5c', glass:'#2e3e5c', brutal:'#000000', minimalist:'#171717', excel:'#323130' };
    return texts[t] || '#2e3e5c';
}

const C = ['#ff4d7e','#10b981','#3b82f6','#f59e0b','#8b5cf6','#06b6d4','#f97316','#64748b','#ec4899','#84cc16','#0ea5e9','#6366f1','#d946ef','#14b8a6','#f43f5e','#a78bfa'];

// ===== MAIN CHARTS =====
function renderReportCharts() {
    const tx = getTC();

    // Chart 1: Pie - Consultations
    new ApexCharts(document.querySelector('#chart-report-1'), {
        chart:{ type:'pie', height:220, background:'transparent', toolbar:{show:false} },
        series:[3375, 1091], labels:['العيون العامة (3375)','التخصصات الدقيقة (1091)'],
        colors:['#ff4d7e','#10b981'],
        legend:{ position:'bottom', labels:{colors:tx}, fontSize:'11px' },
        dataLabels:{ style:{fontSize:'11px', fontWeight:'700'} }
    }).render();

    // Chart 2: Bar - Doctors visits (full width, taller)
    new ApexCharts(document.querySelector('#chart-report-2'), {
        chart:{ type:'bar', height:240, background:'transparent', toolbar:{show:false} },
        series:[{ name:'المراجعون', data:[177,562,120,212,120,346,1204,56,194,729,348,134,106,171,87] }],
        xaxis:{ categories:['غياث','حمزة','ذوالفقار','منتصر','افراح','مؤيد','بشرى','عالء','نور','حيدر','حذيفه','اريج','زهراء','ايات','م.بدر'], labels:{style:{fontSize:'9px',colors:tx}} },
        colors:C, plotOptions:{ bar:{ borderRadius:5, distributed:true, columnWidth:'65%' } },
        legend:{show:false}, dataLabels:{enabled:true, style:{fontSize:'9px', fontWeight:'700'}},
        yaxis:{labels:{style:{colors:tx}}}, tooltip:{theme:'light'}
    }).render();

    // Chart 3: Bar - Governorates consultations
    new ApexCharts(document.querySelector('#chart-report-3'), {
        chart:{ type:'bar', height:220, background:'transparent', toolbar:{show:false} },
        series:[{ name:'عدد المراجعين', data:[3455,127,46,521,120,76,60,47,36,33,9,7,6,5,1,1,0,0] }],
        xaxis:{ categories:['كربلاء','بغداد','النجف','بابل','ذي قار','واسط','البصرة','القادسية','ميسان','المثنى','ديالى','كركوك','نينوى','صالح الدين','اربيل','سليمانية','الانبار','دهوك'], labels:{style:{fontSize:'8px',colors:tx},rotate:-40} },
        colors:['#3b82f6'], plotOptions:{ bar:{ borderRadius:4, columnWidth:'60%' } },
        dataLabels:{enabled:false}, legend:{show:false},
        yaxis:{labels:{style:{colors:tx}}}, tooltip:{theme:'light'}
    }).render();

    // Chart 4: Donut - Outside Iraq consultations
    new ApexCharts(document.querySelector('#chart-report-4'), {
        chart:{ type:'donut', height:200, background:'transparent', toolbar:{show:false} },
        series:[6,4,2,1,1,1], labels:['ايران','افغانستان','سوريا','مصر','نيجيريا','باكستان'],
        colors:['#ff4d7e','#f59e0b','#10b981','#3b82f6','#8b5cf6','#06b6d4'],
        legend:{ position:'bottom', labels:{colors:tx}, fontSize:'11px' },
        dataLabels:{ style:{fontSize:'10px'} }
    }).render();

    // Chart 5: Horizontal Bar - Visual tests
    new ApexCharts(document.querySelector('#chart-report-5'), {
        chart:{ type:'bar', height:220, background:'transparent', toolbar:{show:false} },
        series:[{ name:'العدد', data:[4730,641,1444,135,67,142,61,12,8] }],
        xaxis:{ categories:['فحص البصر','قوة العدسة','OCT','سونار','FUNDUS','C.T','S.M','فلورسين','FDT'], labels:{style:{fontSize:'9px',colors:tx}} },
        colors:C, plotOptions:{ bar:{ borderRadius:5, distributed:true, columnWidth:'65%' } },
        legend:{show:false}, dataLabels:{enabled:true, style:{fontSize:'9px', fontWeight:'700'}},
        yaxis:{labels:{style:{colors:tx}}}, tooltip:{theme:'light'}
    }).render();

    // Chart 6: RadialBar - Lab
    new ApexCharts(document.querySelector('#chart-report-6'), {
        chart:{ type:'radialBar', height:220, background:'transparent', sparkline:{enabled:true} },
        series:[100], colors:['#8b5cf6'],
        plotOptions:{ radialBar:{ hollow:{size:'55%'}, dataLabels:{
            name:{show:true, fontSize:'11px', color:tx, offsetY:-10, formatter:()=>'مراجعو المختبر'},
            value:{fontSize:'24px', fontWeight:'800', color:tx, offsetY:8, formatter:()=>'4566'}
        }}}
    }).render();

    // Chart 7: Stacked Bar - Surgery types
    new ApexCharts(document.querySelector('#chart-report-7'), {
        chart:{ type:'bar', height:260, background:'transparent', stacked:true, toolbar:{show:false} },
        series:[
            { name:'قطاع الصحة', data:[13,1257,46,19,128,1] },
            { name:'العتبة الخاص', data:[13,0,41,51,189,89] },
            { name:'العتبة العام', data:[7,0,16,15,117,0] }
        ],
        xaxis:{ categories:['صغرى','وسطى (حقن)','وسطى (ليزر)','كبرى','فوق الكبرى','خاصة'], labels:{style:{fontSize:'10px',colors:tx}} },
        colors:['#3b82f6','#ff4d7e','#10b981'],
        plotOptions:{ bar:{ borderRadius:4, columnWidth:'55%' } },
        legend:{ position:'top', labels:{colors:tx}, fontSize:'11px' },
        dataLabels:{enabled:false}, yaxis:{labels:{style:{colors:tx}}}, tooltip:{theme:'light'}
    }).render();

    // Chart 8: Bar - Surgery governorates
    new ApexCharts(document.querySelector('#chart-report-8'), {
        chart:{ type:'bar', height:220, background:'transparent', toolbar:{show:false} },
        series:[{ name:'عدد المرضى', data:[1249,72,9,444,83,53,31,25,14,7,5,4,3,1,1,0,0,0] }],
        xaxis:{ categories:['كربلاء','بغداد','النجف','بابل','ذي قار','واسط','القادسية','البصرة','ميسان','المثنى','ديالى','نينوى','صالح الدين','اربيل','سليمانية','الانبار','كركوك','دهوك'], labels:{style:{fontSize:'8px',colors:tx},rotate:-40} },
        colors:['#10b981'], plotOptions:{ bar:{ borderRadius:4, columnWidth:'60%' } },
        dataLabels:{enabled:false}, legend:{show:false},
        yaxis:{labels:{style:{colors:tx}}}, tooltip:{theme:'light'}
    }).render();

    // Chart 9: Donut - Surgery outside Iraq
    new ApexCharts(document.querySelector('#chart-report-9'), {
        chart:{ type:'donut', height:180, background:'transparent', toolbar:{show:false} },
        series:[1,0,0], labels:['افغانستان','سوريا','لبنان'],
        colors:['#f59e0b','#10b981','#3b82f6'],
        legend:{ position:'bottom', labels:{colors:tx}, fontSize:'11px' },
    }).render();

    // Chart 10: Bar - All doctors surgeries total
    new ApexCharts(document.querySelector('#chart-report-10'), {
        chart:{ type:'bar', height:300, background:'transparent', toolbar:{show:false} },
        series:[{ name:'إجمالي العمليات', data:[85,165,22,120,10,146,162,147,189,839,57,12,6,35,2,5] }],
        xaxis:{ categories:['غياث','حمزة','ذوالفقار','منتصر','افراح','مؤيد','بشرى','عالء','نور','حيدر','حذيفه','اريج','خلدون','ايات','م.بدر','زهراء'], labels:{style:{fontSize:'9px',colors:tx},rotate:-40} },
        colors:C, plotOptions:{ bar:{ borderRadius:6, distributed:true, columnWidth:'65%' } },
        legend:{show:false}, dataLabels:{enabled:true, style:{fontSize:'9px', fontWeight:'800'}},
        yaxis:{labels:{style:{colors:tx}}}, tooltip:{theme:'light'}
    }).render();

    // Render first doctor chart
    renderDocChart(1);
}

// ===== INDIVIDUAL DOCTOR CHART =====
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
    1:['قص السائل','رفع ماء اسود','رفع ساد','سليكون+عدسة','زرع عدسة','غسل حجرة','رفع سليكون','حقن ايليليا','حقن افاستين'],
    2:['قص السائل','رفع ساد (خاص)','رفع ساد','سليكون+عدسة','زرع عدسة','زرع صمام','هطول اجفان','تصليب قرنية','غسل حجرة','رفع سليكون','ليزر','تسليك'],
    3:['قص السائل','رفع ساد','حول','رفع سليكون','ليزر'],
    4:['رفع ساد','رفع ظفرة','حقن ايليا','حقن لوسنتس','حقن افاستين','ليزر','تسليك','جسم غريب'],
    5:['زرع صمام','رفع ساد','ليزر'],
    6:['رفع ساد','هطول اجفان','حول','رفع ظفرة','حقن ايليا','حقن افاستين','ليزر','كيس دهني','ورم','تخدير','جسم غريب'],
    7:['رفع ساد','هطول اجفان','تصليب قرنية','غسل حجرة','ليزر','كيس دهني','ورم درمويد','تسليك','جسم غريب'],
    8:['رفع ساد','رفع ظفرة','فابزمو','حقن ايليا','حقن لوسنتس','حقن افاستين','كيناكورت','تخدير'],
    9:['رفع ساد','زرع عدسة','هطول اجفان','حول','رفع ظفرة','حقن ايليا','حقن افاستين','كيناكورت','ليزر'],
    10:['رفع ساد','هطول اجفان','تصليب قرنية','رفع ظفرة','حقن ايليا','حقن افاستين','كيناكورت','اكتيليس','ليزر','كيس دهني','تسليك','جسم غريب'],
    11:['رفع ساد','حول','رفع ظفرة','حقن افاستين','ليزر'],
    12:['رفع ساد','ليزر','كيس دهني'],
    13:['رفع ساد','ليزر','كيس دهني'],
    14:['رفع ساد','ليزر'],
    15:['رفع ساد','هطول اجفان','تصليب قرنية','حقن ايليا','حقن افاستين','ليزر','كيس دهني'],
    16:['رفع ساد']
};

function renderDocChart(id) {
    const el = document.querySelector('#chart-doc-' + id);
    if (!el || window['chartDocDone'+id]) return;
    window['chartDocDone'+id] = true;
    const tx = getTC();
    new ApexCharts(el, {
        chart:{ type:'donut', height:260, background:'transparent', toolbar:{show:false} },
        series: docOpsData[id] || [1],
        labels: docNamesData[id] || [''],
        colors: C,
        legend:{ position:'bottom', labels:{colors:tx}, fontSize:'9px', show: (docOpsData[id]||[]).length <= 8 },
        dataLabels:{ enabled:(docOpsData[id]||[]).length <= 5, style:{fontSize:'9px'} },
        tooltip:{ theme:'light' }
    }).render();
}
</script>
