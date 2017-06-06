<?php

namespace App\Http\Controllers;

use App\Ekaruz;
use App\Invoice;
use App\Client;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','store']);
    }

    //route for admin login
    public function index() {
        return view('admin_pages.index');
    }
    public function store(){//when an admin is attempting to login
        $this->validate(request(),[
            'username'=>'required',
            'password'=>'required|min:6'
        ]);
        if(!auth()->attempt(request(['username','password']))){
            session()->flash('message','Invalid Username or Password');
            return back();
        }
        return redirect('/dashboard');
    }
    //route for displaying admin dashboard
    public function dashboard() {
        //get the count of various invoice displays
        $invoice_completed_count=Invoice::where('completed',1)->latest()->get()->count();//only completed invoices count
        $invoice_not_completed_count=Invoice::where('completed',0)->latest()->get()->count();//only pending invoices count
        $invoice_all_count=Invoice::latest()->get()->count(); //all invoices count
        $invoice_not_completed=Invoice::where('completed',0)->latest()->limit(5)->get();//show maximum of 5 incomplete invoices

        //get the count of various client displays
        $clients_with_invoice_count=Client::has('invoices')->with('invoices')->latest()->get()->count();//only with invoices count
        $clients_with_no_invoice_count=Client::doesntHave('invoices')->latest()->get()->count();//only no invoice count
        $clients_all_count=Client::latest()->get()->count(); //all client count

        //get ekaruz settings data
        $ekaruz=Ekaruz::find(1);

        return view('admin_pages.dashboard',compact('clients_all_count','clients_with_no_invoice_count','clients_with_invoice_count','invoice_completed_count','ekaruz','invoice_not_completed_count','invoice_not_completed','invoice_all_count'));
    }

    // route for editing ekaruz details
    public function getSettings() {

        $ekaruz=Ekaruz::find(1);
        return view('admin_pages.settings',compact('ekaruz'));
    }

    public function postSettings() {//post route for settings
        Ekaruz::updateDetail(request()->all());

        session()->flash('message','Settings updated successfully');
        return redirect('/settings');
    }

    public function destroy(){//admin  logout route
        auth()->logout();
        return redirect('/');
    }
}
