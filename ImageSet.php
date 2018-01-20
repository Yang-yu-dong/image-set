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
        return image_type_to_extension($type, FALSE);
    }

    /**
     *输出图像到网页;
     **/

    public function printImage()
    {
        header('Content-type:image/' . $this->ext);
        $funcName = $this->concatFunName("image");
        $funcName($this->imageTag);
        return $this;
    }

    /**
     *裁剪，
     * startX=>开始位置
     * startY=>结束位置
     * width=>裁剪区域宽度
     * height=>裁剪区域高度
     **/
    public function cut($startX, $startY, $width, $height)
    {
        $newImage = imagecreatetruecolor($width, $height);
        imagecopyresized($newImage, $this->imageTag, 0, 0, $startX, $startY, $width, $height, $width, $height);
        imagedestroy($this->imageTag);
        $this->imageTag = $newImage;
        return $this;
    }

    /**
     *缩放
     * pre=>倍数
     **/
    public function resize($pre)
    {
        $width = $this->width * $pre;
        $height = $this->height * $pre;
        $newImage = imagecreatetruecolor($width, $height);
        imagecopyresized($newImage, $this->imageTag, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
        imagedestroy($this->imageTag);
        $this->imageTag = $newImage;
        return $this;
    }

    /**
     *保存
     * path=>路径
     * 默认根目录下image-set/今日日期
     * 默认文件名uniqid.ext
     * name=>文件名
     **/

    public function save($path = NULL, $name = NULL)
    {
        date_default_timezone_set('Asia/Shanghai');
        if ($path === NULL) {
            $path = $_SERVER['DOCUMENT_ROOT'] . 'image-set/' . date('Y-m-d');
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
        } else {
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
        }
        if ($name === NULL) {
            $name = uniqid() . '.' . $this->ext;
        }
        $funcName = $this->concatFunName('image');
        return $funcName($this->imageTag, $path . '/' . $name);
    }

    /**
     *拼接函数名
     **/
    public function concatFunName($funcName)
    {
        if ($this->ext === 'jpg') {
            $funcName .= "jpeg";
        } else {
            $funcName .= $this->ext;
        }
        return $funcName;
    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        imagedestroy($this->imageTag);
    }
}