<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model {
    public $image;


    public function rules()
    {
        return [
          [['image'], 'required'],
          [['image'],'file', 'extensions'=>'jpg,png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage){
        $this->image = $file;
            $this->deleteCurrentFile($currentImage);
            return $this->save();
    }

    private function getAlias($name){
        return Yii::getAlias('@web') . 'uploads/' . $name;
    }

    private function generateUniqFilename(){
        return strtolower(md5(uniqid($this->image->baseName)) . '.' .$this->image->getExtension());
    }

    public function deleteCurrentFile($currentImage){
        if(!empty($currentImage)){
            $alias = $this->getAlias($currentImage);
            if (file_exists($alias)) {
                unlink($alias);
            }
        }
    }

    public function save(){
        $filename = $this->generateUniqFilename();
        $this->image->saveAs($this->getAlias($filename));
        return $filename;
    }


}
