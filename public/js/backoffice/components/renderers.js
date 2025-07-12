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
        'Pending': 'k-badge--warning'
    };
    const badgeClass = classMap[data] || 'k-badge--secondary';
    return `<span class="k-badge k-badge--inline k-badge--pill ${badgeClass}">${data}</span>`;
};

window.renderActions = function (data) {
    let html = '';
    if (data.update) {
        html += `<a href="${data.update}" class="btn btn-sm btn-warning mr-1" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>`;
    }
    if (data.delete) {
        html += `<button class="btn btn-sm btn-danger" onclick="handleDelete('${data.delete}')" title="Xóa"><i class="fa fa-trash"></i></button>`;
    }
    return html || '<span class="text-muted">No actions</span>';
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
