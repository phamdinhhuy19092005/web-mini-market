<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\InventoryConditionEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreInventoryRequestInterface;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class StoreInventoryRequest extends BaseFormRequest implements StoreInventoryRequestInterface
{
    public function rules(): array
    {

        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:inventories,slug,' . ($this->inventory->id ?? 'NULL')],
            'sku' => ['required', 'string', 'max:50', 'unique:inventories,sku,' . ($this->inventory->id ?? 'NULL')],
            'condition' => ['required', Rule::in(InventoryConditionEnum::all())],
            'quantity_in_unit' => ['nullable', 'integer', 'min:1'],
            'unit_type' => ['nullable', 'string', 'max:50'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'purchase_price' => ['nullable', 'numeric', 'min:0'],
            'sale_price' => ['required', 'numeric', 'min:0'],
            'offer_price' => ['nullable', 'numeric', 'min:0', 'lte:sale_price'],
            'available_from' => ['nullable', 'date'],
            'min_order_quantity' => ['nullable', 'integer', 'min:1'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'init_sold_count' => ['nullable', 'integer', 'min:0'],
            'offer_start' => ['nullable', 'date', 'required_with:offer_price'],
            'offer_end' => ['nullable', 'date', 'after_or_equal:offer_start', 'required_with:offer_price'],
            'condition_note' => ['nullable', 'string'],
            'key_features.*.title' => ['nullable', 'string', 'max:255'],
            'meta' => ['nullable', 'json'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'display_on_frontend' => ['boolean'],
            'allow_frontend_search' => ['boolean'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'image.path' => ['nullable', 'string', 'max:255'],
            'image.file' => ['nullable', 'image', 'max:2048'],
            'attribute_values.*' => ['nullable', 'exists:attribute_values,id'],
            'description' => ['nullable', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN)
                ? ActivationStatus::ACTIVE
                : ActivationStatus::INACTIVE,
            'display_on_frontend' => filter_var($this->display_on_frontend, FILTER_VALIDATE_BOOLEAN),
            'allow_frontend_search' => filter_var($this->allow_frontend_search, FILTER_VALIDATE_BOOLEAN),
            'display_on_frontend' => filter_var($this->display_on_frontend, FILTER_VALIDATE_BOOLEAN),
            'allow_frontend_search' => filter_var($this->allow_frontend_search, FILTER_VALIDATE_BOOLEAN),
            'meta_keywords' => is_array($this->meta_keywords) ? implode(',', $this->meta_keywords) : $this->meta_keywords,
        ]);
    }

    public function imageFile()
    {
        return $this->file('image.file');
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Sản phẩm không được để trống.',
            'product_id.integer' => 'Sản phẩm phải là số nguyên.',
            'product_id.exists' => 'Sản phẩm không tồn tại.',

            'title.required' => 'Tiêu đề không được để trống.',
            'title.string' => 'Tiêu đề phải là chuỗi ký tự.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',

            'slug.required' => 'Slug không được để trống.',
            'slug.string' => 'Slug phải là chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại, vui lòng chọn slug khác.',

            'sku.required' => 'SKU không được để trống.',
            'sku.string' => 'SKU phải là chuỗi ký tự.',
            'sku.max' => 'SKU không được vượt quá 50 ký tự.',
            'sku.unique' => 'SKU đã tồn tại, vui lòng chọn SKU khác.',

            'condition.required' => 'Tình trạng sản phẩm không được để trống.',
            'condition.in' => 'Tình trạng sản phẩm không hợp lệ.',

            'quantity_in_unit.integer' => 'Số lượng trong đơn vị phải là số nguyên.',
            'quantity_in_unit.min' => 'Số lượng trong đơn vị phải lớn hơn 0.',

            'unit_type.string' => 'Loại đơn vị phải là chuỗi ký tự.',
            'unit_type.max' => 'Loại đơn vị không được vượt quá 50 ký tự.',

            'stock_quantity.required' => 'Số lượng kho không được để trống.',
            'stock_quantity.integer' => 'Số lượng kho phải là số nguyên.',
            'stock_quantity.min' => 'Số lượng kho không được nhỏ hơn 0.',

            'purchase_price.numeric' => 'Giá mua phải là số.',
            'purchase_price.min' => 'Giá mua không được nhỏ hơn 0.',

            'sale_price.required' => 'Giá bán không được để trống.',
            'sale_price.numeric' => 'Giá bán phải là số.',
            'sale_price.min' => 'Giá bán không được nhỏ hơn 0.',

            'offer_price.numeric' => 'Giá khuyến mãi phải là số.',
            'offer_price.min' => 'Giá khuyến mãi không được nhỏ hơn 0.',
            'offer_price.lte' => 'Giá khuyến mãi phải nhỏ hơn hoặc bằng giá bán.',

            'available_from.date' => 'Ngày có sẵn không hợp lệ.',

            'min_order_quantity.integer' => 'Số lượng đặt tối thiểu phải là số nguyên.',
            'min_order_quantity.min' => 'Số lượng đặt tối thiểu phải lớn hơn 0.',

            'weight.numeric' => 'Trọng lượng phải là số.',
            'weight.min' => 'Trọng lượng không được nhỏ hơn 0.',

            'init_sold_count.integer' => 'Số lượng đã bán phải là số nguyên.',
            'init_sold_count.min' => 'Số lượng đã bán không được nhỏ hơn 0.',

            'offer_start.date' => 'Ngày bắt đầu khuyến mãi không hợp lệ.',
            'offer_start.required_with' => 'Ngày bắt đầu khuyến mãi bắt buộc khi có giá khuyến mãi.',

            'offer_end.date' => 'Ngày kết thúc khuyến mãi không hợp lệ.',
            'offer_end.after_or_equal' => 'Ngày kết thúc khuyến mãi phải bằng hoặc sau ngày bắt đầu.',
            'offer_end.required_with' => 'Ngày kết thúc khuyến mãi bắt buộc khi có giá khuyến mãi.',

            'condition_note.string' => 'Ghi chú tình trạng phải là chuỗi ký tự.',

            'key_features.*.title.string' => 'Tiêu đề tính năng phải là chuỗi ký tự.',
            'key_features.*.title.max' => 'Tiêu đề tính năng không được vượt quá 255 ký tự.',

            'meta.json' => 'Meta phải là dữ liệu JSON hợp lệ.',

            'meta_keywords.string' => 'Meta keywords phải là chuỗi ký tự.',
            'meta_keywords.max' => 'Meta keywords không được vượt quá 255 ký tự.',

            'meta_title.string' => 'Meta title phải là chuỗi ký tự.',
            'meta_title.max' => 'Meta title không được vượt quá 255 ký tự.',

            'meta_description.string' => 'Meta description phải là chuỗi ký tự.',
            'meta_description.max' => 'Meta description không được vượt quá 255 ký tự.',

            'display_on_frontend.boolean' => 'Hiển thị trên frontend phải là giá trị true hoặc false.',
            'allow_frontend_search.boolean' => 'Cho phép tìm kiếm frontend phải là giá trị true hoặc false.',

            'status.required' => 'Trạng thái sản phẩm không được để trống.',
            'status.in' => 'Trạng thái sản phẩm không hợp lệ.',

            'image.path.string' => 'Đường dẫn ảnh phải là chuỗi ký tự.',
            'image.path.max' => 'Đường dẫn ảnh không được vượt quá 255 ký tự.',
            'image.file.image' => 'File ảnh không hợp lệ.',
            'image.file.max' => 'File ảnh không được vượt quá 2MB.',

            'attribute_values.*.exists' => 'Giá trị thuộc tính không tồn tại.',

            'description.string' => 'Mô tả sản phẩm phải là chuỗi ký tự.',
        ];
    }

}
