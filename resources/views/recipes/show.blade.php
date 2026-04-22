<!DOCTYPE html>
<html>
<head>
    <title>Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container py-5">

    <h1>{{ $recipe->title }}</h1>

    <img src="{{ $recipe->image }}" width="300">

    <p>{{ $recipe->description }}</p>
    <p>{{ $recipe->instructions }}</p>

    <p>⏱ {{ $recipe->cooking_time }} minutes</p>

    <!-- ✅ SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- ✅ RATING FORM -->
    @auth
    <form method="POST" action="{{ route('recipes.rate', $recipe->id) }}">
        @csrf

        <select name="rating" class="form-select w-25">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <button class="btn btn-success mt-2">Rate</button>
    </form>
    @endauth

    <a href="/recipes" class="btn btn-light mt-3">Back</a>

</div>

</body>
</html>