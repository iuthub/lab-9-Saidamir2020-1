<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = new Tag ();
        $tag -> name = 'Tutorial ';
        $tag -> save ();
        $tag = new Tag ();
        $tag -> name = 'Industry News ';
        $tag -> save ();
    }
}
