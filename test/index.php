<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/19
 * Time: 16:50
 */
require_once '../ImageSet.php';
$filename = "test.jpg";
$image = new ImageSet($filename);
$image->printImage();