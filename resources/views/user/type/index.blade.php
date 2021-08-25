<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($types as $type)
        <p>{{ $type->name }}</p>
        <a href="{{route('type.edit', $type->id)}}">Modifica</a>
        <form action="{{ route('type.destroy', $type->id) }}" method='post'>
            @csrf
            @method('delete')
            <div class="form-group">
                <input class="btn btn-danger" value="&#xf2ed;" type="submit">
            </div>
        </form>
    @endforeach
</body>
</html>