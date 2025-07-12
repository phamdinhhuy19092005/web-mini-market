<?php
namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageHelper
{
    protected $diskName;
    protected $disk;

    public function __construct($disk)
    {
        $this->diskName = $disk;
        $this->disk = Storage::disk($disk);
    }

    /**
     * Tải lên ảnh
     *
     * @param mixed $image Đối tượng UploadedFile hoặc mảng chứa file
     * @return string|null Đường dẫn tệp hoặc null nếu không hợp lệ
     */
    public function upload($image)
    {
        // Xử lý nếu $image là UploadedFile trực tiếp
        if ($image instanceof UploadedFile) {
            return $this->handleUploadFile($image);
        }

        // Xử lý nếu $image là mảng chứa file
        if (is_array($image) && isset($image['file']) && $image['file'] instanceof UploadedFile) {
            return $this->handleUploadFile($image['file']);
        }

        return null; // Trả về null nếu không có file hợp lệ
    }

    /**
     * Xử lý tải lên tệp
     *
     * @param UploadedFile $file
     * @return string Đường dẫn tệp đã lưu
     */
    protected function handleUploadFile(UploadedFile $file)
    {
        $now = now();
        $hash = $now->timestamp;
        $filename = Str::uuid();
        $extension = strtolower($file->getClientOriginalExtension());

        // Lưu trong thư mục theo tên disk
        $pathname = "{$this->diskName}/{$filename}-{$hash}.{$extension}";

        $this->disk->put($pathname, file_get_contents($file));

        return $this->disk->url($pathname); // Trả về URL đầy đủ
        // return $pathname;

    }


    /**
     * Xóa tệp
     *
     * @param string $path
     * @return void
     */
    public function delete($path)
    {
        if ($path) {
            $filePath = str_replace($this->disk->url(''), '', $path);
            if ($this->disk->exists($filePath)) {
                $this->disk->delete($filePath);
            }
        }
}

}
