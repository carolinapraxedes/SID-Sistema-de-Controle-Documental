<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\Document;
use PDF;


class FileController extends Controller
{
    public function index(){
        return view('files.index');
    }



    public function generatePdf(Request $request){
        //PDF::SetPrintHeader(false);
        //PDF::SetPrintFooter(false);
        $certificate = 'file://'.base_path().'/storage/app/certificate/certificate.pem';
            // set additional information in the signature
        $info = array(
            'Name' => 'Rafaela Micaela',
            'Location' => 'Brazil',
            'Reason' => 'Generate Demo PDF',
            'ContactInfo' => '',
        );
        PDF::setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);
        PDF::SetFont('helvetica', '', 12);
        PDF::SetCreator('Rafaela Micaela');
        PDF::SetTitle('new-pdf');
        PDF::SetAuthor('rafaela');
        PDF::SetSubject('Generated PDF');
        PDF::AddPage();
        $html = '<div>
            <h1>What is Lorem Ipsum?</h1>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s,
            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            It has survived not only five centuries, but also the leap into electronic typesetting,
            remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
            sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like
            Aldus PageMaker including versions of Lorem Ipsum.
        </div>';

        $documentoCriptografado = encrypt($html);
        // Descriptografar dados
        $documentoDescriptografado = decrypt($documentoCriptografado);
        PDF::writeHTML($documentoDescriptografado, true, false, true, false, '');
        //PDF::Image('kaushalkushwaha.png', 5, 75, 40, 15, 'PNG');
        PDF::setSignatureAppearance(5, 75, 40, 15);
        PDF::Output(public_path('assinado.pdf'), 'F');
        PDF::reset();

        echo "PDF Generated Successfully";

        $conteudoDoDocumento = file_get_contents(public_path('assinado.pdf')); // conteúdo do documento (hash do dicumento)
        $hashDoDocumento = hash('sha256', $conteudoDoDocumento);

        Document::create([
        'title' => 'Hash do documento',
        'hash' => $hashDoDocumento,
        ]);


        echo $hashDoDocumento;



    }
}
