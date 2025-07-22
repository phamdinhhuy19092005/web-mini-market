<?php
namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageHelper
{
    protected $diskName;
    protected $disk;
    protected $folder;


    public function __construct($folder = 'uploads')
    {
        $this->disk = Storage::disk('public');
        $this->folder = $folder;
    }

    /**
     * Tải lên ảnh
     *
     * @param mixed $image Đối tượng UploadedFile hoặc mảng chứa file
     * @return string|null Đường dẫn tệp hoặc null nếu không hợp lệ
     */
    public function upload($image)
    {
         if ($image instanceof UploadedFile) {
            return $this->handleUploadFile($image);
        }

        if (is_array($image) && isset($image['file']) && $image['file'] instanceof UploadedFile) {
            return $this->handleUploadFile($image['file']);
        }

        return null;
    }

    /**
     * Xử lý tải lên tệp
     *
     * @param UploadedFile $file
     * @return string Đường dẫn tệp đã lưu
     */
    protected function handleUploadFile(UploadedFile $file)
    {
        $filename = Str::uuid() . '-' . now()->timestamp . '.' . strtolower($file->getClientOriginalExtension());
        $path = "{$this->folder}/{$filename}";

        $this->disk->put($path, file_get_contents($file));

        return $this->disk->url($path);

    }


    /**
     * Xóa tệp
     *
     * @param string $path
     * @return void
     */
    public function delete($url)
    {
        if (!$url) return;

        $publicUrl = $this->disk->url('');
        $relativePath = str_replace($publicUrl, '', $url);

        if ($this->disk->exists($relativePath)) {
            $this->disk->delete($relativePath);
        }
    }

}
