@extends('template')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Completed Invoices</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Invoices you successfully generated
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    @include('partials.success')
                                    <table class="table table-striped table-bordered table-hover" id="item-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center">Invoice Number</th>
                                            <th class="text-center">Invoice Client</th>
                                            <th class="text-center">Payment method</th>
                                            <th class="text-center">Date Created</th>
                                            <th class="text-center">Due Date</th>
                                            <th class="text-center">View</th>
                                            <th class="text-center">Edit</th>
                                            <th class="text-center">Remove</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($invoices))
                                            @foreach($invoices as $invoice)
                                                <tr class="text-center">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$invoice->invoice_number}}</td>
                                                    <td>{{$invoice->client->first_name.' '.$invoice->client->last_name}}</td>
                                                    <td>{{$invoice->payment_method}}</td>
                                                    <td>{{$invoice->created_at->toFormattedDateString()}}</td>
                                                    <td>{{$invoice->due_date->toFormattedDateString()}}</td>
                                                    <td><a class="btn btn-success btn-sm" href="/invoice/view/{{$invoice->id}}"><i class="fa fa-check"></i> view</a></td>
                                                    <td><a class="btn btn-primary btn-sm" href="/invoice/edit/{{$invoice->id}}"><i class="fa fa-link"></i> Edit</a></td>
                                                    <td><a class="btn btn-danger btn-sm" href="/invoice/delete/{{$invoice->id}}" onclick="return showConfirm()"><i class="fa fa-times"></i> Remove</a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection