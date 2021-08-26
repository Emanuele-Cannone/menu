<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($dishes as $dish)
        <p>{{ $dish->name }}</p>
        <?php 
        $pippos = DB::table('ingredient_dish')->where('dish_ID', $dish->id)->get();
            foreach ($pippos as $pippo) {
                $ingredients = DB::table('ingredients')->where('id', $pippo->ingredient_ID)->get();
                dump($ingredients);
            }
        ?>

        <a href="{{route('dish.edit', $dish->id)}}">Modifica</a>
        <form action="{{ route('dish.destroy', $dish->id) }}" method='post'>
            @csrf
            @method('delete')
            <div class="form-group">
                <input class="btn btn-danger" value="&#xf2ed;" type="submit">
            </div>
        </form>
    @endforeach
</body>
</html>