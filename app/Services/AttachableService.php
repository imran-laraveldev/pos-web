<?php


namespace App\Services;


use App\Models\AttachFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Trait AttachableService
 * @package App\Services
 */
trait AttachableService
{
    /**
     * @var null
     */
    protected $__attchmentType = null;

    /**
     * @param $files
     * @param $uploadDirectoryPath
     * @param null $fileName
     * @return array
     */
    function uploadFiles($files, $uploadDirectoryPath, $fileName=null)
    {
        $uploadDirectoryPath .= DIRECTORY_SEPARATOR . date('Y');
        $uploadDirectoryPath .= DIRECTORY_SEPARATOR . date('m');
        $uploadDirectoryPath .= DIRECTORY_SEPARATOR . date('d');

        if (!is_dir(public_path() . DIRECTORY_SEPARATOR . $uploadDirectoryPath)) {
            @mkdir(public_path() . DIRECTORY_SEPARATOR . $uploadDirectoryPath, 0777, true);
        }

        $attachmentFiles = [];
        if (count($files) > 0) {
            $i = 0;
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName();
                if (!is_null($fileName)) {
                    $customFileName = is_array($fileName) && !blank($fileName) && !empty($fileName[$i]) ? $fileName[$i]
                        : $fileName;
                } else {
                    $customFileName = $originalName;
                }
                $new_name = md5(rand() . strtotime(date('Y-m-d H:i:s') . microtime())) . $originalName;
                $destination = $uploadDirectoryPath . DIRECTORY_SEPARATOR . $new_name;
                Storage::disk('public')->put($destination, File::get($file));
                $attachmentFiles[] = [
                    'url' => $destination,
                    'file_name' => $new_name,
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_size' => $file->getSize(),
                    'original_name' => $customFileName,
                    'created_by' => Auth::user()->id,
                    'created_at' => now()
                ];
                $i++;
            }
        }
        return $attachmentFiles;
    }

    /**
     * @param $file
     * @param $uploadDirectoryPath
     * @return false|string
     */
    function uploadFile($file, $uploadDirectoryPath)
    {
        if (!is_dir(public_path() . DIRECTORY_SEPARATOR . $uploadDirectoryPath)) {
            @mkdir(public_path() . DIRECTORY_SEPARATOR . $uploadDirectoryPath, 0777, true);
        }

        if (isset($file)) {
            $originalName = $file->getClientOriginalName();
            $new_name = md5(rand() . strtotime(date('Y-m-d H:i:s') . microtime())) . $originalName;
            $destination = $uploadDirectoryPath . DIRECTORY_SEPARATOR . $new_name;
            Storage::disk('public')->put($destination, File::get($file));

            return $new_name;
        }
        return false;
    }

    /**
     * @param $obj
     * @param $attachments
     * @param false $deleteOldFiles
     */
    public function insertAttachFiles($obj, $attachments, $deleteOldFiles = false)
    {
        if ($attachments) {
            if ($deleteOldFiles) {
                $this->deleteAttachFiles($obj);
            }
            foreach ($attachments as $attachment) {
                $attachment = $attachment + [
                        'attachable_id' => $obj->id,
                        'attachable_type' => get_class($obj)
                    ];
                $attach = new AttachFile($attachment);
                $obj->attachFiles()->save($attach);
            }
        }
    }

    /**
     * @param $obj
     */
    public function deleteAttachFiles($obj)
    {
        if (!is_null($this->__attchmentType)) {
            $attachFiles = $obj->attachFiles()->where('attachment_type', $this->__attchmentType);
        }
        $oldFiles = $attachFiles->get();
        if (!is_null($oldFiles)) {
            foreach ($oldFiles as $file) {
                Storage::delete('public' . DIRECTORY_SEPARATOR . $file->url);
            }
            $attachFiles->delete();
        }
    }
}
