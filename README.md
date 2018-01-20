# image-set
php图像处理类

composer require yangyudong/image-set dev-master

$image = new ImageSet($filename);

缩放
$image->resize(2);

裁剪
$image->cut(0,0,100,100);

保存
$image->save($path,$filename);

支持连贯操作
$image->resize(2)->cut(0,0,100,100)->save($path,$filename); 