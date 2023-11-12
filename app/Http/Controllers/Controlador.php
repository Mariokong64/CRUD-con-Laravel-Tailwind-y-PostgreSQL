<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudadano;
use App\Models\Domicilio;
use App\Models\Estado;

class Controlador extends Controller
{

    //Función de la vista principal
    public function index()
    {
        $datos = Ciudadano::with('domicilio.estado')->get();
        $estados = Estado::all(); // Obtener todos los estados

        return view('vista', compact('datos', 'estados'));
    }

    //Función para guardar un ciudadano nuevo o editado
    public function store(Request $request)
    {

        $ciudadanoId = $request->post('id');
        $ciudadano = Ciudadano::find($ciudadanoId);

        if ($ciudadano) {
    
            $domicilio = Domicilio::find($ciudadano->id_domicilio);
            $domicilio->id_estado = $request->post('estado');
            $domicilio->domicilio = $request->post('domicilio');
            $domicilio->save();

            
            $ciudadano->nombre = $request->post('nombre');
            $ciudadano->apellido_paterno = $request->post('apellidoPaterno');
            $ciudadano->apellido_materno = $request->post('ApellidoMaterno');
            $ciudadano->edad = $request->post('edad');
            $ciudadano->save();

            return redirect()->route('vista.index')->with('success', 'Ciudadano actualizado con éxito');

        } else {
            
            $domicilio = new Domicilio();
            $domicilio->id_estado = $request->post('estado');
            $domicilio->domicilio = $request->post('domicilio');
            $domicilio->save();

            $ciudadano = new Ciudadano();
            $ciudadano->nombre = $request->post('nombre');
            $ciudadano->apellido_paterno = $request->post('apellidoPaterno');
            $ciudadano->apellido_materno = $request->post('ApellidoMaterno');
            $ciudadano->edad = $request->post('edad');
            $ciudadano->id_domicilio = $domicilio->id;
            $ciudadano->save();

            return redirect()->route('vista.index')->with('success', 'Ciudadano agregado con éxito');
        }
    }

    //Función para eliminar un ciudadano
    public function destroy(Request $request)
    {
        $ciudadano = Ciudadano::find($request->id);
        $ciudadano->delete();
        return redirect()->route('vista.index')->with('success', 'Ciudadano eliminado con éxito');
    }
}
