@extends('admin.layouts.admin')

@section('title', 'Manage Questions')

@section('header-title', 'Contact Questions')

@section('content')
    <div class="container">
        <div class="section">
            <h2 class="section-title">Contact Questions</h2>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Resolved By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td>{{ $question->client_name }}</td>
                            <td>{{ $question->client_email }}</td>
                            <td>{{ $question->subject }}</td>
                            <td>{{ $question->question }}</td>
                            <td>{{ $question->resolved_by ? $question->admin->admin_name : 'Pending' }}</td>
                            <td>
                                @if (!$question->resolved_by)
                                    <form action="{{ route('admin.questions.resolve', $question->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Mark as Resolved</button>
                                    </form>
                                @else
                                    <span class="resolved-tag">Resolved</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
