<style>
    .gmbr {
        border-left: 2px solid rgba(203, 51, 50, 255);
    }

    @media (max-width: 992px) {
        .gmbr {
            border-left: none;
        }
    }
</style>
<div>
    <nav>@include('template.navbar')</nav>
            <div class="container-fluid col-xl-8 px-4 py-4"  style="border-bottom: 2px solid rgba(203,51,50,255)">
                <img src="{{ asset('/img/logo.jpeg') }}" id="image" class="mt-2 img-fluid" alt=""
                    style="box-shadow: 0 0 15px 4px rgba(203,51,50,255)">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-4">
                    <div class="col-10 col-sm-8 col-lg-6 gmbr">
                        <img src="{{ asset('/img/gambarToko.jpg') }}" class="d-block mx-lg-auto img-fluid rounded"
                            alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold lh-1 mb-3 text-center">Kaum Jaya</h1>
                        <p class="lead">Tempat yang memiliki beragam makanan khas karawang. dimulai dari kue kering sampai ke
                            minuman homemade asli khas orang karawang.</p>
                    </div>
                </div>
            </div>
        <section>
            <div class="container-fluid col-xl-8 px-2 py-3 mb-3" style="border-bottom: 2px solid rgba(203,51,50,255)">
                <h1 class="ms-3 fs-3 shadow-md">Menu</h1>
                <div class="album py-3 bg-light">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            @foreach ($Products as $item)
                                <div class="col">
                                    <div class="card shadow-lg rounded">
                                        @if ($item->gambar == null)
                                            <img class="img-thumbnail" src="https://source.unsplash.com/300x300/?food"
                                                alt="">
                                        @else
                                            <img class="img-thumbnail" src="{{ asset('/storage/' . $item->gambar) }}"
                                                width="300" height="300" alt="">
                                        @endif
                                        <title>{{ $item->produk }}</title>
                                        <div class="card-body">
                                            <p class="card-text fw-bold">Nama Produk : {{ $item->produk }}</p>
                                            <hr>
                                            <p class="card-text text-center">Harga : Rp.{{ $item->harga }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-center">
                    {{ $Products->links() }}
                </div>
            </div>
        </section>
        <div class="container d-flex justify-content-center mt-3">
            <a class="btn btn-danger text-light my-3 fw-bold"
                @if (Auth::user()) href="{{ route('jajan') }}"
        @else href="{{ route('login') }}" @endif>Pesan
                di sini!</a>
        </div>
        <div class="position-fixed rounded row p-2 border border-success bg-success-subtle" style="bottom: 2rem; right: 3rem;">
            <a class="text-decoration-none text-success" href="">
                <i class="bi bi-whatsapp fw-bold text-success"></i>
                Kontak admin
            </a>
        </div>
    <footer>@include('template.footer')</footer>
</div>
