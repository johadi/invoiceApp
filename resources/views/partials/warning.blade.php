@if(session()->has('message'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times</span>
        </button>
        <strong>{{session('message')}}</strong>
    </div>
@endif