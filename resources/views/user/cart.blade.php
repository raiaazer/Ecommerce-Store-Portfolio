@extends('user.layouts.layout')
@section('css')
<link rel="stylesheet" href="{{ user_asset('/css/style.min.css') }}">
<style>

.product-image {
  width: 80px;
  height: 80px;
  object-fit: cover; /* Adjust as needed */
}

@media (max-width: 767px) {
  .cart-table-container {
    margin-left: 5%;
    margin-right: 5%;
  }

  .table-cart th,
  .table-cart td {
    padding: 5px;
    font-size: 12px;
  }

  .product-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
  }
}
</style>
@endsection
@section('body')
<main class="main">
    <div class="container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="active">
                <a href="cart.html">Shopping Cart</a>
            </li>
            <li>
                <a href="checkout.html">Checkout</a>
            </li>
            <li class="disabled">
                <a href="cart.html">Order Complete</a>
            </li>
        </ul>
        <div class="row">

        <div class="col-lg-8">
        <div class="cart-table-container" >
            @php
            $cartItems = cache()->get('cart', []);
            @endphp

            @if (!empty($cartItems))
              <table class="table table-cart m-2">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th class="text-left">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($cartItems as $id => $item)
                  @php
                  $subtotal = $item['price'] * $item['quantity'];
                  @endphp
                  <tr>
                    <td>
                      <figure class="product-image-container">
                        <img src="{{ asset('storage/products/' . trim($item['image'])) }}" alt="{{ $item['name'] }}" class="product-image">
                        <a href="javascript:void(0)" class="btn-remove" onclick="event.preventDefault(); document.getElementById('remove-form-{{ $id }}').submit();" title="Remove Product">
                          <span>×</span>
                        </a>
                        <form action="{{ route('cart.destroy', $id) }}" method="POST" id="remove-form-{{ $id }}" style="display: none;">
                          @csrf
                          @method('DELETE')
                        </form>
                      </figure>
                    </td>
                    <td>
                      <h5 class="product-title">
                        <a href="product.html">{{ $item['name'] }}</a>
                      </h5>
                    </td>
                    <td>{{ $item['quantity'] }} * ${{ $item['price'] }}</td>
                    <td class="">
                      <input class="horizontal-quantity1 form-control col-3" type="number" value="{{ $item['quantity'] }}" data-id="{{ $id }}" style="height:30px;">
                    </td>
                    <td class="text-left"><span class="subtotal-price">${{ $subtotal }}</span></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            @else
            <p>There are no items in the cart.</p>
            @endif
        </div>
        </div>

        <div class="col-lg-4">
            <div class="cart-summary">
                <h3>CART TOTALS</h3>

                <table class="table table-totals">

                    <tfoot>
                        <tr>
                            <td>Total</td>
                            @php
                                $subtotal = array_reduce($cartItems, function($carry, $item) {
                                    return $carry + $item['price'] * $item['quantity'];
                                }, 0);
                            @endphp
                            <td>{{ money($subtotal) }}</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="checkout-methods">
                    <a href="{{ route('checkout') }}" class="btn btn-block btn-dark">Proceed to Checkout
                        <i class="fa fa-arrow-right"></i></a>
                </div>
            </div><!-- End .cart-summary -->
        </div>

        </div>
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main>
@endsection
@section('js')

<script>

    let quantityInputs = document.querySelectorAll('.horizontal-quantity1');
    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            let id = input.dataset.id;
            let newQuantity = parseInt(input.value);

            updateCartQuantity(id, newQuantity);

            let priceCol = input.closest('.product-row').querySelector('.price-col');
            if (priceCol) {
                let price = parseFloat(priceCol.textContent.substring(1));
                let subtotalPrice = input.closest('.product-row').querySelector('.subtotal-price');
                if (subtotalPrice) {
                    subtotalPrice.textContent = `$${(price * newQuantity).toFixed(2)}`;
                }
            }
        });
    });

    function updateCartQuantity(id, quantity) {
        $.ajax({
            url: "/cart/" + id,
            method: "PUT",
            data: {
                _token: "{{ csrf_token() }}",
                _method: "PUT",
                quantity: quantity
            },
            success: function(response) {
                console.log("Cart quantity updated successfully!");
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Failed to update cart quantity:", error);
            }
        });
    }
</script>
@endsection
