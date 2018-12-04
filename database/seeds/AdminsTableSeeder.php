<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'uuid' => 'f94b7ad8-af17-4189-958b-798177b8d09c',
            'name' => 'Admin User',
            'email' => 'admin@domain.com',
            'status' => 1,
            'password' => bcrypt('admin123'),
        ]);
    }
}
