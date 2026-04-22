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

<<<<<<< HEAD
        .card-body {
            display: flex;
            flex-direction: column;
=======
        /* responsive tweaks */
        @media (max-width: 767px) {
            .recipe-img { height: 140px; }
        }

        /* subtle image hover */
        .recipe-card .recipe-img {
            transition: transform .35s ease;
        }

        .recipe-card:hover .recipe-img {
            transform: scale(1.03);
        }

        /* ensure columns/cards in the same row stretch to equal height */
        .row {
            align-items: stretch;
        }

        /* make card body take remaining space so footers/actions stay aligned */
        .recipe-card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1 1 auto;
        }

        .badge-role {
            background: #b983ff;
            color: black;
        }

        .btn-custom {
            border-radius: 10px;
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
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
<<<<<<< HEAD

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

=======
    <span class="navbar-brand fw-bold">🍽 Recipe Sharing Platform</span>

    <div class="d-flex gap-2">
        <a href="/" class="btn btn-beige btn-sm btn-custom"><b>Home</b></a>
        <a href="/recipes" class="btn btn-beige btn-sm btn-custom"><b>Recipes</b></a>
        <a href="/recipes/create" class="btn btn-beige btn-sm btn-custom"><b>Create</b></a>
        <button id="refresh-recipes-btn" class="btn btn-outline-light btn-sm btn-custom">Refresh</button>
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
    </div>
</nav>

<div class="container py-5">

    <h2 class="text-center main-title mb-5 text-beige">
        Discover Delicious Recipes 🌍
    </h2>

<<<<<<< HEAD
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
=======
    <div class="row" id="recipes-grid">

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
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
        ];
        @endphp

        @forelse($recipes as $recipe)

        <div class="col-lg-4 col-md-6 mb-4">
<<<<<<< HEAD

            <div class="card recipe-card">

                <img class="recipe-img"
                     src="{{ $recipeImages[$recipe->title] ?? 'https://picsum.photos/400/300?random='.$recipe->id }}">

                <div class="card-body p-3">
=======
            <div class="card recipe-card">

                <img src="{{ $recipeImages[$recipe->title] ?? 'https://picsum.photos/400/300?random='.$recipe->id }}"
                     class="recipe-img"
                     alt="{{ $recipe->title }}">

                <div class="card-body">
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500

                    <h4 class="text-beige">{{ $recipe->title }}</h4>

                    <p class="text-beige small">
                        {{ $recipe->description }}
                    </p>

<<<<<<< HEAD
                    <p class="text-beige">
                        ⏱ {{ $recipe->cooking_time }} min
                    </p>

                    <p class="mb-1 text-beige">
                        👤 {{ $recipe->user->name ?? 'Chef' }}
                        <span class="ms-2">
=======
                    <hr style="opacity:0.2">

                    <p class="mb-1 text-beige">
                        👤 {{ $recipe->user->name ?? 'Chef' }}
                        <span class="badge badge-role ms-2">
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
                            {{ $recipe->user->role ?? 'chef' }}
                        </span>
                    </p>

<<<<<<< HEAD
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
=======
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
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
                              onsubmit="return confirm('Delete this recipe?')">

                            @csrf
                            @method('DELETE')

<<<<<<< HEAD
                            <button class="btn btn-danger btn-sm">Delete</button>
=======
                            <button type="submit"
                                    class="btn btn-danger btn-sm btn-custom">
                                <b>Delete</b>
                            </button>
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
                        </form>

                    </div>

                </div>
<<<<<<< HEAD

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

=======
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

<script>
document.addEventListener('DOMContentLoaded', function(){
    const btn = document.getElementById('refresh-recipes-btn');
    const container = document.getElementById('recipes-grid');

    function escapeHtml(str){
        return String(str || '').replace(/[&<>"']/g, function(m){
            return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
        });
    }

    if(!btn || !container) return;

    btn.addEventListener('click', async function(){
        btn.disabled = true;
        const originalText = btn.textContent;
        btn.textContent = 'Refreshing...';
        try{
            const res = await fetch('/api/recipes', { credentials: 'same-origin', headers: { 'Accept': 'application/json' } });
            if(!res.ok){
                const txt = await res.text();
                console.error('API fetch failed', res.status, txt);
                alert('Failed to fetch recipes (status ' + res.status + '). See console.');
                return;
            }

            const json = await res.json();
            let items = [];
            if(Array.isArray(json)) items = json;
            else if(json && Array.isArray(json.data)) items = json.data;
            else if(json && json.data && Array.isArray(json.data.data)) items = json.data.data;
            else {
                console.error('Unexpected API response', json);
                alert('Unexpected API response format. See console.');
                return;
            }

            container.innerHTML = '';

            items.forEach(function(recipe){
                const col = document.createElement('div');
                col.className = 'col-lg-4 col-md-6 mb-4';

                const image = escapeHtml(recipe.image || ('https://picsum.photos/400/300?random=' + recipe.id));
                const title = escapeHtml(recipe.title || 'Untitled');
                const desc = escapeHtml(recipe.description || '');
                const userName = escapeHtml((recipe.user && recipe.user.name) || 'Chef');
                const userRole = escapeHtml((recipe.user && recipe.user.role) || 'chef');
                const rating = escapeHtml(recipe.rating || 4.5);
                const cooking = escapeHtml(recipe.cooking_time || '');

                col.innerHTML = `
                    <div class="card recipe-card">
                        <img src="${image}" class="recipe-img" alt="${title}">
                        <div class="card-body">
                            <h4 class="text-beige">${title}</h4>
                            <p class="text-beige small">${desc}</p>
                            <hr style="opacity:0.2">
                            <p class="mb-1 text-beige">👤 ${userName}
                                <span class="badge badge-role ms-2">${userRole}</span>
                            </p>
                            <p class="text-beige">⭐ ${rating}<br>⏱ ${cooking} min</p>
                            <div class="d-flex gap-2">
                                <a href="/recipes/${recipe.id}" class="btn btn-beige btn-sm btn-custom"><b>View</b></a>
                                <a href="/recipes/${recipe.id}/edit" class="btn btn-beige btn-sm btn-custom"><b>Edit</b></a>
                            </div>
                        </div>
                    </div>
                `;

                container.appendChild(col);
            });

        }catch(e){
            console.error(e);
            alert('Could not refresh recipes. See console for details.');
        }finally{
            btn.disabled = false;
            btn.textContent = originalText;
        }
    });
});
</script>
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
</body>
</html>