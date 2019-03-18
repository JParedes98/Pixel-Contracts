<?php

namespace App\Http\Controllers;

use App\Contract;
use Lcobucci\JWT\Builder;
use App\Notifications\ContractCopy;
use App\Notifications\ContractUrl;
use Spipu\Html2Pdf\Html2Pdf;
use Illuminate\Http\Request;
use App\Notifications\GenerateContract;

class ContractController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * 
     * 
     * Exclude contract preview of auth
     * ->except(['preview'])
     * 
     */
    public function __construct()
    {
        /*$this->middleware('auth')->except(['preview', 'setStatusComplete']);*/
        $this->middleware('auth', ['except' => ['preview', 'create']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function newCustomer(){
        return view('new-customer');    
    }

    public function createCustomer( Request $request){
        $request->validate([
            'name_rep' => 'required',
            'email' => 'required',
        ]);
        
        $invite = Contract::create([
            'name_rep' => $request->get('name_rep'),
            'email' => $request->get('email'),
            'date' => '2019-12-17 00:00:00'
        ]);
        $invite->notify(new GenerateContract());
        return redirect('home');
    }

    public function create(){
        return view('new-contract');
    }

    public function store(Request $request, $key){
        $request->validate([
            'name_rep' => 'required',
            'social_reason' => 'required',
            'rtn' => 'required|unique:contracts',
            'n_identidad'=> 'required',
            'm_status'=> 'required',
            'contact' => 'required',
            'adress' => 'required',
            'tel' => 'required',
            'email' => 'required|unique:contracts',
            'date' => 'required',
        ]);

        $solved = base64_decode($key);
        $contrato = Contract::find($solved);
        $contrato->update($request->all());
        $contrato->notify(new ContractUrl());
        return redirect()->route('contrato.preview', ['rtn' => $request->input('rtn')]);
    }

    public function edit($id){
        $contrato = Contract::find($id);
        return view('edit-contract', [
           'contrato' => $contrato, 
        ]);
    }

    public function update(Request $request, $id){
        $contract = Contract::find($id);

        $request->validate([
            'name_rep' => 'required',
            'social_reason' => 'required',
            'rtn' => 'sometimes|required|unique:contracts',
            'n_identidad'=> 'required',
            'm_status'=> 'required',
            'contact' => 'required',
            'adress' => 'required',
            'tel' => 'required',
            'email' => 'required',
            'date' => 'required',
        ]);
        
        $contract->update($request->all());
        return redirect('home');
    }

    public function preview($rtn){
        $contrato = Contract::where('rtn',$rtn)->first();

        if($contrato->status)
            return view('preview-denied');

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
        
        return $html2pdf->output('Contrato PixelPay.pdf');
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

        return view('completed-contract');
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
