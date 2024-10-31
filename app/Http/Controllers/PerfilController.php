<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class PerfilController extends Controller
{
    public function index()
    {
        return view('auth.perfil', ['user' => Auth::user()]);
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'firstName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:800', // Limite de 800KB
        ]);

        // Encontre o usuário pelo ID
        $user = User::findOrFail($id);

        // Atualize os dados do usuário
        $user->name = $request->input('firstName');
        $user->email = $request->input('email');

        // Verifique se uma nova foto foi enviada
        if ($request->hasFile('photo')) {
            // Apagar a foto antiga se existir
            if ($user->photo) {
                Storage::delete($user->photo);
            }

            // Salvar a nova foto e obter o caminho
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path; // Atualiza o campo photo com o novo caminho
        }

        // Salve as mudanças no banco de dados
        $user->save();

        return redirect()->route('perfil')->with('success', 'Profile updated successfully!');
    }
}
