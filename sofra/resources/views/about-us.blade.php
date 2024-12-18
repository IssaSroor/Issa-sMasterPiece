@extends('layouts.master')

@section('content')
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="row p-b-148">
            <div class="col-md-7 col-lg-8">
                <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">Our Story</h3>
                    <p class="stext-113 cl6 p-b-26">
                        <b>
                            The idea of creating this platform came to me from real-life challenges.
                        </b>
                        <br />
                        Many people I know live alone and crave home-cooked meals instead of fast food, but they struggle to find a trustworthy place to order from.  
                        On the other hand, there are working mothers who cannot cook for their children because of their busy schedules.  
                        This platform bridges the gap, offering a solution that helps both groups meet their needs.  
                    </p>
                    <p class="stext-113 cl6 p-b-26">
                        <b>Connecting Communities</b><br />
                        By building this platform, I aim to bring people together through food, providing a convenient way for individuals to enjoy homemade meals while supporting local kitchens.  
                    </p>
                </div>
            </div>
            <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                <div class="how-bor1">
                    <div class="hov-img0">
                        <img src="{{ asset('images/about1.jpg') }}" alt="Our Story">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="order-md-2 col-md-7 col-lg-8 p-b-30">
                <div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">Our Mission</h3>
                    <p class="stext-113 cl6 p-b-26">
                        <b>
                            Empowering both service users and local kitchens to thrive.
                        </b>
                    </p>
                    <div class="bor16 p-l-29 p-b-9 m-t-22">
                        <p class="stext-114 cl6 p-r-40 p-b-11">
                            My mission is to create a platform that serves as a bridge between those who need reliable and delicious homemade food and local kitchens that aim to grow their reputation and earn income.  
                            This platform is designed to make it easy for users to find trustworthy kitchens and for kitchens to reach a larger audience.  
                        </p>
                    </div>
                    <div class="bor16 p-l-29 p-b-9 m-t-22">
                        <p class="stext-114 cl6 p-r-40 p-b-11">
                            By fostering this connection, I aim to create a win-win situation where everyone benefits — people get access to quality homemade meals, and local kitchens gain popularity and financial stability to continue their journey.  
                        </p>
                    </div>
                </div>
            </div>
            <div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
                <div class="how-bor2">
                    <div class="hov-img0">
                        <img src="{{ asset('images/about2.jpg') }}" alt="Our Mission">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
