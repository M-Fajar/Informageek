<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect(['android', 'web', 'jaringan', 'desain', 'game']);
    	$categories->each(function($c) {
    		\App\Category::create([
    			'name' => $c,
    			'slug' => \Str::slug($c),
    		]);
    	});
    }
}
