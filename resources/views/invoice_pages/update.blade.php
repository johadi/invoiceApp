@extends('template')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Update Invoice</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        You are about to update Invoice <strong>{{$invoice->invoice_number}}</strong>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="/invoice/show">
                            {{csrf_field()}}
                            @include('partials.warning')
                            <div class="row">
                                <div class="col-lg-6">
                                    <div style="margin-bottom: 0px" class="form-group">
                                        <label>Search for Client by email or name</label>
                                    </div>
                                    <div class="form-group input-group">
                                        <input type="text" placeholder="Search Client by email or name" class="form-control">
                                        <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button"><i class="fa fa-search"></i>
                                                </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div style="margin-bottom: 0px" class="form-group">
                                        <label>Select Client here</label>
                                    </div>
                                    <div class="form-group">
                                        <select name="clients" id="clients" class="form-control" required>
                                            <option
                                                    value="{{$invoice->client->id.'_'.$invoice->client->first_name.' '.$invoice->client->last_name
                                                            .'_'.$invoice->client->email.'_'.$invoice->client->phone1
                                                            .'_'.$invoice->client->company_name}}"
                                            >

                                                {{$invoice->client->first_name.' '.$invoice->client->last_name}}
                                            </option>
                                            @if(count($clients))
                                                @foreach($clients as $client)
                                                    @if($client->id != $invoice->client->id)
                                                        <option
                                                                value="{{$client->id.'_'.$client->first_name.' '.$client->last_name
                                                            .'_'.$client->email.'_'.$client->phone1
                                                            .'_'.$client->company_name}}"
                                                        >

                                                            {{$client->first_name.' '.$client->last_name}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <hr />
                                </div>
                                <div class="col-lg-4">
                                    <h2>Send Invoice to :</h2>

                                    <div class="panel panel-default" id="client-div">
                                        <div class="panel-heading">
                                            Client details
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive table-bordered">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <td id="client_full_name">{{$invoice->client->first_name.' '.$invoice->client->last_name}}</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td id="client_email">{{$invoice->client->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone No</th>
                                                        <td id="client_phone">{{$invoice->client->phone1}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Company name</th>
                                                        <td id="client_company_name">{{$invoice->client->company_name}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <a id="client-link" target="_blank" title="Select Client before clicking here">View full Client detail</a>

                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                    <!-- /.table-responsive -->
                                    <input value="{{$invoice->client->email}}" name="email" id="client_email_hidden" type="hidden">
                                    <input value="{{$invoice->client->id}}" name="client_id" id="client_id" type="hidden">
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-8">
                                    <h2>Invoice Details</h2>
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="disabledSelect">Invoice number</label>
                                            <input class="form-control" id="disabledInput" type="text" value="{{$invoice->invoice_number}}" disabled>
                                            <input name="invoice_number" class="form-control" type="hidden" value="{{$invoice->invoice_number}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="disabledSelect">Payment Method</label>
                                            <select name="payment_method" id="disabledSelect" class="form-control" required>
                                                <option>{{$invoice->payment_method}}</option>
                                                @if($invoice->payment_method != 'Cash Deposit')
                                                    <option>Cash Deposit</option>
                                                @endif
                                                @if($invoice->payment_method != 'Mobile Banking')
                                                    <option>Mobile Banking</option>
                                                @endif
                                                @if($invoice->payment_method != 'Internet Banking')
                                                    <option>Internet Banking</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Invoice due date</label>
                                            <input value="{{$invoice->due_date->toDateString()}}" type="date" class="form-control" id="date" name="date" required>
                                        </div>
                                    </fieldset>

                                    <div class="table-responsive">
                                        <h2><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#itemModal">Add Item</button></h2>
                                        <table class="table table-striped table-bordered table-hover" id="item-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>quantity</th>
                                                <th>total</th>
                                                <th>Edit</th>
                                                <th>Remove</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($invoice->items))
                                                @foreach($invoice->items as $item)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$item->title}}</td>
                                                        <td>{{$item->description}}</td>
                                                        <td>${{$item->price}}</td>
                                                        <td>{{$item->quantity}}</td>
                                                        <td>${{$item->total}}</td>
                                                        <td><a>Edit</a></td>
                                                        <td><a>Remove</a></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <button id="submit" type="submit" class="btn btn-success">Update Invoice</button>
                                    <button type="reset" class="btn btn-default">Reset Fields</button>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- Item Modal -->
        <div id="itemModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Item to this Invoice - (Invoice No: {{$invoice->invoice_number}})</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <form role="form" method="POST" action="/invoice/add-item/by-update">
                                {{csrf_field()}}
                                <h2>Add Item</h2>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" class="form-control" placeholder="i.e Web Application" required>
                                </div>
                                <div class="form-group">
                                    <label>Item Description</label>
                                    <textarea name="description" class="form-control" placeholder="i.e Web Design" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Item Price ($)</label>
                                    <input name="price" class="form-control" placeholder="i.e 1000" required>
                                </div>
                                <div class="form-group">
                                    <label>quantity</label>
                                    <input name="quantity" class="form-control" placeholder="i.e 3" required>
                                </div>
                                <input name="invoice_number" type="hidden" value="{{$invoice->invoice_number}}">

                                <button type="submit" class="btn btn-primary">Add Item</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal end-->
    </div>
    <!-- /#page-wrapper -->
@endsection