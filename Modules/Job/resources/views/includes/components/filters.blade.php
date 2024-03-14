<!-- Filters Column -->
<div class="filters-column col-lg-4 col-md-12 col-sm-12">
    <div class="inner-column">
        <form action="{{ route('website.home') }}">
            <div class="filters-outer">
                <button type="button" class="theme-btn close-filters">X</button>

                <!-- Filter Block -->
                @if(request('country'))
                <input value="{{ request('country') }}" type="hidden" name="country">
                @endif
                <div class="filter-block">
                    <h4>Tìm theo tên</h4>
                    <div class="form-group">
                        <input value="{{ request('name') }}" type="text" name="name"
                            placeholder="Nhập tên công việc...">
                        <span class="icon flaticon-search-3"></span>
                    </div>
                </div>

                <!-- Filter Block -->
                <div class="filter-block">
                    <h4>Tìm theo địa điểm</h4>
                    <div class="form-group">
                        <input value="{{ request('address_work') }}" type="text" name="address_work"
                            placeholder="Nhập địa điểm...">
                        <span class="icon flaticon-map-locator"></span>
                    </div>
                </div>

                <!-- Filter Block -->
                <div class="filter-block">
                    <h4>Tìm theo nghành nghề</h4>
                    <div class="form-group">
                        <select name="career_search[]" class="chosen-select career_search" multiple="multiple">
                            @foreach ($careers as $career)
                            <option {{ in_array($career->id, (array) request('career_search')) ? 'selected' : '' }}
                                value="{{ $career->id }}">{{ $career->name }}</option>
                            @endforeach
                        </select>
                        {{-- <span class="icon flaticon-briefcase"></span> --}}
                    </div>
                </div>


                <button type="submit" class="theme-btn btn-style-one bg-blue"><span class="btn-title">Tìm
                        kiếm</span></button>
            </div>
        </form>

        <!-- End Call To Action -->
    </div>


</div>
<script>
$(document).ready(function() {
    $('.career_search').select2({
        placeholder: 'Chọn nghành nghề', // Đặt chuỗi tùy ý hoặc chuỗi rỗng
    });
});
</script>