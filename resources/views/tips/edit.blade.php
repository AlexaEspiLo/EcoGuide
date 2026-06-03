@extends('layouts.app')
@section('title', 'Edit Tip')
@section('content')
    <div class="main-container">
        <form action="{{ route('tips.update', $tip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="header-container">
                <h1 class="main-title">Edit tip</h1>
                <div style="display:flex; gap: 20px;">
                    <button type="submit" class="post-button">Update</button>
                    <button type="button" class="cancel-button" onclick="window.location.href='/'">Cancel</button>
                </div>
            </div>

            <div class="form-grid">

                <div class="left-column">
                    <div class="form-group-tip">
                        <label class="field-label">Title:</label>
                        <input type="text" name="title" id="title" class="form-input"
                            value="{{ old('title', $tip->title ?? '') }}">
                        @error('title')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group-tip">
                        <label class="field-label">Description:</label>
                        <textarea name="description" id="description"
                            class="form-input description-input">{{old('description', $tip->description ?? '')}}</textarea>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="right-column">
                    <div class="form-group-tip">
                        <label class="field-label">The sustainability topic that best matches your tip:</label>

                        <div class="select-wrapper">
                            <select name="category_id" class="form-input select-input">
                                <option disabled>Select a category</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id', $tip->category_id) == $category->id) ? 'selected' : '' }}>
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
                        <label class="field-label">The image that represents your tip:</label>

                        <label for="image-upload" class="image-upload-container" id="image-label">

                            @if(isset($tip) && $tip->image)
                                <img src="{{ asset('storage/' . $tip->image) }}" class="preview-image" id="preview-image">
                            @else
                                <div class="upload-content" id="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="upload-text" id="file-name">Click to Upload Image <br>
                                        <small class="text-muted">
                                            Formats allowed are jpeg, png, jpg with a max size of 2MB (2048 KB)
                                        </small>
                                    </p>
                                </div>
                            @endif

                            <!-- Overlay -->
                            <div class="overlay">
                                <span>Click to change</span>
                            </div>

                        </label>

                        <input type="file" id="image-upload" name="image" accept="image/*" hidden>

                    </div>
                </div>

            </div>
        </form>
    </div>


@endsection