@extends('template')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">All Clients with no Invoices</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Clients with no invoices
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-12">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="item-table">
                                        <thead>
                                        <tr>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Company Name</th>
                                            <th>Company Address</th>
                                            <th>invoices</th>
                                            <th>View/Edit</th>
                                            <th>Remove</th>
                                        </tr>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($clients))
                                            @foreach($clients as $client)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$client->first_name}}</td>
                                                    <td>{{$client->last_name}}</td>
                                                    <td>{{$client->email}}</td>
                                                    <td>{{$client->phone1}}</td>
                                                    <td>{{$client->company_name}}</td>
                                                    <td>{{$client->company_address}}</td>
                                                    <td>No invoices yet</td>
                                                    <td><a>View/Edit</a></td>
                                                    <td><a>Remove</a></td>
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