@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" title="{{ $title }}">
                @if ($logo)
                    {!! $logo !!}
                @else
                    {!! $brand !!}
                @endif
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-left">
                @foreach ($menu as $item)
                    @if (count($item['children']))
                        <li class="dropdown">
                            <a href="{{ $item['link'] }}" class="dropdown-toggle"
                                data-toggle="dropdown">{{ $item['name'] }} <span class="caret"></span></a>
                            <div class="dropdown-menu row col-lg-12 three-column-navbar" role="menu">
                                @foreach ($item['children'] as $children)
                                    <div class="col-md-3">
                                        <ul class="menu-item list-unstyled">
                                            <li><a href="{{ $children['link'] }}">{{ $children['name'] }}</a></li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    @else
                        <li><a href="{{ $item['link'] }}">{{ $item['name'] }}</a></li>
                    @endif
                @endforeach
            </ul>
            <form class="navbar-form navbar-left" method="get" action="/">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" autocomplete="off"
                        id="search-input" class="form-control" placeholder="Tìm kiếm phim..">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
            </form>
        </div>
    </div>
</nav>
