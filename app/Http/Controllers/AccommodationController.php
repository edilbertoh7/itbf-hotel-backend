<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    //
    public function getAll()
    {
        try {
         return    Accommodation::with('roomType', 'assignment')->get();

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener acomodaciones y asignaciones',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
