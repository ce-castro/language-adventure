<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('countries')->insert([
            ['code' => 'SV', 'name' => 'El Salvador'],
            ['code' => 'US', 'name' => 'United States'],
            ['code' => 'MX', 'name' => 'Mexico'],
        ]);
    }
}
