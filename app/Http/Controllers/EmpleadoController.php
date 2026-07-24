<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\Empleado;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia; 
use Inertia\Response;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :Response
    {
       $empleados = Empleado::orderBy('id_empleado','desc')->get();

       return Inertia::render('Empleados/Index',[
            'empleados'=> $empleados,
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() :Response
    {
        return Inertia::render('Empleados/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpleadoRequest $request): RedirectResponse
    {
      $datos = $request->validated();

      dd([
        'datos_validados' => $datos,
        'request_all' => $request->all(),
        'hasFile' => $request->hasFile('foto'),
        'file' => $request->file('foto'),
      ]);

      if($request->hasFile('foto')){
        $ruta = $request->file('foto')->store(
            'empleados',
            'public'
        );
        $datos['foto'] = $ruta;
      }

      Empleado::create($datos);

      return redirect ()
        ->route('empleados.index')
        ->white('success','Emplead registrado con exito. ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado): Response
    {
        return Inertia::render('Empleados/Edit',[
            'empleado' => $empleado,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpleadoRequest $request, Empleado $empleado): RedirectResponse
    {
        $datos = $request->validated();

        dd([
            'empleado' => $empleado,
            'datos_validados' => $datos, 
            'request_all' => $request->all(),
            'hasFile' => $request->hasFile('foto'),
            'file' => $request->file('foto'),
        ]);

        if($request->hasFile('foto')){
            $rute = $request->file('foto')->store(
                'empleados',
                'public'
            );
            $datos['foto'] =$rute
        }

        $empleado->update($datos);

        return redirect()
            ->route('empleados.index')
            ->with('success','Empleado actulaizadocorrectamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado): RedirectResponse
    {
        if ($empleado->foto && Storage::disk('public')->exists($empleado->foto)){
            Storage::disk ('public')->delete($empleado->foto);
        }

        $empleado->delete();

        return redirevt()
            ->route('empleados.index')
            ->white('success','Empleado eliminado correctamenete.')
    }
}