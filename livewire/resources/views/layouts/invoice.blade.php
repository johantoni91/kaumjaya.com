@include('template.head')
<body>
    <main>
        <div class="container col-md-8">
            <img src="{{ asset('/img/logo.jpeg') }}" id="image" class="my-2 img-fluid" alt="" style="box-shadow: 0 0 15px 4px rgba(203,51,50,255)">
            <strong class="text-center my-2">Bukti pembelian</strong>
            @if (!($cemilan->isEmpty() && $snackbox->isEmpty()))
            <strong>Cemilan</strong>
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr class="text-center align-middle">
                        <th>No.</th>
                        <th>Nama produk</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cemilan as $item)
                    <tr class="align-middle">
                        <td>{{ $i++ }}</td>
                        <td class="text-start">{{ $item->product->produk }}</td>
                        <td class="text-center">{{ $item->jumlah }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <strong>Total Rp.{{ $totalCemilan }}</strong>
            </div>
            <hr class="my-3">
            <strong>Snackbox</strong>
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr class="text-center align-middle">
                        <th>No.</th>
                        <th>Isian box</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($snackbox as $item)
                    <tr class="align-middle">
                        <td>{{ $i++ }}</td>
                        <td class="text-start">{{ $item->product->produk }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <strong>Total Rp.{{ $totalCemilan }}</strong>
            </div>
            @elseif (!($cemilan->isEmpty()) && $snackbox->isEmpty())
            <strong>Cemilan</strong>
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr class="text-center align-middle">
                        <th>No.</th>
                        <th>Nama produk</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cemilan as $item)
                    <tr class="align-middle">
                        <td>{{ $i++ }}</td>
                        <td class="text-start">{{ $item->product->produk }}</td>
                        <td class="text-center">{{ $item->jumlah }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <strong>Total Rp.{{ $totalCemilan }}</strong>
            </div>
            <hr>
            @elseif($cemilan->isEmpty() && !($snackbox->isEmpty()))
            <strong>Snackbox</strong>
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr class="text-center align-middle">
                        <th>No.</th>
                        <th>Isian box</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($snackbox as $item)
                    <tr class="align-middle">
                        <td>{{ $i++ }}</td>
                        <td class="text-start">{{ $item->product->produk }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <strong>Total Rp.{{ $totalCemilan }}</strong>
            </div>
            <hr>
            @endif
            <strong class="fst-italic">Terima kasih telah belanja di kaum jaya</strong>
            <strong class="fst-italic">Copyright &copy; Kaum Jaya 2023. </strong>
        </div>
    </main>
@include('template.foot')