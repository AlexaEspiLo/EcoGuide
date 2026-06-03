@extends('layouts.app')
@section('title', 'New Tip')
@section('content')
    <div class="main-container">
        <form action="{{ route('tips.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="header-container">
                <h1 class="main-title">Create new tip</h1>
                <div style="display:flex; gap: 20px;">
                    <button type="submit" class="post-button">Post</button>
                    <button type="button" class="cancel-button" onclick="window.location.href='/'">Cancel</button>
                </div>
            </div>

            <div class="form-grid">
                
                <div class="left-column">
                    <div class="form-group-tip">
                        <label class="field-label">Title:</label>
                        <input type="text" name="title" id="title" class="form-input @error('title') input-error @enderror" value="{{ old('title') }}" placeholder="e.g. Bring Your Own Reusable Bottle"> 
                        @error('title')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group-tip">
                        <label class="field-label">Description:</label>
                        <textarea name="description" id="description" placeholder="e.g. Carry a reusable water bottle to reduce single-use plastic waste and save money over time." class="form-input description-input @error('description') input-error @enderror">{{ old('description') }}</textarea> 
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="right-column">
                    <div class="form-group-tip">
                        <label class="field-label">Select the sustainability topic that best matches your tip:</label>

                        <div class="select-wrapper">
                            <select name="category_id" class="form-input select-input @error('category_id') input-error @enderror">
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>
                                    Select a category
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
                        <label class="field-label">Upload an image that represents your tip:</label>
                        <label for="image-upload" class="image-upload-container" id="image-label">
                            <div class="upload-content">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p class="upload-text" id="file-name">Click to Upload Image <br>
                                    <small class="text-muted">
                                        Formats allowed are jpeg, png, jpg with a max size of 2MB (2048 KB)
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