@extends('template')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-2">
                                <i class="fa fa-tasks fa-4x"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                                <div class="huge">{{$invoice_not_completed_count > 0 ? $invoice_not_completed_count : 0}}</div>
                                <div>Pending Invoices</div>
                            </div>
                        </div>
                    </div>
                    <a href="/invoice/show/all-not-completed">
                        <div class="panel-footer">
                            <span class="pull-left">View Invoices yet to finish generating</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-eye fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$invoice_completed_count > 0 ? $invoice_completed_count: 0}}</div>
                                <div>Invoices completed</div>
                            </div>
                        </div>
                    </div>
                    <a href="/invoice/show/all-completed">
                        <div class="panel-footer">
                            <span class="pull-left">View completed Invoices</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$invoice_all_count > 0 ? $invoice_all_count : 0}}</div>
                                <div>All available Invoices</div>
                            </div>
                        </div>
                    </div>
                    <a href="/invoice/show/all">
                        <div class="panel-footer">
                            <span class="pull-left">View All Invoices</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$clients_with_no_invoice_count}}</div>
                                <div>Clients With no invoices yet!</div>
                            </div>
                        </div>
                    </div>
                    <a href="/client/show/all-not-completed">
                        <div class="panel-footer">
                            <span class="pull-left">View Clients with no invoices</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-eye fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$clients_with_invoice_count}}</div>
                                <div>Clients with invoices</div>
                            </div>
                        </div>
                    </div>
                    <a href="/client/show/all-completed">
                        <div class="panel-footer">
                            <span class="pull-left">View Clients with completed invoices</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$clients_all_count}}</div>
                                <div>All available Clients</div>
                            </div>
                        </div>
                    </div>
                    <a href="/client/show/all">
                        <div class="panel-footer">
                            <span class="pull-left">View all Clients</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-exclamation-triangle fa-fw text-danger"></i> Invoices You are yet to Complete
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice Number</th>
                                    <th>Date Created</th>
                                    <th>Complete</th>
                                    <th>Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($invoice_not_completed))
                                    @foreach($invoice_not_completed as $invoice)
                                        <tr class="text-danger text-center">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$invoice->invoice_number}}</td>
                                            <td>{{$invoice->created_at->toFormattedDateString()}}</td>
                                            <td><a class="btn btn-primary btn-sm" href="/invoice/generate/{{$invoice->id}}"><i class="fa fa-link"></i> Complete Invoice</a></td>
                                            <td><a class="btn btn-danger btn-sm" href="/invoice/delete/{{$invoice->id}}" onclick="return showConfirm()"><i class="fa fa-times"></i> Remove</a></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel bar-->


            </div>
            <!-- /.col-lg-8 -->

            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle fa-fw"></i> Ekaruz Settings
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            <a class="list-group-item">
                                <i class="fa fa-check-circle fa-fw"></i> {{$ekaruz->email}}
                            </a>
                            <a class="list-group-item">
                                <i class="fa fa-check-circle fa-fw"></i> {{$ekaruz->phone1.' | '.$ekaruz->phone2}}
                            </a>
                            <a class="list-group-item">
                                <i class="fa fa-check-circle fa-fw"></i> {{$ekaruz->street_address}}
                            </a>
                            <a class="list-group-item">
                                <i class="fa fa-check-circle fa-fw"></i> {{$ekaruz->town_address}}
                            </a>
                            <a class="list-group-item">
                                <i class="fa fa-check-circle fa-fw"></i> {{$ekaruz->state_address}}
                            </a>
                        </div>
                        <!-- /.list-group -->
                        <a  href="/settings" class="btn btn-info btn-block">View and Update Settings</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
@endsection