<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Division;
use App\Models\Province;
use App\Models\Tehsil;
use Illuminate\Database\Seeder;

class localitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provArr = ['Azad Jammu and Kashmir',
            'Balochistan',
            'Gilgit-Baltistan',
            'Islamabad Capital Territory',
            'Khyber Pakhtunkhwa',
            'Punjab',
            'Sindh'];
        $prvArr = [];
        foreach ($provArr as $prov) {
            $prvArr[] = [
                'name' => $prov,
                'slug' => str_replace(' ', '-', strtolower($prov)),
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        Province::insert($prvArr);

        $divisionArr = [
            ['Bahawalpur', '6'],
            ['Dera Ghazi Khan', '6'],
            ['Lahore', '6'],
            ['Gujranwala', '6'],
            ['Multan', '6'],
            ['Sahiwal', '6'],
            ['Sargodha', '6'],
            ['Rawalpindi', '6'],
            ['Faisalabad', '6'],
        ];
        $divArr = [];
        foreach ($divisionArr as $div) {
            $divArr[] = [
                'name' => $div[0],
                'slug' => str_replace(' ', '-', strtolower($div[0])),
                'province_idfk' => $div[1],
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        Division::insert($divArr);

        $districtArr = [
            [
                [
                    ['Bahawalnagar', 'بھاولنگر'],
                    ['Bahawalpur', 'بہاولپور'],
                    ['Rahimyar khan', 'رحیم یار خان'],
                ],
                '1'
            ],
            [
                [
                    ['Dera Ghazi Khan', 'ڈیرہ غازی خان'],
                    ['Layyah', 'لیہ'],
                    ['Muzaffargarh', 'مظفر گڑھ'],
                    ['Rajanpur', 'راجن پور'],
                ],
                '2'
            ],
            [
                [
                    ['Kasur', 'قصور'],
                    ['Lahore', 'لاہور'],
                    ['Nankana sahib', 'ننکانہ صاحب'],
                    ['Sheikhupura', ''],
                ],
                '3'
            ],
            [
                [
                    ['Gujranwala', 'گوجرانوالہ'],
                    ['Gujrat', 'گجرات'],
                    ['Hafizabad', 'حافظ آباد'],
                    ['Mandi baha ud din', 'منڈی بہاوالدین'],
                    ['Narowal', 'نارووال'],
                    ['Sialkot', 'سيالكوٹ'],
                ],
                '4'
            ],
            [
                [
                    ['Khanewal', 'خانیوال'],
                    ['Lodhran', 'لودھراں'],
                    ['Multan', 'ملتان'],
                    ['Vehari', '‬وہاڑی'],
                ],
                '5'
            ],
            [
                [
                    ['Okara', 'اوکاڑا'],
                    ['Pakpattan', 'پاکپتن'],
                    ['Sahiwal', 'ساہیوال'],
                ],
                '6'
            ],
            [
                [
                    ['Bhakkar', 'بھکر'],
                    ['Khushab', 'خوشاب'],
                    ['Mianwali', 'میانوالی'],
                    ['Sargodha', 'سرگودھا'],
                ],
                '7'
            ],
            [
                [
                    ['Attock', 'اٹک'],
                    ['Chakwal', 'چکوال'],
                    ['Jhelum', 'جہلم'],
                    ['Rawalpindi', 'راولپنڈی'],
                ],
                '8'
            ],
            [
                [
                    ['Chiniot', 'چنیوٹ'],
                    ['Faisalabad', 'فیصل آباد'],
                    ['Jhang', '‪جھنگ‬'],
                    ['Toba tek singh', 'ٹوبہ ٹیک سنگھ'],
                ],
                '9'
            ],
        ];
        $distArr = [];
        foreach ($districtArr as $dist) {
            foreach ($dist[0] as $name) {
                $distArr[] = [
                    'name' => $name[0],
                    'name_ur' => $name[1],
                    'slug' => str_replace(' ', '-', strtolower($name[0])),
                    'division_idfk' => $dist[1],
                    'created_by' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }
        }
        District::insert($distArr);
        sleep(3);
        $district = District::all(); $arr = [];
        foreach ($district as $item) {
            $arr[$item->slug] = $item->id;
        }
        $tahsilArr = [];
        $tehArr = [
            ['ATTOCK', 'اٹک', 'attock'],
            ['FATEHJANG', 'فتح جنگ', 'attock'],
            ['HASSANABDAL', 'حسن ابدال', 'attock'],
            ['HAZRO', 'ہیزرو', 'attock'],
            ['JAND', 'جنڈ', 'attock'],
            ['PINDIGHEB', 'پنڈی گھیب', 'attock'],
            ['BAHAWALNAGAR', 'بھاولنگر', 'bahawalnagar'],
            ['CHISTIAN', 'چشتتیاں', 'bahawalnagar'],
            ['FORTABBASS', 'فورٹ عباس', 'bahawalnagar'],
            ['HAROONABAD', 'ھارون آباد', 'bahawalnagar'],
            ['MINCHINABAD', 'منچن آباد', 'bahawalnagar'],
            ['AHMED PUR EAST', 'احمد پور شرقیہ', 'bahawalpur'],
            ['BAHAWALPUR CITY', 'بہاولپور سٹی', 'bahawalpur'],
            ['HASILPUR', 'حاصل پور', 'bahawalpur'],
            ['KHAIRPUR TAMEWALI', 'خیرپور ٹامیوالی', 'bahawalpur'],
            ['YAZMAN', 'یزمان', 'bahawalpur'],
            ['BAHAWALPUR SADAR', 'بہاولپور صدر', 'bahawalpur'],
            ['TAMEWALI', 'تمیوالی', 'bahawalpur'],
            ['BHAKKAR', 'بھکر', 'bhakkar'],
            ['DARYA KHAN', 'دریا‪ ‬خان', 'bhakkar'],
            ['KALLUR KOT', 'کلورکوٹ', 'bhakkar'],
            ['MANKERA', 'منکیرہ', 'bhakkar'],
            ['CHAKWAL', 'چکوال', 'chakwal'],
            ['CHOA SAIDDEN SHAH', 'چوا سیدن شاہ', 'chakwal'],
            ['KALARKAHAR', 'کلرکہار', 'chakwal'],
            ['TALAGANG', 'تلہ گنگ', 'chakwal'],
            ['LAWA', 'لاوہ', 'chakwal'],
            ['BHOWANA', 'بھوآ نہ', 'chiniot'],
            ['CHINIOT', 'چنیوٹ', 'chiniot'],
            ['LALIAN', 'لالیاں', 'chiniot'],
            ['D.G.KHAN ', 'ڈیرہ غازی خان', 'dera ghazi khan'],
            ['TAUNSA ', 'تونسہ', 'dera ghazi khan'],
            ['KOT CHUTTA', 'کوٹ چھٹہ', 'dera ghazi khan'],
            ['TRIBAL AREA', 'ٹرائیبل ایریا', 'dera ghazi khan'],
            ['CHAK JHUMRA', 'چک جھمرہ', 'faisalabad'],
            ['FAISALABAD CITY', 'فیصل آباد سٹی', 'faisalabad'],
            ['FAISALABAD SADDAR', 'فیصل‪ ‬آباد‪ ‬صدر', 'faisalabad'],
            ['JARANWALA', 'جڑانوالہ', 'faisalabad'],
            ['SAMMUNDRI', '‬سمندری', 'faisalabad'],
            ['TANDLIANWALA', 'تاندلیانوالہ', 'faisalabad'],
            ['GUJRANWALA', 'گوجرانوالہ', 'gujranwala'],
            ['KAMOKE', 'کامونکی', 'gujranwala'],
            ['NOWSHERA VIRKAN', 'نوشہرہ ورکاں', 'gujranwala'],
            ['WAZIRABAD', 'وزیرآباد', 'gujranwala'],
            ['QILA DIDAR SINGH', 'قلعہ دِيدار سِنگھ', 'gujranwala'],
            ['AROOP', 'آروپ', 'gujranwala'],
            ['KHIALI SHAHPUR', 'کھیالی شاہ پور', 'gujranwala'],
            ['NANDIPUR', 'نندی پور', 'gujranwala'],
            ['GUJRAT', 'گجرات', 'gujrat'],
            ['KHARIAN', 'کھاریاں', 'gujrat'],
            ['SARAI ALAM GIR', 'سرائے عالمگیر', 'gujrat'],
            ['HAFIZABAD', 'حافظ آباد', 'hafizabad'],
            ['PINDI BHATTIAN', 'پِنڈى بهٹياں', 'hafizabad'],
            ['AHMAD PUR SIAL', 'احمد پور سیال', 'jhang'],
            ['JHANG', '‪جھنگ‬', 'jhang'],
            ['SHORKOT', 'شورکوٹ', 'jhang'],
            ['18-HAZARI', '۱۸ ہزاری', 'jhang'],
            ['DINA', 'دینہ', 'jhelum'],
            ['JHELUM', 'جہلم', 'jhelum'],
            ['P.D KHAN', 'پنڈ داد نخان', 'jhelum'],
            ['SOHAWA', 'سوہاوہ', 'jhelum'],
            ['CHUNIAN', 'چونیاں', 'kasur'],
            ['KASUR', 'قصور', 'kasur'],
            ['KOT RADHA KISHAN', 'کوٹ رادھا کشن', 'kasur'],
            ['PATTOKI', 'پتوکی', 'kasur'],
            ['JAHANIAN', 'جہانیاں', 'khanewal'],
            ['KABIRWALA', 'کبیر والا', 'khanewal'],
            ['KHANEWAL', 'خانیوال', 'khanewal'],
            ['MIAN CHANNU', 'میاں چنوں', 'khanewal'],
            ['KHUSHAB', 'خوشاب', 'khushab'],
            ['NOOR PURTHAL', 'نورپور', 'khushab'],
            ['QAID BAD', 'قائد آباد', 'khushab'],
            ['NAUSHERA', 'نَوشہره', 'khushab'],
            ['CANTT', 'کینٹ', 'lahore'],
            ['ALLAMA IQBAL', 'علامہ اقبال', 'lahore'],
            ['AZIZ BHATTI', 'عزیز بھٹی', 'lahore'],
            ['DATA GUNJ BUKSH', 'داتا گنج بخش', 'lahore'],
            ['GULBERG', 'گلبرگ', 'lahore'],
            ['NISHTER', 'نشتر', 'lahore'],
            ['RAVI', 'راوی', 'lahore'],
            ['SHALIMAR', 'شالیمار', 'lahore'],
            ['SAMANABAD', 'سمن آباد', 'lahore'],
            ['WAHGA', 'واہگا', 'lahore'],
            ['CHAUBARA', 'چوبارہ', 'layyah'],
            ['KAROR LALISAN', 'کروڑلعل عیسن', 'layyah'],
            ['LAYYAH', 'لیہ', 'layyah'],
            ['DUNYAPUR', 'دنیا پور', 'lodhran'],
            ['KAROR PACCA', 'کہروڑ پکا', 'lodhran'],
            ['LODHRAN', 'لودھراں', 'lodhran'],
            ['MALIKWAL', 'ملکوال', 'mandi baha ud din'],
            ['MANDI BAHUDDIN', 'منڈی بہاو الدین', 'mandi baha ud din'],
            ['PHALIA', 'پھالیہ', 'mandi baha ud din'],
            ['ISA KHEL', 'عیسی خیل', 'mianwali'],
            ['MIANWALI', 'میانوالی', 'mianwali'],
            ['PIPLAN', 'پپلاں', 'mianwali'],
            ['JALALPUR PIRWALA', 'جلالپور پیر والا', 'multan'],
            ['MULTAN CITY', 'ملتان', 'multan'],
            ['MULTAN SADAR', 'ملتان صدر', 'multan'],
            ['SHUJABAD', 'شجاع آباد', 'multan'],
            ['ALI PUR', 'علی پور', 'muzaffargarh'],
            ['JATAOI', 'جتوئی', 'muzaffargarh'],
            ['KOT ADDU', 'کوٹ اد و', 'muzaffargarh'],
            ['MUZAFFARGARH', 'مظفر گڑھ', 'muzaffargarh'],
            ['NANKANA SAHIB', 'ننکانہ صاحب', 'nankana sahib'],
            ['SANGLA HILL', 'سانگلہ ہِل', 'nankana sahib'],
            ['SHAHKOT', 'شاہ کوٹ', 'nankana sahib'],
            ['NAROWAL', 'نارووال', 'narowal'],
            ['SHAKARGARH', 'شکَرگڑھ', 'narowal'],
            ['ZAFARWAL', 'ظفروال', 'narowal'],
            ['DEPALPUR', 'دیپالپور', 'okara'],
            ['OKARA', 'اوکاڑہ', 'okara'],
            ['RENALA KHURD', 'رینالہ خورد', 'okara'],
            ['ARIFWALA', 'عارفوالا', 'pakpattan'],
            ['PAKPATTAN', 'پاکپتن', 'pakpattan'],
            ['KHANPUR', 'خان پور', 'rahimyar khan'],
            ['LIAQATPUR', 'لیاقت پور', 'rahimyar khan'],
            ['RAHIMYAR KHAN', 'رحیم یار خان', 'rahimyar khan'],
            ['SADIQABAD', 'صادق آباد', 'rahimyar khan'],
            ['JAMPUR', 'جام پور', 'rajanpur'],
            ['RAJANPUR', 'راجن پور', 'rajanpur'],
            ['ROJHAN', 'روجھان', 'rajanpur'],
            ['GUJAR KHAN', 'گجر خان', 'rawalpindi'],
            ['KAHUTTA', 'کہوٹہ', 'rawalpindi'],
            ['KALLER SYEDAN', 'کلر سیدان', 'rawalpindi'],
            ['KOTLI SATTIAN', 'کوٹلی ستیان', 'rawalpindi'],
            ['MUREE', 'مری', 'rawalpindi'],
            ['RAWALPINDI CITY', 'راولپنڈی سٹی', 'rawalpindi'],
            ['TAXILA', 'ٹيکسلا', 'rawalpindi'],
            ['RAWALPINDI RURAL', 'راولپنڈی دیہی', 'rawalpindi'],
            ['RAWALPINDI CANTT', 'راولپنڈی کینٹ', 'rawalpindi'],
            ['CHICHAWATANI', 'چیچہ وطنی', 'sahiwal'],
            ['SAHIWAL', 'ساہیوال', 'sahiwal'],
            ['BHALWAL', 'بھلوال', 'sargodha'],
            ['SARGODHA', 'سرگودھا', 'sargodha'],
            ['SHAHPUR', 'شاہ پور', 'sargodha'],
            ['SILLANWALI', 'سلانوالی', 'sargodha'],
            ['KOT MOMIN', 'کوٹ مومن', 'sargodha'],
            ['BHERA', 'بھیرہ', 'sargodha'],
            ['FEROZEWALA', 'فیروزوالہ', 'sheikhupura'],
            ['MURIDKE', 'مریدکے', 'sheikhupura'],
            ['SAFDAR ABAD', 'صفدرآباد', 'sheikhupura'],
            ['SHARAQPUR SHARIF', 'شرقپور', 'sheikhupura'],
            ['SHEIKHUPURA', 'شیخوپورہ', 'sheikhupura'],
            ['DASKA', 'ڈسکہ', 'sialkot'],
            ['PASRUR', 'پسرور', 'sialkot'],
            ['SAMBRIAL', 'سمبڑيال', 'sialkot'],
            ['SIALKOT', 'سيالكوٹ', 'sialkot'],
            ['GOJRA', 'گوجرہ', 'toba tek singh'],
            ['KAMALIA', 'کمالیہ', 'toba tek singh'],
            ['TOBA TEK SINGH', 'ٹوبہ ٹیک سنگھ', 'toba tek singh'],
            ['PIR MAHAL', 'پیر محل', 'toba tek singh'],
            ['BUREWALA', '‬بوریوالہ', 'vehari'],
            ['MAILSI', '‬میلسی', 'vehari'],
            ['VEHARI', '‬وہاڑی', 'vehari'],
        ];
        foreach ($tehArr as $index => $teh) {
            $slug = str_replace(' ', '-', trim($teh[2]));
            if (isset($arr[$slug])) {
                $name = strtolower(trim($teh[0]));
                $tahsilArr[] = [
                    'name' => ucfirst($name),
                    'name_ur' => $teh[1],
                    'slug' => str_replace(' ', '-', $name),
                    'district_idfk' => $arr[$slug],
                    'created_by' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }
        }
        Tehsil::insert($tahsilArr);
    }
}
