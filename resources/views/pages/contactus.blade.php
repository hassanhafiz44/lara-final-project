@extends('layouts.app')

@section('content')
<div class="row">
    <div class="card col-md-6 offset-md-6">
        <div class="card-body">
            <h1 class="card-title">{{ __('labels.contact_us') }}</h1>
            <div class="d-flex">
                <span class="text-center h1 text-danger align-items-center mr-5"><i class="fa fa-map-marker"></i></span>
                <div>
                    <p class="h2">Find Us Here</p>
                    <span class="card-text">Neika Pura, Pul Aik,</span>
                    <span class="card-text">Sialkot, Pakistan</span>
                </div>
            </div>

            <div class="d-flex mt-5">
                <span class="text-center h1 text-success align-items-center mr-5"><i class="fa fa-phone"></i></span>
                <div>
                    <p class="h2">Give Us a Ring</p>
                    <span class="card-text">Bilal Dar</span>
                    <span class="card-text">0300-1234567</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    @if(session('message'))
        showNotification("{{session('message')}}", 'Success', 'success');
    @endif
</script>
@endsection