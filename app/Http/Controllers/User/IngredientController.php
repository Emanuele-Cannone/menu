<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Ingredient;
use App\Intollerance;
use App\Diet;
use App\Conservation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();

        $data = [
            'ingredients' => $ingredients
        ];

        return view('user.ingredient.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conservations = Conservation::all();
        $diets = Diet::all();
        $intollerances = Intollerance::all();

        $data = [
            'conservations' => $conservations,
            'diets' => $diets,
            'intollerances' => $intollerances,
        ];

        return view('user.ingredient.create', $data);
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
        $diets = Diet::all();
        $intollerances = Intollerance::all();

        $newIngredient = new Ingredient;

        $data['availability'] = $request->input('availability');
        $data['diet'] = $request->input('diet');

        // Diets
        foreach ($diets as $diet) {
            $sql = DB::table('diet_ingredient')->where('ingredient_ID', $newIngredient->id)->where('diet_ID', $diet->id);
            $data[$diet->name] = $request->input($diet->name);
            if (!$request->input($diet->name) || $sql) {
                $sql->delete();
            }
        }

        // Intollerances
        foreach ($intollerances as $intollerance) {
            $sql = DB::table('ingredient_intollerance')->where('ingredient_ID', $newIngredient->id)->where('intollerance_ID', $intollerance->id);
            $data[$intollerance->name] = $request->input($intollerance->name);
            if (!$request->input($intollerance->name) || $sql) {
                $sql->delete();
            }
        }


        $newIngredient->conservation_ID = $request->input('conservation');

        $newIngredient->availability = 0;
        if ($data['availability']) {
            $newIngredient->availability = 1;
        }

        $newIngredient->fill($data);
        $newIngredient->save();


        // Diet sync
        foreach ($diets as $diet) {
            $newIngredient->diet()->sync($data[$diet->name]);
        }

        // Intollerance sync
        foreach ($intollerances as $intollerance) {
            $newIngredient->intollerance()->sync($data[$intollerance->name]);
        }

        return redirect()->route('ingredient.index');
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
    public function edit(Ingredient $ingredient)
    {
        $conservations = Conservation::all();
        $diets = Diet::all();
        $intollerances = Intollerance::all();

        $diet_ingredients = DB::table('diet_ingredient')->where('ingredient_ID', $ingredient->id)->get();
        $intollerance_ingredients = DB::table('ingredient_intollerance')->where('ingredient_ID', $ingredient->id)->get();


        $data = [
            'ingredient' => $ingredient,
            'conservations' => $conservations,
            'diets' => $diets,
            'intollerances' => $intollerances,
            'diet_ingredients' => $diet_ingredients,
            'intollerance_ingredients' => $intollerance_ingredients
        ];

        return view('user.ingredient.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {

        $diets = Diet::all();
        $intollerances = Intollerance::all();
        $data = $request->all();

        $data['availability'] = $request->input('availability');
        $ingredient->conservation_ID = $request->input('conservation');

        // Diets
        foreach ($diets as $diet) {
            $sql = DB::table('diet_ingredient')->where('ingredient_ID', $ingredient->id)->where('diet_ID', $diet->id);
            $data[$diet->name] = $request->input($diet->name);
            if (!$request->input($diet->name) || $sql) {
                $sql->delete();
            }
        }

        // Intollerances
        foreach ($intollerances as $intollerance) {
            $sql = DB::table('ingredient_intollerance')->where('ingredient_ID', $ingredient->id)->where('intollerance_ID', $intollerance->id);
            $data[$intollerance->name] = $request->input($intollerance->name);
            if (!$request->input($intollerance->name) || $sql) {
                $sql->delete();
            }
        }

        $ingredient->availability = 0;
        if ($data['availability']) {
            $ingredient->availability = 1;
        }

        $ingredient->update($data);

        // Diet sync
        foreach ($diets as $diet) {
            $ingredient->diet()->sync($data[$diet->name]);
        }

        // Intollerance sync
        foreach ($intollerances as $intollerance) {
            $ingredient->intollerance()->sync($data[$intollerance->name]);
        }

        return redirect()->route('ingredient.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredient.index');
    }
}
