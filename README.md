# THEME - PNO 2022 - OPHIM CMS

## Demo
### Trang Chủ
![Alt text](https://i.ibb.co/gvHT4qw/PNO-INDEX.png "Home Page")

### Trang Danh Sách Phim
![Alt text](https://i.ibb.co/wyJPq8f/PNO-CATALOG.png "Catalog Page")

### Trang Thông Tin Phim
![Alt text](https://i.ibb.co/ZJn0hbv/PNO-SINGLE.png "Single Page")

### Trang Xem Phim
![Alt text](https://i.ibb.co/P47vsLh/PNO-EPISODE.png "Episode Page")

## Requirements
https://github.com/hacoidev/ophim-core

## Install
1. Tại thư mục của Project: `composer require ophimcms/theme-pno`
2. Kích hoạt giao diện trong Admin Panel

## Update
1. Tại thư mục của Project: `composer update ophimcms/theme-pno`
2. Re-Activate giao diện trong Admin Panel

## Document
### List
- Trang chủ: `Label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_more_url`
    + Ví dụ theo định dạng: `Phim lẻ mới||type|single|updated_at|desc|12|/danh-sach/phim-le`
    + Ví dụ theo định dạng: `Phim bộ mới||type|series|updated_at|desc|12|/danh-sach/phim-bo`
    + Ví dụ theo thể loại: `Phim hành động|categories|slug|hanh-dong|updated_at|desc|12|/the-loai/hanh-dong`
    + Ví dụ theo quốc gia: `Phim hàn quốc|regions|slug|han-quoc|updated_at|desc|12|/quoc-gia/han-quoc`
    + Ví dụ với các field khác: `Phim thịnh hành||is_copyright|0|view_week|desc|12|`


### Custom View Blade
- File blade gốc trong Package: `/vendor/ophimcms/theme-pno/resources/views/themepno`
- Copy file cần custom đến: `/resources/views/vendor/themes/themepno`
