<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Contract;
use App\Notifications\ContractCopy;
use App\Notifications\ContractUrl;
use App\Notification\ContractEdit;
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
            'store',
            'newContract',
            'previewCompleted',
            'setStatusComplete'           
        ]]);
    }

    public function index(){
        $contract = Contract::all()->sortByDesc('created_at');
        return view('home', compact('contract'));
    }

    public function newContract($key){
        if(!$model = Contract::find(base64_decode($key))){
            return view('error-view');
        }

        if ($model->contract_status==1) {
            return view('preview-denied');
        }

        return view('new-contract', ['contract' => $model]);
    }
    
    public function createCustomer(Request $request){
        $request->validate([
            'legal_representative_name' => 'required',
            'company_email' => 'required',
        ]);

        $invite = Contract::create([
            'legal_representative_name' => $request->get('legal_representative_name'),
            'company_email' => $request->get('company_email'),
            'contract_status'=> 2,
            'contract_date' => NULL
        ]);

        $invite->notify(new GenerateContract(), $invite->id);
        return redirect(route('index'));
    }

    public function store(Request $request){
        $request->validate($this->contractRules);
        
        if(!$contrato = Contract::find($request->input('id'))){
            return view('error-view');
        }

        if($contrato->contract_status==1){
            return view('preview-denied');
        }

        $contrato->legal_representative_name = $request->input( 'legal_representative_name');
        $contrato->company_social_reason = $request->input('company_social_reason');
        $contrato->legal_representative_rtn = $request->input( 'legal_representative_rtn');
        $contrato->legal_representative_id_number = $request->input( 'legal_representative_id_number');
        $contrato->legal_representative_home = $request->input( 'legal_representative_home');
        $contrato->legal_representative_marital_status = $request->input('legal_representative_marital_status');
        $contrato->contact_name = $request->input('contact_name');
        $contrato->company_adress = $request->input('company_adress');
        $contrato->company_tel = $request->input('company_tel');
        $contrato->company_email = $request->input('company_email');
        $contrato->contract_status= 0;
        $contrato->contract_date = Carbon::now();

        $contrato->save();
        return redirect()->route('contract-preview', ['key' => base64_encode($contrato->id)]);
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

        $contrato->legal_representative_name = $request->input('legal_representative_name');
        $contrato->company_social_reason = $request->input('company_social_reason');
        $contrato->legal_representative_rtn = $request->input('legal_representative_rtn');
        $contrato->legal_representative_id_number = $request->input('legal_representative_id_number');
        $contrato->legal_representative_home = $request->input('legal_representative_home');
        $contrato->legal_representative_marital_status = $request->input('legal_representative_marital_status');
        $contrato->contact_name = $request->input('contact_name');
        $contrato->company_adress = $request->input('company_adress');
        $contrato->company_tel = $request->input('company_tel');
        $contrato->company_email = $request->input('company_email');
        $contrato->contract_date = new Carbon($request->input('contract_date'));
        $contrato->contract_status=3;

        $contrato->save();
        $this->deletePDF($contrato);
        $contrato->notify(new ContractUrl());

        return redirect()->route('index');
    }

    public function previewCompleted($id){
        $contrato = Contract::find(base64_decode($id));

        if($contrato->contract_status==1){
            return view('preview-denied');
        }

        return view('contract-preview', [
           'contrato' => $contrato, 
        ]);
    }

    public function pdf($legal_representative_rtn){
        $contrato = Contract::where( 'legal_representative_rtn', $legal_representative_rtn)->first();

        $html = view('contract-pdf', ['contrato' => $contrato]);
        $html2pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
        $html2pdf->pdf->SetTitle('CONTRATO PIXELPAY');
        $html2pdf->writeHTML($html);
        
        return $html2pdf->output('Contrato_PixelPay.pdf');
    }

    public function setStatusComplete(Request $request){
        $request->validate([
            'legal_representative_rtn' => 'required',
            'contract_signature'=> 'required',
        ]);
        
        $contrato = Contract::find($request->input('id'));

        $path = public_path('signatures');
        if(!file_exists($path)){
            mkdir($path, 0777);    
        }

        $output_file = public_path('signatures/'.$contrato->id.'.png');
        $ifp = fopen( $output_file, 'cb' );

        $data = explode(',', $request->input('contract_signature'));
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);
                    
        $contrato->contract_status=1; 
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

    private function deletePDF($contrato){
    
        $path = public_path('contracts');
        if(!file_exists($path)){
             mkdir($path, 0777);
        }

        $path = public_path('/contracts/contrato-' . $contrato->id . '.pdf');
        if(file_exists($path)){
            unlink($path);
        }
    }
}
