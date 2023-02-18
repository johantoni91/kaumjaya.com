<!-- Tambah Modal -->
<div class="modal fade" wire:ignore.self id="tambahModal" aria-labelledby="tambahModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="store">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahModalLabel">{{ __('Tambah Produk') }}</h1>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input wire:model="produk" required type="text" class="form-control" id="produk"
                            placeholder="Telur puyuh">
                        <label for="produk">Produk</label>
                    </div>
                    <div class="form-floating">
                        <input wire:model="harga" required type="number" class="form-control" id="harga"
                            placeholder="5000">
                        <label for="harga">Harga</label>
                    </div>
                    <div class="form-group my-3">
                        <label for="gambar">Gambar</label>
                        <input wire:model="gambar" type="file" class="form-control" name="Gambar" id="gambar"
                            accept="image/*">
                        <small>(Boleh kosong)</small>
                        <div class="d-flex justify-content-center">
                            @if ($gambar)
                                <img src="{{ $gambar->temporaryUrl() }}" width="120" height="120">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button @if($produk != null && $harga != null)
                    data-bs-dismiss="modal"
                    @else
                        
                    @endif type="submit" id="tambahBtn" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>