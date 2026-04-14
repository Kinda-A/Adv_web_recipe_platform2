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

    <a href="/recipes" class="btn btn-light">Back</a>

</div>

</body>
</html>