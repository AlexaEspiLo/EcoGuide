<form method="POST" action="{{ route('profile.update') }}">
    @csrf

    <input type="text" name="name" value="{{ auth()->user()->name }}">
    <input type="email" name="email" value="{{ auth()->user()->email }}">
    <input type="password" name="password" placeholder="New password">

    <button type="submit">Save</button>
</form>