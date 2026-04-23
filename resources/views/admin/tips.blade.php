@extends('layouts.admin')

@section('styles')
<link href="{{ asset('css/admin/tips.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="admin-tips-page">
    <div class="admin-tips-inner">
        <div class="admin-tips-header">
            <h1 class="admin-tips-title">Tips Management</h1>
        </div>

        <section class="filters">
            <button class="btn-create active">All</button>
            <button class="btn-create">Published</button>
            <button class="btn-create">Suspended</button>
            <button class="btn-create">Deleted</button>
        </section>

        <div class="admin-card">
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Tip Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Date Posted</th>
                            <th>Status</th>
                            <th class="actions-header">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Natural Fertilizers: Composting 101</td>
                            <td>Patricio Estrella</td>
                            <td>#Recycling</td>
                            <td>Nov 30, 2026</td>
                            <td class="admin-status-published">Published</td>
                            <td>
                                <div class="actions">
                                    <button class="btn-delete">⊘ Block</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Efficient Irrigation Systems</td>
                            <td>Sofia Vargas</td>
                            <td>#WaterSaving</td>
                            <td>Nov 12, 2026</td>
                            <td class="admin-status-suspended">Suspended</td>
                            <td>
                                <div class="actions">
                                                              <button class="btn-delete">⊘ Block</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <footer class="table-footer">
                               <div class="pagination">
                    <button class="admin-page-button">&lt;</button>
                    <span>Page <input type="number" value="1"> of 15</span>
                    <button class="admin-page-button">&gt;</button>
                </div>
            </footer>
        </div>
    </div>
</div>
@endsection
