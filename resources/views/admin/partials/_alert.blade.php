{{-- @if (session('success'))
<div class="" style="position: fixed; top: 0; right: 0;">

    <div class="toast bg-success fade " data-delay="8000" role="alert"  aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Thông báo</strong>
            <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="toast-body">
            {{sestion('success')}}
        </div>
    </div>
</div>
@endif
@if (session('error'))
<div class="" style="position: fixed; top: 0; right: 0;">

    <div class="toast bg-danger fade " data-delay="8000" role="alert"  aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Thông báo</strong>
            <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="toast-body">
            {{ session('error') }}
        </div>
    </div>
</div>
@endif  --}}
@if (session('error'))
<div class="row">
    <div class="col-12 col-xs-12 col-md-12 col-lg-12  pd-0 pd-t-15">
        <div class="alert alert-danger mg-b-0 " role="alert">
            {{ session('error') }}
            <button type="button" class="close iconAlert" data-dismiss="alert" aria-label="Close">x</button>
        </div>
    </div>
</div>
@endif
@if (session('success'))
<div class="ro">
    <div class="col-12 col-xs-12 col-md-12 col-lg-12  pd-0 pd-t-15">
        <div class="alert alert-success mg-b-0 ">
            {{session('success')}}
            <button type="button" class="close iconAlert" data-dismiss="alert" aria-label="Close">x</button>
        </div>
    </div>
</div>
@endif
