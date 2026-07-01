<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = ['ايران','افغانستان','سوريا','مصر','نيجيريا','باكستان','لبنان'];
        foreach ($countries as $c) { Country::firstOrCreate(['name' => $c]); }
    }
}
