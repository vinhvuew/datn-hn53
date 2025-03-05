<!-- COMMON SCRIPTS -->
<script src="{{ asset('client') }}/js/common_scripts.min.js"></script>
<script src="{{ asset('client') }}/js/main.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="{{ asset('client') }}/js/carousel-home.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notyf = new Notyf({
            duration: 3000,
            position: {
                x: 'right',
                y: 'top'
            },
            ripple: true,
        });

        @if (session('success'))
            notyf.success('{{ session('success') }}');
        @endif

        @if (session('error'))
            notyf.error('{{ session('error') }}');
        @endif
    });
</script>

<script>
    const notyf = new Notyf({
        duration: 3000, // Thời gian hiển thị (ms)
        position: {
            x: 'right',
            y: 'top'
        }, // Vị trí thông báo
    });
</script>
