{{-- resources/views/index.blade.php --}}
@extends('layouts.app')

@section('title')
    All Tasks
@endsection

@section('head')
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f3f4f6;
            padding: 2rem;
            color: #1f2937;
        }

        .task-list {
            max-width: 600px;
            margin: auto;
        }

        .task-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            transition: transform 0.2s ease;
        }

        .task-card:hover {
            transform: scale(1.02);
        }

        .task-card a {
            text-decoration: none;
            color: #2563eb;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .no-tasks {
            text-align: center;
            color: #9ca3af;
            font-style: italic;
            margin-top: 2rem;
        }

        h1 {
            text-align: center;
            color: #1d4ed8;
            margin-bottom: 2rem;
        }
    </style>
@endsection

@section('content')
<div class="task-list">
    @forelse ($tasks as $task)
        <div class="task-card">
            <a href="{{ route('task.show', ['id' => $task->id]) }}">
                {{ $task->title }}
            </a>
        </div>
    @empty  
        <div class="no-tasks">No Tasks</div>
    @endforelse
</div>
@endsection
