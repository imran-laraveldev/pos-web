<?php


namespace App\Services;


use App\Models\Navigation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UtilityService
{
    function uploadFiles($files,$uploadDirectoryPath,$fileName=null)
    {
        if (!is_dir(public_path() . DIRECTORY_SEPARATOR . $uploadDirectoryPath)) {
            @mkdir(public_path() . DIRECTORY_SEPARATOR . $uploadDirectoryPath, 0777, true);
        }

        $attachmentFiles = $fileArr = [];
        if (count($files) > 0) {
            $i = 0;
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName();
                $customFileName = isset($fileName[$i]) && !empty($fileName[$i]) ? $fileName[$i] : $originalName;
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
                $fileArr[] = $new_name;
                $i++;
            }
        }
        return implode(',',$fileArr);
    }

    static function uploadFile($file,$uploadDirectoryPath)
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

    function getUserMenu()
    {
        $navigationArray = [];
//        $role = Role::findById($roleId);
        $navs = Navigation::with('children')->where('parent_id', '0')
            ->orderBy('sort_id','ASC')->get();

        foreach ($navs as $n => $nav) {
            $permission = $nav->slug.'-view';
            if (hasPermission($permission)) {
                $navigationArray[] = $nav;
//                $children = $nav->children();
//                foreach ($children as $child)
//                {
//                    $navigationArray[$n][] = $child->toArray();
//                }
            }
        } #dd($navigationArray);
        return $navigationArray;

    }
}
