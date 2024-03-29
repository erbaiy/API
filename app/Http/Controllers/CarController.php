<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $voitures = Car::all();
        return response()->json($voitures);
    }

    public function estimateprix(Request $request)
    {
        $data = $request->validate([
            'marque' => 'required',
            'modele' => 'required',
            'annee' => 'required',
        ]);


        $similarCars = Car::where('marque', $data['marque'])
            ->where('modele', $data['modele'])
            ->where('annee', $data['annee'])
            ->get();

        if (!$similarCars) {
            return response()->json(['message' => 'No similar cars found'], 404);
        }

        $totalPrice = $similarCars->sum('prix');
        $estimatedPrice = $totalPrice / $similarCars->count();

        return response()->json(['the price pur' => $estimatedPrice]);
    }
}
