<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    public function getDepartments()
    {
        // Obtener todos los departamentos con sus municipios
        $departments = Department::all();

        return response()->json($departments);
    }

    public function getMunicipalitiesByDepartment($id)
    {

        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }


        $municipalities = $department->municipalities;

        return response()->json($municipalities);
    }
}
