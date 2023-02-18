<div class="container-fluid my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pesananmu') }}</div>
                <div class="card-body p-4">
                    @if ($Cemilan->isEmpty() && $Snackbox->isEmpty())
                        <h5>Pesananmu kosong</h5>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('jajan') }}" class="btn btn-outline-info"><i class="bi bi-cart3"></i>
                                Pesan</a>
                        </div>
                    @else
                    <div class="mt-2 mb-4 col alert alert-info shadow">
                        <label class="text-dark fw-bold" for="ambilPesan">Tanggal ambil pesanan</label>
                        <input class="ms-3 mb-2" min={{ $besok }} value={{ $waktuPesan }} id="ambilPesan" aria-label="ambilPesan" type="date" wire:model.debounce.500ms="waktuPesan">
                    </div>
                        <div>
                            @include('template.orderCemilan')
                            @include('template.orderSnackbox')
                        </div>
                        <div class="d-flex justify-content-end my-4">
                            <button type="button" class="btn shadow col-sm-2 text-dark fw-bold btn-outline-success"
                                wire:click.prevent="buy">Lanjutkan</button>
                        </div>
                    @endif
                    @include('template.cartModal')
                </div>
            </div>
        </div>
    </div>
</div>
