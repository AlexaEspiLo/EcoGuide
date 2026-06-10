@extends('layouts.admin')

@section('styles')
    <link href="{{ asset('css/admin/info-pages.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="info-pages-page">
        <div class="info-pages-inner">
            <div class="info-pages-left">
                <h2 class="info-pages-title">Info Pages</h2>
                <aside class="info-pages-sidebar">
                    <nav class="info-pages-nav">
                        <button type="button" class="info-pages-button">
                            <span class="info-pages-icon">+</span>
                            <span>New</span>
                        </button>

                        @foreach($pages as $p)
                            <a href="{{ route('admin.pages.edit', $p->slug) }}"
                                class="info-pages-link {{ $page->id == $p->id ? 'active' : '' }}">
                                <span class="info-pages-arrow">›</span>
                                <span>{{ $p->title }}</span>
                            </a>
                        @endforeach
                    </nav>
                </aside>
            </div>

            <main class="info-pages-main">
                <div class="info-pages-card">
                    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" class="info-pages-form">
                        @csrf
                        @method('PUT')

                        <div class="info-pages-row">
                            <label class="info-pages-label">Title</label>
                            <input type="text" name="title" value="{{ old('title', $page->title) }}"
                                class="info-pages-input">
                            <label class="info-pages-label">English Title</label>
                            <input type="text" name="title_en" value="{{ old('title_en', $page->title_en) }}"
                                class="info-pages-input">
                            
                        </div>

                        <div class="info-pages-row">
                            <label class="info-pages-label">Content</label>
                            <textarea name="content" class="info-pages-textarea">
                            {{ old('content', $page->content) }}
                                    </textarea>
                        </div>

                        <div class="info-pages-row">
                            <label class="info-pages-label">English Content</label>
                            <textarea name="content_en" class="info-pages-textarea">
                            {{ old('content_en', $page->content_en) }}
                                    </textarea>
                        </div>

                        <div class="info-pages-footer">
                            <button type="submit" class="info-pages-save">Save Changes</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>
@endsection