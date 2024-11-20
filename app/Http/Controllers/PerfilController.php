<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class PerfilController extends Controller
{
    /**
     * Exibe a página de perfil.
     */
    public function index()
    {
        return view('auth.perfil', ['user' => Auth::user()]);
    }

    /**
     * Atualiza os dados do perfil do usuário.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados enviados
        $request->validate([
            'firstName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:800', // Limite de 800KB
        ]);

        // Obtém o usuário autenticado
        $user = User::findOrFail($id);

        // Atualiza os dados do usuário
        $user->name = $request->input('firstName');
        $user->email = $request->input('email');

        // Verifica se uma nova foto foi enviada
        if ($request->hasFile('photo')) {
            // Apaga a foto antiga, se existir
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // Salva a nova foto no diretório 'users' dentro de 'storage/app/public'
            $path = $request->file('photo')->store('users', 'public');
            $user->photo = $path; // Atualiza o campo 'photo' no banco de dados
        }

        // Salva as alterações
        $user->save();

        // Redireciona com mensagem de sucesso
        return redirect()->route('perfil.index')->with('success', 'Perfil atualizado com sucesso!');
    }
}
