@extends('themes::layout')

@php
    $menu = \Ophim\Core\Models\Menu::getTree();
    $tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 8]);
                try {
                    $data[] = [
                        'label' => $label,
                        'data' => \Ophim\Core\Models\Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                    ];
                } catch (\Exception $e) {
                    # code
                }
            }
        }

        return $data;
    });
@endphp

@push('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/additional.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/ionicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/socicon-styles.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/hover-min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/responsive.css') }}">
    <script src="{{ asset('/themes/pno/assets/theme/default/js/jquery-2.2.4.min.js') }}" crossorigin="anonymous"
        type="text/javascript"></script>

    <link rel="stylesheet" type="text/css"
        href="{{ asset('/themes/pno/assets/theme/default/swiper/css/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/swiper/css/custom.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/owl-custom.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/themes/pno/assets/theme/default/css/owl.theme.default.min.css') }}">
    <script src="{{ asset('/themes/pno/assets/theme/default/js/owl.carousel.js') }}" type="text/javascript"></script>

    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css"
        media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/auto-complete.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/filter.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/blue.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/dark.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/custom.css') }}">

@endpush

@section('body')
    <div id="wrapper">
        <div id="main-content">
            @include('themes::themepno.inc.header')
            @if (get_theme_option('ads_header'))
                {!! get_theme_option('ads_header') !!}
            @endif
            @yield('content')
            {!! get_theme_option('footer') !!}
        </div>
    </div>
@endsection

@section('footer')

    @if (get_theme_option('ads_catfish'))
        {!! get_theme_option('ads_catfish') !!}
    @endif

    <script src="{{asset('/themes/pno/assets/theme/default/swiper/js/swiper.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(".dropdown").hover(function() {
            $(this).addClass("open");
        }, function() {
            $(this).removeClass("open");
        });
    </script>
    <script type="text/javascript" charset="utf8" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.6/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.6/jquery.lazy.plugins.min.js">
    </script>
    <link href="{{ asset('/themes/pno/assets/plugins/swal2/sweetalert2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/themes/pno/assets/theme/default/js/swiper.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/themes/pno/assets/theme/default/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/themes/pno/assets/plugins/swal2/sweetalert2.min.js') }}" type="text/javascript"></script>

    {!! setting('site_scripts_google_analytics') !!}
@endsection
