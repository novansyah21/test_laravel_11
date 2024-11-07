<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuditTrailSeeder extends Seeder
{
    public function run()
    {
        DB::table('audit_trails')->insert([
            [
                'user_id' => 8, // Assuming ID 1 for the admin user
                'username' => 'admin',
                'menu_accessed' => 'Dashboard',
                'method' => 'view',
                'access_time' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 12, // Assuming ID 2 for another user with sales role
                'username' => 'sales',
                'menu_accessed' => 'Sales',
                'method' => 'input',
                'access_time' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
