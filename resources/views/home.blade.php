@extends('layouts.apps')

@section('title')
Sibolu
@endsection

@section('content')
<div class="row" style="height: 461px;">
    <div class="col-md-12 d-flex justify-content-center align-items-center">
        <div class="text-center">
            <img src="{{ asset('gentella/production/images/bolu.png') }}" style="height: 100px;" alt="Brand TaskApps">
            <h3 style="font-weight: 700; letter-spacing: 7px;">Sibolu</h3>
        </div>
    </div>
</div>
@endsection

@section('js')
    @if(session('welcome'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Update Profile, Selamat Datang',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif
@endsection