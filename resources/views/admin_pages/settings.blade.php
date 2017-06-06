@extends('template')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ekaruz settings</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ekaruz settings Form
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3">
                                <form role="form" method="POST">
                                    {{csrf_field()}}
                                    @include('partials.success')
                                    <div class="form-group">
                                        <label>Ekaruz Phone #1</label>
                                        <input class="form-control" name="phone1" value="{{$ekaruz->phone1}}" placeholder="Ekaruz Phone No 1">
                                    </div>
                                    <div class="form-group">
                                        <label>Ekaruz Phone #2</label>
                                        <input class="form-control" name="phone2" value="{{$ekaruz->phone2}}" placeholder="Ekaruz Phone No 2">
                                    </div>
                                    <div class="form-group">
                                        <label>Ekaruz Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$ekaruz->email}}" placeholder="Ekaruz email">
                                    </div>
                                    <div class="form-group">
                                        <label>Ekaruz Street Address</label>
                                        <input  class="form-control" name="street_address" value="{{$ekaruz->street_address}}" placeholder="Ekaruz Street Address">
                                    </div>
                                    <div class="form-group">
                                        <label>Ekaruz State Address</label>
                                        <input class="form-control" name="state_address" value="{{$ekaruz->state_address}}" placeholder="Ekaruz State Address">
                                    </div>
                                    <div class="form-group">
                                        <label>Ekaruz Town Address</label>
                                        <input  class="form-control" name="town_address" value="{{$ekaruz->town_address}}" placeholder="Ekaruz Town Address">
                                    </div>
                                    <button type="submit" class="btn btn-success">Update Settings</button>
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