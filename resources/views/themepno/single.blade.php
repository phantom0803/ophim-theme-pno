@extends('themes::themepno.layout')

@php
    $watch_url = '';
    if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '') {
        $watch_url = $currentMovie->episodes
            ->sortBy([['server', 'asc']])
            ->groupBy('server')
            ->first()
            ->sortByDesc('name', SORT_NATURAL)
            ->groupBy('name')
            ->last()
            ->sortByDesc('type')
            ->first()
            ->getUrl();
    }
@endphp

@section('content')
    <section class="inner-banner-section banner-section bg-overlay-black bg_img">
        <div id="movie-details">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row movies-list-wrap">
                            <div class="ml-title">
                                <div class="tab-content">
                                    <div id="info" class="tab-pane fade in active">
                                        <div class="row">
                                            <div class="col-md-3 m-t-10">
                                                <img class="img-responsive" style="min-width: 100%;"
                                                    src="{{ $currentMovie->thumb_url }}" alt="{{ $currentMovie->name }}">

                                                <div class="block_watch">
                                                    @if ($watch_url)
                                                        <a class="btn btn-primary btn_watch" href="{{ $watch_url }}"><i class="fa fa-play-circle"
                                                            aria-hidden="true"></i> Xem Phim</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h1>{{ $currentMovie->name }}</h1>
                                                        <h2>{{ $currentMovie->origin_name }}
                                                            ({{ $currentMovie->publish_year }})</h2>
                                                        <div class="box-rating">
                                                            <input id="hint_current" type="hidden" value="">
                                                            <input id="score_current" type="hidden"
                                                                value="{{ number_format($currentMovie->rating_star ?? 0, 1) }}">
                                                            <div id="star"
                                                                data-score="{{ number_format($currentMovie->rating_star ?? 0, 1) }}"
                                                                style="cursor: pointer; float: left; width: 200px;">
                                                            </div>
                                                            <span id="hint"></span>
                                                            <div id="div_average"
                                                                style="float:left; line-height:20px; margin:0 5px; ">(<span
                                                                    class="average"
                                                                    id="average">{{ number_format($currentMovie->rating_star ?? 0, 1) }}</span>
                                                                đ/<span id="rate_count"> /
                                                                    {{ $currentMovie->rating_count ?? 0 }}</span> lượt)
                                                            </div>
                                                            <meta itemprop="aggregateRating" itemscope
                                                                itemtype="https://schema.org/AggregateRating" />
                                                            <meta itemprop="ratingValue"
                                                                content="{{ number_format($currentMovie->rating_star ?? 0, 1) }}" />
                                                            <meta itemprop="ratingcount"
                                                                content="{{ $currentMovie->rating_count ?? 0 }}" />
                                                            <meta itemprop="bestRating" content="10" />
                                                            <meta itemprop="worstRating" content="1" />
                                                        </div>
                                                        <div class="addthis_inline_share_toolbox_yl99 m-t-30 m-b-10"
                                                            data-url=""
                                                            data-title="Watch & Download {{ $currentMovie->name }}">

                                                            @if ($currentMovie->content)
                                                                {!! $currentMovie->content !!}
                                                            @else
                                                                <p>Hãy xem phim để cảm nhận nhé...</p>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 text-left">
                                                        <p>
                                                            <strong>Trạng thái: </strong>
                                                            {{ $currentMovie->episode_current }}
                                                        </p>
                                                        <p>
                                                            <strong>Thể loại: </strong>
                                                            {!! $currentMovie->categories->map(function ($category) {
                                                                    return '<a href="' .
                                                                        $category->getUrl() .
                                                                        '" title="' .
                                                                        $category->name .
                                                                        '" rel="category tag">' .
                                                                        $category->name .
                                                                        '</a>';
                                                                })->implode(', ') !!}
                                                        </p>
                                                        <p>
                                                            <strong>Quốc gia: </strong>
                                                            {!! $currentMovie->regions->map(function ($region) {
                                                                    return '<a href="' .
                                                                        $region->getUrl() .
                                                                        '" title="' .
                                                                        $region->name .
                                                                        '" rel="region tag">' .
                                                                        $region->name .
                                                                        '</a>';
                                                                })->implode(', ') !!}
                                                        </p>
                                                        <p>
                                                            <strong>Năm phát hành: </strong>
                                                            {{ $currentMovie->publish_year }}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <p>
                                                            <strong>Tổng số tập:</strong>
                                                            {{ $currentMovie->episode_total }}
                                                        </p>
                                                        <p>
                                                            <strong>Thời lượng:</strong> {{ $currentMovie->episode_time }}
                                                        </p>
                                                        <p>
                                                            <strong>Chất Lượng:</strong>
                                                            <span class="label label-primary">{{ $currentMovie->quality }}
                                                                - {{ $currentMovie->language }}</span>
                                                        </p>
                                                        <p>
                                                            <strong>Tổng lượt xem:</strong> {{ $currentMovie->view_total }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p>
                                                            <strong>Diễn Viên: </strong>
                                                            {!! $currentMovie->actors->map(function ($actor) {
                                                                    return '<a href="' .
                                                                        $actor->getUrl() .
                                                                        '" tite="Diễn viên ' .
                                                                        $actor->name .
                                                                        '" class="actor">' .
                                                                        $actor->name .
                                                                        '</a>';
                                                                })->implode(', ') !!}
                                                        </p>
                                                        <p>
                                                            <strong>Đạo Diễn: </strong>
                                                            {!! $currentMovie->directors->map(function ($director) {
                                                                    return '<a href="' .
                                                                        $director->getUrl() .
                                                                        '" tite="Đạo diễn ' .
                                                                        $director->name .
                                                                        '" class="director">' .
                                                                        $director->name .
                                                                        '</a>';
                                                                })->implode(', ') !!}
                                                        </p>
                                                        <p>
                                                            <strong>Từ khóa:</strong>
                                                            {!! $currentMovie->tags->map(function ($tag) {
                                                                    return '<a href="' . $tag->getUrl() . '" title="' . $tag->name . '" rel="tag">' . $tag->name . '</a>';
                                                                })->implode(', ') !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="similler-movie">
                                <div class="movie-heading overflow-hidden">
                                    <span class="fadeInUp" data-wow-duration="0.8s"> Bình luận </span>
                                    <div class="disable-bottom-line" data-wow-duration="0.8s"></div>
                                </div>
                                <div class="fb-comments" style="background-color:white;" data-colorscheme="light" data-href="{{ $currentMovie->getUrl() }}" data-width="100%" data-numposts="10">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="similler-movie">
                                <div class="movie-heading overflow-hidden">
                                    <span class="fadeInUp" data-wow-duration="0.8s"> Có Thể Bạn Thích </span>
                                    <div class="disable-bottom-line" data-wow-duration="0.8s"></div>
                                </div>
                                <div class="row">
                                    <div class="movie-container">
                                        @foreach ($movie_related as $movie)
                                            <div class="col-md-2 col-sm-3 col-xs-6"> @include('themes::themepno.inc.movie_card') </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='movie-container'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <link href="{{ asset('/themes/pno/libs/jquery-raty/jquery.raty.css') }}" rel="stylesheet" />
    <script src="{{ asset('/themes/pno/libs/jquery-raty/jquery.raty.js') }}"></script>

    <script>
        var rated = false;
        jQuery(document).ready(function($) {
            $('#star').raty({
                number: 10,
                starHalf: '/themes/pno/libs/jquery-raty/images/star-half.png',
                starOff: '/themes/pno/libs/jquery-raty/images/star-off.png',
                starOn: '/themes/pno/libs/jquery-raty/images/star-on.png',
                click: function(score, evt) {
                    if (!rated) {
                        $.ajax({
                            url: '{{ route('movie.rating', ['movie' => $currentMovie->slug]) }}',
                            data: JSON.stringify({
                                rating: score
                            }),
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]')
                                    .getAttribute(
                                        'content')
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                alert("Đánh giá của bạn đã được gửi đi!")
                                rated = true;
                            }
                        });
                    }
                }
            });
        })
    </script>

    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
