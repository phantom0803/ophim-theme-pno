<form id="form-search" class="form-inline" method="GET" action="/">
    <div class="filter-box mt-3">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-6">
                <select class="form-control" id="type" name="filter[type]" form="form-search">
                    <option value="">Mọi định dạng</option>
                    <option value="series" @if (isset(request('filter')['type']) && request('filter')['type'] == 'series') selected @endif>Phim bộ</option>
                    <option value="single" @if (isset(request('filter')['type']) && request('filter')['type'] == 'single') selected @endif>Phim lẻ</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-6">
                <select class="form-control" name="filter[region]" form="form-search">
                    <option value="">Tất cả quốc gia</option>
                    @foreach (\Ophim\Core\Models\Region::fromCache()->all() as $item)
                        <option value="{{ $item->id }}" @if ((isset(request('filter')['region']) && request('filter')['region'] == $item->id) ||
                            (isset($region) && $region->id == $item->id)) selected @endif>
                            {{ $item->name }}</option>
                    @endforeach
               </select>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-6">
                <select class="form-control" id="category" name="filter[category]" form="form-search">
                    <option value="">Tất cả thể loại</option>
                    @foreach (\Ophim\Core\Models\Category::fromCache()->all() as $item)
                        <option value="{{ $item->id }}" @if ((isset(request('filter')['category']) && request('filter')['category'] == $item->id) ||
                            (isset($category) && $category->id == $item->id)) selected @endif>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-6">
                <select class="form-control" name="filter[year]" form="form-search">
                    <option value="">Tất cả năm</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @if (isset(request('filter')['year']) && request('filter')['year'] == $year) selected @endif>
                            {{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-6">
                <select class="form-control" id="sort" name="filter[sort]" form="form-search">
                    <option value="">Sắp xếp</option>
                    <option value="update" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'update') selected @endif>Thời gian cập nhật</option>
                    <option value="create" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'create') selected @endif>Thời gian đăng</option>
                    <option value="year" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'year') selected @endif>Năm sản xuất</option>
                    <option value="view" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'view') selected @endif>Lượt xem</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-6">
                <button type="submit" form="form-search" class="button_filter">Lọc phim</button>
            </div>
        </div>
    </div>
</form>
