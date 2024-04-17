<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WifiPlan;

class WifiPlanSeeder extends Seeder
{
    public function run()
    {
        WifiPlan::create([
            'name' => 'Basic Plan',
            'datalimit' => 100, // 1 GB
            'duration' => '1 hour',
            'amount' => 150,
        ]);

        WifiPlan::create([
            'name' => 'Premium Plan',
            'datalimit' => 2048, // 2 GB
            'duration' => '2 days',
            'amount' => 2500,
        ]);

    }
}

