<?php



namespace App\Traits;
use Illuminate\Support\Facades\File;
trait SaveFIle
{
    protected function saveImage($file, $previousImagePath = '', $path = '')
    {
        if ($previousImagePath != '') {
            // $image=DB::table(''.$table.'')->where('id',$id)->first();
            $image_path = $previousImagePath;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

        }

        if ($path == '') {
            $image_name = time() . '' . $file->extension();
            $file->move(public_path('images/'), $image_name);
        } else {
            
            $image_name = '' . $path . '' . time() . '.' . $file->extension();
            $file->move(public_path('images/categories'), $image_name);
        }

        return $image_name;
    }
}