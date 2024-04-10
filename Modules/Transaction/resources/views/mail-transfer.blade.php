<div>
    <h3>Xin chào,</h3>
    <p>Findwork vừa có giao dịch mới!</p>
    <p>Mã giao dịch : {{ $data['id'] }}</p>
    <p>ID Người giao dịch: {{ $data['user_id'] }}</p>
    <p>Loại giao dịch : {{ $data['type'] }}</p>
    <p>Sô tiền: {{ $data['amount'] }}</p>
    <p><br>Nếu bạn không thực hiện bất kỳ hành động nào,<br>vui lòng liên hệ với quản trị viên qua email:<a
            href="gmail.com">
            env('ADMIN_EMAIL')</a></p>
</div>