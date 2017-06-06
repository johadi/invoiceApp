<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //get the invoice number by incoming query or generate new invoice number
    public function generate($status){
        if($status && $status==='new'){
            //we gonna generate new invoice number randomly and send it to create route
            $invoice_number=abs(crc32(uniqid()));
            session(['invoice_number'=>$invoice_number]);
            return redirect('/invoice/create');
        }
        if($status){//let us check the incoming query
            $invoice=Invoice::find($status);
            if(!$invoice){//someone wants to trick us. e no go work
                return 'Oops! 404';
            }
            if($invoice->completed==1){ //person wants to claim smart. back to sender
                return back();
            }
            //admin really want to complete invoice,set session and send to invoice/create route for necessary action
            session(['invoice_number'=>$invoice->invoice_number]);
            return redirect('/invoice/create');

        }
    }
    //this display form page that will be used to generate invoice
    public function create() {
        if(!session('invoice_number')){
            return back();
        }
        $clients=Client::all();
        $invoice_number=session('invoice_number');//get invoice_number from session
        $invoice=Invoice::where('invoice_number',$invoice_number)->first();

        if($invoice != null){ // there is an existing invoice with this session invoice number

            if($invoice->completed==1){//invoice is already completed, we redirect to show invoice page
                session(['invoice_id'=>$invoice->id]);
                return redirect('/invoice/show');
            }
            //not yet completed ,redirect to page for invoice completion
            $items=$invoice->items;
            return view('invoice_pages.create',compact('clients','invoice_number','items'));
        }
        //no existing invoice number . we might have to create a new invoice with this session invoice number
        Invoice::create([
            'invoice_number'=>$invoice_number,
            'payment_method'=>'',
            'client_id'=>0,
            'admin_id'=>0,
            'ekaruz_id'=>0
        ]);

        $items=[];
        return view('invoice_pages.create',compact('clients','invoice_number','items'));

    }
    //for adding items to invoice
    public function storeItem($item_query){
        //use the invoice number to get the invoice id from db
        if(request('invoice_number') && $item_query){
            $invoice_id=Invoice::where('invoice_number',request('invoice_number'))->first()->id;
            Item::create([
                'description'=>request('description'),
                'price'=>(int)request('price'),
                'title'=>request('title'),
                'total'=>(int)request('price')*(int)request('quantity'),
                'quantity'=>(int)request('quantity'),
                'invoice_id'=>$invoice_id
            ]);

            if($item_query=='by-update'){//admin added item from within invoice update page
                return redirect('/invoice/edit/'.$invoice_id.'#item-table');
            }
            return redirect('/invoice/create#item-table');// admin added item via create invoice page
        }
    }

    //POST route to handle form generating the complete invoice (request can come from invoice/edit or invoice/create)
    public function postShow(){
        $invoice=Invoice::where('invoice_number',request('invoice_number'))->first();
        if(!$invoice){
            return 'No invoice';
        }
        $invoice_item=Item::where('invoice_id',$invoice->id)->first();
        if(!$invoice_item){
            session()->flash('message','Invoice must have at least one item');
            return back();

        }
        $invoice->payment_method=request('payment_method');
        $invoice->client_id=(int)request('client_id');
        $invoice->due_date=request('date');
        $invoice->admin_id=1; //can be gotten from d DB if more than one admin logged in using auth()->user->id
        $invoice->ekaruz_id=1;//used to get d details of ekaruz settings
        $invoice->completed=1;//invoice successfully generated
        $invoice->save();

        session(['invoice_id'=>$invoice->id]);
        return redirect('/invoice/show');
    }
    //get route to displays the generated invoice
    public function getShow(){
        if(session('invoice_id')){
            $invoice=Invoice::find(session('invoice_id'));
            //let's get the total of invoice items if any
            $invoice_items=$invoice->items;
            $invoice_items_total=0;
            if(count($invoice_items)){
                foreach ($invoice_items as $item){
                    $invoice_items_total +=$item->total;
                }
            }

            $invoice_items_total=$invoice_items_total > 0 ? $invoice_items_total: '';
            return view('invoice_pages.show',compact('invoice','invoice_items_total'));
        }
    }

//---------------- Type of invoice display options----------------------------
    public function index($status){
        if($status==='all-completed'){
            $invoices=Invoice::where('completed',1)->latest()->get();
            return view('invoice_pages.completed',compact('invoices'));
        }
        if($status==='all-not-completed'){
            $invoices=Invoice::where('completed',0)->latest()->get();
            return view('invoice_pages.not_completed',compact('invoices'));
        }
        if($status==='all'){
            $invoices=Invoice::latest()->get();

            return view('invoice_pages.all',compact('invoices'));
        }

        return 'Oops! 404';
    }

    //---------Handling View, delete and edit of completed/uncompleted invoices ----------------------------
    public function view(Invoice $invoice){
        if($invoice && $invoice->completed===1){//to make sure is a completed invoice
            session(['invoice_id'=>$invoice->id]);
            return redirect('/invoice/show');//invoice is completed, we redirect to show invoice page
        }
        return 'Oops! Somethings went wrong';
    }
    public function update(Invoice $invoice){
        if($invoice && $invoice->completed===1){
            $clients=Client::all();
            return view('invoice_pages.update',compact('clients','invoice'));
        }
        return 'Oops! Something went wrong';
    }
    public function destroy(Invoice $invoice){

        if($invoice){
           if(count($invoice->items)){
               $invoice->items()->delete();
           }
           $invoice_number=$invoice->invoice_number;
           $invoice->delete();
           session()->flash('message','Invoice '.$invoice_number.' was removed successfully');
           return back();
        }
    }
}
