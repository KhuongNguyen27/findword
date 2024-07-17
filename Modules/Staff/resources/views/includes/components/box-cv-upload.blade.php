<div class="box-cv">
    <img src="/website-assets/images/backgroudemploy.jpg" class="img-responsive">
    <div class="box-bg">
        <div class="cv-main">
            <a title="" class="tcv-tooltip">
                <i class="fa fa-star "></i> Đặt làm CV chính
            </a>
        </div>
        <div class="box-info">
            <h4 class="title-cv"><a href="{{ asset($item->file_path) }}"
                    target="_blank">{{ $item->cv_file ?? 'Chưa có tiêu đề' }} </a>
                <a href="{{ route('staff.cv.edit', $item->id) }}" class="edit">
                    <i class="fa fa-solid fa-pen"></i>
                </a>
            </h4>
            <p class="update_at">Ngày tạo <span>{{ $item->created_at->format('d/m/Y') }}</span></p>
            <ul class="action">
                <!-- <li><a title="" class="btn btn-sm bold tcv-tooltip"><i
                            class="fa fa-solid fa-turn-up"></i> Đẩy Top</a></li> -->
                <li>
                    <a href="http://www.facebook.com/sharer/sharer.php?u={{ asset($item->file_path) }}" target="_blank"
                        class="btn btn-sm bold">
                        <i class="fa fa-solid fa-share"></i> Chia sẻ</a>
                </li>
                <!-- <li>
                    <a href="{{ asset($item->file_path) }}" class="btn btn-sm bold btn-download-cv" download>
                        <i class="fa fa-solid fa-down-to-line"></i> Tải xuống
                    </a>
                </li> -->
                <li>
                    @php
                        $sanitizedFileName = str_replace(' ', '-', $item->cv_file);
                    @endphp
                    <a href="{{ asset($item->file_path) }}" class="btn btn-sm bold btn-download-cv" download="{{ $sanitizedFileName }}.pdf">
                        <i class="fa fa-solid fa-down-to-line"></i> Tải xuống
                    </a>
                </li>
                <li>
                    <form action="{{ route('staff.cv.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('{{ __('confirm_delete') }}?')" class="text-white"
                            data-text="Delete CV"><i class="fa fa-regular fa-trash"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>