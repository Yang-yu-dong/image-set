<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/19
 * Time: 16:50
 */
require_once '../ImageSet.php';
$filename = "https://www.baidu.com/img/bd_logo1.png";
$image = new ImageSet($filename);
$newImage = $image->resize(1)->save();