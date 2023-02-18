@extends('layouts.clientSide')
@section('clientPage')
<nav>@include('template.navbar')</nav>
    @livewire('client.jajan-page')    
@endsection
