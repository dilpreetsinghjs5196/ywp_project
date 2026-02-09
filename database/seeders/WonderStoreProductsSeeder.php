<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WonderStoreProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $products = [

            // Bookmarks – ₹49
            ['image' => 'images/wonderstore/BM1.jpg', 'cat' => 1, 'price' => 49],
            ['image' => 'images/wonderstore/BM2.jpg', 'cat' => 1, 'price' => 49],
            ['image' => 'images/wonderstore/BM3.jpg', 'cat' => 1, 'price' => 49],
            ['image' => 'images/wonderstore/BM4.jpg', 'cat' => 1, 'price' => 49],
            ['image' => 'images/wonderstore/BM5.jpg', 'cat' => 1, 'price' => 49],
            ['image' => 'images/wonderstore/BM7.jpg', 'cat' => 1, 'price' => 49],
            ['image' => 'images/wonderstore/BM8.jpg', 'cat' => 1, 'price' => 49],

            // Cups – ₹499
            ['image' => 'images/wonderstore/C1.jpeg', 'cat' => 2, 'price' => 499],
            ['image' => 'images/wonderstore/C2.jpeg', 'cat' => 2, 'price' => 499],
            ['image' => 'images/wonderstore/C3.jpeg', 'cat' => 2, 'price' => 499],
            ['image' => 'images/wonderstore/C4.jpeg', 'cat' => 2, 'price' => 499],

            // Posters – ₹99
            ['image' => 'images/wonderstore/P1.jpg', 'cat' => 3, 'price' => 99],
            ['image' => 'images/wonderstore/P2.jpg', 'cat' => 3, 'price' => 99],
            ['image' => 'images/wonderstore/P3.jpg', 'cat' => 3, 'price' => 99],
            ['image' => 'images/wonderstore/P4.jpg', 'cat' => 3, 'price' => 99],

            // Stickers – ₹19
            ['image' => 'images/wonderstore/S1.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S2.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S3.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S4.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S5.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S6.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S7.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S8.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S9.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S10.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S11.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S12.jpg', 'cat' => 4, 'price' => 19],
            ['image' => 'images/wonderstore/S13.jpg', 'cat' => 4, 'price' => 19],

            // T-Shirts – ₹799
            ['image' => 'images/wonderstore/T1.jpg', 'cat' => 5, 'price' => 799],
            ['image' => 'images/wonderstore/T2.jpg', 'cat' => 5, 'price' => 799],
            ['image' => 'images/wonderstore/T3.jpg', 'cat' => 5, 'price' => 799],
            ['image' => 'images/wonderstore/T4.jpg', 'cat' => 5, 'price' => 799],
            ['image' => 'images/wonderstore/T5.jpg', 'cat' => 5, 'price' => 799],
            ['image' => 'images/wonderstore/T6.jpg', 'cat' => 5, 'price' => 799],

            // Notebooks – ₹449
            ['image' => 'images/wonderstore/Notebook 1.jpg', 'cat' => 6, 'price' => 449],
            ['image' => 'images/wonderstore/Notebook 2.jpg', 'cat' => 6, 'price' => 449],
            ['image' => 'images/wonderstore/Notebook 3.jpg', 'cat' => 6, 'price' => 449],
            ['image' => 'images/wonderstore/Notebook 4.jpg', 'cat' => 6, 'price' => 449],

            // Calendar – ₹449
            ['image' => 'images/wonderstore/Cal.jpg', 'cat' => 7, 'price' => 449],

            // Hoodies – ₹1499
            ['image' => 'images/wonderstore/Hoodie.jpg', 'cat' => 9, 'price' => 1499],
        ];

        foreach ($products as $p) {
            DB::table('wonder_store_products')->insert([
                'product_image'       => $p['image'],
                'category_id'         => $p['cat'],
                'product_price'       => $p['price'],
                'product_description' => null,
                'is_active'            => 1,
                'created_at'           => $now,
                'updated_at'           => $now,
            ]);
        }
    }
}
