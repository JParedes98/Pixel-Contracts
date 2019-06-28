<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Contract;
use Response;
use Storage;
use App\User;
use Spipu\Html2Pdf\Html2Pdf;
use Illuminate\Http\Request;
use Faker\Provider\File;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ContractCopy;
use App\Notifications\ContractUrl;
use App\Notification\ContractEdit;
use App\Notifications\GenerateContract;
use App\Notifications\completed_contract;
use Illuminate\Support\Facades\Notification;

class ContractController extends Controller
{

    public $contractRules = [
        'legal_representative_name' => 'required|max:60',
        'company_social_reason' => 'required|max:60',
        'legal_representative_rtn' => 'required|max:24',
        'legal_representative_id_number'=> 'required|max:24',
        'contact_name' => 'required|max:30',
        'company_adress' => 'required|max:80',
        'company_tel' => 'required|max:20',
        'company_email' => 'required|max:40'
    ];

    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'store',
            'newContract',
            'previewCompleted',
            'setStatusComplete',
            'getOnceContractAttachments'           
        ]]);
    }

    public function newCustomer(){
        return view('new-customer');
    }

    public function getAttachView(){
        return view('attach-contract');
    }

    public function getContract($id){
        if($contrato = Contract::find($id)) {
            if ($contrato->contract_status == 4 || $contrato->contract_status == 3) {
                return response()->file(storage_path('contracts/contrato-' . $contrato->id . '-uploaded.pdf'));
            }else {
                return response()->file(storage_path('contracts/contrato-' . $contrato->id . '.pdf'));
            }          
        }
    }

    public function getOnceContractAttachments($id){
        if ($contrato = Contract::find($id)) {

            if (!file_exists(public_path($contrato->contract_attachments))) {
                return view('error-view');
            }

            if ($contrato->contract_status == 4) {
                return response()->file(public_path('contract_attachments/Anexo-Contrato-' . $contrato->id . '-uploaded.pdf'));
            } else {
                return response()->file(public_path('contract_attachments/Anexo-Contrato-' . $contrato->id . '.pdf'));
            }
        }
    }

    public function getContractAttachments($id)
    {
        if ($contrato = Contract::find($id)) {
            if ($contrato->contract_status == 4 || $contrato->contract_status == 3) {
                return response()->file(storage_path('contract_attachments/Anexo-Contrato-' . $contrato->id . '-uploaded.pdf'));
            }else {
                return response()->file(storage_path('contract_attachments/Anexo-Contrato-' . $contrato->id . '.pdf'));
            }
        }
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
            'legal_representative_name' => 'required|max:60',
            'company_email' => 'required|max:40',
            'created_by' => 'required'
        ]);

        $invite = Contract::create([
            'legal_representative_name' => $request->get('legal_representative_name'),
            'company_email' => $request->get('company_email'),
            'contract_status'=> 2,
            'contract_date' => NULL,
            'created_by' => $request->get('created_by')
        ]);

        $path = public_path('contract_attachments');
        if(!file_exists($path)){
            mkdir($path, 0777);
        }

        $file = NULL;
        if ($request->hasFile('contract_attachments')) {
            $file = $request->file('contract_attachments');
            $file_name = 'Anexo-Contrato-' . $invite->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/contract_attachments/', $file_name);

            $invite->contract_attachments = '/contract_attachments/' . $file_name;
            $invite->save();
        }
        
        $invite->notify(new GenerateContract(), $invite->id);
        session()->flash('new-customer', 'Generador de Contrato Enviado Exitosamente.');
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

    public function uploadContract(Request $request){
        
        $invite = Contract::create([
            'legal_representative_name' => $request->get('legal_representative_name'),
            'legal_representative_rtn' => $request->get('legal_representative_rtn'),
            'legal_representative_id_number' => $request->get('legal_representative_id_number'),
            'legal_representative_home' => $request->get('legal_representative_home'),
            'legal_representative_marital_status' => $request->get('legal_representative_marital_status'),
            'contact_name' => $request->get('contact_name'),
            'company_social_reason' => $request->get('company_social_reason'),
            'company_adress' => $request->get('company_adress'),
            'company_tel' => $request->get('company_tel'),
            'company_email' => $request->get('company_email'),
            'created_by' => 2,
            'contract_status' => 4,
            'contract_date' => Carbon::now(),
        ]);
        
        $path = storage_path('contracts');
        if(!file_exists($path)){
            mkdir($path, 0777);
        }
        $file = NULL;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = 'contrato-' . $invite->id . '-uploaded.'. $file->getClientOriginalExtension();
            $file->move(storage_path() . '/contracts/', $file_name);
        }

        $path2 = storage_path('contract_attachments');
        if (!file_exists($path2)) {
            mkdir($path2, 0777);
        }
        $file2 = NULL;
        if ($request->hasFile( 'file_attach')) {
            $file2 = $request->file( 'file_attach');
            $file_name2 = 'Anexo-Contrato-' . $invite->id . '-uploaded.' . $file2->getClientOriginalExtension();
            $file2->move(storage_path() . '/contract_attachments/', $file_name2);

            $invite->contract_file_pdf = '/contracts/' . $file_name;
            $invite->contract_attachments = '/contract_attachments/' . $file_name2;
            $invite->save();
        }
            
        return redirect(route('index'));
    }

    public function editContract($id){
        $contrato = Contract::find($id);

        return view('edit-contract', [
           'contrato' => $contrato, 
        ]);
    }

    public function update(Request $request, $id){        
        $contrato = Contract::find($id);

        $status_prev = $contrato->contract_status;

        if($contrato->contract_status != 4){
            $request->validate($this->contractRules);
        }

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
        if ($status_prev != 4) {
            $contrato->contract_status = 3;
        }

        if($status_prev != 4){
            $contrato->notify(new ContractUrl());

            if ($contrato->contract_attachments) {
                if (!file_exists(storage_path('contract_attachments'))) {
                    mkdir(storage_path('contract_attachments'), 0777);
                }

                if (!file_exists(public_path('contract_attachments'))) {
                    mkdir(public_path('contract_attachments'), 0777);
                }

                $old = storage_path() . $contrato->contract_attachments;
                $new = public_path() . $contrato->contract_attachments;

                if (!file_exists($old)) {
                    return view('error-view');
                }

                copy($old, $new);
                unlink($old);
            }
        }
        $contrato->save();
        $this->deleteContractPDF($contrato);

        

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

    public function setStatusComplete(Request $request){
        $request->validate([
            'legal_representative_rtn' => 'required',
            'contract_signature'=> 'required',
        ]);
        
        $contrato = Contract::find($request->input('id'));

        $path = storage_path('signatures');
        if(!file_exists($path)){
            mkdir($path, 0777);    
        }

        $output_file = storage_path('signatures/'.$contrato->id.'.png');
        $ifp = fopen( $output_file, 'cb' );

        $data = explode(',', $request->input('contract_signature'));
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);
                    
        $contrato->contract_status=1; 
        $contrato->contract_file_pdf = '/contracts/' . 'contrato-' . $contrato->id . '.pdf';
        
        if ($contrato->contract_attachments) {
            if (!file_exists(storage_path('contract_attachments'))) {
                mkdir(storage_path('contract_attachments'), 0777);
            }

            if (!file_exists(public_path('contract_attachments'))) {
                mkdir(public_path('contract_attachments'), 0777);
            }   

            $old = public_path() . $contrato->contract_attachments;
            $new = storage_path() . $contrato->contract_attachments;
            
            if(!file_exists($old)){
                return view('error-view');
            }

            copy($old, $new);
            unlink($old);
        }

        $contrato->save();

        $this->generatePDF($contrato);

        $creator = User::find($contrato->created_by);
        $creator->notify(new completed_contract($contrato->legal_rep_name));
        $contrato->notify(new ContractCopy());

        return view('completed-contract', $contrato);
    }

    private function generatePDF($contrato){
        $path = storage_path('contracts');
        if(!file_exists($path)){
            mkdir($path, 0777);
        }

        $path = storage_path('contracts/contrato-' . $contrato->id . '.pdf');

        $html = view('contract-pdf', ['contrato' => $contrato]);
        $html2pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
        $html2pdf->pdf->SetTitle('CONTRATO PIXELPAY');
        $html2pdf->writeHTML($html);
        $html2pdf->Output($path, 'F');
    }

    private function deleteContractPDF($contrato){
        $path = storage_path('/contracts/contrato-' . $contrato->id . '.pdf');
        if(file_exists($path)){
            unlink($path);
        }
    }

    private function deletePDF($contrato){
        $path = storage_path('/contracts/contrato-' . $contrato->id . '.pdf');
        if (file_exists($path)) {
            unlink($path);
        }

        $path2 = storage_path('contract_attachments/Anexo-Contrato-' . $contrato->id . '.png');
        if (file_exists($path2)) {
            unlink($path2);
        }

        $path3 = public_path('contract_attachments/Anexo-Contrato-' . $contrato->id . '.png');
        if (file_exists($path3)) {
            unlink($path3);
        }

        $path4 = storage_path('signatures/' . $contrato->id . '.pdf');
        if (file_exists($path4)) {
            unlink($path4);
        }
    }

    public function delete(Request $request){
        $contrato = Contract::find($request->id);
        // $this->deletePDF($contrato);
        $contrato->delete();
        session()->flash('deleted-contract', 'El contrato respectivo a ' . $contrato->company_social_reason . ' ha sido eliminado');
        return redirect(route('index'));
    }
}
