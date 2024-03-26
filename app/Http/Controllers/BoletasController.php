<?php

namespace App\Http\Controllers;

use App\Models\Boletas;
use App\Models\DetallesBoletas;
use Illuminate\Http\Request;

class BoletasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Boletas $boletas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Boletas $boletas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Boletas $boletas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boletas $boleta)
    {
        $boleta->delete();
        return redirect()->route("boletas.buscar")->with('danger', 'la boleta ha sido anulada');
    }
    public function buscar(){
        $boletas = Boletas::all();
        $detalles = DetallesBoletas::all();
        return view("CRUDS.boletas.busqueda", compact("boletas",'detalles'));
    }
    public function filtrar(Request $request){
        $boleta = Boletas::find($request->buscar);
        if ($boleta == NULL) {
            return redirect()->route('boletas.buscar')
                ->with('danger', 'el numero de boleta no existe');
        } else {

            return redirect()->route('boletas.encontrada', $boleta);
        }
    }
    public function deldia(){
        $boletas = Boletas::all()->where('fecha','=', date("Y-m-d"));

        return view('CRUDS.boletas.boletasdeldia', compact('boletas'));
    }
    public function porfecha(){
        

        return view('CRUDS.boletas.porfecha');
    }
    public function encontrada(Boletas $boleta){
        $detalles = DetallesBoletas::all();

        return view('CRUDS.boletas.encontrado', compact('boleta', 'detalles'));
    }

    public function listadoporfecha(Request $request){
        
        $boletas = Boletas::all()->whereBetween('fecha', [$request->fechainicio, $request->fechafinal]);
        
        return view('CRUDS.boletas.listadoporfecha', compact('boletas'));
    }

    public function anularboleta(){
        

        return view('CRUDS.boletas.anularboleta');
    }
    public function filtraranular(Request $request){
        $boleta = Boletas::find($request->buscar);
        if ($boleta == NULL) {
            return redirect()->route('boletas.anularboleta')
                ->with('danger', 'el numero de boleta no existe');
        } else {

            return redirect()->route('boletas.anularencontrada', $boleta);
        }
    }

    public function anularencontrada(Boletas $boleta){
        
        $detalles = DetallesBoletas::all();
        return view('CRUDS.boletas.anularencontrada', compact('boleta', 'detalles'));
    }
    public function cancelarcompra(Boletas $boleta){
        $detalles = DetallesBoletas::Where('id_boleta','=',$boleta->id_boleta);
        foreach($detalles as $detalle){
            $detalle->delete();
        }
        $boleta->delete();
        return redirect()->route('sazon.caja');
    }
}
