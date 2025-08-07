<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = User::whereIn('usertype', ['guiche', 'impressao', 'producao', 'caixa','admin','design',])->orderByRaw("FIELD(usertype, 'guiche', 'impressao', 'producao', 'caixa','design','admin')")->get();
        $total = User::count();
        return view('admin.funcionario.home', compact(['funcionarios', 'total']));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $funcionarios = User::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%{$query}%")
                        ->orWhere('usertype', 'like', "%{$query}%")
                        ->orWhere('id', 'like', "%{$query}%");
        })
        ->orderBy('id', 'desc')
        ->get()
        ->map(function($funcionario) {
            return[
                'id' => $funcionario->id,
                'name' => $funcionario->name,
                'usertype' => $funcionario->usertype,
                'editUrl' => route('adminFuncionario.edit', $funcionario->id),  // URL de edição
                'deleteUrl' => route('adminFuncionario.destroy', $funcionario->id),  // URL de de
            ];
        });

        return response()->json($funcionarios);
    }

    public function destroy($id)
    {
        $funcionarios = User::findOrFail($id)->delete();
        if ($funcionarios) {
            session()->flash('success', 'Deletado com Sucesso');
            return redirect(route('adminFuncionario.home'));
        } else {
            session()->flash('error', 'Ocorreu algum problema');
            return redirect(route('adminFuncionario.home', ['id'=> $funcionarios->id]));
        }
    }

    public function edit($id)
    {
        $funcionario = User::findOrFail($id);
        return view('admin.funcionario.update', compact('funcionario'));
    }
    
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos do formulário
        $validation = $request->validate([
            'name' => 'required',
            'password'  => 'nullable|string|min:8|confirmed',  // Senha opcional, mas se fornecida, deve ser confirmada
        ]);
        // Encontrar o funcionário pelo ID
        $funcionario = User::findOrFail($id);
    
        // Atualizando os campos obrigatórios
        $funcionario->name = $request->name;
        $funcionario->usertype = $request->usertype;

        // Verificar se a senha foi fornecida e, se for o caso, criptografar e salvar
        if ($request->filled('password')) {
            // Criptografar a senha
            $funcionario->password = Hash::make($request->password);
        }

        // Salvar os dados atualizados
        $data = $funcionario->save();

        // Verificar se a atualização foi bem-sucedida
        if ($data) {
            session()->flash('success', 'Funcionário Atualizado com Sucesso');
            return redirect(route('adminFuncionario.home', ['id' => $funcionario->id]));
        } else {
            session()->flash('error', 'Ocorreu algum problema');
            return redirect(route('adminFuncionario.update'));
        }
    }
}
