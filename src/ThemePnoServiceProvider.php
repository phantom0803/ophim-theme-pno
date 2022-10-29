<?php

namespace Ophim\ThemePno;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemePnoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/pno')
        ], 'pno-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'pno' => [
                'name' => 'Theme PNO',
                'author' => 'opdlnf01@gmail.com',
                'package_name' => 'ophimcms/theme-pno',
                'publishes' => ['pno-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations_limit',
                        'label' => 'Recommendations Limit',
                        'type' => 'number',
                        'hint' => 'Number',
                        'value' => 10,
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_more_url',
                        'value' => "Phim lẻ mới||type|single|updated_at|desc|12|/danh-sach/phim-le\r\nPhim bộ mới||type|series|updated_at|desc|12|/danh-sach/phim-bo\r\nPhim thịnh hành||is_copyright|0|view_week|desc|12|",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <div id="footer">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="footer-about  ">
                                            <div class="movie-heading"> <span>About</span>
                                                <div class="disable-bottom-line"></div>
                                            </div>
                                            <img class="img-responsive" src="https://ophim.cc/logo-ophim-5.png"
                                                alt="Logo">
                                            <p>Xem phim thuyết minh hay, phim hot hàn quốc trung quốc. Phim online thuyết minh nhanh
                                                chất lượng&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="bottom-post ">
                                            <div class="movie-heading"> <span>Liên Kết</span>
                                                <div class="disable-bottom-line"></div>
                                            </div>
                                            <p><br></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="sendus  ">
                                            <div class="movie-heading"> <span>Liên hệ</span>
                                                <div class="disable-bottom-line"></div>
                                            </div>
                                            <div id="contact-form">
                                                <div class="expMessage"></div>
                                                <p class="text-light">Email:</p>
                                                <p class="text-light">Telegram:</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="copyright">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <p> Xem phim mới miễn phí nhanh chất lượng cao. Xem Phim online Việt Sub, Thuyết minh, lồng
                                            tiếng chất lượng HD. Xem phim nhanh online chất lượng cao</p>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <ul class="footer-list">
                                            <li><a href="">Phim bộ</a></li>
                                            <li><a href="">DMCA</a></li>
                                            <li><a href="">Liên Hệ Chúng Tôi</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ]
                ],
            ]
        ])]);
    }
}
