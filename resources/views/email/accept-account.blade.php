<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Xác Nhận tài khoản</h1>

    <a href="{{ route('khach-hang.accept', ['khachhang' => $khachHang->id, 'token' => $khachHang->token]) }}">Xác nhận tài khoản</a>
</body>
</html>