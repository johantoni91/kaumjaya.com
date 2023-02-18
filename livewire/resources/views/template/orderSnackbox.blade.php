<div class="mt-5 d-flex justify-content-between">
    <strong><i class="bi bi-cart fw-bold"></i>Snackbox </strong>
    @if ($Snackbox->isEmpty())
        <span class="badge rounded-circle my-auto bg-success">0</span>
    @else
        <span class="badge rounded-circle my-auto bg-success">{{ $jumlahSnackbox }}</span>
    @endif
</div>
@if (session()->has('status'))
    <div class="alert alert-danger my-2" role="alert">
        <strong>{{ session('status') }}</strong>
    </div>
@elseif(session()->has('sukses'))
    <div class="alert alert-success my-2" role="alert">
        <strong>{{ session('sukses') }}</strong>
    </div>
@endif
@if ($Snackbox->isEmpty())
    <div class="row col-md-5 mx-auto">
        <strong class="text-center">Pesan untuk acara atau event besar? klik di bawah ini</strong>
        <i class="bi bi-arrow-bar-down text-center fw-bold fs-3"></i>
        <button type="button" class="btn btn-outline-success text-dark fw-bold mb-1" data-bs-toggle="modal"
            data-bs-target="#tambahSnackbox">+ Snackbox</button>
    </div>
@else
    <div class="rounded shadow p-3 mt-2">
        <table class="table table-striped table-responsive table-hover">
            <thead>
                <tr class="text-center align-middle">
                    <th>
                        No.
                    </th>
                    <th>
                        Produk
                    </th>
                    <th>
                        Harga Satuan Produk
                    </th>
                    <th>
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($Snackbox as $snackbox)
                    <tr class="text-center align-middle">
                        <td class="">{{ $i++ }}</td>
                        <td class=" text-start align-middle">
                            {{-- Gambar --}}
                            @if ($snackbox->products->gambar == null)
                                <img class="rounded shadow " src="https://source.unsplash.com/300x300/?food"
                                    width="60" height="60" alt="">
                            @else
                                <img class="rounded shadow "
                                    src="{{ asset('/storage/' . $snackbox->products->gambar) }}" width="60"
                                    height="60" alt="">
                            @endif

                            {{-- Nama Produk --}}
                            {{ $snackbox->products->produk }}
                        </td>
                        <td class=" text-center align-middle">{{ $snackbox->products->harga }}</td>
                        <td class="align-middle">
                            <button class="bg-transparent border-0 text-dark fw-bold"
                                wire:click="hapusSnackbox({{ $snackbox->id }})"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <strong>Total Rp. {{ $totalSnackbox }}</strong>
        </div>
    </div>
@endif
