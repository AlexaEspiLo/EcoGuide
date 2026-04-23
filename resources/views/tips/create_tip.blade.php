@extends('layouts.app')
@section('title', 'New Tip')
@section('content')
    <div class="main-container">
        <form action="{{ route('tips.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="header-container">
                <h1 class="main-title">Create new tip</h1>
                <button type="submit" class="post-button">Post</button>
            </div>

            <div class="form-grid">
                
                <div class="left-column">
                    <div class="form-group-tip">
                        <label class="field-label">Title:</label>
                        <input type="text" name="title" id="title" class="form-input" value="{{ old('title') }}"> 
                        <span class="error-message" id="error-title"></span>
                    </div>

                    <div class="form-group-tip">
                        <label class="field-label">Description:</label>
                        <textarea name="description" id="description" class="form-input description-input">{{ old('description') }}</textarea> 
                        <span class="error-message" id="error-description"></span>
                    </div>
                </div>

                <div class="right-column">
                    <div class="form-group-tip">
                        <label class="field-label">Select a category:</label>

                        <div class="select-wrapper">
                            <select name="category_id" class="form-input select-input">
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

                        <span class="error-message" id="error-category_id"></span>
                    </div>

                    <div class="form-group-tip">
                        <label class="field-label">Image:</label>
                        <label for="image-upload" class="image-upload-container" id="image-label">
                            <div class="upload-content">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p class="upload-text" id="file-name">Click to Upload Image</p>
                            </div>
                        </label>
                        <input type="file" id="image-upload" name="image" style="display: none;"
                               onchange="document.getElementById('file-name').innerText = this.files[0].name">
                        
                        <span class="error-message" id="error-image-upload"></span>
                    </div>
                </div>

            </div>
        </form>
    </div>


@endsection