window.renderImageColumn = function (data) {
    if (!data) return '';
    return `<img src="${data}" alt="Hình ảnh" style="height: 60px;">`;
};

window.renderStatusColumn = function(data) {
    console.log('renderStatusColumn data:', data);
    if (!data) return '';
    const classMap = {
        'Active': 'k-badge--success',
        'Inactive': 'k-badge--danger',
        'Pending': 'k-badge--warning',
        'Declined': 'k-badge--danger',
        'Approved': 'k-badge--success',
        'Default': 'k-badge--success',
        'Normal': 'k-badge--danger',
    };
    const badgeClass = classMap[data] || 'k-badge--secondary';
    return `<span class="k-badge k-badge--inline k-badge--pill ${badgeClass}">${data}</span>`;
};

window.handleDelete = function (url) {
    if (confirm("Bạn có chắc chắn muốn xóa?")) {
        $.ajax({
            url: url,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                $('.datatable').DataTable().ajax.reload();
                alert('Xóa thành công!');
            },
            error: function () {
                alert('Lỗi khi xoá!');
            }
        });
    }
};


window.renderCallbackOfferPrice = function (data) {
    if (!data || parseFloat(data) === 0) {
        return `<span class="text-muted">-</span>`;
    }
    let formattedPrice = parseFloat(data).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    return `<span class="font-weight-bold">${formattedPrice}</span>`;
};

window.renderCallbackCategoryGroups = function (data) {
    if (!data) return '';
    return `<span class="k-badge k-badge--brand k-badge--inline k-badge--outline k-badge--pill">${data}</span>`;
}

window.renderCallbackCategories = (data, type, full) => {
    const count = data?.length || 0;

    if (!count) {
        return;
    }

    const categoriesBadge = data.map((category) => {
        return $('<span>', { class: `mr-1 mt-1 mb-1 d-inline-block` })
            .append(`<span class="k-badge k-badge--brand k-badge--inline k-badge--outline k-badge--pill">${category.name}</span>`)
            .prop('outerHTML');
    });

    const container = $('<div>', { class: 'category-see-more' }).append(categoriesBadge.join(''));

    return container.prop('outerHTML');
};
