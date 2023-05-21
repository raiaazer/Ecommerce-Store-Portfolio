<header class="header @if (Route::currentRouteName() != 'checkout' && Route::currentRouteName() != 'cart.index' && Route::currentRouteName() != 'user.product' && Route::currentRouteName() != 'products.filterByPrice') header-transparent @endif">
    <div class="@if (Route::currentRouteName() != 'checkout' && Route::currentRouteName() != 'cart.index' && Route::currentRouteName() != 'user.product' && Route::currentRouteName() != 'products.filterByPrice') header-top @endif">
    <div class="header-middle @if(Route::currentRouteName() == 'index' || Route::currentRouteName() == 'checkout' || Route::currentRouteName() == 'cart.index' || Route::currentRouteName() == 'user.category' || Route::currentRouteName() == 'user.product' || Route::currentRouteName() == 'products.filterByPrice') sticky-header @endif">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler" type="button">
                    <i class="fas fa-bars"></i>
                </button>

                <a href="{{ route('index') }}" class="logo">
                    <img src="{{ asset('storage/sites/' . $settings->logo) }}" alt="Logo" width="50px" height="50px">
                </a>

                <nav class="main-nav font2">
                    <ul class="menu">
                        <li class="@if(Route::currentRouteName() == 'index') active @endif">
                            <a href="{{ route('index') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('user.category') }}">Categories</a>

                        </li>
                        <li>
                            <a href="{{ route('user.product') }}">Products</a>

                        </li>
                    </ul>
                </nav>
            </div><!-- End .header-left -->

            <div class="header-right">
                <div class="header-search header-search-popup header-search-category d-none d-sm-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q"
                                placeholder="I'm searching for..." required="">
                            <div class="select-custom">
                                <select id="cat" name="cat">
                                    <option value="">All Categories</option>
                                    <option value="4">Fashion</option>
                                    <option value="12">- Women</option>
                                    <option value="13">- Men</option>
                                    <option value="66">- Jewellery</option>
                                    <option value="67">- Kids Fashion</option>
                                    <option value="5">Electronics</option>
                                    <option value="21">- Smart TVs</option>
                                    <option value="22">- Cameras</option>
                                    <option value="63">- Games</option>
                                    <option value="7">Home &amp; Garden</option>
                                    <option value="11">Motors</option>
                                    <option value="31">- Cars and Trucks</option>
                                    <option value="32">- Motorcycles &amp; Powersports</option>
                                    <option value="33">- Parts &amp; Accessories</option>
                                    <option value="34">- Boats</option>
                                    <option value="57">- Auto Tools &amp; Supplies</option>
                                </select>
                            </div><!-- End .select-custom -->
                            <button class="btn text-dark icon-magnifier" type="submit"></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div>

                @guest
                <a href="{{ route('login') }}" class="header-icon header-icon-user" title="Login"><i
                    class="icon-user-2"></i></a>
                @endguest

                @auth
                <a href="wishlist.html" class="header-icon header-icon-wishlist" title="Wishlist"><i
                    class="icon-wishlist-2"></i></a>

                @endauth



                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle dropdown-arrow cart-toggle" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                    <i class="icon-cart-thick"></i>
                    <span class="cart-count badge-circle" id="cart-count">0</span>
                    </a>

                    <div class="cart-overlay"></div>

                    @include('user.includes.side-cart')
                </div><!-- End .dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
    </div>
</header><!-- End .header -->

