<marquee behavior=alternate direction="right" loop="">
    <h4 class="fw-bold mt-2">
        <i class="bi bi-cart3"></i> Snackbox
    </h4>
</marquee>
<hr>
<div class="row g-3 align-items-center mb-3">
    <div class="col-lg-3">
        <label for="inputHargaPerbox">Masukkan biaya per box</label>
    </div>
    <div class="col-sm-3">
        <input type="number" wire:model.debounce.500ms="harga" value={{ $harga }} class="form-control"
            min="5000">
    </div>
    <div class="col-sm-4">
        <span class="text-danger fst-italic form-text">
            Minimal Rp.5000
        </span>
    </div>
</div>
<div class="row g-3 align-items-center mb-3">
    <div class="col-lg-3">
        <label for="inputJumlahBox">Masukkan jumlah box</label>
    </div>
    <div class="col-sm-3">
        <input type="number" wire:model.debounce.500ms="num" value={{ $num }} class="form-control">
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
            <th scope="col">No.</th>
            <th scope="col">Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Pilih</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 0;
        @endphp
        @foreach ($ProductSnackbox as $item)
            <tr class="{{ $item->status == 'Tersedia' ? 'align-middle' : 'align-middle bg-danger-subtle' }}">
                <th scope="row" class="text-center">{{ ++$i }}</th>
                <td class="text-left">
                    {{-- Gambar --}}
                    @if ($item->gambar == null)
                        <img class="rounded shadow " src="https://source.unsplash.com/300x300/?food" width="60"
                            height="60" alt="">
                    @else
                        <img class="rounded shadow " src="{{ asset('/storage/' . $item->gambar) }}" width="60"
                            height="60" alt="">
                    @endif

                    {{-- Nama Produk --}}
                    {{ $item->produk }}
                </td>
                <td class="text-center">{{ $item->harga }}</td>
                <td class="text-center">
                    @if ($item->status == 'Tersedia')
                        <input type="checkbox" @checked(old('active', $item->id)) wire:model="pesenSnackbox" value={{ $item->id }}
                            class="form-check-input">
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
@if (session()->has('status'))
    <div class="alert alert-danger my-2" role="alert">
        <small>Mohon maaf isian box melebihi biaya yang anda tentukan.</small>
    </div>
@endif
<div class="d-flex justify-content-between">
    <button type="button" wire:click.prevent="backSnackbox" class="btn btn-outline-danger fw-bold">kembali</button>
    <button type="button" wire:click.prevent="Snackboxes" class="btn btn-outline-info fw-bold">Pesan</button>
</div>