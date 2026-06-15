@extends('layouts.app')
@section('title', 'My Profile')
@section('content')
    <section class="account-page">
        <div class="account-shell">
            <div class="account-top">
                <div class="account-profile">
                    <div class="account-avatar">
                        <img
                            src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/placeholder_user.png') }}">
                        <button type="button" class="avatar-edit" id="openAvatarModal">
                            <img src="{{ asset('icons/edit2-icon.png') }}" alt="Edit avatar">
                        </button>
                    </div>
                    <div class="account-user">
                        <h1 class="account-user-name">{{ auth()->user()->name ?? 'Usuario' }}</h1>
                        <p class="account-user-email">{{ auth()->user()->email ?? 'Correo' }}</p>
                    </div>
                </div>
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
                        <label for="name">{{ __('messages.name') }}</label>
                        <input type="text" id="name" name="name" value="{{ auth()->user()->name ?? 'Usuario' }}">
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('messages.email') }}</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email ?? 'Correo' }}">
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('messages.password') }}</label>
                        <span class="label-instruction">{{ __('messages.new-password') }}</span>
                        <input type="password" id="password" name="password" placeholder="••••••••">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="save-btn">{{ __('messages.save-changes') }}</button>
                        <button type="button" class="back-btn"
                            onclick="window.location.href='/profile'">{{ __('messages.back') }}</button>
                    </div>
                </form>
                <div class="danger-zone">
                    <h3>{{ __('messages.delete-account') }}</h3>

                    <p>{{ __('messages.delete-account-warning') }}</p>

                    <form action="{{ route('account.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="input-group">
                            <label for="delete_password">
                                {{ __('messages.confirm-password') }}
                            </label>

                            <input type="password" name="delete_password" id="delete_password" required
                                placeholder="********">

                            @error('delete_password')
                                <small style="color: #b13b3b;">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <button type="submit" class="delete-account-btn"
                            onclick="return confirm('{{ __('messages.delete-account-confirm') }}')">
                            {{ __('messages.delete-account') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>



        <div class="upload-modal" id="avatarUploadModal" aria-hidden="true">
            <div class="upload-modal-card">

                <button type="button" class="upload-modal-close" id="closeAvatarModal">
                    <img src="{{ asset('icons/x-icon.png') }}" alt="Close modal">
                </button>

                <form action="{{ route('account.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="avatarUploadInput" class="upload-dropzone">
                        <img src="{{ asset('icons/load-file-icon.png') }}" alt="Upload icon">
                        <span>{{ __('messages.upload-image') }}</span>
                        <small class="text-muted">
                            {{ __('messages.formats-allowed') }}
                        </small>
                    </label>

                    <input id="avatarUploadInput" type="file" name="avatar" accept="image/*" class="upload-file-input"
                        onchange="this.form.submit()">
                </form>

            </div>
        </div>
    </section>
    <script src="{{ asset('js/account.js') }}"></script>
@endsection