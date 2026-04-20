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
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="header-container">
                <h1 class="main-title">Create new tip</h1>
                <button type="submit" class="post-button">Post</button>
            </div>

            <div class="form-grid">
                
                <div class="left-column">
                    <div class="form-group">
                        <label class="field-label">Title:</label>
                        <input type="text" name="title" class="form-input"> <span class="error-message" id="error-title"></span>
                    </div>

                    <div class="form-group">
                        <label class="field-label">Description:</label>
                        <textarea name="description" class="form-input description-input"></textarea> <span class="error-message" id="error-description"></span>
                    </div>
                </div>

                <div class="right-column">
                    <div class="form-group">
                        <label class="field-label">Select an category:</label>
                        <div class="select-wrapper">
                            <select name="category" class="form-select" required>
                                <option value=""disabled selected> Choose one...</option>
                                <option value="recycling">Recycling</option>
                                <option value="water">Water Saving</option>
                                <option value="energy">Energy</option>
                            </select>
                        </div>
                        <span class="error-message" id="error-category"></span>
                    </div>

                    <div class="form-group">
                        <label class="field-label">Image:</label>
                        <label for="image-upload" class="image-upload-container">
                            <div class="upload-content">
                                <i class="fas fa-chevron-down select-icon"></i>
                                <p class="upload-text" id="file-name">Click to Upload Image</p>
                            </div>
                        </label>
                        <input type="file" id="image-upload" name="image" style="display: none;" 
                               onchange="document.getElementById('file-name').innerText = this.files[0].name">

                               <span class="error-message" id="error-image"></span>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <script src="{{ asset('js/validaciones.js') }}"></script>

</body>
</html>