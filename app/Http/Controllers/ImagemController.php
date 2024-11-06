<?php


namespace App\Http\Controllers;

use App\Models\Imagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagemController extends Controller
{
    /**
     * Excluir uma imagem específica.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
{
    $imagem = Imagem::find($id);
    if ($imagem) {
        // Aqui você pode adicionar lógica para deletar a imagem do storage, se necessário
        $imagem->delete();
        return redirect()->back()->with('success', 'Imagem deletada com sucesso!');
    }
    return redirect()->back()->with('error', 'Imagem não encontrada!');
}

}
