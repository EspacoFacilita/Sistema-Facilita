<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // app/Http/Controllers/UserController.php
    public function getUserName($id)
    {
        // Adicionar log para verificar o valor de $id
        \Log::info('ID recebido para busca: ' . $id);

        // Tente encontrar o usuário pelo ID
        $user = User::find($id);
        // Verifique se o usuário foi encontrado
        if ($user) {
            \Log::info('Usuário encontrado: ' . $user->name);
            return response()->json(['name' => $user->name]);
        }
        // Se o usuário não for encontrado, retorne um erro 404 com mensagem JSON
        \Log::error('Usuário não encontrado com ID: ' . $id);
        return response()->json(['error' => 'Usuário não encontrado!'], 404);
    }

}
