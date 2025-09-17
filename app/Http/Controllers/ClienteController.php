<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fone' => 'required|unique:clientes|regex:/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/',
            'nome' => 'required|string|max:255',
            'endereco' => 'nullable|string|max:255',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }


    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'fone' => 'required|regex:/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/|unique:clientes,fone,' . $cliente->id,
            'nome' => 'required|string|max:255',
            'endereco' => 'nullable|string|max:255',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }

    public function autocomplete(Request $request)
    {
        $query = $request->input('search');

        $clientes = Cliente::when($query, function ($q) use ($query) {
            $q->where('nome', 'LIKE', '%' . $query . '%');
        })
            ->orderBy('nome', 'asc')
            ->get(['id', 'nome', 'endereco', 'fone']);

        return response()->json($clientes);
    }
}
