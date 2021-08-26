<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Diet;
use App\Http\Controllers\Controller;

class DietController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diets = Diet::all();

        $data = [
            'diets' => $diets
        ];

        return view('user.diet.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('user.diet.create');
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

        $newDiet = new Diet;

        $newDiet->fill($data);
        $newDiet->save();

        return redirect()->route('diet.index');
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
    public function edit(Diet $diet)
    {
        $data = [
            'diet' => $diet,
        ];

        return view('user.diet.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diet $diet)
    {
        $data = $request->all();

        $diet->update($data);

        return redirect()->route('diet.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diet $diet)
    {
        $diet->delete();

        return redirect()->route('diet.index');
    }
}
