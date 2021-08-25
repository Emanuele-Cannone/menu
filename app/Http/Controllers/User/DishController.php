<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Dish;
use App\Type;
use App\Ingredient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        $data['availability'] = $request->input('availability');
        $data['promo'] = $request->input('promo');
        $data['price'] = $request->input('price');
        $data['major_price'] = $request->input('major_price');
        $data['take_away'] = $request->input('take_away');
        $data['type'] = $request->input('type');

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

        $newDish->fill($data);
        $newDish->save();


        // Diet sync
        foreach ($ingredients as $ingredient) {
            $newDish->diet()->sync($data[$ingredient->name]);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
