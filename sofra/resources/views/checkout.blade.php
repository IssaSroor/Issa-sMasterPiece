@extends('layouts.master')

@section('content')
    <div>
        {{-- Checkout Form --}}
        <form class="bg0 p-t-40 p-b-85" method="POST" action="{{ route('checkout.placeOrder') }}">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50 checkout"> <!-- Added checkout class for styling -->
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <h4 class="mtext-109 cl2 p-b-30">Checkout</h4>

                            {{-- Name --}}
                            <div class="bor8 bg0 m-b-20">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name"
                                    value="{{ $userData['name'] ?? '' }}" disabled placeholder="Name" />
                            </div>

                            {{-- Email --}}
                            <div class="bor8 bg0 m-b-20">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="email"
                                    value="{{ $userData['email'] ?? '' }}" disabled placeholder="Email Address" />
                            </div>

                            {{-- Phone Number --}}
                            <div class="bor8 bg0 m-b-20">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone"
                                    value="{{ $userData['phone'] ?? '' }}" disabled placeholder="Phone Number" />
                            </div>

                            {{-- Address --}}
                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address"
                                    value="{{ $userData['address'] ?? '' }}" disabled placeholder="Address" />
                            </div>
                        </div>
                    </div>

                    {{-- Order Summary --}}
                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50 summary"> <!-- Added summary class for styling -->
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2">Your Order</h4>

                            {{-- Display the products in the cart --}}
                            @if (!empty($cartItems))
                                @foreach ($cartItems as $item)
                                    <div class="flex-w flex-t bor12 p-b-13 p-t-20">
                                        <div class="size-208">
                                            <span class="stext-110 cl2 p-b-20">
                                                {{ $item['productName'] }}
                                            </span>
                                        </div>
                                        <div class="size-209">
                                            <span class="mtext-110 cl2" style="margin-left: 90px;">
                                                {{ number_format($item['productPrice'], 2) }}JD X {{ $item['quantity'] }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No products in the cart.</p>
                            @endif

                            <div class="flex-w flex-t p-t-20 p-b-10">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">Subtotal:</span>
                                </div>
                                <div class="size-209">
                                    <span class="mtext-110 cl2" style="margin-left: 90px;">
                                        {{ number_format($subtotal, 2) }}JD
                                    </span>
                                </div>
                            </div>

                            {{-- Delivery/Shipping Fee --}}
                            <div class="flex-w flex-t p-t-10 p-b-10">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">Delivery Fee:</span>
                                </div>
                                <div class="size-209">
                                    <span class="mtext-110 cl2" style="margin-left: 90px;">
                                        2.00JD
                                    </span>
                                </div>
                            </div>

                            {{-- Total --}}
                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">Total:</span>
                                </div>
                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2" style="margin-left: 90px;">
                                        {{ number_format($subtotal, 2) + 2 }}JD
                                    </span>
                                </div>
                            </div>

                            <button type="submit"
                                class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection