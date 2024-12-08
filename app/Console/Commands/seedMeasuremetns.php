<?php

namespace App\Console\Commands;

use App\Models\FoodIntake;
use App\Models\Measurement;
use Carbon\Carbon;
use Illuminate\Console\Command;

class seedMeasuremetns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:measurements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        for ($i = 0; $i < 1000; $i++) {
            $day = Carbon::now()->subYears(2)->addDays($i);
            Measurement::insert([
                'kg' => rand(0, 1) ? 65 - $i/100 - rand(1, 10)/10 : 0,
                'chest_cm' => rand(0, 1) ? 100 - $i/100 - rand(1, 10)/10 : 0,
                'waist_cm' => rand(0, 1) ? 70 - $i/100 - rand(1, 10)/10 : 0,
                'thighs_cm' => rand(0, 1) ? 100 - $i/100 - rand(1, 10)/10 : 0,
                'wrist_cm' => rand(0, 1) ? 18 - $i/1000 - rand(1, 10)/100 : 0,
                'neck_cm' => rand(0, 1) ? 40 - $i/100 - rand(1, 10)/10 : 0,
                'biceps_cm' => rand(0, 1) ? 30 - $i/100 - rand(1, 10)/10 : 0,
                'mood' => rand(0, 1) ? rand(1, 5) : 0,
                'hunger' => rand(0, 1) ? rand(1, 5) : 0,
                'kpdn' => rand(0, 1) ? 2000 - $i/10 - rand(1, 100) : 0,
                'sleep' => rand(0, 1) ? rand(4, 14) : 0,
                'date' => $day,
                'user_id' => 1
            ]);
            FoodIntake::insert([
                'product_id' => 1,
                'user_id' => 1,
                'g' => 1,
                'proteins' => rand(90, 100),
                'fats' => rand(50, 100),
                'carbohydrates' => rand(150, 200),
                'calories' => 1700 - $i/10 - rand(1, 100),
                'type_food_intake' => 1,
                'date' => $day
            ]);
        }
    }
}
