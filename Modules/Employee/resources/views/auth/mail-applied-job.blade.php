<div>
    <h3>Xin chào,</h3>
    <p>Bạn đã nhận được cv!</p>
    <p>Người nộp: {{ $data['name_applied'] }}</p>
    <p>Email: {{ $data['email_applied'] }}</p>
    <p>Công việc ứng tuyển : {{ $data['job'] }}</p>
    <p><br>Nếu bạn không thực hiện bất kỳ hành động nào,<br>vui lòng liên hệ với quản trị viên qua email:<a
            href="gmail.com">
            env('ADMIN_EMAIL')</a></p>
</div>