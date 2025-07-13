{{-- resources/views/show.blade.php --}}
@extends('layouts.app')

@section('title')
    Task Details
@endsection

@section('head')
    <style>
        body {
        font-family: 'Segoe UI', sans-serif;
        background: #f9fafb;
        padding: 2rem;
        color: #111827;
    }

    .container {
        max-width: 700px;
        margin: auto;
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.05);
    }

    h2 {
        text-align: center;
        color: #1d4ed8;
        margin-bottom: 1.5rem;
    }

    .field {
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .field strong {
        display: inline-block;
        width: 160px;
        font-weight: 600;
        color: #4b5563;
    }

    .field span {
        color: #111827;
    }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="field"><strong>ID:</strong> <span>{{ $task->id }}</span></div>
    <div class="field"><strong>Title:</strong> <span>{{ $task->title }}</span></div>
    <div class="field"><strong>Description:</strong> <span>{{ $task->description }}</span></div>
    <div class="field"><strong>Long Description:</strong> <span>{{ $task->long_description ?? 'N/A' }}</span></div>
    <div class="field"><strong>Completed:</strong> <span>{{ $task->completed ? 'Yes' : 'No' }}</span></div>
    <div class="field"><strong>Created At:</strong> <span>{{ $task->created_at }}</span></div>
    <div class="field"><strong>Updated At:</strong> <span>{{ $task->updated_at }}</span></div>
</div>
@endsection
