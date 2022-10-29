@extends('themes::themepno.layout')

@push('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/pno/assets/theme/default/css/episode.css') }}">
@endpush

@section('content')
    <section class="inner-banner-section banner-section bg-overlay-black bg_img">
        <div id="movie-details">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="movie-payer">
                                    <div class="video-embed-container" id="video-embed-container">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 m-t-10">
                                            <div class="text-center text-primary">
                                                Đổi nguồn phát hoặc tải lại trang khi lỗi
                                                @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                                                    <a data-id="{{ $server->id }}" data-link="{{ $server->link }}" data-type="{{ $server->type }}"
                                                        onclick="chooseStreamingServer(this)" class="btn btn-default streaming-server">
                                                            <i class='icon-play'></i>
                                                            <span class='title'>VIP #{{ $loop->index + 1 }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="latest-movie movie-opt">
                                                <div class="movie-heading overflow-hidden"> <span>Danh sách tập phim: {{$server}}</span>
                                                    <div class="disable-bottom-line"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <ul class="col-md-12 col-sm-12 list-episodes">
                                            @foreach ($data->sortByDesc('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                                                @if ($item->contains($episode))
                                                    <li>
                                                        <span>{{$name}}</span>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ $item->sortByDesc('type')->first()->getUrl() }}">{{$name}}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row movies-list-wrap">
                            <div class="ml-title">
                                <div class="tab-content">
                                    <div id="info" class="tab-pane fade in active">
                                        <div class="row">
                                            <div class="col-md-2 m-t-10">
                                                <img class="img-responsive" style="min-width: 100%;"
                                                    src="{{ $currentMovie->thumb_url }}" alt="{{ $currentMovie->name }}">
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
                                <div class="fb-comments" style="background-color:white;" data-colorscheme="light"
                                    data-href="{{ $currentMovie->getUrl() }}" data-width="100%" data-numposts="10">
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

    <script src="/themes/pno/player/js/p2p-media-loader-core.min.js"></script>
    <script src="/themes/pno/player/js/p2p-media-loader-hlsjs.min.js"></script>

    <script src="/js/jwplayer-8.9.3.js"></script>
    <script src="/js/hls.min.js"></script>
    <script src="/js/jwplayer.hlsjs.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            jQuery('html, body').animate({
                scrollTop: jQuery('#video-embed-container').offset().top
            }, 'slow');
        });
    </script>

    <script>
        const wrapper = document.getElementById('video-embed-container');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link;
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname +
                "?id=" + id;

            history.pushState({
                path: newUrl
            }, "", newUrl);


            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('active');
            })
            el.classList.add('active');

            link.replace('http://', 'https://');
            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        file: "/themes/pno/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        jQuery("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="445px" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adSkipped', function(event) {
                        jQuery("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="445px" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adComplete', function(event) {
                        jQuery("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="445px" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML = `<iframe width="100%" height="445px" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    image: "{{ $currentMovie->poster_url ?: $currentMovie->thumb_url }}",
                    file: link,
                    playbackRateControls: true,
                    playbackRates: [0.25, 0.75, 1, 1.25],
                    sharing: {
                        sites: [
                            "reddit",
                            "facebook",
                            "twitter",
                            "googleplus",
                            "email",
                            "linkedin",
                        ],
                    },
                    volume: 100,
                    mute: false,
                    autostart: true,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua"
                    }
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                        var engine = new p2pml.hlsjs.Engine(engine_config);
                        player.setup(objSetup);
                        jwplayer_hls_provider.attach();
                        p2pml.hlsjs.initJwPlayer(player, {
                            liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                            maxBufferLength: 300,
                            loader: engine.createLoaderClass(),
                        });
                    } else {
                        player.setup(objSetup);
                    }
                } else {
                    player.setup(objSetup);
                }


                const resumeData = 'OPCMS-PlayerPosition-' + id;
                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            console.log("No cookie for position found");
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                            console.log("Position cookie found: " + localStorage[resumeData]);
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const episode = urlParams.get('id')
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>

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
