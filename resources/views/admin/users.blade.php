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
                <span class="admin-search-icon">🔍</span>
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
                        <tr>
                            <td>Patricio Estrella</td>
                            <td>p.estrella.eco</td>
                            <td class="admin-status-active">Active</td>
                        </tr>
                        <tr>
                            <td>Sofia Vargas</td>
                            <td>s.vargas@ecoguide.com</td>
                            <td class="admin-status-active">Active</td>
                        </tr>
                        <tr>
                            <td>Samuel Flores</td>
                            <td>s.flores@ecoguide.com</td>
                            <td class="admin-status-suspended">Suspended</td>
                        </tr>
                        <tr>
                            <td>Isabella Ruiz</td>
                            <td>i.ruiz@ecoguide.com</td>
                            <td class="admin-status-active">Active</td>
                        </tr>
                        <tr>
                            <td>Patricio Estrella</td>
                            <td>p.estrella.eco</td>
                            <td class="admin-status-suspended">Suspended</td>
                        </tr>
                        <tr>
                            <td>Valentina Diaz</td>
                            <td>v.diaz@ecoguide.com</td>
                            <td class="admin-status-active">Active</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="admin-pagination">
                <button class="admin-page-button">&lt;</button>
                <span class="admin-page-label">Page 1 of 15</span>
                <button class="admin-page-button">&gt;</button>
            </div>
        </div>
    </div>
</div>
@endsection