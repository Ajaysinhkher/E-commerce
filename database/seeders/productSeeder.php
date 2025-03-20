<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Nike football studs',
                'price' => 3000.00,
                'image' => 'images/sports3.jpg',
                'description'=>'this is description.',
                'quantity' =>10,
                'slug'=>Str::slug('Nike football studs'),
                'status'=>'available',
                'created_at'=>now(),
                'updated_at'=>now(),


                
            ],
            [
                'name' => 'Keeper Gloves',
                'price' => 899.99,
                'image' => 'images/sports4.jpg',
                'description'=>'this is description.',
                'quantity' =>10,
                'slug'=>Str::slug('Keeper Gloves'),
                'status'=>'available',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name' => 'T-Shirt',
                'price' => 299.99,
                'image' => 'images/clothes3.jpg',
                'description'=>'this is description.',
                'quantity' =>10,
                'slug'=>Str::slug('T-Shirt'),
                'status'=>'available',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name' => 'Round-neck T-shirt',
                'price' => 1499.99,
                'image' => 'images/clothes5.jpg',
                'description'=>'this is description.',
                'quantity' =>10,
                'slug'=>Str::slug('Round-neck T-shirt'),
                'status'=>'available',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name' => 'T-shirts full sleeve',
                'price' => 1199.99,
                'image' => 'images/clothes2.jpg',
                'description'=>'this is description.',
                'quantity' =>10,
                'slug'=>Str::slug('T-shirts full sleeve'),
                'status'=>'available',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
        ];

        DB::table('products')->insert($products);
    }
}
