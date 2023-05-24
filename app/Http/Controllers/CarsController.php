<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Product;
use App\Http\Requests\CreateValidationRequest;
class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();

        return view('cars.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateValidationRequest $request)
    {

        $request->validated();

        $car = Car::create(
            [
                'name' => $request->input('name'),
                'founded' => $request->input('founded'),
                'description' => $request->input('description')
            ]
        );

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $car = Car::find($id);
         $products = Product::find($id);

         return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::find($id);
        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateValidationRequest $request, string $id)
    {

        $request->validated();
        $car = Car::where('id', $id)
            ->update(
                [
                    'name' => $request->input('name'),
                    'founded' => $request->input('founded'),
                    'description' => $request->input('description')
                ]
            );
        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {

        if ($car != null) {
            $car->delete();
        }
        return redirect('/cars');
    }
}
