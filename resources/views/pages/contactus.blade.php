@extends('layouts.app')

@section('content')
<section class="head pb-5" data-aos="fade-right">
    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <h1 class="font-weight-bold text-center py-3">{{ __('labels.contact_us') }}</h1>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="row pt-3">
                            <div class="col-lg-1 offset-1 col-md-2 col-sm-2 col-2">
                                <span style="font-size: 35px; color: red;"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="col-lg-10 col-md-9 col-sm-9 col-9">
                                <h3 class="font-weight-light">Find us here</h3>
                                <p>Neika Pura, Pul Aik,<br> Sialkot, Pakistan </p>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-lg-1 offset-1 col-md-2 col-sm-2 col-2">
                                <span style="font-size: 35px; color: green;"><i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="col-lg-10 col-md-9 col-sm-9 col-9">
                                <h3 class="font-weight-light">Give us a ring</h3>
                                <p>Bilal Dar<br>
                                    0300-1234567<br> 9AM - 8PM
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <form action="{{ route('pages.submit.contact.us') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-sm-12 col-md-12 col-12">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" value="{{ $customer->name }}" placeholder="Enter your name" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" placeholder="Enter your email" readonly value="{{ $customer->email}}">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" class="form-control mb-3" placeholder="Write your message here" minlength="15" maxlength="500" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@section('scripts')
<script>
    @if(session('message'))
        showNotification("{{session('message')}}", 'Success', 'success');
    @endif
</script>
@endsection