<div>
    <h3>Hi, {{ $data['name'] }}</h3>
    <p>Bạn vừa yêu cầu đặt lại mật khẩu</p>
    <p>Nhấp vào liên kết để đặt lại mật khẩu</p>
    <b>email của bạn: {{ $data['email'] }}<br></b>
    <p>Hãy nhớ: Liên kết chỉ hoạt động một lần khi nhấp chuột</p>
    <a href="{{ route('auth.getReset',$data['token']) }}">Đặt lại mật khẩu</a>
    <p><br>Nếu bạn không thực hiện bất kỳ hành động nào,<br>vui lòng liên hệ với quản trị viên qua email:<a href="gmail.com">
        env('ADMIN_EMAIL')</a></p>
</div>
