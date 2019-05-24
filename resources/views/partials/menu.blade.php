<nav class="nav">
    <div class="row" style="width: 100%;">
        <div class="col-md-9">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}">{{config('app.name')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{url('/')}}">Accueil</a>
                </li>
                @if(Route::is('book.*') == false)
                    @forelse($genres as $id => $name)
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('genre', $id)}}">{{ucfirst($name)}}</a>
                        </li>
                    @empty
                        <li>Aucun genre pour l'instant</li>
                    @endforelse
                @endif
            </ul>
        </div>
        <div class="col-md-3">
            <ul class="nav">
                @if(Auth::check())
                    <li class="nav-item"><a class="nav-link" href="{{url('/admin/book')}}">Dashboard</a></li>
                    <li class="nav-item">
                        <a class="nav-link" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>