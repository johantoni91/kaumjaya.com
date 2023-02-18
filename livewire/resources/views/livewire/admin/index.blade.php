<div>
    @if (session()->has('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="form-floating mb-3">
        <input wire:model="cari" type="text" class="form-control" id="floatingInput" placeholder="Martabak telor">
        <label for="floatingInput">Cari Produk ...</label>
    </div>
    <div class="d-flex justify-content-between my-2">
        <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#tambahModal">+ Tambah</button>
        <button class="btn btn-outline-danger" wire:click.prevent="resetHistory">Reset riwayat order pelanggan</button>
    </div>
    <hr>
    <table class="table table-hover">
        <thead>
            <tr class="text-center">
                <th scope="col">No.</th>
                <th scope="col">Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($Product == null)
                <tr>
                    <th>
                        <p>Belum ada produk</p>
                    </th>
                </tr>
            @else
            @php
                $i = 0;
            @endphp
                @foreach ($Product as $item)
                    <tr class="{{ $item->status == 'Tersedia' ? 'align-middle' : 'align-middle bg-danger-subtle' }}">
                        <th scope="row" class="text-center">{{ ++$i }}</th>
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
                        <td class="text-center">{{ $item->status }}</td>
                        <td class="text-center">
                            <Button wire:click="edit({{ $item->id }})" class="btn btn-outline-info text-dark"
                                data-bs-toggle="modal" data-bs-target="#ubahModal"><i class="bi bi-pencil-square"></i>
                            </Button>
                            @if($order == null)
                            <button wire:click="delete({{ $item->id }})" class="btn text-dark btn-outline-danger"><i
                                    class="bi bi-trash"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    <!-- Ubah Modal -->
                    <div class="modal fade" wire:ignore.self id="ubahModal" tabindex="-1"
                        aria-labelledby="ubahModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form wire:submit.prevent="edit({{ $item->id }})">
                                <input hidden type="text" wire:model="prodId">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="ubahModalLabel">{{ __('Ubah Produk') }}</h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input wire:model="produkEdit" value="{{ $produkEdit }}" required
                                                type="text" class="form-control" id="produk"
                                                placeholder="Telur puyuh">
                                            <label for="produk">Produk</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input wire:model="hargaEdit" value="{{ $hargaEdit }}" required
                                                type="number" class="form-control" id="harga" placeholder="5000">
                                            <label for="harga">Harga</label>
                                        </div>
                                        <label for="status">Status</label>
                                        <select class="form-select" aria-label="status" wire:model="status">
                                            @if ($status == 'Tersedia')
                                                <option selected>Tersedia</option>
                                                <option>Tidak Tersedia</option>
                                            @elseif ($status == 'Tidak Tersedia')
                                                <option>Tersedia</option>
                                                <option selected>Tidak Tersedia</option>
                                            @endif
                                        </select>
                                        <div class="form-group my-3">
                                            <label for="gambar">Gambar</label>
                                            <input wire:model="gambarEdit" value="{{ $gambarEdit }}" type="file"
                                                class="form-control" accept="image/*">
                                            <div class="d-flex justify-content-center mt-2">
                                                @if ($gambarEdit)
                                                    <img src="{{ Storage::url($gambarEdit) }}" width="120"
                                                        height="120">
                                                @else
                                                    <img src="" width="120" height="120">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" data-bs-dismiss="modal"
                                            wire:click="submitEdit({{ $prodId }})"
                                            class="btn btn-primary">Ubah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
        </tbody>
    </table>
    {{ $Product->links() }}
    @if($order != null)
    <small class="fst-italic fw-bold text-danger">Ket: Jika ingin menghapus sebuah produk, perlu reset riwayat pesanan pelanggan terlebih dahulu.</small>
    @endif
    @include('template.modal')
    @endif
</div>
