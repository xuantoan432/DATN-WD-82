<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin liên hệ</title>
</head>
<body>
    <h1>Thông tin liên hệ mới</h1>
    <p><strong>Tên:</strong> {{ $contact->name }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>Số điện thoại:</strong> {{ $contact->phone }}</p>
    <p><strong>Thông điệp:</strong> {{ $contact->message }}</p>
</body>
</html>
