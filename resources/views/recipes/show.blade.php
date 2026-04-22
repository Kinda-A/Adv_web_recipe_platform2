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

    <!-- SUCCESS / ERROR MESSAGES -->
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <!-- RATING FORM -->
    <form method="POST" action="{{ route('recipes.rate', $recipe->id) }}" class="mt-3">
        @csrf

        <label class="mb-2">Rate this recipe:</label>

        <select name="rating" class="form-select w-25" required>
            <option value="">Select rating</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <button type="submit" class="btn btn-success mt-2">
            Rate
        </button>
    </form>

    <a href="/recipes" class="btn btn-light mt-4">Back</a>

</div>

</body>
</html>