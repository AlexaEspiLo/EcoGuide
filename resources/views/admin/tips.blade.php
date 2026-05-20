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
                            @foreach($tips as $tip)
                                <tr>
                                    <td>{{ $tip->title }}</td>
                                    <td>{{ $tip->user->name ?? 'Unknown' }}</td>
                                    <td>#{{ $tip->category->category_name ?? 'General' }}</td>
                                    <td>{{ $tip->created_at?->format('M d, Y') ?? 'Sin fecha' }}</td>
                                    <td class="admin-status-{{ strtolower($tip->status ?? 'published') }}">
                                        {{ ucfirst($tip->status ?? 'Published') }}
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <form action="" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-delete">⊘ Block</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <footer class="table-footer">
                    <div class="">
                        {{ $tips->links() }}
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection