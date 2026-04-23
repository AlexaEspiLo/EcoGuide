@extends('layouts.admin')

@section('styles')
    <link href="{{ asset('css/admin/users.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="admin-users-page">
        <div class="admin-users-inner">
            <div class="admin-users-header">
                <h1 class="admin-users-title">Users Management</h1>

                <div class="admin-search">
                    <span class="admin-search-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Search members by name or mail..." />
                </div>
            </div>

            <div class="admin-filters">
                <button class="admin-filter-button active">All</button>
                <button class="admin-filter-button">Active</button>
                <button class="admin-filter-button">Suspended</button>
            </div>

            <div class="admin-card">
                <div class="overflow-x-auto">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Full name</th>
                                <th>Email Address</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {{-- Si es 'alta' ponemos clase active, si no, suspended --}}
                                        <span
                                            class="{{ $user->status === 'alta' ? 'admin-status-active' : 'admin-status-suspended' }}">
                                            {{ ucfirst($user->status) }}
                                            {{-- Opcional: mostrar una insignia si es admin --}}
                                            @if($user->is_admin)
                                                <small>(Admin)</small>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="admin-pagination">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection