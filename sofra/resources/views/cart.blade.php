@extends('layouts.master')

@section('content')
    <div>
        <form class="bg0 p-t-40 p-b-85">
            <div class="container">
                <?php
                // Fetch cart data from cookies
                $cart = [];
                if (isset($_COOKIE['cart'])) {
                    $cart = json_decode($_COOKIE['cart'], true);
                }
                ?>

                <div class="cart-container">
                    <!-- Cart Table -->
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>

                    <!-- Cart Summary Section -->
                    <div class="cart-summary">
                        <h4>Cart Totals</h4>
                        <div class="summary-item">
                            <span>Subtotal:</span>
                            <span id="subtotal">0 JD</span>
                        </div>
                        <div class="summary-item">
                            <span>Shipping:</span>
                            <span id="shipping">2 JD</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-total">Total:</span>
                            <span id="total">0 JD</span>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="checkout-btn">Proceed to Checkout</a>
                    </div>

                </div>

            </div>

    </div>
    </div>
    </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to all plus and minus buttons
            document.querySelectorAll('.quantity-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const isPlus = btn.classList.contains('plus-btn');
                    const productId = btn.dataset.id;
                    const quantitySpan = document.getElementById(`quantity-${productId}`);
                    let currentQuantity = parseInt(quantitySpan.textContent);

                    // Update quantity
                    if (isPlus) {
                        currentQuantity++;
                    } else if (currentQuantity > 1) { // Prevent quantity from going below 1
                        currentQuantity--;
                    }

                    // Update the quantity on the frontend
                    quantitySpan.textContent = currentQuantity;

                    // Make an AJAX request to update the cart on the backend
                    updateCartQuantity(productId, currentQuantity);
                });
            });

            function updateCartQuantity(productId, quantity) {
                fetch('/cart/update', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            productId,
                            quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Cart updated successfully.');
                            // Optionally, update the total price or other elements
                        } else {
                            console.error('Failed to update cart:', data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error updating cart:', error);
                    });
            }
        });
    </script>
@endsection
