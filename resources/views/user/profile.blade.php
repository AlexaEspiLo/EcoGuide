@extends('layouts.app')
@section('content')

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="banner"></div>

        <div class="profile">
            <img src="https://i.pravatar.cc/150" class="avatar">
            <h2>{{ $user->name ?? 'Nombre Usuario' }}</h2>
        </div>
    </div>

    <!-- TABS -->
    <div class="tabs">
        <div class="tab active">❤️ Favorites</div>
        <div class="tab">My Tips</div>
    </div>

    <!-- CARDS DINÁMICAS -->
    <div class="cards">

       @forelse($tips ?? [] as $tip)
            <div class="card">
                <h3>{{ $tip->titulo }}</h3>
                <p>{{ $tip->descripcion }}</p>

                <div class="card-footer">
                    <button>See Tip</button>
                    <span>{{ $tip->likes }} ❤️</span>
                </div>
            </div>
        @empty
            <p class="empty">No hay tips todavía</p>
        @endforelse

    </div>

</div>

</body>
</html>


@endsection
