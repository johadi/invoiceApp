@extends('template')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Client Details</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        You can update client Details
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3">
                                <form role="form" method="POST">
                                    {{csrf_field()}}
                                    @include('partials.success')
                                    @include('partials.errors')
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control" value="{{$client->first_name}}" name="first_name" placeholder="Client First Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" value="{{$client->last_name}}" name="last_name" placeholder="Client Last name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{$client->email}}" class="form-control" placeholder="Client email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone No#</label>
                                        <input name="phone1" class="form-control" value="{{$client->phone1}}" placeholder="Client Phone Number 1" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone No#2</label>
                                        <input name="phone2" class="form-control" value="{{$client->phone2}}" placeholder="Client Phone Number 2 (Optional)">
                                    </div>
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input name="company_name" class="form-control" value="{{$client->company_name}}" placeholder="Client Company Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Company Address</label>
                                        <textarea name="company_address" placeholder="Client Company Address" class="form-control" rows="3" required>{{$client->company_address}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control" required>
                                            <option>{{$client->gender == 'Male' ? 'Male': 'Female'}}</option>
                                            <option>{{$client->gender == 'Male' ? 'Female': 'Male'}}</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="client_id" value="{{$client->id}}">
                                    <button type="submit" class="btn btn-success">Update Client</button>
                                    <button type="reset" class="btn btn-default">Reset Fields</button>
                                </form>
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