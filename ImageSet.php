<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/19
 * Time: 16:50
 */
class ImageSet
{
    private $ext;
    private $width;
    private $height;
    private $imageTag;
    public function __construct($filename)
    {
        $img = getimagesize($filename);
        $this->ext = $this->checkExt($img[2]);
        $this->width = $img[0];
        $this->height = $img[1];
        $funcName = $this->concatFunName("imagecreatefrom");
        $this->imageTag = $funcName($filename);
    }

    /**
     *获取文件格式
     **/
    public function checkExt($type)
    {
        $extArr = ['gif', 'jpg', 'png', 'swf', 'psd', 'bmp', 'tiff', 'tiff', 'jpc', 'jp2', 'jpx', 'swc', 'iff', 'wbmp', 'xbm'];
        return $extArr[$type - 1];
    }

    /**
     *输出图像到网页;
     **/

    public function printImage () {
        header('Content-type:image/'.$this->ext);
        $funcName = $this->concatFunName("image");
        $funcName($this->imageTag);
        return $this;
    }
    /**
     *拼接函数名
     **/
    public function concatFunName($funcName){
        if ($this->ext === 'jpg') {
            $funcName.="jpeg";
        } else {
            $funcName.=$this->ext;
        }
        return $funcName;
    }
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        imagedestroy($this->imageTag);
    }
}