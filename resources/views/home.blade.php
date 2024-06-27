@extends('layouts.app')

@section('content')
    @if(Auth::user()->role == 'admin')
        @include('pages.home.admin')
    @elseif(Auth::user()->role == 'mhs')
        @include('pages.home.mhs')
    @endif
@endsection
