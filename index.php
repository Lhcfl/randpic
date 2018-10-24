<?php
//这里是复制来的，源 https://blog.csdn.net/markely/article/details/8805492
function get_allfiles($path,&$files) {
    if(is_dir($path)){
        $dp = dir($path);
        while ($file = $dp ->read()){
            if($file !="." && $file !=".."){
                get_allfiles($path."/".$file, $files);
            }
        }
        $dp ->close();
    }
    if(is_file($path)){
        $files[] =  $path;
    }
}
   
function get_filenamesbydir($dir){
    $files =  array();
    get_allfiles($dir,$files);
    return $files;
}
   
//这将得到一个文件夹中的所有文件的数组，可将参数改为你要获取的文件夹
//注意，如果是./xxx/这样的形式，会导致最终出现  https://aaa.com/bbb/picture//yyyyy/zzz.jpg
//问题在于网址中会出现//这样的情况导致404
$img_array = get_filenamesbydir("./picture");
//允许的后缀名列表 
$extentions = array("jpg", "png");
//循环取
do{
    //从数组中选择一个随机图片
    $img = array_rand($img_array);
}while(!in_array(strtolower(pathinfo($img_array[$img], PATHINFO_EXTENSION)), $extentions));
//↑检查文件后缀名
//302显示图片
header("location:$img_array[$img]"); 
?>
