<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post ([
            'title ' => 'Learning Laravel ',
            'content ' => 'This blog post will get you right on track with Laravel !'
        ]);
        $post -> save ();
        $post = new Post ([
            'title ' => 'Something else ',
            'content ' => 'Some other content '
        ]);
        $post -> save ();
    }
}
