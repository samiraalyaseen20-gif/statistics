<!-- PAGE 2: REPORTS PAGE SECTION - COMPLETE VERSION -->
<section id="page-reports" class="page-section space-y-8 hidden">
    
    <!-- Filter Bar -->
    <div class="custom-card p-4 sm:p-5 rounded-2xl flex flex-col lg:flex-row gap-4 items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-text-main flex items-center gap-2">
                <i data-lucide="file-bar-chart-2" class="w-5 h-5 text-theme-pink"></i>
                الإحصاءات الطبية - مركز السيدة زينب الكبرى (ع)
            </h2>
            <p class="text-[11px] text-text-main opacity-60 mt-0.5">جميع الجداول (1-10) + الإحصائية التفصيلية لـ 16 طبيب</p>
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

    <!-- ======================== جدول (1) و (2) ======================== -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- TABLE 1 -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="report-section-title"><i data-lucide="stethoscope" class="w-4 h-4 text-theme-pink"></i>جدول رقم (1): أعداد المراجعين في الاستشاريات</h3>
            <table class="report-table">
                <thead><tr class="report-thead-row"><th class="w-12 text-center">ت</th><th>اسم الوحدة الطبية</th><th class="text-center">المجموع</th></tr></thead>
                <tbody>
                    <tr class="report-row"><td class="text-center">1</td><td>استشارية العيون العامة</td><td class="text-center font-bold">3375</td></tr>
                    <tr class="report-row"><td class="text-center">2</td><td>استشارية التخصصات الدقيقة</td><td class="text-center font-bold">1091</td></tr>
                    <tr class="report-total-row"><td class="text-center" colspan="2">المجموع</td><td class="text-center">4566</td></tr>
                </tbody>
            </table>
        </div>

        <!-- TABLE 2 -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="report-section-title"><i data-lucide="users" class="w-4 h-4 text-emerald-500"></i>جدول رقم (2): أعداد مراجعين الاستشارية لكل طبيب اختصاص</h3>
            <div class="max-h-[220px] overflow-y-auto custom-scrollbar pr-1">
                <table class="report-table">
                    <thead><tr class="report-thead-row"><th class="w-10 text-center">ت</th><th>اسم الطبيب</th><th class="text-center">المراجعون</th></tr></thead>
                    <tbody>
                        <tr class="report-row"><td class="text-center">1</td><td>د. غياث الدين ثجيل نعمة</td><td class="text-center font-bold">177</td></tr>
                        <tr class="report-row"><td class="text-center">2</td><td>د. حمزة صادق علوان الشريفي</td><td class="text-center font-bold">562</td></tr>
                        <tr class="report-row"><td class="text-center">3</td><td>د. ذوالفقار غني الكندي</td><td class="text-center font-bold">120</td></tr>
                        <tr class="report-row"><td class="text-center">4</td><td>د. منتصر محمد عرب</td><td class="text-center font-bold">212</td></tr>
                        <tr class="report-row"><td class="text-center">5</td><td>د. افراح عبد الزهرة القصير</td><td class="text-center font-bold">120</td></tr>
                        <tr class="report-row"><td class="text-center">6</td><td>د. مؤيد عبد اللطيف صبار</td><td class="text-center font-bold">346</td></tr>
                        <tr class="report-row"><td class="text-center">7</td><td>د. بشرى سليمان علي الصقر</td><td class="text-center font-bold">1204</td></tr>
                        <tr class="report-row"><td class="text-center">8</td><td>د. عالء صبري الغانمي</td><td class="text-center font-bold">56</td></tr>
                        <tr class="report-row"><td class="text-center">9</td><td>د. نور رعد كريم</td><td class="text-center font-bold">194</td></tr>
                        <tr class="report-row"><td class="text-center">10</td><td>د. حيدر حسين علي الموسوي</td><td class="text-center font-bold">729</td></tr>
                        <tr class="report-row"><td class="text-center">11</td><td>د. حذيفه سامي جواد العبايجي</td><td class="text-center font-bold">348</td></tr>
                        <tr class="report-row"><td class="text-center">12</td><td>د. اريج هادي كريم</td><td class="text-center font-bold">134</td></tr>
                        <tr class="report-row"><td class="text-center">13</td><td>د. زهراء علوان عيدان الحمداني</td><td class="text-center font-bold">106</td></tr>
                        <tr class="report-row"><td class="text-center">14</td><td>د. ايات معتز محمد</td><td class="text-center font-bold">171</td></tr>
                        <tr class="report-row"><td class="text-center">15</td><td>د. محمد بدر محمد الجريان</td><td class="text-center font-bold">87</td></tr>
                        <tr class="report-total-row"><td colspan="2" class="text-center">المجموع</td><td class="text-center">4566</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ======================== جدول (3) و (4) ======================== -->
    <div class="custom-card p-6 rounded-2xl space-y-6">
        <h3 class="report-section-title"><i data-lucide="map" class="w-4 h-4 text-sky-500"></i>جدول رقم (3): التوزيع الديمغرافي لمراجعي الاستشاريات — داخل العراق</h3>
        <div class="overflow-x-auto">
            <table class="report-table text-center">
                <thead>
                    <tr class="report-thead-row">
                        <th>كربلاء</th><th>بغداد</th><th>النجف</th><th>بابل</th><th>ذي قار</th><th>واسط</th><th>البصرة</th><th>القادسية</th><th>ميسان</th><th>المثنى</th><th>ديالى</th><th>كركوك</th><th>نينوى</th><th>صالح الدين</th><th>اربيل</th><th>سليمانية</th><th>الانبار</th><th>دهوك</th><th class="bg-sky-50/50 text-sky-600">المجموع</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="report-row font-bold">
                        <td>3455</td><td>127</td><td>46</td><td>521</td><td>120</td><td>76</td><td>60</td><td>47</td><td>36</td><td>33</td><td>9</td><td>7</td><td>6</td><td>5</td><td>1</td><td>1</td><td>0</td><td>0</td><td class="text-sky-600 font-extrabold">4550</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <h3 class="report-section-title mt-4"><i data-lucide="globe" class="w-4 h-4 text-indigo-500"></i>جدول رقم (4): التوزيع الديمغرافي لمراجعي الاستشاريات — خارج العراق</h3>
        <div class="overflow-x-auto">
            <table class="report-table text-center w-auto">
                <thead><tr class="report-thead-row"><th class="px-6">ايران</th><th class="px-6">افغانستان</th><th class="px-6">سوريا</th><th class="px-6">مصر</th><th class="px-6">نيجيريا</th><th class="px-6">باكستان</th><th class="px-6 bg-indigo-50/50 text-indigo-600">المجموع</th></tr></thead>
                <tbody>
                    <tr class="report-row font-bold text-center">
                        <td>6</td><td>4</td><td>2</td><td>1</td><td>1</td><td>1</td><td class="text-indigo-600 font-extrabold">16</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ======================== جدول (5) و (6) ======================== -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- TABLE 5 -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="report-section-title"><i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>جدول رقم (5): إجمالي أعداد الفحوصات البصرية والساندة</h3>
            <table class="report-table">
                <thead><tr class="report-thead-row"><th>نوع الفحص</th><th class="text-center">المجموع</th></tr></thead>
                <tbody>
                    <tr class="report-row"><td>فحص البصر</td><td class="text-center font-bold">4730</td></tr>
                    <tr class="report-row"><td>فحص قوة العدسة</td><td class="text-center font-bold">641</td></tr>
                    <tr class="report-row"><td>فحص الشبكية OCT</td><td class="text-center font-bold">1444</td></tr>
                    <tr class="report-row"><td>فحص سونار العين</td><td class="text-center font-bold">135</td></tr>
                    <tr class="report-row"><td>فحص قاع العين FUNDUS</td><td class="text-center font-bold">67</td></tr>
                    <tr class="report-row"><td>فحص تصوير القرنية C.T</td><td class="text-center font-bold">142</td></tr>
                    <tr class="report-row"><td>فحص خايا القرنية S.M</td><td class="text-center font-bold">61</td></tr>
                    <tr class="report-row"><td>فحص صبغة الفلورسين</td><td class="text-center font-bold">12</td></tr>
                    <tr class="report-row"><td>فحص الساحة البصرية FDT</td><td class="text-center font-bold">8</td></tr>
                    <tr class="report-total-row"><td>المجموع الكلي</td><td class="text-center">7240</td></tr>
                </tbody>
            </table>
        </div>

        <!-- TABLE 6 -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="report-section-title"><i data-lucide="test-tube" class="w-4 h-4 text-purple-500"></i>جدول رقم (6): أعداد مراجعي المختبر والتحاليل المختبرية</h3>
            <table class="report-table mb-4">
                <thead><tr class="report-thead-row"><th>البيان</th><th class="text-center">العدد</th></tr></thead>
                <tbody>
                    <tr class="report-row"><td>أعداد المراجعين للمختبر</td><td class="text-center font-bold text-theme-pink">4566</td></tr>
                    <tr class="report-row"><td>أعداد التحاليل المختبرية المنجزة</td><td class="text-center font-bold text-purple-600">—</td></tr>
                </tbody>
            </table>
            <div class="mt-4">
                <p class="text-[10px] font-bold text-text-main opacity-60 mb-2">ملاحظة: وحدة التحاليل المختبرية تشمل:</p>
                <div class="flex flex-wrap gap-1.5">
                    @foreach(['RBS', 'WBC', 'Hp', 'PCV', 'HIV', 'HCV', 'HBV', 'PT', 'PTT', 'INR'] as $test)
                        <span class="text-[10px] font-bold bg-purple-50/50 text-purple-700 border border-purple-100 px-2 py-1 rounded-lg">{{ $test }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- ======================== جدول (7) ======================== -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="report-section-title"><i data-lucide="activity" class="w-4 h-4 text-rose-500"></i>جدول رقم (7): أعداد وتصنيف العمليات الجراحية للعيون</h3>
        <div class="overflow-x-auto">
            <table class="report-table text-center">
                <thead>
                    <tr class="report-thead-row">
                        <th class="text-right">تصنيف العمليات الجراحية</th>
                        <th>قطاع الصحة</th>
                        <th>قطاع العتبة الخاص</th>
                        <th>قطاع العتبة العام</th>
                        <th class="text-rose-600 bg-rose-50/50">المجموع</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="report-row"><td class="text-right">العمليات الصغرى</td><td>13</td><td>13</td><td>7</td><td class="font-bold">33</td></tr>
                    <tr class="report-row"><td class="text-right">العمليات الوسطى (حقن العين)</td><td>1257</td><td>0</td><td>0</td><td class="font-bold">1257</td></tr>
                    <tr class="report-row"><td class="text-right">العمليات الوسطى (الليزر)</td><td>46</td><td>41</td><td>16</td><td class="font-bold">103</td></tr>
                    <tr class="report-row"><td class="text-right">العمليات الكبرى</td><td>19</td><td>51</td><td>15</td><td class="font-bold">85</td></tr>
                    <tr class="report-row"><td class="text-right">العمليات فوق الكبرى</td><td>128</td><td>189</td><td>117</td><td class="font-bold">434</td></tr>
                    <tr class="report-row"><td class="text-right">العمليات الخاصة</td><td>1</td><td>89</td><td>0</td><td class="font-bold">90</td></tr>
                    <tr class="report-total-row">
                        <td class="text-right">المجموع</td>
                        <td>1464</td><td>383</td><td>155</td>
                        <td class="text-rose-700 font-extrabold text-sm">2002</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ======================== جدول (8) و (9) ======================== -->
    <div class="custom-card p-6 rounded-2xl space-y-6">
        <h3 class="report-section-title"><i data-lucide="map-pin" class="w-4 h-4 text-emerald-500"></i>جدول رقم (8): التوزيع الديمغرافي لمرضى العمليات الجراحية — داخل العراق</h3>
        <div class="overflow-x-auto">
            <table class="report-table text-center">
                <thead>
                    <tr class="report-thead-row">
                        <th>كربلاء</th><th>بغداد</th><th>النجف</th><th>بابل</th><th>ذي قار</th><th>واسط</th><th>القادسية</th><th>البصرة</th><th>ميسان</th><th>المثنى</th><th>ديالى</th><th>نينوى</th><th>صالح الدين</th><th>اربيل</th><th>سليمانية</th><th>الانبار</th><th>كركوك</th><th>دهوك</th><th class="bg-emerald-50/50 text-emerald-600">المجموع</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="report-row font-bold">
                        <td>1249</td><td>72</td><td>9</td><td>444</td><td>83</td><td>53</td><td>31</td><td>25</td><td>14</td><td>7</td><td>5</td><td>4</td><td>3</td><td>1</td><td>1</td><td>0</td><td>0</td><td>0</td><td class="text-emerald-600 font-extrabold">2001</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3 class="report-section-title"><i data-lucide="globe" class="w-4 h-4 text-teal-500"></i>جدول رقم (9): التوزيع الديمغرافي لمرضى العمليات الجراحية — خارج العراق</h3>
        <div class="overflow-x-auto">
            <table class="report-table text-center w-auto">
                <thead><tr class="report-thead-row"><th class="px-8">افغانستان</th><th class="px-8">سوريا</th><th class="px-8">لبنان</th><th class="px-8 bg-teal-50/50 text-teal-600">المجموع</th></tr></thead>
                <tbody>
                    <tr class="report-row font-bold text-center">
                        <td>1</td><td>0</td><td>0</td><td class="text-teal-600 font-extrabold">1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ======================== جدول (10) ======================== -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="report-section-title"><i data-lucide="scissors" class="w-4 h-4 text-indigo-500"></i>جدول رقم (10): أعداد العمليات الجراحية لكل طبيب اختصاص — جميع القطاعات (16 طبيب)</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-center text-[10px] border-collapse">
                <thead>
                    <tr class="text-text-main opacity-80 border-b-2 border-slate-200/30 bg-slate-50/80">
                        <th class="py-2.5 border-l border-slate-200/20 px-2 w-6" rowspan="2">ت</th>
                        <th class="py-2.5 border-l border-slate-200/20 px-3 text-right min-w-[140px]" rowspan="2">الطبيب</th>
                        <th class="py-1.5 border-l border-slate-200/20 font-bold bg-yellow-50/50" colspan="3">صغرى</th>
                        <th class="py-1.5 border-l border-slate-200/20 font-bold bg-blue-50/50" colspan="3">وسطى</th>
                        <th class="py-1.5 border-l border-slate-200/20 font-bold bg-orange-50/50" colspan="3">كبرى</th>
                        <th class="py-1.5 border-l border-slate-200/20 font-bold bg-rose-50/50" colspan="3">فوق الكبرى</th>
                        <th class="py-1.5 border-l border-slate-200/20 font-bold bg-purple-50/50" colspan="3">خاصة</th>
                        <th class="py-2.5 font-bold text-theme-pink text-xs" rowspan="2">المجموع</th>
                    </tr>
                    <tr class="text-[9px] text-text-main opacity-60 border-b border-slate-200/30">
                        <th class="py-1 border-l border-slate-200/20">ص</th><th class="py-1 border-l border-slate-200/20">خ</th><th class="py-1 border-l border-slate-200/20">ع</th>
                        <th class="py-1 border-l border-slate-200/20">ص</th><th class="py-1 border-l border-slate-200/20">خ</th><th class="py-1 border-l border-slate-200/20">ع</th>
                        <th class="py-1 border-l border-slate-200/20">ص</th><th class="py-1 border-l border-slate-200/20">خ</th><th class="py-1 border-l border-slate-200/20">ع</th>
                        <th class="py-1 border-l border-slate-200/20">ص</th><th class="py-1 border-l border-slate-200/20">خ</th><th class="py-1 border-l border-slate-200/20">ع</th>
                        <th class="py-1 border-l border-slate-200/20">ص</th><th class="py-1 border-l border-slate-200/20">خ</th><th class="py-1 border-l border-slate-200/20">ع</th>
                    </tr>
                </thead>
                <tbody class="text-text-main">
                    @php
                    $doctors10 = [
                        ['num'=>1,'name'=>'د. غياث الدين ثجيل نعمه','data'=>[2,1,0,31,0,0,3,6,0,3,10,0,1,28,0],'total'=>85],
                        ['num'=>2,'name'=>'د. حمزة صادق علوان الشريفي','data'=>[0,1,0,0,11,4,0,27,9,0,55,8,0,50,0],'total'=>165],
                        ['num'=>3,'name'=>'د. ذو الفقار غني عبد','data'=>[0,0,0,0,2,1,0,4,0,0,5,0,0,10,0],'total'=>22],
                        ['num'=>4,'name'=>'د. منتصر محمد عرب','data'=>[1,1,0,101,0,0,1,0,0,15,1,0,0,0,0],'total'=>120],
                        ['num'=>5,'name'=>'د. افراح عبدالزهرة القصير','data'=>[0,0,0,0,2,0,0,0,0,0,7,0,0,1,0],'total'=>10],
                        ['num'=>6,'name'=>'د. مؤيد عبد اللطيف صبار','data'=>[3,4,0,86,1,0,4,9,0,27,12,0,0,0,0],'total'=>146],
                        ['num'=>7,'name'=>'د. بشرى سليمان علي الصقر','data'=>[0,2,7,0,1,11,0,0,6,0,28,107,0,0,0],'total'=>162],
                        ['num'=>8,'name'=>'د. عالء صبري الغانمي','data'=>[1,0,0,128,0,0,1,0,0,13,4,0,0,0,0],'total'=>147],
                        ['num'=>9,'name'=>'د. نور رعد كريم','data'=>[0,0,0,151,3,0,2,5,0,11,17,0,0,0,0],'total'=>189],
                        ['num'=>10,'name'=>'د. حيدر حسين علي الموسوي','data'=>[3,1,0,751,14,0,4,0,0,29,37,0,0,0,0],'total'=>839],
                        ['num'=>11,'name'=>'د. حذيفه سامي جواد العبايجي','data'=>[0,0,0,31,6,0,2,0,0,10,8,0,0,0,0],'total'=>57],
                        ['num'=>12,'name'=>'د. اريج هادي كريم','data'=>[0,1,0,1,0,0,0,0,0,8,2,0,0,0,0],'total'=>12],
                        ['num'=>13,'name'=>'د. خلدون خليل نايف','data'=>[0,0,0,1,0,0,0,0,0,4,1,0,0,0,0],'total'=>6],
                        ['num'=>14,'name'=>'د. ايات معتز محمد','data'=>[1,2,0,22,0,0,2,0,0,6,2,0,0,0,0],'total'=>35],
                        ['num'=>15,'name'=>'د. محمد بدر الجريان','data'=>[0,0,0,0,0,0,0,0,0,0,0,2,0,0,0],'total'=>2],
                        ['num'=>16,'name'=>'د. زهراء علوان الحمداني','data'=>[2,0,0,0,1,0,0,0,0,2,0,0,0,0,0],'total'=>5],
                    ];
                    @endphp
                    @foreach($doctors10 as $doc)
                    <tr class="border-b border-slate-200/10 hover:bg-slate-50/30 transition-colors">
                        <td class="py-2 border-l border-slate-200/10 font-medium">{{ $doc['num'] }}</td>
                        <td class="py-2 border-l border-slate-200/10 text-right pr-2 font-bold whitespace-nowrap text-[10px]">{{ $doc['name'] }}</td>
                        @foreach($doc['data'] as $val)
                            <td class="py-2 border-l border-slate-200/10 {{ $val == 0 ? 'text-slate-300' : 'font-bold' }}">{{ $val }}</td>
                        @endforeach
                        <td class="py-2 font-extrabold text-theme-pink text-xs">{{ $doc['total'] }}</td>
                    </tr>
                    @endforeach
                    <!-- Total Row -->
                    <tr class="bg-rose-50/40 text-rose-700 font-extrabold border-t-2 border-rose-200/50">
                        <td class="py-3 border-l border-rose-200/30" colspan="2">المجموع الكلي</td>
                        <td class="py-3 border-l border-rose-200/30">13</td><td class="py-3 border-l border-rose-200/30">13</td><td class="py-3 border-l border-rose-200/30">7</td>
                        <td class="py-3 border-l border-rose-200/30">1303</td><td class="py-3 border-l border-rose-200/30">41</td><td class="py-3 border-l border-rose-200/30">16</td>
                        <td class="py-3 border-l border-rose-200/30">19</td><td class="py-3 border-l border-rose-200/30">51</td><td class="py-3 border-l border-rose-200/30">15</td>
                        <td class="py-3 border-l border-rose-200/30">128</td><td class="py-3 border-l border-rose-200/30">189</td><td class="py-3 border-l border-rose-200/30">117</td>
                        <td class="py-3 border-l border-rose-200/30">1</td><td class="py-3 border-l border-rose-200/30">89</td><td class="py-3 border-l border-rose-200/30">0</td>
                        <td class="py-3 text-sm">2002</td>
                    </tr>
                </tbody>
            </table>
            <p class="text-[9px] text-text-main opacity-40 mt-1">ص = صحة &nbsp;|&nbsp; خ = عتبة خاص &nbsp;|&nbsp; ع = عتبة عام</p>
        </div>
    </div>

    <!-- ======================== الإحصائية التفصيلية لكل طبيب (الملف الثاني) ======================== -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="report-section-title mb-6"><i data-lucide="user-cog" class="w-4 h-4 text-violet-500"></i>الإحصائية التفصيلية لكل طبيب — أيار 2026 (16 طبيب)</h3>
        
        <!-- Tabs -->
        <div class="flex flex-wrap gap-2 mb-6" id="doctor-tabs">
            @php
            $doctorNames = [
                1 => 'د. غياث الدين ثجيل نعمة', 2 => 'د. حمزة صادق علوان', 3 => 'د. ذوالفقار غني',
                4 => 'د. منتصر محمد عرب', 5 => 'د. افراح عبد الزهرة', 6 => 'د. مؤيد عبد اللطيف',
                7 => 'د. بشرى سليمان', 8 => 'د. عالء صبري', 9 => 'د. نور رعد كريم',
                10 => 'د. حيدر حسين', 11 => 'د. حذيفه سامي', 12 => 'د. اريج هادي',
                13 => 'د. زهراء علوان', 14 => 'د. خلدون خليل', 15 => 'د. ايات معتز', 16 => 'د. محمد بدر'
            ];
            @endphp
            @foreach($doctorNames as $id => $name)
            <button onclick="showDoctorDetail({{ $id }})" id="doc-tab-{{ $id }}" 
                class="doc-tab py-1.5 px-3 rounded-xl text-[10px] font-bold text-text-main custom-inset hover-press transition-all {{ $id == 1 ? 'bg-violet-100 text-violet-700' : '' }}">
                {{ $id }}- {{ $name }}
            </button>
            @endforeach
        </div>

        <!-- Doctor Detail Tables -->
        @php
        $doctorDetails = [
            1 => ['name' => 'د. غياث الدين ثجيل نعمة', 'total' => 85, 'ops' => [
                ['قص السائل الزجاجي', 'خاصة', 29],
                ['رفع ماء اسود + رفع ساد', 'خاصة', 2],
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 3],
                ['رفع سليكون + زرع عدسة', 'فوق الكبرى', 8],
                ['زرع عدسة ثانوية', 'فوق الكبرى', 2],
                ['زرع صمام احمد (داء الزرقاء)', 'فوق الكبرى', 0],
                ['غسل حجرة', 'كبرى', 3],
                ['رفع سليكون', 'كبرى', 6],
                ['حقن الايليليا', 'وسطى', 18],
                ['حقن الافاستين', 'وسطى', 13],
            ]],
            2 => ['name' => 'د. حمزة صادق علوان الشريفي', 'total' => 165, 'ops' => [
                ['قص السائل الزجاجي', 'خاصة', 50],
                ['رفع ماء اسود + رفع ساد', 'خاصة', 2],
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 56],
                ['رفع سليكون + زرع عدسة', 'فوق الكبرى', 5],
                ['زرع عدسة ثانوية', 'فوق الكبرى', 1],
                ['زرع صمام احمد (داء الزرقاء)', 'فوق الكبرى', 1],
                ['تعديل هطول الاجفان', 'كبرى', 1],
                ['تصليب القرنية', 'كبرى', 1],
                ['غسل حجرة', 'كبرى', 9],
                ['رفع سليكون', 'كبرى', 25],
                ['الليزر', 'وسطى', 15],
                ['تسليك مجرى الدمع', 'صغرى', 1],
            ]],
            3 => ['name' => 'د. ذوالفقار غني عبد الكندي', 'total' => 22, 'ops' => [
                ['قص السائل الزجاجي', 'خاصة', 10],
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 5],
                ['الحول', 'كبرى', 1],
                ['رفع سليكون', 'كبرى', 3],
                ['الليزر', 'وسطى', 3],
            ]],
            4 => ['name' => 'د. منتصر محمد عرب', 'total' => 120, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 16],
                ['رفع ظفرة', 'كبرى', 1],
                ['حقن الايليا', 'وسطى', 52],
                ['حقن اللوسنتس', 'وسطى', 11],
                ['حقن الافاستين', 'وسطى', 30],
                ['الليزر', 'وسطى', 8],
                ['تسليك مجرى الدمع', 'صغرى', 1],
                ['رفع جسم غريب (ثالول)', 'صغرى', 1],
            ]],
            5 => ['name' => 'د. افراح عبد الزهرة القصير', 'total' => 10, 'ops' => [
                ['زرع صمام مع رفع ماء اسود + رفع ساد', 'خاصة', 1],
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 7],
                ['الليزر', 'وسطى', 2],
            ]],
            6 => ['name' => 'د. مؤيد عبد اللطيف صبار', 'total' => 146, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 39],
                ['تعديل هطول الاجفان', 'كبرى', 1],
                ['الحول', 'كبرى', 10],
                ['رفع ظفرة', 'كبرى', 2],
                ['حقن الايليا', 'وسطى', 58],
                ['حقن الافاستين', 'وسطى', 26],
                ['الليزر', 'وسطى', 3],
                ['رفع كيس دهني', 'صغرى', 4],
                ['رفع ورم من مجرى الدمع', 'صغرى', 1],
                ['فحص تحت التخدير العام', 'صغرى', 1],
                ['رفع جسم غريب (خيط)', 'صغرى', 1],
            ]],
            7 => ['name' => 'د. بشرى سليمان علي الصقر', 'total' => 162, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 135],
                ['تعديل هطول الاجفان', 'كبرى', 1],
                ['تصليب القرنية', 'كبرى', 4],
                ['غسل حجرة', 'كبرى', 1],
                ['الليزر', 'وسطى', 21],
                ['رفع كيس دهني', 'صغرى', 3],
                ['رفع ورم (درمويد)', 'صغرى', 1],
                ['تسليك مجرى الدمع', 'صغرى', 3],
                ['رفع جسم غريب', 'صغرى', 1],
                ['رفع جسم غريب (خيط)', 'صغرى', 1],
            ]],
            8 => ['name' => 'د. عالء صبري الغانمي', 'total' => 147, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 17],
                ['رفع ظفرة', 'كبرى', 1],
                ['حقن الفابزمو', 'وسطى', 3],
                ['حقن الايليا', 'وسطى', 82],
                ['حقن اللوسنتس', 'وسطى', 23],
                ['حقن الافاستين', 'وسطى', 18],
                ['حقن الكيناكورت', 'وسطى', 2],
                ['فحص تحت التخدير العام', 'صغرى', 1],
            ]],
            9 => ['name' => 'د. نور رعد كريم', 'total' => 189, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 27],
                ['زرع عدسة ثانوية', 'فوق الكبرى', 1],
                ['تعديل هطول الاجفان', 'كبرى', 1],
                ['الحول', 'كبرى', 4],
                ['رفع ظفرة', 'كبرى', 2],
                ['حقن الايليا', 'وسطى', 45],
                ['حقن الافاستين', 'وسطى', 101],
                ['حقن الكيناكورت', 'وسطى', 1],
                ['الليزر', 'وسطى', 7],
            ]],
            10 => ['name' => 'د. حيدر حسين علي الموسوي', 'total' => 839, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 66],
                ['تعديل هطول الاجفان', 'كبرى', 1],
                ['تصليب القرنية', 'كبرى', 2],
                ['رفع ظفرة', 'كبرى', 1],
                ['حقن الايليا', 'وسطى', 148],
                ['حقن الافاستين', 'وسطى', 572],
                ['حقن الكيناكورت', 'وسطى', 15],
                ['حقن الاكتيليس', 'وسطى', 1],
                ['الليزر', 'وسطى', 29],
                ['رفع كيس دهني', 'صغرى', 1],
                ['تسليك مجرى الدمع', 'صغرى', 2],
                ['رفع جسم غريب (من القرنية)', 'صغرى', 1],
            ]],
            11 => ['name' => 'د. حذيفه سامي جواد العبايجي', 'total' => 57, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 18],
                ['الحول', 'كبرى', 1],
                ['رفع ظفرة', 'كبرى', 1],
                ['حقن الافاستين', 'وسطى', 30],
                ['الليزر', 'وسطى', 7],
            ]],
            12 => ['name' => 'د. اريج هادي كريم', 'total' => 12, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 10],
                ['الليزر', 'وسطى', 1],
                ['رفع كيس دهني', 'صغرى', 1],
            ]],
            13 => ['name' => 'د. زهراء علوان عيدان الحمداني', 'total' => 5, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 2],
                ['الليزر', 'وسطى', 1],
                ['رفع كيس دهني', 'صغرى', 2],
            ]],
            14 => ['name' => 'د. خلدون خليل نايف', 'total' => 6, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 5],
                ['الليزر', 'وسطى', 1],
            ]],
            15 => ['name' => 'د. ايات معتز محمد', 'total' => 35, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 8],
                ['تعديل هطول الاجفان', 'كبرى', 1],
                ['تصليب القرنية', 'كبرى', 1],
                ['حقن الايليا', 'وسطى', 1],
                ['حقن الافاستين', 'وسطى', 20],
                ['الليزر', 'وسطى', 1],
                ['رفع كيس دهني', 'صغرى', 3],
            ]],
            16 => ['name' => 'د. محمد بدر محمد الجريان', 'total' => 2, 'ops' => [
                ['رفع ساد + زراعة عدسة', 'فوق الكبرى', 2],
            ]],
        ];
        @endphp

        @foreach($doctorDetails as $id => $doctor)
        <div id="doctor-detail-{{ $id }}" class="doctor-detail-panel {{ $id == 1 ? '' : 'hidden' }}">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-extrabold text-text-main flex items-center gap-2">
                    <span class="w-7 h-7 rounded-xl bg-violet-100 text-violet-700 text-xs font-black flex items-center justify-center">{{ $id }}</span>
                    {{ $doctor['name'] }}
                </h4>
                <span class="text-xs font-bold text-white bg-violet-500 px-3 py-1 rounded-full">المجموع: {{ $doctor['total'] }} عملية</span>
            </div>
            <table class="report-table w-full sm:w-2/3 lg:w-1/2">
                <thead>
                    <tr class="report-thead-row">
                        <th class="w-10 text-center">ت</th>
                        <th>اسم العملية</th>
                        <th class="text-center min-w-[100px]">التصنيف</th>
                        <th class="text-center">العدد</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctor['ops'] as $idx => $op)
                    <tr class="report-row">
                        <td class="text-center">{{ $idx + 1 }}</td>
                        <td>{{ $op[0] }}</td>
                        <td class="text-center">
                            @php
                            $badgeColor = match($op[1]) {
                                'خاصة' => 'bg-purple-100 text-purple-700',
                                'فوق الكبرى' => 'bg-rose-100 text-rose-700',
                                'كبرى' => 'bg-orange-100 text-orange-700',
                                'وسطى' => 'bg-blue-100 text-blue-700',
                                'صغرى' => 'bg-yellow-100 text-yellow-700',
                                default => 'bg-slate-100 text-slate-700'
                            };
                            @endphp
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $badgeColor }}">{{ $op[1] }}</span>
                        </td>
                        <td class="text-center font-bold text-violet-600">{{ $op[2] }}</td>
                    </tr>
                    @endforeach
                    <tr class="report-total-row">
                        <td colspan="3" class="text-center">المجموع</td>
                        <td class="text-center">{{ $doctor['total'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
    </div>

    <!-- Signature Footer -->
    <div class="custom-card p-6 rounded-2xl">
        <div class="grid grid-cols-2 gap-4 text-center text-xs text-text-main">
            <div class="border-l border-slate-200/20 pl-4">
                <p class="font-bold mb-1">المهندسة</p>
                <p class="font-black text-sm">سميره علي ياسين</p>
                <p class="opacity-60 mt-1">مسؤول الإحصاء الطبي</p>
            </div>
            <div class="pr-4">
                <p class="font-bold mb-1">الطبيب الاستشاري</p>
                <p class="font-black text-sm">د. عدي عبد الحسين السالمي</p>
                <p class="opacity-60 mt-1">مدير مركز السيدة زينب الكبرى (ع) الجراحي التخصصي للعيون</p>
            </div>
        </div>
    </div>

</section>

<style>
    .report-section-title {
        @apply text-sm font-bold text-text-main mb-4 flex items-center gap-2 border-b border-slate-200/20 pb-3;
    }
    .report-table {
        @apply w-full text-right text-xs border-collapse;
    }
    .report-thead-row th {
        @apply pb-3 pt-1 font-bold text-text-main opacity-70 border-b border-slate-200/20 px-2;
    }
    .report-row td {
        @apply py-2.5 border-b border-slate-200/10 px-2 text-text-main;
    }
    .report-row:hover td {
        @apply bg-slate-50/30;
    }
    .report-total-row td {
        @apply py-3 font-extrabold text-theme-pink bg-pink-50/20 px-2;
    }
</style>

<script>
function showDoctorDetail(id) {
    document.querySelectorAll('.doctor-detail-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.doc-tab').forEach(t => {
        t.classList.remove('bg-violet-100', 'text-violet-700');
    });
    document.getElementById('doctor-detail-' + id).classList.remove('hidden');
    const tab = document.getElementById('doc-tab-' + id);
    if (tab) tab.classList.add('bg-violet-100', 'text-violet-700');
}
</script>
