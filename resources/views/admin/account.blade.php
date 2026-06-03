@extends('layouts.admin')
@section('title', 'My Profile')
@section('styles')
    <link href="{{ asset('css/admin/account.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="account-page">
        <div class="account-shell">
            <div class="account-top">
                <div class="account-profile">
                    <div class="account-avatar">
                        <img src="{{ asset('images/placeholder_user.png') }}" alt="User Avatar">
                        <button type="button" class="avatar-edit" id="openAvatarModal">
                            <img src="{{ asset('icons/edit2-icon.png') }}" alt="Edit avatar">
                        </button>
                    </div>
                    <div class="account-user">
                        <h1 class="account-user-name">{{ auth()->user()->name ?? 'Usuario' }}</h1>
                        <p class="account-user-email">{{ auth()->user()->email ?? 'Correo' }}</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            </div>

            <div class="account-form-card">
                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('account.update') }}" method="POST" class="profile-content">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{ auth()->user()->name ?? 'Usuario' }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email ?? 'Correo' }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <span class="label-instruction">Enter your new password to change it</span>
                        <input type="password" id="password" name="password" placeholder="••••••••">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="save-btn">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>



        <div class="upload-modal" id="avatarUploadModal" aria-hidden="true">
            <div class="upload-modal-card">
                <button type="button" class="upload-modal-close" id="closeAvatarModal">
                    <img src="{{ asset('icons/x-icon.png') }}" alt="Close modal">
                </button>
                <label for="avatarUploadInput" class="upload-dropzone">
                    <img src="{{ asset('icons/load-file-icon.png') }}" alt="Upload icon">
                    <span>Click to Upload Image</span>
                    <small class="text-muted">
                        Formats allowed are jpeg, png, jpg with a max size of 2MB (2048 KB)
                    </small>
                </label>
                <input id="avatarUploadInput" type="file" accept="image/*" class="upload-file-input">
            </div>
        </div>
    </section>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var openBtn = document.getElementById('openAvatarModal');
        var closeBtn = document.getElementById('closeAvatarModal');
        var modal = document.getElementById('avatarUploadModal');

        if (openBtn && closeBtn && modal) {
            openBtn.addEventListener('click', function () {
                modal.classList.add('open');
                modal.setAttribute('aria-hidden', 'false');
            });

            closeBtn.addEventListener('click', function () {
                modal.classList.remove('open');
                modal.setAttribute('aria-hidden', 'true');
            });

            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.classList.remove('open');
                    modal.setAttribute('aria-hidden', 'true');
                }
            });
        }
    });
</script>