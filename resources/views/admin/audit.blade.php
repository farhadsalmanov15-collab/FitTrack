@extends('layouts.app')
@section('title', 'Audit Log')
@section('content')
<h2 class="mb-4">Audit Log</h2>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>Time</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Model</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td>{{ $log->timestamp }}</td>
                    <td>{{ $log->user->name ?? 'Deleted user' }}</td>
                    <td><span class="badge bg-secondary">{{ $log->action }}</span></td>
                    <td>{{ $log->model }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">No logs yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $logs->links() }}</div>
@endsection