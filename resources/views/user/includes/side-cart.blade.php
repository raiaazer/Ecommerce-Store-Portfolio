<div class="dropdown-menu mobile-cart">
    <a href="#" title="Close (Esc)" class="btn-close">×</a>

    <div class="dropdownmenu-wrapper custom-scrollbar">
        <div class="dropdown-cart-header">Shopping Cart</div>
        <!-- End .dropdown-cart-header -->

        <div class="dropdown-cart-products">
            @php
                $cartItems = Cache::get('cart', []);
            @endphp
            @if (!empty($cartItems))
                @foreach ($cartItems as $id => $item)
                    <div class="product">
                        <div class="product-details">
                            <h4 class="product-title">
                                <a href="#">{{ $item['name'] }}</a>
                            </h4>
                            <span class="cart-product-info">
                                <span class="cart-product-qty">{{ $item['quantity'] }}</span>
                                × {{ $item['price'] }}
                            </span>
                        </div><!-- End .product-details -->

                        <figure class="product-image-container">
                            <img src="{{ asset('storage/products/' . trim($item['image'])) }}" alt="{{ $item['name'] }}" width="78" height="78">
                            <a href="javascript:void(0)" class="btn-remove" onclick="event.preventDefault(); document.getElementById('remove-form-{{ $id }}').submit();" title="Remove Product">
                                <span>×</span>
                            </a>
                            <form action="{{ route('cart.destroy', $id) }}" method="POST" id="remove-form-{{ $id }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </figure>

                    </div><!-- End .product -->
                @endforeach
            @else
                <p>There are no items in the cart.</p>
            @endif
        </div><!-- End .cart-product -->

        <div class="dropdown-cart-total">
            <span>SUBTOTAL:</span>
            @php
                $subtotal = array_reduce($cartItems, function($carry, $item) {
                    return $carry + $item['price'] * $item['quantity'];
                }, 0);
            @endphp
            <span class="cart-total-price float-right">{{ money($subtotal) }}</span>
        </div><!-- End .dropdown-cart-total -->

        <div class="dropdown-cart-action">
            {{-- <a href="{{ route('cart.index') }}" class="btn btn-gray btn-block view-cart">View Cart</a> --}}
            <a href="{{ route('cart.index') }}" class="btn btn-dark btn-block">View Cart</a>
        </div><!-- End .dropdown-cart-total -->
    </div><!-- End .dropdownmenu-wrapper -->

</div><!-- End .dropdown-menu -->
