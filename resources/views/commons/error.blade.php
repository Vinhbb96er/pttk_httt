@if (Session::has('errorMsg'))
    <div class="col-md-12">
        <div class="alert alert-danger msg-alert">
            <strong>{{ Session::get('errorMsg') }}</strong>
        </div>
    </div>
@endif

@if (Session::has('successMsg'))
    <div class="col-md-12">
        <div class="alert alert-success msg-alert">
            <strong>{{ Session::get('successMsg') }}</strong>
        </div>
    </div>
@endif
