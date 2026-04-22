@extends('layouts.app')
@section('content')
    <section class="account-page">
        <div class="account-shell">
            <div class="account-top">
                <div class="account-profile">
                    <div class="account-avatar">
                        <img src="{{ auth()->user()->avatar? asset('storage/' . auth()->user()->avatar): asset('images/placeholder_user.png') }}">
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

                <!-- 🔥 FORM AQUÍ -->
                <form action="{{ route('account.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="avatarUploadInput" class="upload-dropzone">
                        <img src="{{ asset('icons/load-file-icon.png') }}" alt="Upload icon">
                        <span>Click to Upload Image</span>
                    </label>

                    <input id="avatarUploadInput" type="file" name="avatar" accept="image/*" class="upload-file-input"
                        onchange="this.form.submit()">
                </form>

            </div>
        </div>
    </section>
    <script src="{{ asset('js/account.js') }}"></script>
@endsection