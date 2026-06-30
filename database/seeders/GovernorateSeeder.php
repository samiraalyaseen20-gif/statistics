<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Governorate;

class GovernorateSeeder extends Seeder
{
    public function run(): void
    {
        $govs = ['كربلاء','بغداد','النجف','بابل','ذي قار','واسط','البصرة','القادسية',
                 'ميسان','المثنى','ديالى','كركوك','نينوى','صلاح الدين','اربيل','السليمانية','الانبار','دهوك'];
        foreach ($govs as $g) { Governorate::create(['name' => $g]); }
    }
}
