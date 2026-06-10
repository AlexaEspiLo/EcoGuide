@extends('layouts.app')
@section('title', 'New Tip')
@section('content')
    <div class="main-container">
        <form action="{{ route('tips.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="header-container">
                <h1 class="main-title">{{ __('messages.create-tip') }}</h1>
                <div style="display:flex; gap: 20px;">
                    <button type="submit" class="post-button">{{ __('messages.post') }}</button>
                    <button type="button" class="cancel-button" onclick="window.location.href='/'">{{ __('messages.cancel') }}</button>
                </div>
            </div>

            <div class="form-grid">
                
                <div class="left-column">
                    <div class="form-group-tip">
                        <label class="field-label">{{ __('messages.title') }}:</label>
                        <input type="text" name="title" id="title" class="form-input @error('title') input-error @enderror" value="{{ old('title') }}" placeholder="{{ __('messages.ex-title') }}"> 
                        @error('title')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group-tip">
                        <label class="field-label">{{ __('messages.description') }}:</label>
                        <textarea name="description" id="description" placeholder="{{ __('messages.ex-description') }}" class="form-input description-input @error('description') input-error @enderror">{{ old('description') }}</textarea> 
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="right-column">
                    <div class="form-group-tip">
                        <label class="field-label">{{ __('messages.category') }}:</label>

                        <div class="select-wrapper">
                            <select name="category_id" class="form-input select-input @error('category_id') input-error @enderror">
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>
                                    {{ __('messages.select-category') }}
                                </option>

                                @foreach($categories as $category)
                                    <option 
                                        value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @error('category_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group-tip">
                        <label class="field-label">{{ __('messages.upload-image-tip') }}:</label>
                        <label for="image-upload" class="image-upload-container" id="image-label">
                            <div class="upload-content">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p class="upload-text" id="file-name">{{ __('messages.upload-image') }}<br>
                                    <small class="text-muted">
                                        {{ __('messages.formats-allowed') }}
                                    </small>
                                </p>
                            </div>
                        </label>
                        <input type="file" id="image-upload" name="image" style="display: none;"
                               onchange="document.getElementById('file-name').innerText = this.files[0].name">
                    
                    </div>
                </div>

            </div>
        </form>
    </div>


@endsection