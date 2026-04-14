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

        .badge-role {
            background: #b983ff;
            color: black;
        }

        .btn-custom {
            border-radius: 10px;
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
        <a href="/" class="btn btn-beige btn-sm btn-custom"><b>Home</b></a>
        <a href="/recipes" class="btn btn-beige btn-sm btn-custom"><b>Recipes</b></a>
        <a href="/recipes/create" class="btn btn-beige btn-sm btn-custom"><b>Create</b></a>
    </div>
</nav>

<div class="container py-5">

    <h2 class="text-center main-title mb-5 text-beige">
        Discover Delicious Recipes 🌍
    </h2>

    <div class="row">

        @php
        $recipeImages = [
            "Tabbouleh" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfgqR9vpafPPW8EowuE3EVHG3eGLMPK1Toeg&s",
            "Shawarma" => "https://b3067249.smushcdn.com/3067249/wp-content/uploads/2022/07/Shawarma-848x477.jpg?lossy=0&strip=1&webp=1",
            "Kibbeh" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShlOilq8loqpd7-H2ESU6TIsljePcJUyF4pg&s",
            "Hummus" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUqOpl_1aLFSA5VDJ5nHdCPdCdlwhfdzHY-g&s",
            "Pizza Margherita" => "https://kristineskitchenblog.com/wp-content/uploads/2024/07/margherita-pizza-22-2.jpg",
            "Caesar Salad" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRV5Yp0uPt-uqJ5udVjAL71-ArAIvCzE84nYQ&s",
            "Burger" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTlNQ2KlqoI-Y1pziuCN5uhV7SvxLuX5nSdFQ&s",
            "Sushi" => "https://www.yakinori.co.uk/wp-content/uploads/2024/11/Untitled-design-12-1024x1024.png",
            "Manakish" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7A1aOwm7AjdGqglfCNto37s4HM96bUKp5sA&s",
            "Chicken Alfredo" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkBWB1aXVeB7uc5THFWEXaEHbgY3DJsaTxGA&s",
            "Mocha Frappe" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ5XlglhBYv9g0ojlSrufzXhtY7IDuC-NrvLA&s",
            "Falafel" => "https://tastythriftytimely.com/wp-content/uploads/2023/06/Falafel-FEATURED.jpg",
            "Grilled Chicken" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnW76NMD7JRb9GprhgdIX3M6naqoUk8-IObA&s",
            "Brownies" => "https://icecreambakery.in/wp-content/uploads/2024/12/Brownie-Recipe-with-Cocoa-Powder-1200x821.jpg"
        ];
        @endphp

        @forelse($recipes as $recipe)

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card recipe-card">

                <img src="{{ $recipeImages[$recipe->title] ?? 'https://picsum.photos/400/300?random='.$recipe->id }}"
                     class="recipe-img"
                     alt="{{ $recipe->title }}">

                <div class="card-body">

                    <h4 class="text-beige">{{ $recipe->title }}</h4>

                    <p class="text-beige small">
                        {{ $recipe->description }}
                    </p>

                    <hr style="opacity:0.2">

                    <p class="mb-1 text-beige">
                        👤 {{ $recipe->user->name ?? 'Chef' }}
                        <span class="badge badge-role ms-2">
                            {{ $recipe->user->role ?? 'chef' }}
                        </span>
                    </p>

                    <p class="text-beige">
                        ⭐ {{ $recipe->rating ?? 4.5 }}
                        <br>
                        ⏱ {{ $recipe->cooking_time }} min
                    </p>

                    <div class="d-flex gap-2">

                        <a href="{{ route('recipes.show', $recipe->id) }}"
                           class="btn btn-beige btn-sm btn-custom">
                            <b>View</b>
                        </a>

                        <a href="{{ route('recipes.edit', $recipe->id) }}"
                           class="btn btn-beige btn-sm btn-custom">
                            <b>Edit</b>
                        </a>

                        <form action="{{ route('recipes.destroy', $recipe->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this recipe?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm btn-custom">
                                <b>Delete</b>
                            </button>
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
    <p>© {{ date('Y') }} Recipe Sharing Platform. All rights reserved.</p>
    <small>Kinda Mira Mohammad 💜</small>
</footer>

</body>
</html>