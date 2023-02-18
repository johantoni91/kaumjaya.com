@extends('layouts.clientSide')
@section('clientPage')
    <nav>@include('template.navbar')</nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Riwayat pesanan') }}</div>
                    <div class="card-body">
                        @livewire('client.history')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection