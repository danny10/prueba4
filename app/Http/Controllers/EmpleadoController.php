<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/'); //solo permite acceder a este metodo mediante peticiones ajax

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            // se debe unir con la tabla empresa por la llave foranea
            // se trabaja con Paginating Eloquent Results
            $empleados = Empleado::join('empresas','empleados.empresa_id','=','empresas.id')
            ->select('empleados.id','empleados.empresa_id','empleados.cedula','empleados.nombre',
            'empleados.apellido','empleados.telefono','empleados.direccion',
            'empresas.nombre as nombre_empresa','empleados.condicion')
            ->where('empleados.condicion','1')->orderBy('empleados.nombre', 'desc')->paginate(5); 
        }
       else{

            if($criterio == 'nombre'){

                $empleados = Empleado::join('empresas','empleados.empresa_id','=','empresas.id')
                ->select('empleados.id','empleados.empresa_id','empleados.cedula','empleados.nombre',
                'empleados.apellido','empleados.telefono','empleados.direccion',
                'empresas.nombre as nombre_empresa','empleados.condicion')
                ->where('empleados.'.$criterio, 'like','%'. $buscar .'%')
                ->orderBy('empleados.nombre', 'desc')->paginate(5); 

            }else{
                $empleados = Empleado::join('empresas','empleados.empresa_id','=','empresas.id')
                ->select('empleados.id','empleados.empresa_id','empleados.cedula','empleados.nombre',
                'empleados.apellido','empleados.telefono','empleados.direccion',
                'empresas.nombre as nombre_empresa','empleados.condicion')
                ->where('empresas.nombre', 'like','%'. $buscar .'%')
                ->orderBy('empleados.nombre', 'desc')->paginate(5); 
            }
 
       }
        
        return [
            'pagination' => [
                'total' => $empleados->total(),
                'current_page' => $empleados->currentPage(),
                'per_page' => $empleados->perPage(),
                'last_page' => $empleados->lastPage(),
                'from' => $empleados->firstItem(),
                'to' => $empleados->lastItem(),
            ],
            'empleados' => $empleados
        ];
        
    }
    
    public function listarEmpleados(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $empleados = Empleado::join('empresas','empleados.empresa_id','=','empresas.id')
            ->select('empleados.id','empleados.empresa_id','empleados.cedula','empleados.nombre','empresas.nombre as nombre_empresa','empleados.apellido','empleados.telefono','empleados.direccion','empleados.condicion')
            ->orderBy('empleados.nombre', 'desc')->paginate(10);
        }
        else{
            $empleados = Empleado::join('empresas','empleados.empresa_id','=','empresas.id')
            ->select('empleados.id','empleados.empresa_id','empleados.cedula','empleados.nombre','empresas.nombre as nombre_empresa','empleados.apellido','empleados.telefono','empleados.direccion','empleados.condicion')
            ->where('empleados.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('empleados.nombre', 'desc')->paginate(10);
        }
         
 
        return ['empleados' => $empleados];
    }
    
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $empleado = new Empleado();
        $empleado->empresa_id = $request->empresa_id;
        $empleado->cedula = $request->cedula;
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->telefono = $request->telefono;
        $empleado->direccion = $request->direccion;
        $empleado->condicion = '1';
        $empleado->save();
        
    }


    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->id);
        $empleado->empresa_id = $request->empresa_id;
        $empleado->cedula = $request->cedula;
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->telefono = $request->telefono;
        $empleado->direccion = $request->direccion;
        $empleado->condicion = '1';
        $empleado->save();
    }


    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->id);
        $empleado->condicion = '0';
        $empleado->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->id);
        $empleado->condicion = '1';
        $empleado->save();
    }
}
