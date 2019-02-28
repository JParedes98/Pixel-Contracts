<?php

namespace App\Http\Controllers;

use App\Contract;
use Spipu\Html2Pdf\Html2Pdf;
use Illuminate\Http\Request;

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
        $this->middleware('auth')->except(['preview', 'setStatusComplete']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(){
        return view('new-contract');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'name_rep' => 'required',
            'social_reason' => 'required',
            'rtn' => 'required|unique:contracts',
            'n_identidad'=> 'required',
            'contact' => 'required',
            'adress' => 'required',
            'tel' => 'required',
            'email' => 'required|unique:contracts',
            'date' => 'required',
        ]);
        
        Contract::create($request->all());
        return redirect('home');
    }

    public function edit($id){
        $contrato = Contract::find($id);
        return view('edit-contract', [
           'contrato' => $contrato, 
        ]);
    }

    public function update(Request $request, $id){
        $contract = Contract::find($id);

        $validateData = $request->validate([
            'name_rep' => 'required',
            'social_reason' => 'required',
            'rtn' => 'required',
            'n_identidad'=> 'required',
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

        return view('contract-pdf', [
           'contrato' => $contrato, 
        ]);
    }

    public function setStatusComplete(Request $request){
        $validateData = $request->validate([
            'rtn' => 'required',
            'signature'=> 'required',
        ]);

        $contrato = Contract::where('rtn',$request->input('rtn'))->first();

        $contrato->signature=$request->input('signature');
        $contrato->status=1; 
        $contrato->save();
        return view('completed-contract');
    }
}
