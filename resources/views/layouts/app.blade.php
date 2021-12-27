@extends('layouts.base')

@section('content')
<div class="main-content position-relative bg-gray-100">
    {{-- @include('layouts.navbars.sidebar') --}}
    @include('layouts.navbars.nav')
    <main>
        <div class="container-fluid">
            @yield('app')
            <div class="row">
                @include('layouts.footers.footer')
            </div>
        </div>
    </main>
</div>
@endsection