    <section id="main-header">
        <header class="site-header">
            <div class="container">
                <div class="site-header_wrap">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <img src="images/menu-icn.svg">
                    </button>
                    <a class="navbar-brand">CRUD <span>Practice</span></a>
                    <div class="user-login_nav">
                        <div class="btn-group user-login_dropdown">
                            <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img src="{{ asset('images/user-icn.svg') }}" class="avatar-img">
                                <span>{{\Auth::user()->name }}</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item" type="button" href="">Profile</button>
                                <li class="nav-item active">
                                    <a class="nav-link dropdown-item" href=""
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Logout</button>
                                    </form>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <nav class="site-navbar navbar-expand-lg navbar navbar-light">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('blog-list')}}">Blogs <span class="count"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('create-food')}}">Foods <span class="count"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('product-list')}}">Shopping <span
                                    class="count"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('shopping-cart')}}"><i class="fa fa-cart-plus"></i>
                                @if (Cart::instance('default')->count() > 0)
                                <span class="badge badge-warning ">
                                    {{ Cart::instance('default')->count() }}
                                </span>
                                @endif
                            </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <img src="{{ asset('images/cross-icn.svg') }}">
                    </button>
                </div>
            </div>
        </nav>
    </section>