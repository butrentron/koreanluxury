<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::create([
            'name' => 'David Lùn',
            'email' => 'butrentron.man95@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'superadmin'
        ]);
    }
}
