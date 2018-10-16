<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\File as FileModel;

class File extends Model
{
    /**
     * Save Image
     *
     * @param Request $request
     * @param Model $model
     * @param string $path
     * @param string $filePrefix
     *
     * @return void
     */
    public static function saveFileToModel(Request $request, $model, $path, $filePrefix)
    {
        $file = $request->file('image');
        $filename = uniqid($filePrefix . '_') . '.' . $file->getClientOriginalExtension();
        $path = public_path($path);
    
        $uploaded = $file->move($path, $filename);
    
        if (is_null($model->image)) {
            $image = new FileModel();
            $image->filename = $uploaded->getFilename();
            $image->image_url = $uploaded->getPathname();
            $image->file()->associate($model);
            $image->save();
        }else {
            unlink($path . '/' . $model->image->filename);
            $model->image->filename = $uploaded->getFilename();
            $model->image->image_url = $uploaded->getPathname();
            $model->image->update();
        }
    }
    
    public function file()
    {
        return $this->morphTo();
    }
}
