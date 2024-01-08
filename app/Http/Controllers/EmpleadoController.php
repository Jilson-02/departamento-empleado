<?php

namespace App\Http\Controllers;

use App\Models\departamento;
use App\Models\empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    public function index(){
        $departamento = departamento::get();
        $empleado = DB::table('departamentos')
        ->join('empleados', 'departamentos.id', '=', 'empleados.depa_id')
        ->select('empleados.*', 'departamentos.nombre_departamento')
        ->where('empleados.estado', true)
        ->get();
        return view('departamento_empleado.empleados', compact('departamento','empleado'));
    }
    
    public function store(Request $request){
        $empleado = new empleado();
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->puesto = $request->puesto;
        $empleado->salario = $request->salario;
        $empleado->depa_id = $request->depa_id;
        $empleado->save();
        return back();
    }

    public function eliminar($id){
        $empleados = empleado::find($id);
        if($empleados){
            $empleados->estado = false;
            $empleados->save();
            return back();
        }
    }

    public function showProductoBono($id){
        $departamento = departamento::get();
        $empleado = empleado::where('id',$id)->first();
        return view('departamento_empleado.bono', compact('departamento','empleado'));
    }

    public function bono($id, Request $request){
        $empleado = empleado::where('id',$id)->first();
        $alm=0;        //se utilizará para almacenar la nueva cantidad en stock.
        $message="";
        if( $request->cantidadBono <= 0){
            $message="No se realizo el bono";
        }else{
            $alm= $request->cantidadBono + $empleado->salario ;
            $message="Bono realizado";
            $empleado->salario=$alm;
        }

        $empleado->save();
        return redirect('/empleado')->with('status', $message);;
    }


}