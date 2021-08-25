<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Dish;
use App\Type;
use App\Image;
use App\Ingredient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\User\Detail;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();

        $data = [
            'dishes' => $dishes
        ];

        return view('user.dish.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $ingredients = Ingredient::all();


        $data = [
            'types' => $types,
            'ingredients' => $ingredients,
        ];

        return view('user.dish.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $ingredients = Ingredient::all();

        $newDish = new Dish;

        $images = array();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $images[] = $name;
            }
        };

        $newDish->images = json_encode($images);

        $data['availability'] = $request->input('availability');
        $data['promo'] = $request->input('promo');
        $data['take_away'] = $request->input('take_away');
        // Ingredient
        foreach ($ingredients as $ingredient) {
            $sql = DB::table('ingredient_dish')->where('dish_ID', $newDish->id)->where('ingredient_ID', $ingredient->id);
            $data[$ingredient->name] = $request->input($ingredient->name);
            if (!$request->input($ingredient->name) || $sql) {
                $sql->delete();
            }
        }

        $newDish->type_ID = $request->input('type');

        $newDish->availability = 0;
        if ($data['availability']) {
            $newDish->availability = 1;
        }

        $newDish->promo = 0;
        if ($data['promo']) {
            $newDish->promo = 1;
        }

        $newDish->take_away = 0;
        if ($data['take_away']) {
            $newDish->take_away = 1;
        }

        $newDish->fill($data);
        $newDish->save();

        // Ingredient sync
        foreach ($ingredients as $ingredient) {
            $newDish->ingredient()->sync($data[$ingredient->name]);
        }

        return redirect()->route('dish.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $types = Type::all();
        $ingredients = Ingredient::all();

        $ingredient_dishes = DB::table('ingredient_dish')->where('dish_ID', $dish->id)->get();

        $images = json_decode($dish->images);


        $data = [
            'dish' => $dish,
            'types' => $types,
            'ingredients' => $ingredients,
            'ingredient_dishes' => $ingredient_dishes,
            'images' => $images,
        ];

        return view('user.dish.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $ingredients = Ingredient::all();
        $data = $request->all();

        $images = json_decode($dish->images);

        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $images[] = $name;
            }
        };


        foreach ($images as $k => $image) {

            // prendere il valore del name chechkato


        }
        exit;

        $dish->images = json_encode($images);

        $data['availability'] = $request->input('availability');
        $data['promo'] = $request->input('promo');
        $data['take_away'] = $request->input('take_away');
        $dish->type_ID = $request->input('type');

        // Diets
        foreach ($ingredients as $ingredient) {
            $sql = DB::table('ingredient_dish')->where('dish_ID', $dish->id)->where('ingredient_ID', $ingredient->id);
            $data[$ingredient->name] = $request->input($ingredient->name);
            if (!$request->input($ingredient->name) || $sql) {
                $sql->delete();
            }
        }

        $dish->availability = 0;
        if ($data['availability']) {
            $dish->availability = 1;
        } else {
        }

        $dish->promo = 0;
        if ($data['promo']) {
            $dish->promo = 1;
        }

        $dish->take_away = 0;
        if ($data['take_away']) {
            $dish->take_away = 1;
        }

        $dish->update($data);

        // Ingredient sync
        foreach ($ingredients as $ingredient) {
            $dish->ingredient()->sync($data[$ingredient->name]);
        }

        return redirect()->route('dish.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
