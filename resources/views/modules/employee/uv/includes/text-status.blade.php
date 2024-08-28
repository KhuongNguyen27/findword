<p class="viewed-status">
    @if ($item->employeeCv && $item->employeeCv->status === '1')
    Không tuyển
    @elseif ($item->employeeCv && $item->employeeCv->status === '2')
    Đã mời phỏng vấn
    @elseif ($item->employeeCv && $item->employeeCv->status === '0')
    Đã gửi lời mời làm việc
    @elseif ($item->employeeCv && $item->employeeCv->is_read == 1)
    Đã xem thông tin liên hệ
    @else
    Nộp đơn
    @endif
</p>