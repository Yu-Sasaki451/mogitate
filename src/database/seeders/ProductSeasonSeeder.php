<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $seasonIds = DB::table('seasons')->pluck('id', 'name');

        $productIds = DB::table('products')->orderBy('id')->limit(10)->pluck('id')->values();

        $rows = [
            ['product_id' => $productIds[0],
            'season_id' => $seasonIds['秋'],
            'created_at' => $now,
            'updated_at' => $now],
            ['product_id' => $productIds[0],
            'season_id' => $seasonIds['冬'],
            'created_at' => $now,
            'updated_at' => $now],

            ['product_id' => $productIds[1],
            'season_id' => $seasonIds['春'],
            'created_at' => $now,
            'updated_at' => $now],

            ['product_id' => $productIds[2],
            'season_id' => $seasonIds['冬'],
            'created_at' => $now,
            'updated_at' => $now],

            ['product_id' => $productIds[3],
            'season_id' => $seasonIds['夏'],
            'created_at' => $now,
            'updated_at' => $now],

            ['product_id' => $productIds[4],
            'season_id' => $seasonIds['夏'],
            'created_at' => $now,
            'updated_at' => $now],

            ['product_id' => $productIds[5],
            'season_id' => $seasonIds['夏'],
            'created_at' => $now,
            'updated_at' => $now],
            ['product_id' => $productIds[5],
            'season_id' => $seasonIds['秋'],
            'created_at' => $now,
            'updated_at' => $now],

            ['product_id' => $productIds[6],
            'season_id' => $seasonIds['春'],
            'created_at' => $now,
            'updated_at' => $now],
            ['product_id' => $productIds[6],
            'season_id' => $seasonIds['夏'],
            'created_at' => $now,
            'updated_at' => $now],

            ['product_id' => $productIds[7],
            'season_id' => $seasonIds['夏'],
            'created_at' => $now,
            'updated_at' => $now],
            ['product_id' => $productIds[7],
            'season_id' => $seasonIds['秋'],
            'created_at' => $now,
            'updated_at' => $now],

            ['product_id' => $productIds[8],
            'season_id' => $seasonIds['夏'],
            'created_at' => $now,
            'updated_at' => $now],

            ['product_id' => $productIds[9],
            'season_id' => $seasonIds['春'],
            'created_at' => $now,
            'updated_at' => $now],
            ['product_id' => $productIds[9],
            'season_id' => $seasonIds['夏'],
            'created_at' => $now,
            'updated_at' => $now],
        ];
        DB::table('product_season')->insert($rows);
    }
}
