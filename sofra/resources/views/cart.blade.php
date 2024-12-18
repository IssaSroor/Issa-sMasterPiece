@extends('layouts.master')

@section('content')
    <div>
        <form class="bg0 p-t-40 p-b-85">
            <div class="container">
                <div class="row">
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
                                <?php if (!empty($cart)): ?>
                                <?php foreach ($cart as $item): ?>
                                <tr>
                                    <td><img src="<?= htmlspecialchars($item['productImage']) ?>"
                                            alt="<?= htmlspecialchars($item['productName']) ?>" width="50"></td>
                                    <td><?= htmlspecialchars($item['productName']) ?></td>
                                    <td><?= number_format($item['productPrice'], 2) ?> JD</td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>
                                        <button onclick="removeFromCart(<?= $item['productId'] ?>)" class="btn-remove"><i class="fa fa-multiply"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="5">Your cart is empty.</td>
                                </tr>
                                <?php endif; ?>
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
    </div>
    </form>
    </div>
@endsection
