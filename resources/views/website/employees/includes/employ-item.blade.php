<div class="inner-box">
    <ul class="job-other-info">
        <li class="green">Nỗi bật</li>
    </ul>
    <div class="cover-wrapper">
        <span class="thumb-cover">
            <img src="{{ $item->background_fm }}" alt="" style="width: 300px; height: 100px;">
        </span>
        <span class="thumb"><img src="{{ $item->image_fm }}" alt=""></span>
    </div>
    <div class="name-wrapper">
        <h3 class="name">
            <a href="{{ route('employee.show', ['id' => $item->slug]) }}">
                {{ $item->name }}
            </a>
        </h3>
        <ul class="job-info">
            <li>
                <span class="icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 0px;">
                        <g clip-path="url(#clip0_533_6629)">
                            <path d="M4.02887 4C3.19226 4 2.51464 4.67762 2.51464 5.51423V7.78557V9.29979H16.8998H20.6854V7.02845C20.6854 6.19184 20.0077 5.51423 19.1711 5.51423H9.47949L9.01221 4.73493C8.73889 4.27915 8.24613 4 7.71388 4H4.02887ZM2.13757 10.814C1.37364 10.814 0.82659 11.554 1.0507 12.2839L3.29837 19.5874C3.49447 20.2226 4.08131 20.6565 4.74606 20.6565H11.6H18.4539C19.1187 20.6565 19.7055 20.2226 19.9016 19.5874L22.1493 12.2839C22.3734 11.554 21.8264 10.814 21.0624 10.814H11.6H2.13757Z" fill="#888"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_533_6629">
                                <rect width="24" height="24" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </span>
                @php
                    $address = $item->address ? $item->address : '-';
                    $shortAddress = mb_substr($address,0, 40); 
                @endphp
                {{ $shortAddress }}
            </li>
            <li class="d-none">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-telephone-fill"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                    </svg>
                </span>
                {{ $item->phone ? $item->phone : '-' }}
            </li>
        </ul>
        <a href="{{ route('employee.show', ['id' => $item->slug]) }}"
            class="theme-btn btn-style-three">Xem thêm</a>
    </div>
</div>