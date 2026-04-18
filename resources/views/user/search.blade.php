@extends('layouts.app')

@section('content')

<form action="{{ route('search') }}" method="GET">
    <input type="text" name="query" placeholder="Search by user, category, or tip">
</form>

@endsection