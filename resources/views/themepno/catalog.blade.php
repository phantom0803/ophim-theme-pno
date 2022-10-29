@extends('themes::themepno.layout')

@php
    $years = Cache::remember('all_years', \Backpack\Settings\app\Models\Setting::get('site_cache_ttl', 5 * 60), function () {
        return \Ophim\Core\Models\Movie::select('publish_year')
            ->distinct()
            ->pluck('publish_year')
            ->sortDesc();
    });
@endphp

@section('content')
    <section class="inner-banner-section banner-section bg-overlay-black bg_img">

        <div id="title-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <div class="page-title">
                            <h1 class="text-uppercase">{{$section_name}}</h1>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 text-right">
                        <ul class="breadcrumb">
                            <li>
                                <a href="/"><i class="fi ion-ios-home"></i>Trang chủ</a>
                            </li>
                            <li class="active">{{$section_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="section-opt">
            <div class="container">
                @include('themes::themepno.inc.catalog_filter')
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="latest-movie movie-opt">
                            <div class="row clean-preset">
                                <div class="pagination-container-top text-center" id="pagination_link1">
                                    <div class="pagination-container text-center">
                                        {{ $data->appends(request()->all())->links('themes::themepno.inc.pagination') }}
                                    </div>
                                </div>
                                <div class="movie-container">
                                    @if (count($data))
                                        @foreach ($data as $movie)
                                            <div class="col-md-2 col-sm-3 col-xs-6">
                                                @include('themes::themepno.inc.movie_card')
                                            </div>
                                        @endforeach
                                    @else
                                        <p>Không có phim cho mục này...</p>
                                    @endif
                                </div>
                                <div class="pagination-container text-center" id="pagination_link2">
                                    <div class="pagination-container text-center">
                                        {{ $data->appends(request()->all())->links('themes::themepno.inc.pagination') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
