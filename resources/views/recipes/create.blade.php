<!DOCTYPE html>
<html>
<head>
    <title>Create Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container py-5">

    <h2>Create Recipe</h2>

    <form method="POST" action="{{ route('recipes.store') }}">
        @csrf

        <input class="form-control mb-2" name="title" placeholder="Title">

        <input class="form-control mb-2" name="image" placeholder="Image URL">

        <textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>

        <textarea class="form-control mb-2" name="instructions" placeholder="Instructions"></textarea>

        <input class="form-control mb-2" name="origin_country" placeholder="Origin Country">

        <input type="number" class="form-control mb-3" name="cooking_time" placeholder="Cooking time">

        <button class="btn btn-success">Save</button>
    </form>

</div>

</body>
</html>