pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

document.addEventListener("DOMContentLoaded", function () {

    const canvases = document.querySelectorAll('.pdf-thumbnail');

    canvases.forEach(canvas => {
        const url = canvas.dataset.pdfUrl;
        if (url) {
            const loadingDiv = canvas.nextElementSibling;

            pdfjsLib.getDocument(url).promise.then(pdf => {
                return pdf.getPage(1);
            }).then(page => {
                const viewport = page.getViewport({ scale: 1.5 });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: canvas.getContext('2d'),
                    viewport: viewport
                };

                page.render(renderContext).promise.then(() => {
                    if (loadingDiv) loadingDiv.style.display = 'none';
                    canvas.classList.remove('opacity-0');
                });
            }).catch(err => {
                console.error('Error rendering PDF:', err);
                if (loadingDiv) {
                    loadingDiv.innerHTML = '<i class="fa-solid fa-file-pdf text-3xl mb-2"></i><span class="text-[10px]">ไฟล์ PDF</span>';
                }
            });
        }
    });

    const fileInput = document.getElementById('portfolio_upload');
    const previewBox = document.getElementById('file_preview_box');
    const previewName = document.getElementById('file_preview_name');
    const previewBtn = document.getElementById('file_preview_btn');

    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            previewName.textContent = file.name;

            const fileURL = URL.createObjectURL(file);
            previewBtn.href = fileURL;

            previewBox.classList.remove('hidden');
            previewBox.classList.add('flex');
        } else {
            previewBox.classList.add('hidden');
            previewBox.classList.remove('flex');
            previewBtn.href = "#";
        }
    });

});