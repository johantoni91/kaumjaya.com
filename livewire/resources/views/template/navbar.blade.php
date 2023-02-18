<nav class="navbar navbar-expand-lg" id="tampilAtas" style="background-color: rgba(203,51,50,255)">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="{{ asset('/img/logo.png') }}" class="rounded"
                style="max-height: 2.6rem " alt="Kaum Jaya"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a @if (Route::is('rumah'))
                    class="nav-link fw-bold text-dark"
                        @else
                        class="nav-link text-light fw-bold"
                    @endif aria-current="page" href="/">Kaum Jaya</a>
                </li>
                <li class="nav-item">
                    <a @if (Route::is('jajan'))
                    class="nav-link fw-bold text-dark"
                        @else
                        class="nav-link text-light fw-bold"
                    @endif aria-current="page" href="{{ url('/order') }}">Pesan</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="fw-bold text-light fs-5 nav-link dropdown-toggle" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="bi bi-person"></i>
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-end" style="background-color: rgba(203,51,50,255)"
                                aria-labelledby="navbarDropdown">
                                <a class="nav-link fw-bold text-light text-center"
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                                <a class="nav-link fw-bold text-light text-center"
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                            </div>
                        </li>
                    @endif
                @else
                <a @if (Route::is('jajanCart'))
                class="nav-item fw-bold text-dark my-auto text-decoration-none me-3"
                @else
                class="nav-item fw-bold text-light my-auto text-decoration-none me-3"
                @endif href="{{ route('jajanCart') }}"><i class="bi bi-box-seam fw-bold"></i> Pesananmu</a>
                    <a id="navbarDropdown" class="fw-bold text-light nav-link dropdown-toggle" href="#"
                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="bi bi-person fw-bold"></i> {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if(Auth::user()->level == 1)
                        <a class="dropdown-item" href="{{ route('home') }}">
                            {{ __('Kelola Produk') }}
                        </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('history') }}">
                            {{ __('Riwayat belanja') }}
                        </a>
                        {{-- <a class="dropdown-item" href="{{ route('history') }}">
                            {{ __('Atur akun') }}
                        </a> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
