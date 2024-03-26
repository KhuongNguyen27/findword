<div class="job-search-form">
    <form method="get" action="">
        <div class="row">
            <div class="form-group col-lg-10 col-md-12 col-sm-12">
                <span class="icon flaticon-search-1"></span>
                <input type="text" name="name" value="{{ request()->name }}" placeholder="Nhập tên công ty">
            </div>
            <div class="form-group col-lg-2 col-md-12 col-sm-12 text-right">
                <button type="submit" class="theme-btn btn-style-one">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>