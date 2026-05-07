
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

document.addEventListener("DOMContentLoaded", function () {
    const canvases = document.querySelectorAll('.pdf-thumbnail');

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const canvas = entry.target;
                const url = canvas.getAttribute('data-pdf-url');

                if (url && !canvas.dataset.loaded) {
                    canvas.dataset.loaded = 'true';

                    const loadingTask = pdfjsLib.getDocument(url);

                    loadingTask.promise.then(function (pdf) {
                        return pdf.getPage(1);
                    }).then(function (page) {
                        const scale = 1.5;
                        const viewport = page.getViewport({ scale: scale });

                        const context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };

                        return page.render(renderContext).promise;
                    }).then(function () {
                        console.log('✅ โหลดและวาดภาพ PDF สำเร็จ:', url);
                    }).catch(function (error) {
                        console.error('❌ ไม่สามารถโหลดภาพหน้าแรก PDF ได้:', url, error);

                        const ctx = canvas.getContext('2d');
                        canvas.width = 300;
                        canvas.height = 400;
                        ctx.fillStyle = '#f3f4f6';
                        ctx.fillRect(0, 0, canvas.width, canvas.height);

                        ctx.fillStyle = '#9ca3af';
                        ctx.font = '16px Mitr, sans-serif';
                        ctx.textAlign = 'center';
                        ctx.fillText('ดูเอกสาร PDF', canvas.width / 2, canvas.height / 2);
                    });
                }

                observer.unobserve(canvas);
            }
        });
    }, {
        rootMargin: '150px'
    });

    canvases.forEach(canvas => {
        observer.observe(canvas);
    });
});