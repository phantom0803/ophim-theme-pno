@extends('themes::themepno.layout')

@php
    use Ophim\Core\Models\Movie;

    $recommendations = Cache::remember('site.movies.recommendations', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('is_recommended', true)
            ->limit(get_theme_option('recommendations_limit', 10))
            ->orderBy('updated_at', 'desc')
            ->get();
    });

    $data = Cache::remember('site.movies.latest', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('latest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit, $link] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 12, '']);
                try {
                    $data[] = [
                        'label' => $label,
                        'link' => $link,
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

@section('content')
    @include('themes::themepno.inc.slider_recommended')
    <section class="inner-banner-section banner-section bg-overlay-black bg_img">
        @foreach ($data as $item)
            <div id="section-opt">
                <div class="container">
                    <div class="movies-list-wrap mlw-latestmovie">
                        <div class="ml-title">
                            <span class="pull-left title">{{$item['label']}}</span>
                            @if ($item['link'])
                                <a href="{{$item['link']}}" class="pull-right cat-more">Xem Thêm »</a>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-content">
                            <div class="movies-list movies-list-full tab-pane fade active in">
                                <div class="row clean-preset">
                                    <div class="movie-container">
                                        @foreach ($item['data'] as $movie)
                                            <div class="col-md-2 col-sm-3 col-xs-6">
                                                @include('themes::themepno.inc.movie_card')
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
