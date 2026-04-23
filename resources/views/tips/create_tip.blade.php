<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>EcoGuide - Create New Tip</title>
    
    <link rel="stylesheet" href="{{ asset('css/general.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/tip.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="logo-top-container">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide" class="site-logo">
        </a>
    </div>
            
    <div class="main-container">
        <form action="{{ route('tips.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="header-container">
                <h1 class="main-title">Create new tip</h1>
                <button type="submit" class="post-button">Post</button>
            </div>

            <div class="form-grid">
                
                <div class="left-column">
                    <div class="form-group">
                        <label class="field-label">Title:</label>
                        <input type="text" name="title" id="title" class="form-input" value="{{ old('title') }}"> 
                        <span class="error-message" id="error-title"></span>
                    </div>

                    <div class="form-group">
                        <label class="field-label">Description:</label>
                        <textarea name="description" id="description" class="form-input description-input">{{ old('description') }}</textarea> 
                        <span class="error-message" id="error-description"></span>
                    </div>
                </div>

                <div class="right-column">
                    <div class="form-group">
                        <label class="field-label">Select a category:</label>
                        <div class="category-buttons-grid" id="category-group">
                            <label class="category-button">
                                <input type="radio" name="category_id" value="1" class="radio-input">
                                <span class="button-content">Recycling</span>
                            </label>
                            
                            <label class="category-button">
                                <input type="radio" name="category_id" value="2" class="radio-input">
                                <span class="button-content">Water Saving</span>
                            </label>
                            
                            <label class="category-button">
                                <input type="radio" name="category_id" value="3" class="radio-input">
                                <span class="button-content">Energy</span>
                            </label>
                        </div>
                        <span class="error-message" id="error-category_id"></span>
                    </div>

                    <div class="form-group">
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
    
    <script src="{{ asset('js/validaciones.js') }}"></script>
</body>
</html>