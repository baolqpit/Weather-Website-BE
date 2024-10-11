<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'localtime' => 'required|string',
            'icon' => 'required|string',
            'humidity' => 'required|numeric',
            'tempC' => 'required|numeric',
            'tempF' => 'required|numeric',
            'windMph' => 'required|numeric',
            'windKph' => 'required|numeric',
            'windDegree' => 'required|numeric',
        ]);

        $weather = Weather::create([
            'name' => $validatedData['name'],
            'localtime' => $validatedData['localtime'],
            'icon' => $validatedData['icon'],
            'humidity' => $validatedData['humidity'],
            'tempC' => $validatedData['tempC'],
            'tempF' => $validatedData['tempF'],
            'windMph' => $validatedData['windMph'],
            'windKph' => $validatedData['windKph'],
            'windDegree' => $validatedData['windDegree'],
        ]);

        if (!$weather) {
            return response()->json(['message' => 'Weather data not stored'], 500);
        }

        return response()->json(['message' => 'Weather data stored successfully', 'weather' => $weather], 201);
    }

    public function show(Request $request)
    {
        $weather = Weather::all();

        return response()->json(['weather' => $weather], 200);
    }
}
