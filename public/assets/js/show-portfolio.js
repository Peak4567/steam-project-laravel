document.addEventListener("DOMContentLoaded", () => {
    const url = window.PORTFOLIO_PDF_URL;
    if (!url) return;

    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    const ext = url.split('.').pop().toLowerCase();

    let pdfDoc = null,
        pageNum = 1,
        pageIsRendering = false,
        pageNumIsPending = null,
        currentScale = 0.7;

    const minScale = 0.3,
        maxScale = 3.0,
        thumbScale = 0.2,
        canvas = document.querySelector('#pdf-render'),
        ctx = canvas.getContext('2d'),
        loading = document.getElementById('loading-indicator'),
        controls = document.getElementById('pdf-controls'),
        zoomControls = document.getElementById('pdf-zoom-controls'),
        imgRender = document.getElementById('img-render'),
        thumbWrapper = document.getElementById('thumbnails-wrapper'),
        thumbContainer = document.getElementById('thumbnails-container'),
        zoomLevelText = document.getElementById('zoom-level');

    if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
        loading.style.display = 'none';
        imgRender.src = url;
        imgRender.classList.remove('hidden');
    } else {
        pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
            pdfDoc = pdfDoc_;
            document.getElementById('page-count').textContent = pdfDoc.numPages;

            loading.style.display = 'none';
            controls.classList.remove('hidden');
            controls.classList.add('flex');
            zoomControls.classList.remove('hidden');
            zoomControls.classList.add('flex');
            canvas.classList.remove('hidden');
            thumbWrapper.classList.remove('hidden');
            thumbWrapper.classList.add('block');

            updateZoomText();
            renderPage(pageNum);
            generateThumbnails();
        }).catch(err => {
            loading.innerHTML = `
                <div class="flex flex-col items-center text-red-400 py-10">
                    <i class="fa-solid fa-circle-exclamation text-4xl mb-3"></i>
                    <span class="font-bold">ไม่สามารถโหลดไฟล์ PDF ได้ หรือไฟล์อาจเสียหาย</span>
                </div>
            `;
        });
    }

    const renderPage = num => {
        pageIsRendering = true;
        canvas.style.opacity = 0.5;

        pdfDoc.getPage(num).then(page => {
            const viewport = page.getViewport({ scale: currentScale });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderCtx = { canvasContext: ctx, viewport };

            page.render(renderCtx).promise.then(() => {
                pageIsRendering = false;
                canvas.style.opacity = 1;

                if (pageNumIsPending !== null) {
                    renderPage(pageNumIsPending);
                    pageNumIsPending = null;
                }
            });

            document.getElementById('page-num').textContent = num;
            document.getElementById('prev-page').disabled = num <= 1;
            document.getElementById('next-page').disabled = num >= pdfDoc.numPages;

            highlightActiveThumbnail(num);
        });
    };

    const queueRenderPage = num => {
        if (pageIsRendering) {
            pageNumIsPending = num;
        } else {
            renderPage(num);
        }
    };

    function updateZoomText() {
        zoomLevelText.textContent = Math.round(currentScale * 100) + '%';
    }

    document.getElementById('zoom-in').addEventListener('click', () => {
        if (currentScale >= maxScale) return;
        currentScale += 0.1;
        updateZoomText();
        queueRenderPage(pageNum);
    });

    document.getElementById('zoom-out').addEventListener('click', () => {
        if (currentScale <= minScale) return;
        currentScale -= 0.1;
        updateZoomText();
        queueRenderPage(pageNum);
    });

    document.getElementById('prev-page').addEventListener('click', () => {
        if (pageNum <= 1) return;
        pageNum--;
        queueRenderPage(pageNum);
    });

    document.getElementById('next-page').addEventListener('click', () => {
        if (pageNum >= pdfDoc.numPages) return;
        pageNum++;
        queueRenderPage(pageNum);
    });

    async function generateThumbnails() {
        for (let i = 1; i <= pdfDoc.numPages; i++) {
            const thumbDiv = document.createElement('div');
            thumbDiv.id = `thumb-${i}`;
            thumbDiv.className = "cursor-pointer shrink-0 rounded-lg border-2 border-gray-200 hover:border-[#5EBEE6] hover:shadow-md transition-all p-1 w-[100px] md:w-full flex flex-col items-center bg-gray-50";

            thumbDiv.onclick = () => {
                if (pageNum !== i) {
                    pageNum = i;
                    queueRenderPage(pageNum);
                }
            };

            const thumbCanvas = document.createElement('canvas');
            thumbCanvas.className = "w-full bg-white shadow-sm border border-gray-100";

            const thumbLabel = document.createElement('span');
            thumbLabel.className = "text-[10px] font-bold text-gray-400 mt-2";
            thumbLabel.textContent = `หน้า ${i}`;

            thumbDiv.appendChild(thumbCanvas);
            thumbDiv.appendChild(thumbLabel);
            thumbContainer.appendChild(thumbDiv);

            const page = await pdfDoc.getPage(i);
            const viewport = page.getViewport({ scale: thumbScale });
            thumbCanvas.height = viewport.height;
            thumbCanvas.width = viewport.width;
            await page.render({ canvasContext: thumbCanvas.getContext('2d'), viewport }).promise;
        }
        highlightActiveThumbnail(pageNum);
    }

    function highlightActiveThumbnail(num) {
        document.querySelectorAll('[id^="thumb-"]').forEach(el => {
            el.classList.remove('border-[#5EBEE6]', 'bg-[#eaf6fc]');
            el.classList.add('border-gray-200', 'bg-gray-50');
            el.querySelector('span').classList.remove('text-[#5EBEE6]');
            el.querySelector('span').classList.add('text-gray-400');
        });

        const activeThumb = document.getElementById(`thumb-${num}`);
        if (activeThumb) {
            activeThumb.classList.remove('border-gray-200', 'bg-gray-50');
            activeThumb.classList.add('border-[#5EBEE6]', 'bg-[#eaf6fc]');
            activeThumb.querySelector('span').classList.remove('text-gray-400');
            activeThumb.querySelector('span').classList.add('text-[#5EBEE6]');

            activeThumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
    }
});