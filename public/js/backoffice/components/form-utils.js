document.addEventListener('DOMContentLoaded', () => {
    // === Image group handling ===
    const wrapper = document.querySelector('#media-gallery-wrapper');
    const addBtn = document.querySelector('#add-media-image');
    const initImageGroupEvents = (group) => {
        const fileInput = group.querySelector('.image-file');
        const urlInput = group.querySelector('.image-url');
        const previewImg = group.querySelector('.image-preview');
        const removeBtn = group.querySelector('.remove-media-image');

        if (!fileInput || !urlInput || !previewImg) return;

        fileInput.onchange = (e) => {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (evt) => {
                previewImg.src = evt.target.result;
                previewImg.style.display = 'block';
                urlInput.value = file.name;
            };
            reader.readAsDataURL(file);
        };

        urlInput.oninput = () => {
            const url = urlInput.value.trim();
            if (url) {
                previewImg.src = url;
                previewImg.style.display = 'block';
                previewImg.onerror = () => {
                    previewImg.src = '';
                    previewImg.style.display = 'none';
                    previewImg.onerror = null;
                };
            } else {
                previewImg.src = '';
                previewImg.style.display = 'none';
                fileInput.value = '';
            }
        };

        removeBtn?.addEventListener('click', (e) => {
            e.preventDefault();
            if (confirm('Bạn có chắc chắn muốn xóa ảnh này không?')) group.remove();
        });
    };

    document.querySelectorAll('.form-group, .media-image-item').forEach(initImageGroupEvents);

    addBtn?.addEventListener('click', () => {
        const template = document.querySelector('#media-image-template');
        if (!template) return;
        const newItem = template.content.firstElementChild.cloneNode(true);
        newItem.querySelector('.image-url').value = '';
        newItem.querySelector('.image-file').value = '';
        const previewImg = newItem.querySelector('.image-preview');
        previewImg.src = '';
        previewImg.style.display = 'none';
        initImageGroupEvents(newItem);
        wrapper?.appendChild(newItem);
    });

    // === Auto-generate random code ===
    document.querySelectorAll('button[data-generate]').forEach(btn => {
        btn.addEventListener('click', () => {
            const length = +btn.dataset.generateLength || 5;
            const input = document.querySelector(btn.dataset.generateRef);
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const result = Array.from({ length }, () => chars[Math.floor(Math.random() * chars.length)]).join('');
            if (input) input.value = btn.dataset.generateUppercase === 'true' ? result.toUpperCase() : result;
        });
    });

    // === Auto-generate slug ===
    const nameInput = document.querySelector('#name');
    const titleInput = document.querySelector('#title');
    const slugInput = document.querySelector('#slug');

    const slugify = (text) => {
        return text
            .toLowerCase()
            .normalize('NFD')                     
            .replace(/[\u0300-\u036f]/g, '')     
            .replace(/[^a-z0-9\s-]/g, '')         
            .trim()
            .replace(/\s+/g, '-')                 
            .replace(/-+/g, '-');               
    };

    const updateSlug = () => {
        const value = titleInput?.value || nameInput?.value || '';
        slugInput.value = slugify(value);
    };

    if (nameInput) {
        nameInput.addEventListener('input', updateSlug);
    }

    if (titleInput) {
        titleInput.addEventListener('input', updateSlug);
    }
});

