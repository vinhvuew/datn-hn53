<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 | Không có quyền</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Không có quyền truy cập',
            text: '{{ $message }}',
            confirmButtonText: 'Quay lại',
        }).then(() => {
            window.history.back();
        });
    </script>
</body>

</html>
