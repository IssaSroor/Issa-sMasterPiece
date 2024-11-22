@extends('admin.layouts.admin')

@section('title', 'Manage Orders')

@section('header-title', 'Orders by Kitchen')

@section('content')
    <div class="container">
        <h2>Kitchens and Orders</h2>
        <table id="kitchensTable" class="display">
            <thead>
                <tr>
                    <th>Kitchen Name</th>
                    <th>Total Orders</th>
                    <th>Actions</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($kitchens as $kitchen)
                    <tr>
                        <td>{{ $kitchen->kitchen_name }}</td>
                        <td>{{ $kitchen->orders->count() }}</td>
                        <td>
                            <form action="{{ route('admin.orders.show', $kitchen->id) }}">
                                <button class="btn btn-info">View Orders</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
