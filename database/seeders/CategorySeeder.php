<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $datas = [
            'komik',
            'novel',
            'romance',
            'mystery',
            'fiction',
            'horror',
            'western'
        ];

        foreach ($datas as $data) {
            Category::insert([
                'name'  => $data
            ]);
        }
    }
}
