@extends('layouts.app')
@section('title', 'Edit Tip')
@section('content')
    <div class="main-container">
        <form action="{{ route('tips.update', $tip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="header-container">
                <h1 class="main-title">Edit tip</h1>
                <button type="submit" class="post-button">Update</button>
            </div>

            <div class="form-grid">

                <div class="left-column">
                    <div class="form-group-tip">
                        <label class="field-label">Title:</label>
                        <input type="text" name="title" id="title" class="form-input"
                            value="{{ old('title', $tip->title ?? '') }}">
                        <span class="error-message" id="error-title"></span>
                    </div>

                    <div class="form-group-tip">
                        <label class="field-label">Description:</label>
                        <textarea name="description" id="description"
                            class="form-input description-input">{{old('description', $tip->description ?? '')}}</textarea>
                        <span class="error-message" id="error-description"></span>
                    </div>
                </div>

                <div class="right-column">
                    <div class="form-group-tip">
                        <label class="field-label">Select a category:</label>

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

                        <span class="error-message" id="error-category_id"></span>
                    </div>

                    <div class="form-group-tip">
                        <label class="field-label">Image:</label>

                        <label for="image-upload" class="image-upload-container" id="image-label">

                            @if(isset($tip) && $tip->image)
                                <img src="{{ asset('storage/' . $tip->image) }}" class="preview-image" id="preview-image">
                            @else
                                <div class="upload-content" id="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="upload-text">Click to Upload Image</p>
                                </div>
                            @endif

                            <!-- Overlay -->
                            <div class="overlay">
                                <span>Click to change</span>
                            </div>

                        </label>

                        <input type="file" id="image-upload" name="image" accept="image/*" hidden>

                        <span class="error-message" id="error-image-upload"></span>
                    </div>
                </div>

            </div>
        </form>
    </div>


@endsection