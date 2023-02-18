<marquee behavior=alternate direction="right" loop="">
    <h4 class="fw-bold mt-2">
        <i class="bi bi-cart3"></i> Cemilan
    </h4>
</marquee>
<hr>
<div class="form-floating mb-3">
    <input type="text" wire:model="cari" class="form-control" id="floatingInput"
        placeholder="cemilan">
    <label for="floatingInput">Ngemil apa ya ...</label>
</div>
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
        @foreach ($Product as $item)
            <tr
                class="{{ $item->status == 'Tersedia' ? 'align-middle' : 'align-middle bg-danger-subtle' }}">
                <th scope="row" class="text-center">{{ ++$i }}</th>
                <td class="text-left">
                    {{-- Gambar --}}
                    @if ($item->gambar == null)
                        <img class="rounded shadow "
                            src="https://source.unsplash.com/300x300/?food" width="60"
                            height="60" alt="">
                    @else
                        <img class="rounded shadow "
                            src="{{ asset('/storage/' . $item->gambar) }}" width="60"
                            height="60" alt="">
                    @endif

                    {{-- Nama Produk --}}
                    {{ $item->produk }}
                </td>
                <td class="text-center">{{ $item->harga }}</td>
                <td class="text-center">
                    @if ($item->status == 'Tersedia')
                        <input type="checkbox" @checked(old('active', $item->id)) wire:model="pesenCemilan"
                            value={{ $item->id }} class="form-check-input">
                    @else
                        <small class="text-center">Stok habis</small>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">
    {{ $Product->links() }}
</div>
<div class="d-flex justify-content-between">
<button type="button" wire:click.prevent="backCemilan" class="btn btn-outline-danger fw-bold">kembali</button>
<button type="button" data-bs-toggle="modal" data-bs-target="#cemilanModal" wire:click.prevent="Snacks" class="btn btn-outline-info fw-bold">Pesan</button>
</div>