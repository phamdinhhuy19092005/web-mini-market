export default function initDataTable(selector) {
    const tableEl = $(selector);
    const columns = [];

    tableEl.find('thead th').each(function () {
        const prop = $(this).data('property');
        const isOrderable = $(this).data('orderable') !== false;

        columns.push({
            data: prop || null,
            orderable: isOrderable,
            searchable: !!prop,
        });
    });

    return tableEl.DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: tableEl.data('request-url'),
            data: function (d) {
                const orderColIdx = d.order?.[0]?.column;
                const orderCol = columns[orderColIdx]?.data;

                d.order_column = orderCol;
                d.order_dir = d.order?.[0]?.dir || 'asc';
                d.query = d.search.value;
                d.per_page = d.length;
            }
        },
        columns,
        order: [[0, 'desc']]
    });
}
