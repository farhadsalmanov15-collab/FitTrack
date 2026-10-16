@extends('layouts.app')
@section('title', 'User Management')
@section('content')
<h2 class="mb-4">User Management</h2>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Change Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge bg-{{ $user->isAdmin() ? 'danger' : 'primary' }}">{{ ucfirst($user->role) }}</span></td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.role', $user) }}" class="d-flex gap-2">
                            @csrf
                            <select name="role" class="form-select form-select-sm" style="width:120px">
                                <option value="member" {{ $user->role === 'member' ? 'selected' : '' }}>Member</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $users->links() }}</div>
@endsection