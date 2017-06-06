<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientRequest;
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
    public function show() {
        return view('client_pages.show');
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
}
