<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\departamento;
use App\Models\empleado;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index(){
        $departamento = departamento::get();
        $empleado = DB::table('departamentos')
        ->join('empleados', 'departamentos.id', '=', 'empleados.depa_id')
        ->select('empleados.*', 'departamentos.nombre_departamento')
        ->where('empleados.estado',true)
        ->get();
        return view('departamento_empleado.departamentos', compact('departamento','empleado'));
    }

    public function store(Request $request){
        $departamento= new departamento();
        $departamento->nombre_departamento = $request->nombre_departamento;
        $departamento->ubicacion = $request->ubicacion;
        $departamento->save();
        return back();
    }

    public function mostrarEmpleados(Request $request)
    {
        $depa = Departamento::get();
        $datoFiltrado = $request->datoFiltrado;
        $message = " ";

        $empleados = DB::table('empleados')
            ->join('departamentos', 'depa_id', '=', 'departamentos.id')
            ->where('empleados.estado', 1)
            ->where('departamentos.id', '=', $datoFiltrado)
            ->select('empleados.*', 'departamentos.nombre_departamento')
            ->get();

        // Contar el número de empleados en el departamento seleccionado
        $countEmpleados = $empleados->count();

        // Verificar si hay empleados y construir el mensaje en consecuencia
        if ($countEmpleados > 0) {
            $message = "Se encontraron $countEmpleados empleados en el departamento seleccionado.";
        } else {
            $message = "No hay empleados en el departamento seleccionado.";
        }

        // Puedes usar compact para pasar las variables a la vista
        // return view('depaemple.mostrarEmple', compact('empleados', 'depa', 'countEmpleados', 'message'));
        session()->flash('message', $message);
        return view('departamento_empleado.contar', compact('empleados', 'depa', 'countEmpleados', 'message'));
    }

}
