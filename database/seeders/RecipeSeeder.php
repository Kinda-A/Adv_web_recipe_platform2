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
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Shawarma',
                'description' => 'Spiced grilled meat wrap with garlic sauce.',
                'instructions' => 'Marinate meat, grill, slice, serve in bread.',
                'image' => 'https://b.zmtcdn.com/data/pictures/chains/4/21627804/1735546437db0dba9a-4e08-4deb-b8ba-af0f57c29676.jpg',
                'origin_country' => 'Middle East',
                'cooking_time' => 45,
                'created_at' => now(),
                'updated_at' => now(),
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
                'created_at' => now(),
                'updated_at' => now(),
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
                'created_at' => now(),
                'updated_at' => now(),
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
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Sushi',
                'description' => 'Japanese rice rolls.',
                'instructions' => 'Roll rice and fish in seaweed.',
                'image' => 'https://images.unsplash.com/photo-1553621042-f6e147245754',
                'origin_country' => 'Japan',
                'cooking_time' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Manakish',
                'description' => 'Flatbread with zaatar.',
                'instructions' => 'Bake dough with topping.',
                'image' => 'https://urbanfarmandkitchen.com/wp-content/uploads/2023/08/manakish-zaatar-2.jpg',
                'origin_country' => 'Lebanon',
                'cooking_time' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Chicken Alfredo',
                'description' => 'Creamy pasta.',
                'instructions' => 'Cook pasta and sauce.',
                'image' => 'https://www.budgetbytes.com/wp-content/uploads/2022/07/Chicken-Alfredo-V3.jpg',
                'origin_country' => 'Italy',
                'cooking_time' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Mocha Frappe',
                'description' => 'Cold coffee drink.',
                'instructions' => 'Blend ingredients.',
                'image' => 'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7',
                'origin_country' => 'Greece',
                'cooking_time' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ===== NEW ONES =====

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Omelette',
                'description' => 'Quick fluffy egg breakfast dish.',
                'instructions' => 'Beat eggs, cook in pan, add cheese or veggies.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRJsCDxNF0x3sOX_W4AG4s_yLYgCN4d65A5A&s',
                'origin_country' => 'France',
                'cooking_time' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Pancakes',
                'description' => 'Soft fluffy pancakes with syrup.',
                'instructions' => 'Mix ingredients, cook on pan.',
                'image' => 'https://eggs.ca/wp-content/uploads/2024/06/fluffy-pancakes-1664x832-1.jpg',
                'origin_country' => 'USA',
                'cooking_time' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Caesar Salad',
                'description' => 'Crispy salad with dressing.',
                'instructions' => 'Mix lettuce, chicken, croutons.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRV5Yp0uPt-uqJ5udVjAL71-ArAIvCzE84nYQ&s',
                'origin_country' => 'Italy',
                'cooking_time' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Strawberry Smoothie',
                'description' => 'Cold fruity drink.',
                'instructions' => 'Blend strawberries, milk, yogurt.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBgA1GG13niWAiXb-RWOFvOi_n3T0pZKzXew&s',
                'origin_country' => 'USA',
                'cooking_time' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Apple Pie',
                'description' => 'Classic baked dessert.',
                'instructions' => 'Bake apples with crust.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSdUhefZX8p2BeUSO7reRcOrLuWan4LE7fUww&s',
                'origin_country' => 'USA',
                'cooking_time' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Chocolate Muffins',
                'description' => 'Soft chocolate muffins.',
                'instructions' => 'Mix and bake.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRe4hB2UXw_2zP2AC57876ZIRMASSahVlrI1w&s',
                'origin_country' => 'USA',
                'cooking_time' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Rice',
                'description' => 'Fluffy rice.',
                'instructions' => 'Boil rice.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRVE8BJzmsMe5y7ND_appSZ5WWvEl1UOPfnA&s',
                'origin_country' => 'Asia',
                'cooking_time' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Cheesecake',
                'description' => 'Creamy dessert.',
                'instructions' => 'Bake or chill.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_723BuviTBGetNvaxa74q_nW6FadVa8bxPA&s',
                'origin_country' => 'USA',
                'cooking_time' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Crispy Tender Chicken',
                'description' => 'Crispy fried chicken strips.',
                'instructions' => 'Fry chicken.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRY19uD_Z2zdjVnYJ6-bB6LGNr6kxHozWz_LA&s',
                'origin_country' => 'USA',
                'cooking_time' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}