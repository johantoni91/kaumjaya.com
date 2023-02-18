<div>
    <div class="mx-auto">
        <div class="mt-2 mb-4 col alert alert-info shadow">
            <label class="text-dark fw-bold" for="ambilPesan">Filter pesanan</label>
            <input class="ms-3 mb-2" value={{ $cari }} id="ambilPesan" aria-label="ambilPesan" type="date" wire:model.debounce.500ms="cari">
        </div>
        @if (session()->has('status'))
            <div class="alert alert-warning">
                {{ $status }}
            </div>
        @endif
    <table class="table table-responsive table-hover">
        <thead class="text-center">
            <tr>
                <th>Tanggal pesan</th>
                <th>Ambil pesanan</th>
                <th>Status</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center align-middle">
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->updated_at }}</td>
                    <td>{{ $item->take_order }}</td>
                    <td>
                        @if($item->status == 'Belum dibayar')
                        <a href="{{ route('jajanCart') }}" class=" btn btn-outline-danger border-0 fst-italic">{{ $item->status }}</a>
                        @elseif ($item->status == 'Sudah dibayar')
                        <strong class="fst-italic text-success">{{ $item->status }}</strong>
                        @endif
                    </td>
                    <td>{{ $item->total }}</td>
                    <td>
                        <a href="/invoice/.{{ $item->updated_at }}" target="_blank" wire:click.prevent="downloadPDF({{ $item->uid }})" class="text-decoration-none bg-transparent border-0"><i class="bi bi-download"></i></a>&nbsp; |
                        <button class="bg-transparent border-0" wire:click.prevent="hapus({{ $item->id }})"><i class="text-danger bi bi-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>