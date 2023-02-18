<!-- Tambah Cemilan -->
<div class="modal fade" wire:ignore.self id="tambahCemilan" aria-labelledby="tambahCemilanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="modal-title" id="tambahModalLabel">{{ __('Tambah Cemilan') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input wire:model="cari" type="text" class="bg-white form-control" id="floatingInput"
                        placeholder="hmm">
                    <label for="floatingInput">Mau ngemil apa ya ... </label>
                </div>
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ProductCemilan as $item)
                            <tr
                                class="{{ $item->status == 'Tersedia' ? 'align-middle' : 'align-middle bg-danger-subtle' }}">
                                <td class="text-left">
                                    {{-- Gambar --}}
                                    @if ($item->gambar == null)
                                        <img class="rounded shadow " src="https://source.unsplash.com/300x300/?food"
                                            width="60" height="60" alt="">
                                    @else
                                        <img class="rounded shadow " src="{{ asset('/storage/' . $item->gambar) }}"
                                            width="60" height="60" alt="">
                                    @endif

                                    {{-- Nama Produk --}}
                                    {{ $item->produk }}
                                </td>
                                <td class="text-center">{{ $item->harga }}</td>
                                <td class="text-center">
                                    @if ($item->status == 'Tersedia')
                                        <input type="checkbox" wire:model="pesenCemilan" value={{ $item->id }}
                                            class="form-check-input">
                                    @else
                                        <small class="text-center">Stok habis</small>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $ProductCemilan->links() }}
            </div>
            <div class="modal-footer">
                <a href="#" wire:click="beliCemilan" data-bs-dismiss="modal"
                    class="btn btn-info fw-bold">Tambah</a>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Snackbox -->
<div class="modal fade" wire:ignore.self id="tambahSnackbox" aria-labelledby="tambahSnackboxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="modal-title" id="tambahModalLabel"><i class="bi bi-cart3"></i> {{ __('Tambah Snackbox') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-lg-3">
                        <small>Masukkan biaya per box</small>
                    </div>
                    <div class="col-sm-3">
                        <input type="number" wire:model.debounce.500ms="harga" value={{ $harga }}
                            class="form-control" min="5000">
                    </div>
                    <div class="col-sm-4">
                        <span class="text-danger fst-italic form-text">
                            Minimal Rp.5000
                        </span>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-lg-3">
                        <small>Masukkan jumlah box</small>
                    </div>
                    <div class="col-sm-3">
                        <input type="number" wire:model.debounce.500ms="jumlahSnackbox" value={{ $jumlahSnackbox }}
                            class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <span class="text-danger fst-italic form-text">
                            Minimal 20box
                        </span>
                    </div>
                </div>
                <hr>
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ProductSnackbox as $item)
                            <tr
                                class="{{ $item->status == 'Tersedia' ? 'align-middle' : 'align-middle bg-danger-subtle' }}">
                                <td class="text-left">
                                    {{-- Gambar --}}
                                    @if ($item->gambar == null)
                                        <img class="rounded shadow " src="https://source.unsplash.com/300x300/?food"
                                            width="60" height="60" alt="">
                                    @else
                                        <img class="rounded shadow " src="{{ asset('/storage/' . $item->gambar) }}"
                                            width="60" height="60" alt="">
                                    @endif

                                    {{-- Nama Produk --}}
                                    {{ $item->produk }}
                                </td>
                                <td class="text-center">{{ $item->harga }}</td>
                                <td class="text-center">
                                    @if ($item->status == 'Tersedia')
                                        <input type="checkbox" wire:model="pesenSnackbox"
                                            value={{ $item->id }} class="form-check-input">
                                    @else
                                        <small class="text-center">Stok habis</small>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-3">
                    {{ $ProductSnackbox->links() }}
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-outline-danger fw-bold">kembali</button>
                    <button type="button" wire:click.prevent="Snackboxes" data-bs-dismiss="modal" class="btn btn-outline-info fw-bold">Pesan</button>
                </div>
            </div>
        </div>
    </div>
</div>
