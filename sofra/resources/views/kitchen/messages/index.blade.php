@extends('layouts.kitchen')

@section('content')
<h1>Messages</h1>

<!-- Table to display the messages -->
<table id="messages-table" class="common-table">
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Phone Number</th>
            <th>Subject</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        @foreach($messages as $message)
        <tr>
            <td>{{ $message->customer->name }}</td>
            <td>{{ $message->customer->customer_phone }}</td>
            <td>{{ $message->message_subject }}</td>
            <td>{{ $message->message_text }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

