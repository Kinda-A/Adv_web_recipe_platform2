<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('recipes')->insert([
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Tabbouleh',
                'description' => 'Fresh Lebanese parsley salad with lemon and bulgur.',
                'instructions' => 'Chop parsley, tomato, onion. Mix with bulgur, lemon juice, olive oil, and salt.',
                'image' => 'https://www.kdfoods-sy.com/images/salad7.jpg',
                'origin_country' => 'Lebanon',
                'cooking_time' => 20,
                'created_at' => '2026-04-07 07:41:10',
                'updated_at' => '2026-04-07 07:41:10',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Shawarma',
                'description' => 'Spiced grilled meat wrap with garlic sauce.',
                'instructions' => 'Marinate meat, grill, slice, serve in bread.',
                'image' => 'https://b.zmtcdn.com/data/pictures/chains/4/21627804/1735546437db0dba9a-4e08-4deb-b8ba-af0f57c29676.jpg?fit=around|771.75:416.25&crop=771.75:416.25;*,*',
                'origin_country' => 'Middle East',
                'cooking_time' => 45,
                'created_at' => '2026-04-07 07:41:10',
                'updated_at' => '2026-04-07 07:41:10',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Kibbeh',
                'description' => 'Crispy bulgur and minced meat croquettes.',
                'instructions' => 'Mix bulgur, meat, spices. Shape and fry.',
                'image' => 'https://www.mushroomcouncil.org/wp-content/uploads/2023/07/Mushroom-Kibbeh.jpg',
                'origin_country' => 'Lebanon',
                'cooking_time' => 100,
                'created_at' => '2026-04-07 07:41:10',
                'updated_at' => '2026-04-07 07:41:10',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Burger',
                'description' => 'Juicy beef burger with cheese and toppings.',
                'instructions' => 'Grill patty, assemble bun.',
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd',
                'origin_country' => 'USA',
                'cooking_time' => 25,
                'created_at' => '2026-04-07 07:41:10',
                'updated_at' => '2026-04-07 07:41:10',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Brownies',
                'description' => 'Rich chocolate dessert.',
                'instructions' => 'Mix and bake.',
                'image' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c',
                'origin_country' => 'USA',
                'cooking_time' => 40,
                'created_at' => '2026-04-07 07:41:10',
                'updated_at' => '2026-04-07 07:41:10',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Sushi',
                'description' => 'Japanese rice rolls.',
                'instructions' => 'Roll rice and fish in seaweed.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSMaoZuqM_NULLsR95VobtH0PebyHEvoVRK_w&s',
                'origin_country' => 'Japan',
                'cooking_time' => 50,
                'created_at' => '2026-04-07 07:41:10',
                'updated_at' => '2026-04-07 07:41:10',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Manakish',
                'description' => 'Flatbread with zaatar.',
                'instructions' => 'Bake dough with topping.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7A1aOwm7AjdGqglfCNto37s4HM96bUKp5sA&s',
                'origin_country' => 'Lebanon',
                'cooking_time' => 60,
                'created_at' => '2026-04-07 07:57:08',
                'updated_at' => '2026-04-07 07:57:08',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Chicken Alfredo',
                'description' => 'Creamy pasta.',
                'instructions' => 'Cook pasta and sauce.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkBWB1aXVeB7uc5THFWEXaEHbgY3DJsaTxGA&s',
                'origin_country' => 'Italy',
                'cooking_time' => 35,
                'created_at' => '2026-04-07 07:57:08',
                'updated_at' => '2026-04-07 07:57:08',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Mocha Frappe',
                'description' => 'Cold coffee drink.',
                'instructions' => 'Blend ingredients.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ5XlglhBYv9g0ojlSrufzXhtY7IDuC-NrvLA&s',
                'origin_country' => 'Greece',
                'cooking_time' => 10,
                'created_at' => '2026-04-07 07:57:08',
                'updated_at' => '2026-04-07 07:57:08',
            ],
        ]);
    }
}