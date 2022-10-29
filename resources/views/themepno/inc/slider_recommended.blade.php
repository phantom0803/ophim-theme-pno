<div class="inner-banner-section banner-section bg-overlay-black bg_img">
    <div class="slider-content container">
        <div id="slider" class="swiper-container-horizontal">
            <div class="swiper-wrapper">
                @foreach ($recommendations as $movie)
                    <div class="swiper-slide" style="background-image: url('{{$movie->poster_url ?? $movie->thumb_url}}');">
                        <a href="{{$movie->getUrl()}}" class="slide-link" title="{{$movie->name}}"></a>
                        <span class="slide-caption">
                            <h2>{{$movie->name}}</h2>
                            <p class="sc-desc">
                                {!! mb_substr($movie->content, 0, 255, 'UTF-8') !!}...
                            </p>
                            <div class="slide-caption-info">
                                <div class="block">
                                    <strong>Thể loại: </strong> {!! $movie->categories->map(function($category) {
                                        return $category->name;
                                    })->implode(', ') !!}
                                </div>
                                <div class="block">
                                    <strong>Trạng thái:</strong> {{$movie->episode_current}} [{{$movie->quality}}-{{$movie->language}}]
                                </div>
                                <div class="block">
                                    <strong>Năm:</strong> {{$movie->publish_year}}
                                </div>
                                <div class="block">
                                    <strong>Đánh giá:</strong> {{number_format($movie->rating_star ?? 0, 1)}} sao/{{$movie->rating_count ?? 0}} lượt
                                </div>
                            </div>
                            <a href="">
                                <div class="btn btn-sm btn-success mt20" style="margin-top: 10px;">Xem Ngay </div>
                            </a>
                        </span>
                    </div>
                @endforeach
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <div style="margin-top: 20px;"></div>
</div>
