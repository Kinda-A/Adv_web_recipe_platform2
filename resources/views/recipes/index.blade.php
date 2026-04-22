<!DOCTYPE html>
<html>
<head>
    <title>Recipe Sharing Platform</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #1a0b2e, #2d0b3f, #12001f);
            color: white;
            min-height: 100vh;
        }

        .navbar {
            background: rgba(20, 0, 40, 0.7);
            backdrop-filter: blur(12px);
        }

        .main-title {
            font-weight: bold;
            letter-spacing: 1px;
        }

        .recipe-card {
            background: rgba(255, 255, 255, 0.08);
            border: none;
            border-radius: 18px;
            overflow: hidden;
            transition: 0.3s;
            backdrop-filter: blur(12px);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .recipe-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
        }

        .recipe-img {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .text-beige {
            color: #f5e6c8;
        }

        .btn-beige {
            background-color: #f5e6c8;
            color: #2d0b3f;
            font-weight: bold;
            border: none;
        }

        .btn-beige:hover {
            background-color: #e6d3a3;
            color: #1a0b2e;
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            text-align: center;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(10px);
            color: #ccc;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark px-4 py-3 d-flex justify-content-between">

    <span class="navbar-brand fw-bold">🍽 Recipe Sharing Platform</span>

    <div class="d-flex gap-2">

        <a href="/recipes" class="btn btn-beige btn-sm">Recipes</a>
        <a href="/recipes/create" class="btn btn-beige btn-sm">Create</a>

        @auth
            <a href="/dashboard" class="btn btn-beige btn-sm">Dashboard</a>

            <!-- LOGOUT BUTTON ADDED -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
            <a href="{{ route('register') }}" class="btn btn-beige btn-sm">Register</a>
        @endguest

        <form method="GET" action="/recipes">
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-beige btn-sm">Search</button>
        </form>

    </div>
</nav>

<div class="container py-5">

    <h2 class="text-center main-title mb-5 text-beige">
        Discover Delicious Recipes 🌍
    </h2>

    <div class="row">

        @php
        $recipeImages = [
            "Tabbouleh" => "https://www.kdfoods-sy.com/images/salad7.jpg",
            "Shawarma" => "https://b.zmtcdn.com/data/pictures/chains/4/21627804/1735546437db0dba9a-4e08-4deb-b8ba-af0f57c29676.jpg",
            "Kibbeh" => "https://www.mushroomcouncil.org/wp-content/uploads/2023/07/Mushroom-Kibbeh.jpg",
            "Burger" => "https://images.unsplash.com/photo-1568901346375-23c9450c58cd",
            "Brownies" => "https://images.unsplash.com/photo-1606313564200-e75d5e30476c",
            "Sushi" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSMaoZuqM_NULLsR95VobtH0PebyHEvoVRK_w&s",
            "Manakish" => "https://urbanfarmandkitchen.com/wp-content/uploads/2023/08/manakish-zaatar-2.jpg",
            "Chicken Alfredo" => "https://www.budgetbytes.com/wp-content/uploads/2022/07/Chicken-Alfredo-V3.jpg",
            "Mocha Frappe" => "https://thehowtohome.com/wp-content/uploads/2022/06/2-1.jpg",
            "Omelette" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRJsCDxNF0x3sOX_W4AG4s_yLYgCN4d65A5A&s",
            "Pancakes" => "https://eggs.ca/wp-content/uploads/2024/06/fluffy-pancakes-1664x832-1.jpg",
            "Caesar Salad" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRV5Yp0uPt-uqJ5udVjAL71-ArAIvCzE84nYQ&s",
            "Strawberry Smoothie" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBgA1GG13niWAiXb-RWOFvOi_n3T0pZKzXew&s",
            "Apple Pie" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSdUhefZX8p2BeUSO7reRcOrLuWan4LE7fUww&s",
            "Chocolate Muffins" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRe4hB2UXw_2zP2AC57876ZIRMASSahVlrI1w&s",
            "Rice" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRVE8BJzmsMe5y7ND_appSZ5WWvEl1UOPfnA&s",
            "Cheesecake" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_723BuviTBGetNvaxa74q_nW6FadVa8bxPA&s",
            "Crispy Tender Chicken" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRY19uD_Z2zdjVnYJ6-bB6LGNr6kxHozWz_LA&s",
        ];
        @endphp

        @forelse($recipes as $recipe)

        <div class="col-lg-4 col-md-6 mb-4">

            <div class="card recipe-card">

                <img class="recipe-img"
                     src="{{ $recipeImages[$recipe->title] ?? 'https://picsum.photos/400/300?random='.$recipe->id }}">

                <div class="card-body p-3">

                    <h4 class="text-beige">{{ $recipe->title }}</h4>

                    <p class="text-beige small">
                        {{ $recipe->description }}
                    </p>

                    <p class="text-beige">
                        ⏱ {{ $recipe->cooking_time }} min
                    </p>

                    <p class="mb-1 text-beige">
                        👤 {{ $recipe->user->name ?? 'Chef' }}
                        <span class="ms-2">
                            {{ $recipe->user->role ?? 'chef' }}
                        </span>
                    </p>

                    <p class="text-beige small">
                        🌍 {{ $recipe->origin_country }}
                    </p>

                    <p class="text-beige">
                        ⭐ {{ $recipe->average_rating ?? 'No ratings yet' }}
                    </p>

                    <div class="d-flex gap-2 mt-auto">

                        <a href="/recipes/{{ $recipe->id }}" class="btn btn-beige btn-sm">View</a>

                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-beige btn-sm">Edit</a>

                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST"
                              onsubmit="return confirm('Delete this recipe?')">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

        @empty
            <h4 class="text-center text-beige">No recipes found</h4>
        @endforelse

    </div>

</div>

<footer>
    <p>© {{ date('Y') }} Recipe Sharing Platform</p>
    <p>💜Kinda Mira Mohammed💜</p>
</footer>

</body>
</html>