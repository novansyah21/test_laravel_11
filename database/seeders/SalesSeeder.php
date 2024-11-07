<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // For using Carbon for date handling

class SalesSeeder extends Seeder
{
    public function run()
    {
        DB::table('sales')->insert([
            'user_id' => 12,                  // Set user_id as 12
            'amount' => 10000000,             // Set the amount to 10,000,000
            'sale_date' => Carbon::now(),    // Use current date and time for sale_date
            'created_at' => Carbon::now(),   // Set created_at to now
            'updated_at' => Carbon::now(),   // Set updated_at to now
        ]);
    }
}
