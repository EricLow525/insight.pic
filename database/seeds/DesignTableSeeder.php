<?php

use Illuminate\Database\Seeder;

class DesignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('designs')->insert([
            'design_url_id' => "design1",
            'info_design' => '[{"component_id":1,"width":100,"height":15,"position":"absolute","left":0,"top":70,"textalign":"center"},{"component_id":2,"width":100,"height":15,"position":"absolute","left":0,"top":85,"textalign":"center"}]'
        ]);
        DB::table('designs')->insert([
            'design_url_id' => "4_b4hxe9",
            'info_design' => '[{"component_id":1,"width":100,"height":15,"position":"absolute","left":0,"top":85,"textalign":"center"},{"component_id":2,"width":100,"height":15,"position":"absolute","left":0,"top":0,"textalign":"center"}]'
        ]);
    }
}
