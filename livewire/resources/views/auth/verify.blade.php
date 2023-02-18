@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verifikasi email') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Verifikasi email sudah dikirim ke alamat email anda.') }}
                            </div>
                        @endif

                        <p>Sebelum lanjut, silahkan klik tombol verifikasi pada email yang sudah kami kirimkan ke email
                            anda.</p>
                        <strong class="fst-italic">Jika kamu tidak mendapatkan email verifikasi, silahkan klik tombol di
                            bawah ini</strong>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-info text-dark">di sini</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
