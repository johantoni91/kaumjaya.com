<div class="my-4">
    <div class="container-fluid row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pesan') }}</div>

                <div class="card-body shadow px-4">
                    @if ($cemilan->isEmpty() && $snackbox->isEmpty() && ($tipeCemilan == false && $tipeSnackbox == false))
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="inputTipePesanan" class="col-form-label">Pilih tipe pesanan : </label>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" wire:click.prevent="tipeCemilan"
                                                href="#">Cemilan</a></li>
                                        <li><a class="dropdown-item" wire:click.prevent="tipeSnackbox"
                                                href="#">Snackbox</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @elseif($tipeCemilan == true)
                        @include('template.jajanCemilan')
                    @elseif($tipeSnackbox == true)
                        @include('template.jajanSnackbox')
                    @elseif(!$cemilan->isEmpty() || !$snackbox->isEmpty())
                        <div class="col d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-outline-danger fw-bold"><i
                                    class="bi bi-box-arrow-left"></i> Kembali ke beranda</a>
                            <a href="{{ route('jajanCart') }}" class="btn btn-outline-info fw-bold">Selesaikan
                                pesanan <i class="bi bi-box-arrow-right"></i></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
