<?php

use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        for ($i=0; $i < sizeof($week); $i++)
        {
            factory(App\Day::class)->create([
                'name' => $week[$i],
                'index' => $i
            ]);
        }
    }
}
