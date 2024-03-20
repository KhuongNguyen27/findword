# Sau khi clone về
### Tạo file env, sau đó cấu hình CSDL
cp .env.example .env
### Cài đặt thư viện
composer install
### Chạy database và seed</br>
php artisan migrate:fresh --seed</br>
php artisan module:migrate --seed Staff</br>
php artisan module:migrate --seed Employee</br>
php artisan module:migrate --seed Cvs</br>
php artisan module:migrate --seed Permission</br>
### Tạo key cho dự án
php artisan key:generate
### Tạo thư mục
php artisan storage:link
### Chạy ứng dụng
php artisan ser


# Sử dụng VietNamZone
$provinces = \Kjmtrue\VietnamZone\Models\Province::get();
$districts = \Kjmtrue\VietnamZone\Models\District::whereProvinceId(50)->get();
$wards = \Kjmtrue\VietnamZone\Models\Ward::whereDistrictId(552)->get();