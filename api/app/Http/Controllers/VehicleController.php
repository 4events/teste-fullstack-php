<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Vehicle::all();
    }

    public function filter(Request $request)
    {
        $vehicles = Vehicle::query();

        if ($request->has('make')) {
            $vehicles->where('make', $request->input('make'));
        }
    
        if ($request->has('model')) {
            $vehicles->where('model', $request->input('model'));
        }
    
        return $vehicles->get();
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
        $request->validate([
            'veiculo' => 'required',
            'marca' => 'required',
            'ano' => 'required',
            'descricao' => 'required',
            'vendido' => 'required',
        ]);

        return Vehicle::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Vehicle::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function search($vehicle)
    {
        return Vehicle::where('veiculo', 'LIKE', '%' . $vehicle . '%')->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicle = vehicle::find($id);
        $vehicle->veiculo = $request->veiculo;
        $vehicle->marca = $request->marca;
        $vehicle->ano = $request->ano;
        $vehicle->descricao = $request->descricao;
        $vehicle->vendido = $request->vendido;
        $vehicle->save();
    
        return response()->json(['vehicle' => $vehicle], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle) {
            $vehicle->delete();
            return response()->json([
                'message' => 'Veículo deletado com sucesso!'
            ]);
        } else {
            return response()->json([
                'message' => 'Erro ao deletar veículo!'
            ], 400);
        }
    }
}
