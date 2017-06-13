<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function create() {
        return view('client_pages.create');
    }
    public function store(ClientRequest $request) {
        Client::addClient(request(['first_name','last_name','email','phone1','phone2','company_name','company_address','gender']));

        session()->flash('message','New Client successfully added');
        return redirect('/client/create');
    }
    public function index($status) {//Client routers
        if($status==='all-completed'){
            $clients=Client::has('invoices')->with('invoices')->latest()->get();
            return view('client_pages.completed',compact('clients'));
        }
        if($status==='all-not-completed'){

            $clients=Client::doesntHave('invoices')->latest()->get();
            return view('client_pages.not_completed',compact('clients'));
        }
        if($status==='all'){
            $clients=Client::latest()->get();
            return view('client_pages.all',compact('clients'));
        }

        return 'Oops! 404';
    }
    public function viewProcess(Client $client) {
        if($client){
            session(['client'=>$client]);
            return redirect('/client/view');
        }
    }
    public function viewClient() {
        if(session('client')){
            return view('client_pages.view')->with(['client'=>session('client')]);
        }
    }
    public function viewClientPost(ClientUpdateRequest $updateRequest) {
        if(count(request()->all())){
            //return request(['client_id','first_name','last_name','email','phone1','phone2','company_name','company_address','gender']);
            Client::updateClient(request(['first_name','last_name','email','phone1','phone2','company_name','company_address','gender']),request('client_id'));
            session()->flash('message','Client details updated successfully');
            $updated_client=Client::find(request('client_id'));
            session(['client'=>$updated_client]);
            return redirect('/client/view');
        }
    }
    public function destroy(Client $client) {
        if($client){
            if(count($client->invoices)){//if client has invoices attached to it
                foreach ($client->invoices as $invoice){//loop through each invoice
                    if(count($invoice->items)){
                        $invoice->items()->delete();//delete items for each invoice
                    }
                }
                $client->invoices()->delete();//delete invoices for this client
            }

            $client_name=$client->first_name.' '.$client->last_name;
            $client->delete(); //delete client
            session()->flash('message','Client '.$client_name.' was removed successfully');
            return back();
        }
    }
}
