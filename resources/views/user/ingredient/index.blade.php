<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($ingredients as $ingredient)
        <p>{{ $ingredient->name }}</p>
        <a href="{{route('ingredient.edit', $ingredient->id)}}">Modifica</a>
        <form action="{{ route('ingredient.destroy', $ingredient->id) }}" method='post'>
            @csrf
            @method('delete')
            <div class="form-group">
                <input class="btn btn-danger" value="&#xf2ed;" type="submit">
            </div>
        </form>
    @endforeach
</body>
</html>