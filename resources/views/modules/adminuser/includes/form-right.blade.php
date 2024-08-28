<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('adminuser.index',['type'=>request()->type]) }}"
                class="btn btn-danger px-4">{{ __('back') }}</a>
            <button type="submit" class="btn btn-primary px-4">{{ __('save') }}</button>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('image') }}</label>
            <x-admintheme::form-image name="image" imageUrl="{{ $item->employee->image_fm ?? '' }}" upload="1"
                accept=".jpg, .png, image/jpeg, image/png" />
            <x-admintheme::form-input-error field="image" />
        </div>

        <!-- @if (request()->type == 'employee')
        <div class="mb-4">
            <label class="mb-3">Giấy phép kinh doanh</label>
            <x-admintheme::form-image name="image_business_license" imageUrl="{{ !empty($item->employee->image_business_license) ? asset($item->employee->image_business_license) : asset('/website-assets/images/backgroudemploy.jpg') }}" upload="1"
            accept=".jpg, .png, image/jpeg, image/png" />
            <x-admintheme::form-input-error field="image_business_license" />
        </div>
        @endif -->

        @if (request()->type == 'employee')
        <div class="mb-4">
            <label class="mb-3">Logo xu hướng</label>
            <x-admintheme::form-image name="logo_trending" imageUrl="{{ $item->employee->logo_trending_fm ?? '' }}" upload="1"
                accept=".jpg, .png, image/jpeg, image/png" />
            <x-admintheme::form-input-error field="logo_trending" />
        </div>
        <div class="mb-4">
            <label class="mb-3">Giấy phép kinh doanh</label>
            <div class="image-gallery" id="business-license-preview">
                @if (!empty($item->employee->image_business_license))
                @foreach (json_decode($item->employee->image_business_license) as $image)
                <div class="image-item" style="display: inline-block; position: relative; margin: 5px;">
                    <img src="{{ asset($image) }}" alt="Preview Image" style="max-width: 150px; max-height: 120px;">
                    <a href="#" class="delete-image" data-image="{{ $image }}"
                        data-url="{{ route('employee.image.delete') }}"
                        style="position: absolute; top: 5px; right: 5px; color: red; font-size: 20px; text-decoration: none;">
                        <i class="fas fa-times-circle"></i>
                    </a>
                </div>
                @endforeach
                @endif
            </div>
            <input type="file" name="image_business_license[]" accept=".jpg, .png, image/jpeg, image/png, .pdf"
                multiple>
            <x-admintheme::form-input-error field="image_business_license" />
        </div>
        @endif


        <!-- @if (request()->type == 'employee')
        <div class="mb-4">
            <label class="mb-3">Giấy phép kinh doanh</label>
            <x-admintheme::form-image name="image_business_license" imageUrl="{{ !empty($item->employee->image_business_license) ? asset($item->employee->image_business_license) : asset('/website-assets/images/backgroudemploy.jpg') }}" upload="1"
            accept=".jpg, .png, image/jpeg, image/png" />
            <x-admintheme::form-input-error field="image_business_license" />
        </div>
        @endif -->

        <!-- @if (request()->type == 'employee')
        <div class="mb-4">
            <label class="mb-3">Giấy phép kinh doanh</label>
            <div class="image-gallery" id="business-license-preview">
                @if (!empty($item->employee->image_business_license))
                @foreach (json_decode($item->employee->image_business_license) as $image)
                <div class="image-item" style="display: inline-block; position: relative; margin: 5px;">
                    @if (pathinfo($image, PATHINFO_EXTENSION) == 'pdf')
                    <div class="pdf-container">
                        <canvas id="pdf-canvas" style="border: 1px solid black;"></canvas>
                        <a href="{{ asset($image) }}" target="_blank">Xem PDF</a>
                    </div>
                    @else
                    <img src="{{ asset($image) }}" alt="Preview Image" style="max-width: 150px; max-height: 120px;">
                    @endif
                    <a href="#" class="delete-image" data-image="{{ $image }}"
                        data-url="{{ route('employee.image.delete') }}"
                        style="position: absolute; top: 5px; right: 5px; color: red; font-size: 20px; text-decoration: none;">
                        <i class="fas fa-times-circle"></i>
                    </a>
                </div>
                @endforeach
                @endif
            </div>
            <input type="file" name="image_business_license[]" accept=".jpg, .png, image/jpeg, image/png, .pdf"
                multiple>
            <x-admintheme::form-input-error field="image_business_license" />
        </div>

        @endif -->
        <!-- <script src="path_to_pdfjs/build/pdf.js"></script> -->
        <!-- <script>
    var pdfContainer = document.getElementById('business-license-preview');

    function renderPdf(url) {
        pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
            var pdfDoc = pdfDoc_;
            var numPages = pdfDoc.numPages;
            console.log('# Document Loaded');
            console.log('Number of Pages: ' + numPages);

            // Clear previous content
            pdfContainer.innerHTML = '';

            for (var i = 1; i <= numPages; i++) {
                pdfDoc.getPage(i).then(function (page) {
                    console.log('Page ' + page.pageIndex);
                    var scale = 1.5;
                    var viewport = page.getViewport({ scale: scale });

                    // Prepare canvas using PDF.js
                    var canvas = document.createElement('canvas');
                    var context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    // Render PDF page into canvas context
                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    var renderTask = page.render(renderContext);
                    renderTask.promise.then(function () {
                        console.log('Page rendered');
                        pdfContainer.appendChild(canvas);
                    });
                });
            }
        });
    }
</script> -->


        @if (request()->type == 'employee')
        <div class="mb-4">
            <label class="mb-3">Ảnh bìa</label>
            <x-admintheme::form-image name="background" imageUrl="{{ $item->employee->background_fm ?? '' }}" upload="1"
                accept=".jpg, .png, image/jpeg, image/png" />
            <x-admintheme::form-input-error field="background" />
        </div>
        @endif

        <div class="mb-4">
            <label class="mb-3">{{ __('status') }}</label>
            <x-admintheme::form-status model="{{ $model }}" status="{{ $item->status ?? old('status') }}"
                name="status" />
        </div>
    </div>
</div>

@yield('custom-fields-right')
