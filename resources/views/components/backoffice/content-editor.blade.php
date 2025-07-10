<div class="content-editor">
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        cols="{{ $cols }}"
        rows="{{ $rows }}"
        data-disk="{{ $disk }}"
        placeholder="{{ $placeholder }}"
        class="summernote {{ $class }} d-none"
    >{!! nl2br($value) !!}</textarea>
</div>

@push('style_pages')
<style>
.note-editor.note-frame .note-editing-area .note-editable {
    padding: 20px 10px!important;
}
</style>
@endpush

@push('js_pages')
<script>
    const config = @json($config);

    const element = $('.summernote');

    const instance = element.summernote({
        height: 300,
        ...config,
        toolbar: [
            ['style', ['style'],],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        styleTags: ['h2', 'h3', 'h4'],
        popover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ],
        },
        callbacks: {
            onImageUpload: (files) => {
                uploadFiles(files, function({ index, data }) {
                    const { path, id } = data;
                    const image = $('<img data-image="__image__'+id+'__">').attr('src', path);
                    element.summernote("insertNode", image[0]);
                });
            },
        }
    });

    async function uploadFiles(fields, callback = () => undefined) {
        const formData = new FormData();
        const disk = $("#{{ $id }}").attr('data-disk');

        for (let index = 0; index < fields.length; index++) {
            formData.append('file', fields[index]);
            formData.append('disk', disk);

            $.ajax({
                url: "{{ route('bo.web.file-manager.upload') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    callback({ index, data: response });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                },
            });
        }
    }

    function renderImageColumn(data, type, full, meta) {
        if (!data) return '';
        return `<img src="${data}" alt="Hình ảnh" style="height: 60px;">`;
    }
</script>
@endpush
