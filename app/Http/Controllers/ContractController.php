<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Contract;
use Lcobucci\JWT\Builder;
use App\Notifications\ContractCopy;
use App\Notifications\ContractUrl;
use Spipu\Html2Pdf\Html2Pdf;
use Illuminate\Http\Request;
use App\Notifications\GenerateContract;

class ContractController extends Controller
{

    public $contractRules = [
        'legal_representative_name' => 'required',
        'company_social_reason' => 'required',
        'legal_representative_rtn' => 'required',
        'legal_representative_id_number'=> 'required',
        'contact_name' => 'required',
        'company_adress' => 'required',
        'company_tel' => 'required',
        'company_email' => 'required'
    ];

    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'create',
            'store',
            'previewCompleted',
            'setStatusComplete'           
        ]]);
    }

    public function index(){
        $contract = Contract::all()->sortByDesc('created_at');
        return view('home', compact('contract'));
    }
    

    /*NO SE PARA QUE PUTAS ES*/
    public function create($key){
        if(!$model = Contract::find(base64_decode($key)))
            return 'No encuentra Contrato';

        return view('new-contract', ['contract' => $model]);
    }
    
    public function createCustomer(Request $request){
        $request->validate([
            'legal_representative_name' => 'required',
            'company_email' => 'required',
        ]);
        
        $invite = Contract::create([
            'legal_representative_name' => $request->get( 'legal_representative_name'),
            'company_email' => $request->get( 'company_email'),
            'contract_date' => NULL
        ]);

        $invite->notify(new GenerateContract());
        return redirect('index');
    }


    public function store(Request $request){
        $request->validate($this->contractRules);
        
        if(!$contrato = Contract::find($request->input('id')))
            // DEBE SER VISTA DE ERROR
            return view('preview-denied');

        if($contrato->status ){
            return view('preview-denied');
        }

        $contrato->name_rep = $request->input( 'legal_representative_name');
        $contrato->social_reason = $request->input('COMPANY_social_reason');
        $contrato->rtn = $request->input( 'legal_representative_rtn');
        $contrato->n_identidad = $request->input( 'legal_representative_id_number');
        $contrato->m_status = $request->input( 'legal_representative_marital_status');
        $contrato->contact = $request->input('contact_name');
        $contrato->adress = $request->input('company_adress');
        $contrato->tel = $request->input('company_tel');
        $contrato->email = $request->input('company_email');

        $contrato->date = Carbon::now();

        $contrato->save();
        $contrato->notify(new ContractUrl());
        return redirect()->route('contrato.preview', ['id' => $contrato->id]);
}

    public function editContract($id){
        $contrato = Contract::find($id);

        return view('edit-contract', [
           'contrato' => $contrato, 
        ]);
    }

    public function update(Request $request, $id){
        $request->validate($this->contractRules);
        
        $contrato = Contract::find($id);
        

        $contrato->name_rep = $request->input('name_rep');
        $contrato->social_reason = $request->input('social_reason');
        $contrato->rtn = $request->input('rtn');
        $contrato->n_identidad = $request->input('n_identidad');
        $contrato->m_status = $request->input('m_status');
        $contrato->contact = $request->input('contact');
        $contrato->adress = $request->input('adress');
        $contrato->tel = $request->input('tel');
        $contrato->email = $request->input('email');
        $contrato->date = new Carbon($request->input('date'));

        $contrato->save();


        // $contract->update($request->all());
        return redirect('home');
    }

    public function previewCompleted($id){
        $contrato = Contract::find($id);

        if($contrato->status){
            return view('preview-denied');
        }
        return view('contract-preview', [
           'contrato' => $contrato, 
        ]);
    }

    public function pdf($rtn){
        $contrato = Contract::where('rtn',$rtn)->first();

        $html = view('contract-pdf', ['contrato' => $contrato]);
        $html2pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
        $html2pdf->pdf->SetTitle('CONTRATO PIXELPAY');
        $html2pdf->writeHTML($html);
        
        return $html2pdf->output('Contrato_PixelPay.pdf');
    }

    public function setStatusComplete(Request $request){
        $request->validate([
            'rtn' => 'required',
            'signature'=> 'required',
        ]);
        
        $contrato = Contract::where('rtn',$request->input('rtn'))->first();
        $contrato->signature=$request->input('signature');

        $path = public_path('signatures');
        if(!file_exists($path)){
            mkdir($path, 0777);    
        }

        $output_file = public_path('signatures/'.$contrato->id.'.png');
        $ifp = fopen( $output_file, 'cb' );

        $data = explode(',', $request->input('signature'));
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);
                    
        $contrato->status=1; 
        $contrato->save();

        $this->generatePDF($contrato);
        $contrato->notify(new ContractCopy());

        return view('completed-contract', $contrato);
    }

    private function generatePDF($contrato){
        $path = public_path('contracts');
        if(!file_exists($path)){
            mkdir($path, 0777);    
        }

        $path = public_path('contracts/contrato-' . $contrato->id . '.pdf');

        $html = view('contract-pdf', ['contrato' => $contrato]);
        $html2pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
        $html2pdf->pdf->SetTitle('CONTRATO PIXELPAY');
        $html2pdf->writeHTML($html);
        $html2pdf->Output($path, 'F');
    }
}
