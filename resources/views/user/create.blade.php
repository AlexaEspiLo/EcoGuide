<form method="POST" action="{{ route('tips.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" placeholder="Title">

    <textarea name="description"></textarea>

    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <input type="file" name="image">

    <button type="submit">Post</button>
</form>