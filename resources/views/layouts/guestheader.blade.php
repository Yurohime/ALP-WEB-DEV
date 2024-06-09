<!-- resources/views/layouts/header.blade.php -->

<header class="custom-bg text-dark shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/header_logo.jpg') }}" alt="Logo" class="d-inline-block align-top" width="150">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/customer/home') }}">Products</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('wishlist') }}" id="wishlist-link">Wishlist</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/cart') }}" id="cart-link">Cart</a>
                    </li>
                    <li class="nav-item">
                        @if(Auth::check())
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        @else
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        @endif
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link">
                            {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                        </span>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};

    if (!isLoggedIn) {
        document.getElementById('wishlist-link').addEventListener('click', function (e) {
            e.preventDefault();
            alert('Please login to access your wishlist.');
        });

        document.getElementById('cart-link').addEventListener('click', function (e) {
            e.preventDefault();
            alert('Please login to view your cart.');
        });
    }
});
</script>
