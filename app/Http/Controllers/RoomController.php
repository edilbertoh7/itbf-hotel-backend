<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rooms = Room::with(['hotel.municipality', 'accommodation.roomType', 'accommodation.assignment'])->get();

        if (!$rooms->isEmpty()) {
            return $rooms->map(function ($room) {
                return [
                    'id' => $room->id,
                    'hotel' => [
                        'id' => $room->hotel->id,
                        'name' => $room->hotel->name,
                        'address' => $room->hotel->address,
                        'city_id' => $room->hotel->city,
                        'city' => $room->hotel->municipality->name ?? null,
                        'tax_id' => $room->hotel->tax_id,
                        'max_rooms' => $room->hotel->max_rooms,
                        'created_at' => $room->hotel->created_at,
                        'updated_at' => $room->hotel->updated_at,
                    ],
                    'room_type' => $room->accommodation->roomType->name ?? null,
                    'assignment' => $room->accommodation->assignment->name ?? null,
                    'quantity' => $room->quantity,
                    'created_at' => $room->created_at,
                    'updated_at' => $room->updated_at,
                ];
            });
        } else {
            return response()->json([
                'message' => 'No hay informacion para mostrar',

            ], 201);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $validated = $request->validate([
                'hotel_id' => 'required|exists:hotels,id',
                'accommodation_id' => [
                    'required',
                    'exists:accommodations,id',
                    Rule::unique('rooms')->where(function ($query) use ($request) {
                        return $query->where('hotel_id', $request->hotel_id);
                    }),
                ],
                'quantity' => 'required|integer|min:1',
            ], [
                'hotel_id.required' => 'El campo hotel es obligatorio.',
                'hotel_id.exists' => 'El hotel seleccionado no existe.',
                'accommodation_id.required' => 'El campo acomodación es obligatorio.',
                'accommodation_id.exists' => 'La acomodación seleccionada no existe.',
                'accommodation_id.unique' => 'Ya existen habitaciones configuradas con estos parámetros.',
                'quantity.required' => 'El campo cantidad es obligatorio.',
                'quantity.integer' => 'El campo cantidad debe ser un número entero.',
                'quantity.min' => 'La cantidad debe ser al menos 1.',
            ]);

            $room = Room::create($validated);

            return response()->json([
                'message' => 'Habitacion creada exitosamente',
                'data' => $room
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Error al gurdar la habitacion',
                'errors' => $e->errors()
            ], 422); // no se puede procesar
        }
        catch (QueryException $e) {
            // Manejar el error de la base de datos
            if ($e->getCode() === 'P0001') { // Código de error específico
                return response()->json([
                    'message' => ' el numero total de habitaciones exceden el maximo permitido para este hotel.',
                ], 400); // Código HTTP 400: Bad Request
            }}
        catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el hotel',
                'error' => $e->getMessage()
            ], 500); //error interno de servidorr
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
        $room->load(['hotel.municipality', 'accommodation.roomType', 'accommodation.assignment']);

        // ajusto  la respuesta para pesonalizar la salida
        return response()->json([
            'id' => $room->id,
            'hotel' => [
                'id' => $room->hotel->id,
                'accommodation_id' => $room->accommodation_id,
                'name' => $room->hotel->name,
                'address' => $room->hotel->address,
                'city_id' => $room->hotel->municipality->id ?? null,
                'city' => $room->hotel->municipality->name ?? null,
                'tax_id' => $room->hotel->tax_id,
                'max_rooms' => $room->hotel->max_rooms,
                'created_at' => $room->hotel->created_at,
                'updated_at' => $room->hotel->updated_at,
            ],
            'room_type' => $room->accommodation->roomType->name ?? null,
            'assignment' => $room->accommodation->assignment->name ?? null,
            'quantity' => $room->quantity,
            'created_at' => $room->created_at,
            'updated_at' => $room->updated_at,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
        try {
            $validated = $request->validate([
                'hotel_id' => [
                    'required',
                    'exists:hotels,id',
                    function ($attribute, $value, $fail) use ($request, $room) {
                        //hago una validacion similara a la del trigger de la DB para capturar el error
                        if (
                            ($request->hotel_id != $room->hotel_id || $request->accommodation_id != $room->accommodation_id) &&
                            Room::where('hotel_id', $request->hotel_id)
                            ->where('accommodation_id', $request->accommodation_id)
                            ->where('id', '!=', $room->id)
                            ->exists()
                        ) {
                            $fail('Ya existen habitaciones configuradas con estos parámetros.');
                        }
                    },
                ],
                'accommodation_id' => 'required|exists:accommodations,id',
                'quantity' => 'required|integer|min:1',
            ]);

            // Actualizar el registro
            $room->update($validated);

            return response()->json([
                'message' => 'Habitación actualizada exitosamente.',
                'data' => $room
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Error al gurdar la habitacion',
                'errors' => $e->errors()
            ], 422); // no se puede procesar
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la habitación',
                'error' => $e->getMessage()
            ], 500); //error interno de servidorr
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
        $room->delete();

        return response()->noContent();
    }
}
