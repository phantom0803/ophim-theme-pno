<div class="popup" title="{{$movie->name}} - {{$movie->origin_name}} ({{$movie->publish_year}})">
    <div class="latest-movie-img-container lazy"
        style="background-image: url('{{$movie->getThumbUrl()}}'); display: inline-block;">
        <div class="movie-img">
            <a href="{{$movie->getUrl()}}" class="ico-play ico-play-sm">
                <svg version="1.1" id="play_sv" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60px"
                    width="60px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                    <path class="stroke-solid" fill="none" stroke="#ff277d"
                        d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7 C97.3,23.7,75.7,2.3,49.9,2.5">
                    </path>
                    <path class="stroke-dotted" fill="none" stroke="white"
                        d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7 C97.3,23.7,75.7,2.3,49.9,2.5">
                    </path>
                    <path class="icon" fill="white"
                        d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z">
                    </path>
                </svg>
            </a>
            <div class="overlay-div"></div>
            <div class="video_quality_movie">
                <span class="label label-primary"> {{$movie->episode_current}} </span>
            </div>
            <div class="movie-title">
                <h3>
                    <a href="{{$movie->getUrl()}}">{{$movie->name}} - {{$movie->origin_name}} ({{$movie->publish_year}})</a>
                </h3>
            </div>
        </div>
    </div>
</div>
