/**
 * Shared multi-file upload helper: caps file count, validates size client-side,
 * shows a removable file-chip preview, and submits via XHR so large uploads
 * can show real upload progress. The response HTML (after Laravel's redirect-back)
 * is swapped into the current document so session-flash driven SweetAlert popups
 * (see sweetalert.js) still fire correctly.
 */
const MultiUpload = {
    init(config) {
        const form = document.getElementById(config.formId);
        const fileInput = document.getElementById(config.fileInputId);
        const previewList = document.getElementById(config.previewListId);
        const progressWrap = document.getElementById(config.progressWrapId);
        const progressBar = document.getElementById(config.progressBarId);
        const progressText = document.getElementById(config.progressTextId);
        const dropzone = config.dropzoneId ? document.getElementById(config.dropzoneId) : null;
        const emptyHint = config.emptyHintId ? document.getElementById(config.emptyHintId) : null;

        if (!form || !fileInput || !previewList) return;

        const maxFiles = config.maxFiles || 3;
        const maxSizeMb = config.maxSizeMb || 10;
        const fieldName = config.fieldName;
        const submitBtn = form.querySelector('button[type="submit"]');

        let selectedFiles = [];

        // We manage validity ourselves; a lingering `required` would block submit
        // even when files are already staged in our own array instead of the input.
        fileInput.removeAttribute('required');

        function iconFor(filename) {
            const ext = filename.split('.').pop().toLowerCase();
            if (ext === 'pdf') return ['fa-file-pdf', 'text-rose-500'];
            if (['doc', 'docx'].includes(ext)) return ['fa-file-word', 'text-blue-500'];
            if (['png', 'jpg', 'jpeg'].includes(ext)) return ['fa-file-image', 'text-emerald-500'];
            return ['fa-file-invoice', 'text-slate-400'];
        }

        function formatSize(bytes) {
            return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        }

        function renderPreview() {
            previewList.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                const [icon, color] = iconFor(file.name);
                const row = document.createElement('div');
                row.className = 'flex items-center justify-between gap-3 bg-slate-50 border border-slate-100 rounded-xl px-3 py-2';
                row.innerHTML = `
                    <div class="flex items-center gap-2.5 min-w-0">
                        <i class="fa-solid ${icon} ${color} text-base shrink-0"></i>
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-slate-700 truncate max-w-[220px]">${file.name}</p>
                            <p class="text-[10px] text-slate-400 font-medium">${formatSize(file.size)}</p>
                        </div>
                    </div>
                    <button type="button" data-remove-index="${index}" class="w-7 h-7 shrink-0 rounded-lg bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-colors flex items-center justify-center">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                `;
                previewList.appendChild(row);
            });

            previewList.querySelectorAll('[data-remove-index]').forEach(btn => {
                btn.addEventListener('click', () => {
                    selectedFiles.splice(parseInt(btn.dataset.removeIndex, 10), 1);
                    renderPreview();
                });
            });

            if (emptyHint) {
                emptyHint.classList.toggle('hidden', selectedFiles.length > 0);
            }
            previewList.classList.toggle('hidden', selectedFiles.length === 0);
        }

        function addFiles(fileList) {
            const incoming = Array.from(fileList);

            for (const file of incoming) {
                if (selectedFiles.length >= maxFiles) {
                    if (typeof AppAlert !== 'undefined') {
                        AppAlert.error(`อัปโหลดได้สูงสุด ${maxFiles} ไฟล์ต่อครั้งเท่านั้น`, 'เกินจำนวนที่กำหนด');
                    }
                    break;
                }

                if (file.size > maxSizeMb * 1024 * 1024) {
                    if (typeof AppAlert !== 'undefined') {
                        AppAlert.error(`ไฟล์ "${file.name}" มีขนาดใหญ่เกินไป! ระบบกำหนดให้อัปโหลดได้สูงสุดไม่เกิน ${maxSizeMb}MB ต่อไฟล์`, 'ขนาดไฟล์เกินกำหนด');
                        continue;
                    }
                }

                const isDuplicate = selectedFiles.some(f => f.name === file.name && f.size === file.size);
                if (isDuplicate) continue;

                selectedFiles.push(file);
            }

            renderPreview();
        }

        fileInput.addEventListener('change', function () {
            addFiles(this.files);
            this.value = '';
        });

        if (dropzone) {
            ['dragover', 'dragenter'].forEach(evt => {
                dropzone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    dropzone.classList.add('border-[#5EBEE6]', 'bg-white');
                });
            });

            ['dragleave', 'dragend'].forEach(evt => {
                dropzone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    dropzone.classList.remove('border-[#5EBEE6]', 'bg-white');
                });
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('border-[#5EBEE6]', 'bg-white');
                if (e.dataTransfer && e.dataTransfer.files) {
                    addFiles(e.dataTransfer.files);
                }
            });
        }

        form.addEventListener('reset', () => {
            selectedFiles = [];
            renderPreview();
            if (progressWrap) progressWrap.classList.add('hidden');
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (form.dataset.requireFile !== 'false' && selectedFiles.length === 0) {
                if (typeof AppAlert !== 'undefined') {
                    AppAlert.error('กรุณาเลือกไฟล์อย่างน้อย 1 ไฟล์ก่อนอัปโหลด');
                }
                return;
            }

            const formData = new FormData(form);
            selectedFiles.forEach(file => formData.append(`${fieldName}[]`, file));

            if (submitBtn) submitBtn.disabled = true;
            if (progressWrap) {
                progressWrap.classList.remove('hidden');
                progressBar.style.width = '0%';
                progressText.textContent = '0%';
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);

            xhr.upload.onprogress = function (evt) {
                if (evt.lengthComputable && progressBar) {
                    const pct = Math.round((evt.loaded / evt.total) * 100);
                    progressBar.style.width = pct + '%';
                    progressText.textContent = pct + '%';
                }
            };

            xhr.onload = function () {
                // Laravel's redirect-back is followed transparently by the browser,
                // so xhr.responseText is already the fully rendered next page
                // (with the session-flash success/error banner baked in). Swapping
                // it in directly means the SweetAlert flash still fires correctly.
                document.open();
                document.write(xhr.responseText);
                document.close();
            };

            xhr.onerror = function () {
                if (submitBtn) submitBtn.disabled = false;
                if (progressWrap) progressWrap.classList.add('hidden');
                if (typeof AppAlert !== 'undefined') {
                    AppAlert.error('เกิดข้อผิดพลาดในการเชื่อมต่อ กรุณาตรวจสอบอินเทอร์เน็ตแล้วลองใหม่อีกครั้ง');
                }
            };

            xhr.send(formData);
        });

        renderPreview();
    }
};
