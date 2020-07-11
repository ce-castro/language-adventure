<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Cesar',
            'last_name' => 'Castro',
            'status' => '1',
            'email' => 'ce.castro@outlook.es',
            'password' => bcrypt('cesar'),
            'created_at' => '2019-02-01 00:00:00',
            'updated_at' => '2019-02-01 00:00:00',
        ]);
    }
}
