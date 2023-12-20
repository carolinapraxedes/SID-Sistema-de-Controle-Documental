<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class FileController extends Controller
{
    public function index()
    {
        return view('files.index');
    }

    public function generatePdf()
    {

        // Obtenha o usuário autenticado
        $user = Auth::user();

        // Dados a serem criptografados
        $dadosDocumento = ['nomeUsuario' => $user->name];

        // Criptografe os dados do documento
        $dadosCriptografados = Crypt::encrypt(json_encode($dadosDocumento));

        // Calcula o hash do conteúdo do PDF
        $hash = hash('sha256', $dadosCriptografados);

        // Carregue a view do PDF e passe os dados criptografados e o hash como variáveis
        $pdf = PDF::loadView('files.pdf', ['dadosCriptografados' => $dadosCriptografados, 'hash' => $hash]);

        // Obtém o conteúdo do PDF como string
        $pdfContent = $pdf->output();

       

        // Retorna o PDF para visualização no navegador (ou para download) com o hash incluído nos cabeçalhos
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="documento.pdf"')
            ->header('Content-Length', strlen($pdfContent))
            ->header('X-Hash', $hash);
 
    }

   
    
}
