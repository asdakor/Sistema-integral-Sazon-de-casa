<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use DateTime;
class UsuariosController extends Controller
{
    //
    public function create()
    {
        return view('CRUDS.usuarios.create');
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
    public function listado()
    {
        $usuarios = User::all();

        return view('CRUDS.usuarios.listado', compact('usuarios'));
    }
    public function show(User $usuario)
    {
        $fechaActual = new DateTime(); // Obtener la fecha actual
        $fechaNacimiento = new DateTime($usuario->fecha_nacimiento); // Convertir la fecha de nacimiento a objeto DateTime

        // Calcular la diferencia entre las dos fechas
        $diferencia = $fechaNacimiento->diff($fechaActual);

        // Obtener la edad desde la diferencia
        $edad = $diferencia->y;

        $rol = Roles::find($usuario->rol);

        return view('CRUDS.usuarios.show', compact('usuario', 'rol', 'edad'));
    }
    public function edit(User $usuario)
    {
        return view('CRUDS.usuarios.edit', compact('usuario'));
    }
    public function update(User $usuario, Request $request)
    {
        $usuario->update($request->all());
        $usuarios = User::all();
        return view('CRUDS.usuarios.listado', compact('usuarios'));
    }
    public function destroy(User $usuario)
    {
        $usuario->delete();
        $usuarios = User::all();
        return view('CRUDS.usuarios.listado', compact('usuarios'));
    }
}

