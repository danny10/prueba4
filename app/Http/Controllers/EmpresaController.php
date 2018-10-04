<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresaController extends Controller
{

    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $empresas = Empresa::where('condicion','1')->orderBy('nombre', 'desc')->paginate(5); // se trabaja con Paginating Eloquent Results
        }
       else{
            $empresas = Empresa::where($criterio, 'like','%'. $buscar .'%')->orderBy('nombre', 'desc')->paginate(5);
       }
        
        return [
            'pagination' => [
                'total' => $empresas->total(),
                'current_page' => $empresas->currentPage(),
                'per_page' => $empresas->perPage(),
                'last_page' => $empresas->lastPage(),
                'from' => $empresas->firstItem(),
                'to' => $empresas->lastItem(),
            ],
            'empresas' => $empresas
        ];
        
    }  


    public function selectEmpresa(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $empresas = Empresa::where('condicion','=','1')
        ->select('id','nombre')->orderBy('nombre','asc')->get();

        return ['empresas' => $empresas];
    }
    
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $empresa = new Empresa();
        $empresa->nit = $request->nit;
        $empresa->nombre = $request->nombre;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->condicion = '1';
        $empresa->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $empresa = Empresa::findOrFail($request->id);
        $empresa->nit = $request->nit;
        $empresa->nombre = $request->nombre;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->condicion = '1';
        $empresa->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $empresa = Empresa::findOrFail($request->id);
        $empresa->condicion = '0';
        $empresa->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $empresa = Empresa::findOrFail($request->id);
        $empresa->condicion = '1';
        $empresa->save();
    }

    
}
