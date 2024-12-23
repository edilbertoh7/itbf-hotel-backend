<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $hotels = Hotel::with('municipality')->get();

        // verifico si no hay información
        if ($hotels->isEmpty()) {
            return response()->json([
                'message' => 'No hay información para mostrar.'
            ], 404); // Código HTTP 404: Not Found
        }

        // Devolver los datos si existen
        return response()->json($hotels, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate(
                // Validaciones
                $this->validations(),
                // Mensajes personalizados
                $this->custommessages()
            );

            $hotel = Hotel::create($validated);

            return response()->json([
                'message' => 'Hotel creado exitosamente',
                'data' => $hotel
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $e->errors()
            ], 422); // no se puede procesar
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el hotel',
                'error' => $e->getMessage()
            ], 500); //error interno de servidorr
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
        return $hotel->load('municipality');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        try {
            //
            $validated = $request->validate(
                // Validaciones
                $this->validations($hotel->id),
                // Mensajes personalizados
                $this->custommessages()
            );

            $hotel->update($validated);

            // return $hotel;
            return response()->json([
                'message' => 'Hotel actualizado exitosamente',
                'data' => $hotel
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $e->errors()
            ], 422); // no se puede procesar
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el hotel',
                'error' => $e->getMessage()
            ], 500); //error interno de servidorr
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        //
        $hotel->delete();

        return response()->noContent();
    }
    public function validations($id = null)
    {
        if ($id) {
            return [

                'name' => 'sometimes|required|string|unique:hotels,name,' . $id . ',|max:150',
                'address' => 'required|string|max:255',
                'city' => 'required|integer|exists:municipalities,id',
                'tax_id' => 'required|string|unique:hotels,tax_id,' . $id . ',|max:20',
                'max_rooms' => 'required|integer|min:1',
            ];
        } else {
            return [
                'name' => 'required|string|unique:hotels|max:150',
                'address' => 'required|string|max:255',
                'city' => 'required|integer|exists:municipalities,id',
                'tax_id' => 'required|string|max:20|unique:hotels',
                'max_rooms' => 'required|integer|min:1',
            ];
        }
    }

    public function custommessages()
    {
        return [
            'name.required' => 'El nombre del hotel es obligatorio.',
            'name.unique' => 'El nombre del hotel ya está registrado.',
            'name.max' => 'El nombre del hotel no puede tener más de 150 caracteres.',
            'city.required' => 'La ciudad es obligatoria.',
            'city.integer' => 'El identificador de la ciudad debe ser un número.',
            'city.exists' => 'La ciudad seleccionada no es válida.',
            'tax_id.required' => 'El NIT del hotel es obligatorio.',
            'tax_id.unique' => 'El NIT del hotel ya está registrado.',
            'tax_id.max' => 'El NIT no puede tener más de 20 caracteres.',
            'max_rooms.required' => 'El número máximo de habitaciones es obligatorio.',
            'max_rooms.min' => 'al número maximo de habitaxiones debe tener al menos 1.',
        ];
    }
}
