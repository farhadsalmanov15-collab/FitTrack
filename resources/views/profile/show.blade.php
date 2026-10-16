@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle mb-3" width="100" height="100" style="object-fit:cover">
                @else
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width:100px;height:100px;font-size:2rem">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                @endif
                <h4>{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
                <span class="badge bg-{{ $user->isAdmin() ? 'danger' : 'primary' }}">{{ ucfirst($user->role) }}</span>
                <div class="mt-3">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection