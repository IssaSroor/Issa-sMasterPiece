@extends('layouts.master') <!-- Extend your main layout -->

@section('content')
    <!-- Page Start -->
    <div class="container mt-5">
        <div class="d-flex flex-column flex-lg-row">
            <!-- Sidebar -->
            <aside class="sidebar-wrapper col-lg-4 col-md-12 order-lg-1 order-1">
                <!-- Search Widget -->
                <form action="{{ route('menu', ['kitchenId' => $kitchenId]) }}" method="GET" class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search"
                            value="{{ request('search') }}">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>



                <!-- Categories Widget -->
                <div class="categories-widget mb-4 custom-border p-4">
                    <div class="widget-title-2">
                        <h4 class="heading-4">Product Categories</h4>
                    </div>
                    <div class="widget-nav mt-3">
                        <ul>
                            <!-- All Products Option -->
                            <li>
                                <a href="{{ route('menu', ['kitchenId' => $kitchenId]) }}">
                                    <i class="fas fa-angle-right"></i> All Products
                                </a>
                            </li>

                            <!-- Loop through categories -->
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('menu', ['kitchenId' => $kitchenId, 'category' => $category->id]) }}">
                                        <i class="fas fa-angle-right"></i> {{ $category->category_name }}
                                    </a>
                                </li>
                            @endforeach

                            <!-- Discounted Items Option -->
                            <li>
                                <a href="{{ route('menu', ['kitchenId' => $kitchenId, 'discount' => true]) }}">
                                    <i class="fas fa-angle-right"></i> Discounts
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </aside>

            <!-- Products Section -->
            <div class="all-products col-lg-8 col-md-12 order-lg-2 order-2">
                <div class="products-wrapper">
                    @if ($menuItems->isEmpty())
                        <p>No results found for "{{ request('search') }}".</p>
                    @else
                        <div class="row">
                            @foreach ($menuItems as $item)
                                <div class="col-lg-6 col-sm-6 mb-4">
                                    <div class="card border-0 product-card custom-round h-100">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <a>
                                                    <img src="{{ asset('storage/' . $item->item_image) }}"
                                                        class="card-img-top" alt="{{ $item->item_name }}">
                                                </a>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h6 class="heading-6">
                                                        <a>{{ $item->item_name }}</a>
                                                    </h6>
                                                    <!-- Truncate the description -->
                                                    <p class="card-text text-truncate"
                                                        title="{{ $item->item_description }}">
                                                        {{ $item->item_description }}
                                                    </p>
                                                    <div class="card-meta d-flex py-2">
                                                        <div class="product-price pl-4">
                                                            @if ($item->item_discount > 0)
                                                                <span class="text-muted text-decoration-line-through">
                                                                    {{ $item->item_price }} JD
                                                                </span>
                                                                <span class="text-danger">
                                                                    {{ number_format($item->item_price - $item->item_price * $item->item_discount, 2) }}
                                                                    JD
                                                                </span>
                                                            @else
                                                                <span>{{ $item->item_price }} JD</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <button class="mt-3 add-to-cart-btn"
                                                        onclick="addToCart(
                                                        {{ $item->id }}, 
                                                        {{ $item->kitchen_id }}, 
                                                        '{{ $item->item_name }}', 
                                                        {{ $item->item_discount > 0 ? number_format($item->item_price - $item->item_price * $item->item_discount, 2, '.', '') : $item->item_price }}, 
                                                        '{{ asset('storage/' . $item->item_image) }}')">
                                                        Add To Cart
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <!-- Pagination Links -->
                        <div class="custom-pagination d-flex justify-content-center mt-4">
                            {{ $menuItems->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>


@endsection
