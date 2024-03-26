<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registro()
    {
        return view('registro.registro');
    }
    public function store(Request $request)
    {
        if ($request->nombre == null){
            return redirect()->route('usuarios.create')
            ->with('danger', 'Error esta enviando un campo vacio');
        }
        if ($request->apellidom == null){
            return redirect()->route('usuarios.create')
            ->with('danger', 'Error esta enviando un campo vacio');
        }
        if ($request->apellidop == null){
            return redirect()->route('usuarios.create')
            ->with('danger', 'Error esta enviando un campo vacio');
        }
        if ($request->fecha_nacimiento == null){
            return redirect()->route('usuarios.create')
            ->with('danger', 'Error esta enviando un campo vacio');
        }
        if ($request->fecha_ingreso == null){
            return redirect()->route('usuarios.create')
            ->with('danger', 'Error esta enviando un campo vacio');
        }
        $validador = User::where('rut', '=', $request->rut)->first();
        $validaemail = User::where('email', '=', $request->email)->first();

        if ($validaemail === null) {
            if ($validador === null) {
                $usuario = new User();
                $usuario->rut = $request->rut;
                $usuario->nombre = $request->nombre;
                $usuario->apellidop = $request->apellidop;
                $usuario->apellidom = $request->apellidom;
                $usuario->fecha_nacimiento = $request->fecha_nacimiento;
                $usuario->fecha_ingreso = $request->fecha_ingreso;
                $usuario->email = $request->email;
                $usuario->rol = 1;
                $usuario->password = Hash::make($request->password);
                $usuario->save();

                return redirect()->route('login');
            } else {
                return redirect()->route('registro.formulario')
                    ->with('danger', 'El RUT ingresado ya existe');
            }
        } else {
            return redirect()->route('registro.formulario')
                ->with('danger', 'El Email ingresado ya existe');
        }


    }
}
