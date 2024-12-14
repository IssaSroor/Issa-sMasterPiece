@extends('layouts.kitchen')

@section('content')
<div class="dashboard-container">

    @if(!$kitchen)
        <p>You don't have a kitchen registered yet.</p>
        <a href="{{ route('kitchen.register.page') }}" class="btn btn-primary">Register Your Kitchen</a>
    @else

    <main class="dashboard-content">
        @yield('dashboard-content')
    </main>
</div>
@endif
@endsection
