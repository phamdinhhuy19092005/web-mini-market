    @extends('backoffice.layouts.master')

    @php
        $title = __('Create Post Category');

        $breadcrumbs = [
            [
                'label' => __('Utilities'),
            ],
            [
                'label' => __('Blogs'),
            ],
            [
                'label' => __('Create Post Category'),
            ],
        ];
    @endphp


    @component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
    @endcomponent


    <!-- begin:: Content Body -->
    @section('content_body')
        <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
            <div class="row">
                <div class="col-md">

                    <!--begin::Portlet-->
                    <div class="k-portlet">
                        <div class="k-portlet__head">
                            <div class="k-portlet__head-label">
                                <h3 class="k-portlet__head-title">Tạo danh mục</h3>
                            </div>
                        </div>

                        <!--begin::Form-->
                        <form action="{{ route('bo.web.post-categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                             @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Nhập tên" autocomplete="off" value="{{ old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label for="slug">Đường dẫn</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        placeholder="Nhập đường dẫn" autocomplete="off" value="{{ old('slug') }}">
                                </div>

                                <div class="form-group">
                                    <label for="order">Thứ tự</label>
                                    <input type="number" name="order" id="order" class="form-control"
                                        placeholder="Nhập thứ tự" min="1" autocomplete="off" value="{{ old('order') }}">
                                </div>

                                <div class="form-group">
                                    <label>Ảnh hiển thị *</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="upload_image_custom position-relative">
                                                <!-- Ô nhập URL ảnh -->
                                                <input 
                                                    type="text"
                                                    id="image_desktop_url"
                                                    class="form-control image_input_url"
                                                    name="image[path]"
                                                    placeholder="Tải ảnh lên hoặc nhập URL ảnh"
                                                    autocomplete="off"
                                                    style="padding-right: 104px;"
                                                    data-image-ref="desktop"
                                                >

                                                <!-- Xem trước ảnh khi có URL hoặc upload -->
                                                <div class="d-none w-100 position-absolute preview-wrapper" data-image-ref="desktop"
                                                    style="top: 50%; left: 4px; transform: translateY(-50%); height: 90%; background-color: #fff;">
                                                    <div class="d-flex align-items-center h-100">
                                                        <img src="" alt="Image preview" class="mr-2 preview-img" style="height: 100%; width: 100px;">
                                                        <span class="delete-image" style="font-size: 16px; cursor: pointer;">×</span>
                                                    </div>
                                                </div>

                                                <!-- Nút upload -->
                                                <label class="btn position-absolute btn-secondary btn-sm d-flex upload-btn"
                                                    style="right: 5px; top: 4px; color:#4346CD; border: 1px solid #4346CD;">
                                                    <input type="file"
                                                        id="image_desktop_file"
                                                        name="image[file]"
                                                        class="d-none image_input_file"
                                                        accept="image/*"
                                                        data-image-ref="desktop">
                                                    <i class="flaticon2-image-file"></i>
                                                    <span>Tải lên</span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Hiển thị xem trước ảnh bên cạnh -->
                                        <div class="col-md-6">
                                            <div class="image-preview-box" data-image-ref="desktop"
                                                style="width: 100px; height: 100px; border: 1px solid #ccc;" class="d-none">
                                                <img src="" alt="" style="width: 100%; height: 100%;" class="review-img">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="seo_title">[SEO] Tiêu đề</label>
                                    <input type="text" name="meta_title" id="seo_title" class="form-control"
                                        placeholder="Nhập [SEO] Tiêu đề" autocomplete="off" value="{{ old('seo_title') }}">
                                </div>

                                <div class="form-group">
                                    <label for="seo_description">[SEO] Mô tả</label>
                                    <input type="text" name="meta_description" id="seo_description" class="form-control"
                                        placeholder="Nhập [SEO] Mô tả" autocomplete="off" value="{{ old('seo_description') }}">
                                </div>

                                <div class="form-group d-flex align-items-center">
                                    <label>FE</label>
                                    <span class="k-switch d-flex" style="margin-left: 70px;">
                                        <label>
                                            <input type="checkbox" name="display_on_frontend" value="1" checked>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>

                                <div class="form-group d-flex align-items-center">
                                    <label>Hoạt động</label>
                                    <span class="k-switch d-flex" style="margin-left: 20px;">
                                        <label>
                                            <input type="checkbox" name="status" value="1" checked>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                <button type="reset" class="btn btn-secondary">Hủy</button>
                            </div>
                        </form>


                        <!--end::Form-->
                    </div>

                    <!--end::Portlet-->
                </div>

            </div>
        </div>
        <!-- end:: Content Body -->

    <script>
        document.querySelectorAll('.image_input_file').forEach(input => {
            input.addEventListener('change', function (e) {
                const file = e.target.files[0];
                const ref = e.target.dataset.imageRef;

                if (file) {
                    const inputText = document.querySelector(`input.image_input_url[data-image-ref="${ref}"]`);
                    const previewWrapper = document.querySelector(`.preview-wrapper[data-image-ref="${ref}"]`);
                    const previewImg = previewWrapper.querySelector('.preview-img');
                    const reviewBox = document.querySelector(`.image-preview-box[data-image-ref="${ref}"]`);
                    const reviewImg = reviewBox.querySelector('.review-img');

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                        reviewImg.src = e.target.result;

                        previewWrapper.classList.remove('d-none');
                        reviewBox.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);

                    // Hiển thị tên file
                    if (inputText) {
                        inputText.value = file.name;
                    }
                }
            });
        });

        document.querySelectorAll('.image_input_url').forEach(input => {
            input.addEventListener('input', function () {
                const url = input.value;
                const ref = input.dataset.imageRef;

                const previewWrapper = document.querySelector(`.preview-wrapper[data-image-ref="${ref}"]`);
                const previewImg = previewWrapper.querySelector('.preview-img');
                const reviewBox = document.querySelector(`.image-preview-box[data-image-ref="${ref}"]`);
                const reviewImg = reviewBox.querySelector('.review-img');

                if (url) {
                    previewImg.src = url;
                    reviewImg.src = url;
                    previewWrapper.classList.remove('d-none');
                    reviewBox.classList.remove('d-none');
                } else {
                    previewWrapper.classList.add('d-none');
                    reviewBox.classList.add('d-none');
                }
            });
        });

        document.querySelectorAll('.delete-image').forEach(btn => {
            btn.addEventListener('click', function () {
                const previewWrapper = btn.closest('.preview-wrapper');
                const ref = previewWrapper.dataset.imageRef;
                const reviewBox = document.querySelector(`.image-preview-box[data-image-ref="${ref}"]`);
                const inputText = document.querySelector(`input.image_input_url[data-image-ref="${ref}"]`);
                const inputFile = document.querySelector(`input.image_input_file[data-image-ref="${ref}"]`);

                // Clear image
                previewWrapper.querySelector('.preview-img').src = '';
                reviewBox.querySelector('.review-img').src = '';
                inputText.value = '';
                inputFile.value = '';

                // Hide preview
                previewWrapper.classList.add('d-none');
                reviewBox.classList.add('d-none');
            });
        });
    </script>


    @endsection
