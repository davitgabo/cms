<header class="Container">
    <section class="content header-content">
        <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="site logo" class="logo"></a>
        <ul class="menu">
            @foreach ($menus as $menu)
                @if($menu->redirect_url)
                    <li>
                        <a href="{{ $menu->redirect_url }}" target="_blank" rel="noopener noreferrer">
                            {{ $menu->name }}
                        </a>
                    </li>
                @else
                    <li><a href="{{ $menu->slug }}">{{$menu->name}}</a></li>
                @endif
            @endforeach
        </ul>
        <div class="utility-bar">
            <form class="search">
                <button id="toggle-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input type="text" name="search" id="search" placeholder="ძიება">
            </form>
            <a href=""><i class="fa-brands fa-facebook-f"></i></a>
            <button
                onclick="location.href='/' + location.pathname.split('/').filter(Boolean).map((s, i) => i === 0 ? (s === 'en' ? 'ka' : 'en') : s).join('/')"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
            >
                🌐 Switch Language
            </button>
        </div>
        <img class="menu-toggle" src="{{ asset('assets/images/menu-icon.svg') }}" alt="menu icon" id="menu-toggle-button">
    </section>

    <div class="dropdownMenu" id="dropdownMenu">
        <ul class="mobile-menu">
            @foreach ($menus as $menu)
                @if($menu->redirect_url)
                    <li>
                        <a href="{{ $menu->redirect_url }}" target="_blank" rel="noopener noreferrer">
                            {{ $menu->name }}
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ $menu->redirect_url }}" target="_blank" rel="noopener noreferrer">
                            {{ $menu->name }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
        <form class="mobile-search">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" name="search" placeholder="ძიება">
        </form>
        <a href="" class="mobile-fb"><i class="fa-brands fa-facebook-f"></i></a>
    </div>
</header>
