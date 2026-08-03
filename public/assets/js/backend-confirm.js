document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (form.dataset.confirmed === 'true') {
                return;
            }

            e.preventDefault();

            const isSafe = form.dataset.confirmType === 'safe';

            Swal.fire({
                title: form.dataset.confirmTitle || 'ยืนยันการดำเนินการ',
                text: form.dataset.confirm,
                icon: isSafe ? 'question' : 'warning',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: isSafe ? '#2E8DA3' : '#EF4444',
                cancelButtonColor: '#94a3b8',
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.dataset.confirmed = 'true';
                    form.submit();
                }
            });
        });
    });
});
