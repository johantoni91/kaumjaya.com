<div class="d-flex justify-content-between">
    <strong><i class="bi bi-cart fw-bold"></i>Cemilan </strong>
    <span class="badge rounded-circle my-auto bg-success">{{ $Cemilan->count() }}</span>
</div>
@if ($Cemilan->isEmpty())
    <div class="row col-md-5 mx-auto">
        <p class="fw-bold text-center">Mau ngemil ? klik di bawah ini</p>
        <i class="bi bi-arrow-bar-down text-center fw-bold"></i>
        <button type="button" class="btn btn-outline-success text-dark fw-bold mb-1" data-bs-toggle="modal"
            data-bs-target="#tambahCemilan">+ Cemilan</button>
    </div>
@else
    <div class="rounded shadow p-3 mt-2">
        <button class="btn btn-outline-success mb-1 text-dark" data-bs-toggle="modal" data-bs-target="#tambahCemilan">+
            Cemilan</button>
        <table class="table table-striped table-responsive table-hover mb-5">
            <thead>
                <tr class="text-center">
                    <th>
                        No.
                    </th>
                    <th>
                        Produk
                    </th>
                    <th>
                        Harga per item (Rp.)
                    </th>
                    <th>
                        Jumlah
                    </th>
                    <th>
                        Total per item (Rp.)
                    </th>
                    <th>
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($Cemilan as $jajan)
                    <tr class="align-middle">
                        <td>{{ $i++ }}</td>
                        <td class="text-left ">
                            {{-- Gambar --}}
                            @if ($jajan->products->gambar == null)
                                <img class="rounded shadow " src="https://source.unsplash.com/300x300/?food"
                                    width="60" height="60" alt="">
                            @else
                                <img class="rounded shadow " src="{{ asset('/storage/' . $jajan->products->gambar) }}"
                                    width="60" height="60" alt="">
                            @endif

                            {{-- Nama Produk --}}
                            {{ $jajan->products->produk }}
                        </td>
                        <td class="text-center ">{{ $jajan->products->harga }}</td>
                        <td class=" text-center">
                            <button class="bg-transparent border-0 fw-bold"
                                wire:click="kurangCemilan({{ $jajan->id }})">-</button>
                            <input type="number" class="text-end border-0 bg-transparent" disabled
                                style="max-width: 2.5rem" min="1" max="20" value="{{ $jajan->jumlah }}">
                            <button class="bg-transparent border-0 fw-bold"
                                wire:click="tambahCemilan({{ $jajan->id }})">+</button>
                        </td>
                        <td class="text-center ">
                            <h6>{{ $jajan->total }}</h6>
                        </td>
                        <td class="align-middle text-center">
                            <button class="bg-transparent border-0 text-dark p-1"
                                wire:click="hapusCemilan({{ $jajan->id }})"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col d-flex justify-content-end">
            <strong>Total Rp. {{ $Cemilan->sum('total') }}</strong>
        </div>
    </div>
@endif
