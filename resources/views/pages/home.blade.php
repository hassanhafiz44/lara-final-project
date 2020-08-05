@extends('layouts.app')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}">
@endsection

@section('content')
        <div class="page-content">
              Welocome to Our Store
            </div>

            <footer>
              <div class="footer-container">
                <div class="left-col">
                  <div class="social-media">
                    <a href="#"><i class="fa fa-facebook-f"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                    <a href="#"><i class="fa fa-linkedin-in"></i></a>
                  </div>
                  <p class="rights-text">© 2020 All Rights Reserved.</p>
                </div>

                <div class="right-col">
                  <h1>Our Newsletter</h1>
                  <div class="border"></div>
                  <p>Enter Your Email to get our news and updates.</p>
                  <form action="" class="newsletter-form">
                    <input type="text" class="txtb" placeholder="Enter Your Email">
                    <input type="submit" class="btn" value="submit">
                  </form>
                </div>
              </div>
            </footer>
@endsection
