const AppAlert = {
    success: function(message, title = 'สำเร็จ!') {
        Swal.fire({
            icon: 'success',
            title: title,
            text: message,
            confirmButtonColor: '#2E8DA3',
            borderRadius: '12px'
        });
    },

    error: function(message, title = 'เกิดข้อผิดพลาด!') {
        Swal.fire({
            icon: 'error',
            title: title,
            text: message,
            confirmButtonColor: '#EF4444'
        });
    },

    validateFileSize: function(inputElement, maxMb = 10) {
        if (inputElement.files && inputElement.files[0]) {
            const maxSize = maxMb * 1024 * 1024;
            const fileSize = inputElement.files[0].size;

            if (fileSize > maxSize) {
                this.error(`ไฟล์ของคุณมีขนาดใหญ่เกินไป! ระบบกำหนดให้อัปโหลดได้สูงสุดไม่เกิน ${maxMb}MB เท่านั้น`, 'ขนาดไฟล์เกินกำหนด');
                inputElement.value = '';
                return false;
            }
        }
        return true;
    }
};

document.addEventListener("DOMContentLoaded", function () {
    const flashSuccess = document.getElementById('laravel-flash-success');
    const flashError = document.getElementById('laravel-flash-error');

    if (flashSuccess && flashSuccess.value) {
        AppAlert.success(flashSuccess.value);
    }

    if (flashError && flashError.value) {
        AppAlert.error(flashError.value);
    }
});