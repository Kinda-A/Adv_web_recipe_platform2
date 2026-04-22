<!DOCTYPE html>
<html>
<head>
    <title>Edit Recipe</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #1a0b2e;
            color: white;
        }

        .form-box {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255,255,255,0.05);
            border-radius: 15px;
        }

        .btn-beige {
            background: #f5e6c8;
            color: #2d0b3f;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="form-box">

    <h2>Edit Recipe</h2>

    <form method="POST" action="{{ route('recipes.update', $recipe->id) }}">
        @csrf
        @method('PUT')

        <input class="form-control mb-2" name="title" value="{{ $recipe->title }}">
        <textarea class="form-control mb-2" name="description">{{ $recipe->description }}</textarea>
        <textarea class="form-control mb-2" name="instructions">{{ $recipe->instructions }}</textarea>
        <input class="form-control mb-2" name="image" value="{{ $recipe->image }}">
        <input class="form-control mb-2" name="origin_country" value="{{ $recipe->origin_country }}">
        <input type="number" class="form-control mb-2" name="cooking_time" value="{{ $recipe->cooking_time }}">

        <button class="btn btn-beige w-100">Update</button>
    </form>

</div>

</body>
</html>