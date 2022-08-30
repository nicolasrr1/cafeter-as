<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name_category'=>'postres '
        ]);
        Category::create([
            'name_category'=>'paquetes'
        ]);
        Category::create([
            'name_category'=>'bebida'
        ]);
    }
}
