@extends('layouts.admin')

@section('styles')
<link href="{{ asset('css/admin/categories.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="admin-categories-page">
    <div class="admin-categories-inner">
        <div class="admin-categories-header">
            <h1 class="admin-categories-title">Categories Management</h1>
            <button type="button" class="btn-create" id="openCreateModal">
                <span class="plus-icon">+</span> Create Category
            </button>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="modal-backdrop" id="createCategoryModal" aria-hidden="true"></div>

        <div class="create-category-modal" id="createCategoryModalDialog" aria-hidden="true">
            <div class="modal-content">
                <button type="button" class="modal-close" id="closeCreateModal">
                    <span>&times;</span>
                </button>
                <h2 class="modal-title">Create New Category</h2>

                <form id="categoryForm" class="create-category-form" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="POST" id="categoryFormMethod">

                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="text" id="categoryName" name="category_name" placeholder="Enter category name" required>
                    </div>

                    <div class="form-group">
                        <label for="categoryStatus">Status</label>
                        <select id="categoryStatus" name="category_status">
                            <option value="published">Published</option>
                            <option value="suspended">Suspended</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="categoryIcon" class="upload-dropzone">
                            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M32 8V40M32 40L22 30M32 40L42 30" stroke="#2b3a27" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 48H48C49.0609 48 50.0783 48.4214 50.8284 49.1716C51.5786 49.9217 52 50.9391 52 52V56C52 57.0609 51.5786 58.0783 50.8284 58.8284C50.0783 59.5786 49.0609 60 48 60H16C14.9391 60 13.9217 59.5786 13.1716 58.8284C12.4214 58.0783 12 57.0609 12 56V52C12 50.9391 12.4214 49.9217 13.1716 49.1716C14.4217 48.4214 15.4391 48 16 48Z" stroke="#2b3a27" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Click to Upload Category Icon</span>
                            <span class="upload-hint">Required format: PNG only</span>
                        </label>
                        <input id="categoryIcon" type="file" accept="image/png" name="category_icon" class="upload-file-input" required>
                    </div>

                    <button type="submit" class="btn-submit">Create Category</button>
                </form>
            </div>
        </div>

        <div class="admin-card">
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th class="center-text">Associated Tips</th>
                            <th>Date Posted</th>
                            <th>Status</th>
                            <th class="actions-header">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    <div class="category-cell">
                                        @if($category->image)
                                            <img src="{{ asset($category->image) }}" alt="{{ $category->category_name }} icon" class="category-icon">
                                        @endif
                                        <span>{{ $category->category_name }}</span>
                                    </div>
                                </td>
                                <td class="center-text">{{ $category->tips()->count() }}</td>
                                <td>{{ $category->created_at->format('M d, Y') }}</td>
                                <td class="{{ $category->status ? 'admin-status-published' : 'admin-status-suspended' }}">
                                    {{ $category->status ? 'Published' : 'Suspended' }}
                                </td>
                                <td>
                                    <div class="actions">
                                        <button class="btn-edit edit-category-button" type="button"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->category_name }}"
                                            data-status="{{ $category->status ? 'published' : 'suspended' }}"
                                            data-update-route="{{ route('categories.update', $category) }}"
                                        >✎ Edit</button>
                                        <button class="btn-delete delete-category-button" type="button"
                                            data-delete-route="{{ route('categories.destroy', $category) }}"
                                        ><span class="trash-icon">🗑</span> Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-row">No categories yet. Create one to begin.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="admin-pagination">
                <button class="admin-page-button" type="button">&lt;</button>
                <span class="admin-page-label">Page 1 of 15</span>
                <button class="admin-page-button" type="button">&gt;</button>
            </div>
        </div>
        <form id="deleteCategoryForm" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openBtn = document.getElementById('openCreateModal');
        const closeBtn = document.getElementById('closeCreateModal');
        const modal = document.getElementById('createCategoryModalDialog');
        const backdrop = document.getElementById('createCategoryModal');
        const categoryForm = document.getElementById('categoryForm');
        const categoryFormMethod = document.getElementById('categoryFormMethod');
        const categoryNameInput = document.getElementById('categoryName');
        const categoryStatusSelect = document.getElementById('categoryStatus');
        const categoryIconInput = document.getElementById('categoryIcon');
        const formSubmit = categoryForm.querySelector('.btn-submit');
        const modalTitle = document.querySelector('.modal-title');
        const deleteForm = document.getElementById('deleteCategoryForm');
        const editButtons = document.querySelectorAll('.edit-category-button');
        const deleteButtons = document.querySelectorAll('.delete-category-button');
        const originalAction = categoryForm.action;

        function openModal() {
            modal.classList.add('open');
            backdrop.classList.add('open');
            modal.setAttribute('aria-hidden', 'false');
            backdrop.setAttribute('aria-hidden', 'false');
        }

        function closeModal() {
            modal.classList.remove('open');
            backdrop.classList.remove('open');
            modal.setAttribute('aria-hidden', 'true');
            backdrop.setAttribute('aria-hidden', 'true');
        }

        function resetForm() {
            categoryForm.action = originalAction;
            categoryFormMethod.value = 'POST';
            categoryNameInput.value = '';
            categoryStatusSelect.value = 'published';
            categoryIconInput.required = true;
            formSubmit.textContent = 'Create Category';
            modalTitle.textContent = 'Create New Category';
            categoryIconInput.value = null;
        }

        if (openBtn && closeBtn && modal && backdrop && categoryForm) {
            openBtn.addEventListener('click', function () {
                resetForm();
                openModal();
            });

            closeBtn.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);
        }

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const updateRoute = button.dataset.updateRoute;
                const name = button.dataset.name;
                const status = button.dataset.status;

                categoryForm.action = updateRoute;
                categoryFormMethod.value = 'PATCH';
                categoryNameInput.value = name;
                categoryStatusSelect.value = status;
                categoryIconInput.required = false;
                formSubmit.textContent = 'Edit Category';
                modalTitle.textContent = 'Edit Category';
                categoryIconInput.value = null;

                openModal();
            });
        });

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const deleteRoute = button.dataset.deleteRoute;
                if (!confirm('¿Eliminar esta categoría?')) {
                    return;
                }
                deleteForm.action = deleteRoute;
                deleteForm.submit();
            });
        });
    });
</script>
