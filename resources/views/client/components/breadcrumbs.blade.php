<section class="blog about-blog">
    <div class="container">
        <div class="blog-bradcrum">
            <span><a href="{{ route('home.index') }}">Home</a></span>
            <span class="devider">/</span>

            @if(request()->routeIs('home.about'))
                <span><a href="{{ route('home.about') }}">About</a></span>
            @elseif(request()->routeIs('home.contact'))
                <span><a href="{{ route('home.contact') }}">Contact</a></span>
            @else
                <span><a href="#">{{ ucwords(str_replace('-', ' ', last(explode('.', request()->route()->getName())))) }}</a></span>
            @endif
        </div>

        <div class="blog-heading about-heading">
            <h1 class="heading">{{ ucwords(str_replace('-', ' ', last(explode('.', request()->route()->getName())))) }}</h1>
        </div>
    </div>
</section>