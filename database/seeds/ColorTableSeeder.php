<?php

use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'color_name' =>"Red",
            'color' => "#b00003",
            'alpha' => "0.5"
        ]);
        DB::table('colors')->insert([
            'color_name' =>"Blue",
            'color' => "#0000ff",
            'alpha' => "0.5"
        ]);
        DB::table('colors')->insert([
            'color_name' =>"OrangeRed",
            'color' => "#ff4500",
            'alpha' => "0.5"
        ]);
        DB::table('colors')->insert([
            'color_name' =>"purple1",
            'color' => "#9b30ff",
            'alpha' => "0.5"
        ]);
    }
}
