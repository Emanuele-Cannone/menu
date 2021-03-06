<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Dish;
use App\Type;
use App\Diet;
use App\Intollerance;
use App\Conservation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


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
            'dishes' => $dishes,
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
        $diets = Diet::all();
        $intollerances = Intollerance::all();
        $conservations = Conservation::all();

        $data = [
            'types' => $types,
            'diets' => $diets,
            'intollerances' => $intollerances,
            'conservations' => $conservations,
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
        $intollerances = Intollerance::all();
        // $conservations = Conservation::all();

        $newDish = new Dish;

        $images = array();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $images[] = $name;
            }
        };

        $newDish->images = json_encode($images);

        $data['available'] = $request->input('available');
        $data['promo'] = $request->input('promo');
        $data['take_away'] = $request->input('take_away');

        // Intollerances
        foreach ($intollerances as $intollerance) {
            $sql = DB::table('dish_intollerance')->where('dish_id', $newDish->id)->where('intollerance_id', $intollerance->id);
            $data[$intollerance->name] = $request->input($intollerance->name);
            if (!$request->input($intollerance->name) || $sql) {
                $sql->delete();
            }
        }

        $newDish->type_id = $request->input('type');
        $newDish->diet_id = $request->input('diet');
        $newDish->video = $request->input('video');
        $newDish->conservation_id = $request->input('conservation');

        $newDish->available = 0;
        if ($data['available']) {
            $newDish->available = 1;
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

        // Intollerance sync
        foreach ($intollerances as $intollerance) {
            $newDish->intollerance()->sync($data[$intollerance->name]);
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
        $diets = Diet::all();
        $intollerances = Intollerance::all();
        $conservations = Conservation::all();

        $images = json_decode($dish->images);

        $data = [
            'dish' => $dish,
            'types' => $types,
            'diets' => $diets,
            'intollerances' => $intollerances,
            'conservations' => $conservations,
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

        $data = $request->all();
        $intollerances = Intollerance::all();

        $images = json_decode($dish->images);

        foreach ($images as $k => $image) {
            if (isset($data['img' . $k])) {
                unset($images[$k]);
            }
        }

        if ($files = $request->file('images')) {
            foreach ($files as $k => $file) {
                $name = $file->getClientOriginalName();
                $images[] = $name;
            }
        };

        $dish->images = json_encode($images);

        $data['available'] = $request->input('available');
        $data['promo'] = $request->input('promo');
        $data['take_away'] = $request->input('take_away');

        $dish->type_id = $request->input('type');
        $dish->conservation_id = $request->input('conservation');
        $dish->diet_id = $request->input('diet');
        $dish->video = $request->input('video');

        // Intollerances
        foreach ($intollerances as $intollerance) {
            $sql = DB::table('dish_intollerance')->where('dish_id', $dish->id)->where('intollerance_id', $intollerance->id);
            $data[$intollerance->name] = $request->input($intollerance->name);
            if (!$request->input($intollerance->name) || $sql) {
                $sql->delete();
            }
        }

        $dish->available = 0;
        if ($data['available']) {
            $dish->available = 1;
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

        if (isset($data['video_altro'])) {
            $dish->video = null;
        }


        $dish->update($data);


        return redirect()->route('dish.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();

        return redirect()->route('dish.index');
    }
}
