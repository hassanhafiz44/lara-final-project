@extends('layout')

	@section('content')
	 <section class="head pb-5">
        <div class="container py-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-light text-center py-3">Contact Us</h2>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="row pt-3">
                                <div class="col-lg-1 offset-1 col-md-2 col-sm-2 col-2">
                                   <span style="font-size: 35px; color: red;"><i class="fa fa-map-marker" aria-hidden="true"></i>
</span>    
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-9 col-9">
                                    <h3 class="font-weight-light">Find us here</h3>
                                    <p>Neika Pura, Pul Aik <br>
                                       Sialkot,Pakistan </p>
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
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-lg-6 col-sm-12 col-md-12 col-12">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" placeholder="First name">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12 col-md-12 col-12">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" placeholder="Last name">
                                    </div>
                                </div>
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email">
                                <label>Message</label>
                                <textarea class="form-control mb-3" placeholder="Write your message here..."></textarea>
                                <button class="btn btn-primary">Send Message</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
          
      </section>
	@endsection