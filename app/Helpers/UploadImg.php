<?php

namespace App\Helpers;

use Image, File, Storage;

use Carbon\Carbon;

class UploadImg{
  protected $imagePath = '';
  protected $disk = null;
  protected $imageDimentions = [
    245, 300, 500
  ];
  protected $img = null;
  protected $filename = null;

  public function __construct($img, $storage = false, $disk = null){
    $this->img = $img;
  }

  protected function randFilename(){
    $filename = Carbon::now()->timestamp.'_'.uniqid().'.'.$this->getExt();
    return $filename;
  }

  public function upload($resize = true, $box = true){
    $filename = $this->getFilename();

    $img = Image::make($this->img)->encode($this->getExt())->getEncoded();
    $storage = Storage::disk($this->disk)->put($this->imagePath.$filename, $img, 'public');

    if($resize){
      $this->resizeImg($filename, $box);
    }
    return $filename;
  }

  protected function resizeImg($filename, $box = true){
    $img = $this->img;
    foreach($this->imageDimentions as $r){
      $image = Image::make($img);
      if($box){
        $width  = $r;
        $height = $r;
      }else{
        $w = $image->width();
        $h = $image->height();

        $width  = $r;
        $height = ($h * $width) / $w;
      }

      $canvas      = Image::canvas($width, $height);
      $resizeImage = $image->resize($width, $height, function($constraint){
        $constraint->aspectRatio();
      });
      $canvas->insert($resizeImage, 'center');

      $img = $canvas->encode($this->getExt())->getEncoded();
      Storage::disk($this->disk)->put($this->imagePath.$r.'/'.$filename, $img, 'public');
    }
  }

  public function setDisk($disk){
    $this->disk = $disk;
  }

  public function setPath($location){
    if(substr($location, -1) != '/') $location .= '/';
    $this->imagePath = $location;
  }

  public function getPath(){
    return $this->imagePath;
  }

  public function setFilename($filename){
    $this->filename = $filename.'.'.$this->getExt();
  }

  public function getFilename(){
    if(is_null($this->filename)){
      $this->filename = $this->randFilename();
    }
    return $this->filename;
  }

  public function getExt(){
    $img = $this->img;
    return strtolower($img->getClientOriginalExtension());
  }
}