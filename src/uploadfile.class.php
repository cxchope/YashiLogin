<?php
// require_once 'vendor/autoload.php';
class uploadfile {
    function getuploadfile($echojson=true) {
        global $nlcore;
        $jsonarrTotpsecret = $nlcore->safe->decryptargv("session");
        $jsonarr = $jsonarrTotpsecret[0];
        $totpsecret = $jsonarrTotpsecret[1];
        $totptoken = $jsonarrTotpsecret[2];
        $ipid = $jsonarrTotpsecret[3];
        $appid = $jsonarrTotpsecret[4];
        if (!isset($_FILES["file"])) $nlcore->msg->stopmsg(2050104,$totpsecret);
        $uploadconf = $nlcore->cfg->app->upload;
        $uploadconf["type"] = $nlcore->cfg->app->uploadtype;
        //整理文件详细信息数组
        $files = $nlcore->safe->dicvals2arrsdic($this->filearr($_FILES));
        //准备文件存储路径(绝对路径,/结尾)
        $savedir = $this->savepath($uploadconf["uploaddir"],$uploadconf["datedir"],$uploadconf["chmod"]).DIRECTORY_SEPARATOR; //目标存储文件夹
        $stmpdir = $this->savepath($uploadconf["tmpdir"]).DIRECTORY_SEPARATOR; //二压临时文件夹
        $uploaddirstrcount = strlen($this->savepath($uploadconf["uploaddir"]));
        //遍历文件资讯
        $returnarr = [];
        foreach ($files as $nowfile) {
            $mediatype = $this->chkfile($nowfile,$uploadconf); //检查文件
            $code = 1000000;
            $info = [];
            $tmpfile = $nowfile["tmp_name"];
            if (is_numeric($mediatype)) {
                $code = $mediatype; //返回错误
                $info = ["code" => $code];
            } else {
                $info["type"] = $mediatype;
                $info["code"] = $code;
            }
            // $newfilename = $nlcore->safe->randstr(64); //创建文件名
            $newfilename = md5_file($tmpfile); //文件哈希值创建文件名
            $twotmpfile = $uploadconf["tmpdir"];
            $savefile = $savedir.$newfilename; //最终存储文件完整路径
            $savetmpfile = $stmpdir.$newfilename.'.'.$mediatype["extension"]; //最终存储临时文件完整路径
            //是视频还是图片？
            $info["files"] = [];
            if ($mediatype["media"] == "image") {
                //如果是图片文件则直接进行二压
                foreach ($nlcore->cfg->app->imageresize as $key => $value) {
                    $nowfilename = $savefile.'.'.$key;
                    $newfiles = $this->resizeto($tmpfile, $nowfilename, $mediatype["extension"], $value);
                    foreach ($newfiles as $newfile) {
                        $newfilesub = substr($newfile, $uploaddirstrcount);
                        $filepatharr = explode(".", $newfilesub);
                        $info["files"][implode(",",array_slice($filepatharr, -2))] = str_replace("\\","/",$newfilesub);
                        // array_push($info["files"],str_replace("\\","/",$newfilesub));
                    }
                }
            } else if ($mediatype["media"] == "video") {
                $videofile = $savefile.'.'.$mediatype[1];
                $info["files"] = array_push($info["files"],str_replace("\\","/",$videofile));
                //异步用文件
                $vcfgfile = fopen($savetmpfile.'.txt', "w");
                fwrite($vcfgfile, $videofile);
                fclose($vcfgfile);
                copy($tmpfile,$savetmpfile) or $nlcore->msg->stopmsg(2050105,$totpsecret);
            }
            array_push($returnarr,$info);
        }
        $returnarr["code"] = 1000000;
        if ($echojson) echo $nlcore->safe->encryptargv($returnarr,$totpsecret);
        return $returnarr;
    }

    /**
     * @description: 缩小图片（如果已经小于设定值则输出原尺寸）
     * @param Float imageWidth 原始图片宽度
     * @param Float imageHeight 原始图片高度
     * @param Float maxWidth 目标尺寸宽度
     * @param Float maxHeight 目标尺寸高度
     * @return Array<Float> 新的宽高
     */
    function getresize($imageWidth,$imageHeight,$maxWidth,$maxHeight) {
        $newWidth = $imageWidth;
        $newHeight = $imageHeight;
        $imageScale = $imageWidth / $imageHeight;
        $maxScale = $maxWidth / $maxHeight;
        if ($maxScale < $imageScale) {
            $newWidth = $maxWidth;
            $newHeight = $maxWidth / $imageScale;
        } else if ($maxScale > $imageScale) {
            $newHeight = $maxHeight;
            $newWidth = $maxHeight * $imageScale;
        }
        return [$newWidth,$newHeight];
    }

    /**
     * @description: 将图片限制到指定尺寸，压缩成更小的 gif 或 jpg+webp 格式，然后存入日期文件夹。
     * @param String imagefile 图片临时文件完整路径
     * @param String tofile 最终存储文件完整路径
     * @param String type 扩展名
     * @param Array sizequality 最大尺寸和清晰度 [宽,高,在 jpg+webp 模式时的压缩比]
     * @return Array 文件信息和状态数组
     */
    function resizeto($imagefile,$tofile,$type,$sizequality) {
        $imagick = new Imagick($imagefile);
        $imagick->stripImage(); //去除图片信息
        $imageWidth = $imagick->getImageWidth();
        $imageHeight = $imagick->getImageHeight();
        if ($imageWidth <= 0 || $imageHeight <= 0) {
            $imageWidth = imagesx($srcImg);
            $imageHeight = imagesy($srcImg);
        }
        $newsize = $this->getresize($imageWidth,$imageHeight,$sizequality[0],$sizequality[1]);
        if ($type == "gif") {
            $transparent = new ImagickPixel("transparent");
            $newimagick = new Imagick();
            foreach($imagick as $img){
                $page = $img->getImagePage();
                $tmp = new Imagick();
                $tmp->newImage($page['width'], $page['height'], $transparent, 'gif');
                $tmp->compositeImage($img, Imagick::COMPOSITE_OVER, $page['x'], $page['y']);
                $tmp->thumbnailImage($newsize[0], $newsize[1], true);
                $tmp->setFormat("gif");
                $newimagick->addImage($tmp);
                $newimagick->setImagePage($tmp->getImageWidth(), $tmp->getImageHeight(), 0, 0);
                $newimagick->setImageDelay($img->getImageDelay());
                $newimagick->setImageDispose($img->getImageDispose());
                $tmp->destroy();
            }
            $newimagick->setFormat("gif");
            $savefilename = $tofile.".gif";
            $newimagick->writeImages($savefilename,true);
            $newimagick->destroy();
            return [$savefilename];
        } else {
            $imagick->adaptiveResizeImage($newsize[0], $newsize[1]);
            $imagick->setImageCompressionQuality($sizequality[2]); //图片质量
            $webp = $imagick;
            $webp->setFormat("webp");
            $savefilename1 = $tofile.".webp";
            $webp->writeImage($savefilename1);
            $jpeg = $imagick;
            $jpeg->setFormat("jpeg");
            $savefilename2 = $tofile.".jpg";
            $jpeg->writeImage($savefilename2);
            $webp->destroy();
            $jpeg->destroy();
            $imagick->destroy();
            return [$savefilename1,$savefilename2];
        }
    }
    /* return
[
    {
        "type": [
            "image/png",
            "png",
            "image"
        ],
        "code": 1000000,
        "files": [
            "\\2019\\09\\10\\rrNjGYteUdiKvWP4W3MvfSS1PJO4Tr5bQd6fHt0wixA9YpNVCwyQvTM0jVvKujFI.S.webp",
            "\\2019\\09\\10\\rrNjGYteUdiKvWP4W3MvfSS1PJO4Tr5bQd6fHt0wixA9YpNVCwyQvTM0jVvKujFI.S.jpg",
            "\\2019\\09\\10\\rrNjGYteUdiKvWP4W3MvfSS1PJO4Tr5bQd6fHt0wixA9YpNVCwyQvTM0jVvKujFI.M.webp",
            "\\2019\\09\\10\\rrNjGYteUdiKvWP4W3MvfSS1PJO4Tr5bQd6fHt0wixA9YpNVCwyQvTM0jVvKujFI.M.jpg",
            "\\2019\\09\\10\\rrNjGYteUdiKvWP4W3MvfSS1PJO4Tr5bQd6fHt0wixA9YpNVCwyQvTM0jVvKujFI.L.webp",
            "\\2019\\09\\10\\rrNjGYteUdiKvWP4W3MvfSS1PJO4Tr5bQd6fHt0wixA9YpNVCwyQvTM0jVvKujFI.L.jpg"
        ]
    }
]
    */

    // 使用 GD 库（已弃用）
    // function resizeto($imagefile,$tofile,$type,$size) {
    //     $srcImg = null;
    //     $isGIF = false;
    //     switch ($type) {
    //         case 'jpg':
    //             $srcImg = imagecreatefromjpeg($imagefile);
    //             break;
    //         case 'png':
    //             $srcImg = imagecreatefrompng($imagefile);
    //             break;
    //         case 'gif':
    //             $srcImg = imagecreatefromgif($imagefile);
    //             $isGIF = true;
    //             break;
    //         case 'webp':
    //             $srcImg = imagecreatefromwebp($imagefile);
    //             break;
    //         case 'bmp':
    //             $srcImg = imagecreatefrombmp($imagefile);
    //             break;
    //         default:
    //             break;
    //     }
    //     if (!$srcImg) return false;
    //     $srcWidth = imagesx($srcImg);
    //     $srcHeight = imagesy($srcImg);
    //     $newsize = $this->getresize($srcWidth,$srcHeight,$size[0],$size[1]);
    //     $newImg = imagecreatetruecolor($newsize[0], $newsize[1]);
    //     echo count($srcImg);
    //     $alpha = imagecolorallocatealpha($newImg, 0, 0, 0, 127);
    //     imagefill($newImg, 0, 0, $alpha);
    //     imagecopyresampled($newImg, $srcImg, 0, 0, 0, 0, $newsize[0], $newsize[1], $srcWidth, $srcHeight);
    //     imagesavealpha($newImg, true);
    //     // imagepng($newImg, $tofile);
    //     // imagewebp($newImg, $tofile.'.webp');
    //     // imagegif($newImg, $tofile.'.gif');
    //     imagedestroy($newImg);
    //     return true;
    // }

    /**
     * @description: 检查文件是否符合要求
     * @param String nowfile 当前文件完整路径
     * @param Array uploadconf 上传配置数组
     * @param Array enable 允许上传的媒体类别，默认["image","video"]都可以
     * @return Array [MIME类型,扩展名,image还是video]
     */
    function chkfile($nowfile,$uploadconf,$enable=["image","video"]) {
        //检查错误代码
        if ($nowfile["error"] != 0) {
            return 2050100;
        }
        //检查文件大小是否超过限制
        $maxsize = $uploadconf["maxsize"];
        if ($nowfile["size"] > $maxsize["all"]) {
            return 2050101;
        }
        //检查文件类型是否符合
        $fi = new finfo(FILEINFO_MIME_TYPE); //FILEINFO_MIME_TYPE FILEINFO_EXTENSION
        $mime_type = $fi->file($nowfile["tmp_name"]);
        //mediatype [MIME类型, 扩展名, 媒体类别(图片/视频)] ，来自设置 uploadtype 。
        $mediatype = null;
        foreach ($uploadconf["type"] as $typename => $typevalue) {
            foreach ($typevalue as $typearr) {
                if ($mime_type == $typearr[0]) {
                    $mediatype = [
                        "mime" => $typearr[0],
                        "extension" => $typearr[1]
                    ];
                    $mediatype["media"] = $typename;
                    break;
                }
            }
        }
        if (!$mediatype || !in_array($mediatype["media"],$enable)) {
            return 2050102;
        }
        if ($mediatype["media"] == "video") { //如果是视频
            //当前类型的限制大小
            if ($nowfile["size"] > $maxsize["video"]) {
                return 2050101;
            }
            //检查视频时长是否太长
            $videoduration = $this->getvideoduration($nowfile["tmp_name"]);
            if ($videoduration > $uploadconf["videoduration"]) {
                return 2050103;
            }
        } else if ($mediatype["media"] == "image") { //如果是图片
            //当前类型的限制大小
            if ($mediatype["extension"] == "gif" && $nowfile["size"] > $maxsize["gif"]) {
                return 2050101;
            } else if ($nowfile["size"] > $maxsize["image"]) {
                return 2050101;
            }
        }
        return $mediatype;
    }

    /**
     * @description: 获取视频长度
     * @param String file 视频文件路径
     * @return Float 视频持续时间（秒）
     */
    function getvideoduration($file) {
        $ffprobe = FFMpeg\FFProbe::create();
        $duration = $ffprobe
            ->format($file)
            ->get('duration');
        return $duration;
    }

    /**
     * @description: 通过读取文件头原始数据，判断文件真实类型（已废弃）
     * @param String filename 文件完整路径
     * @return String 文件扩展名
     */
    function getImagetype($filename)
    {
        $file = fopen($filename, 'rb');
        $bin = fread($file, 2); //只读2字节
        fclose($file);
        $strInfo = @unpack('C2chars', $bin);
        $typeCode = intval($strInfo['chars1'].$strInfo['chars2']);
        $fileType = '';
        switch ($typeCode) {
            case 255216:
                $fileType = 'jpg';
                break;
            case 7173:
                $fileType = 'gif';
                break;
            case 6677:
                $fileType = 'bmp';
                break;
            case 13780:
                $fileType = 'png';
                break;
            default:
                $fileType = $typeCode;
        }
        return $fileType;
    }
    /**
     * @description: 获取目的地文件夹
     * @param String uploadpath 要存储的文件夹
     * @return String 绝对路径,无/结尾
     */
    function savepath($uploadpath,$datedir=false,$chmod=0770) {
        $uploadto = pathinfo(__FILE__)["dirname"].DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.$uploadpath;
        if ($datedir) {
            $uploadto = $uploadto.DIRECTORY_SEPARATOR.date('Y').DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.date('d');
            if (!is_dir($uploadto)) {
                mkdir($uploadto,$chmod,true);
            }
        } else if (!is_dir($uploadto)) {
            mkdir($uploadto,$chmod,true);
        }
        return $uploadto;
    }
    /**
     * @description: 合并多name上传的文件
     * @param Array $_FILES
     * @return Array 转换后的数组
     */
    function filearr($files) {
        if (!$files || count($files) == 0) return [];
        $filearr = null;
        $filekeys = array_keys($files);
        //取所有文件数组
        foreach ($files as $fileskey => $filesvalue) {
            $nowfileskey = array_keys($filesvalue);
            //初始化文件信息数组
            if ($filearr == null) {
                $filearr = array();
                foreach ($nowfileskey as $nowfileskeyname) {
                    $filearr[$nowfileskeyname] = array();
                }
                $filearr["form"] = array();
            }
            if (is_array($filesvalue[$nowfileskey[0]])) {
                $firstadd = true;
                foreach ($filesvalue as $fkey => $fvalue) {
                    if ($firstadd) {
                        for ($i=0; $i < count($fvalue); $i++) {
                            array_push($filearr["form"],$fileskey);
                        }
                        $firstadd = false;
                    }
                    $filearr[$fkey] = array_merge($filearr[$fkey],$fvalue);
                }
            } else {
                foreach ($filesvalue as $fkey => $fvalue) {
                    array_push($filearr[$fkey],$fvalue);
                }
                array_push($filearr["form"],$fileskey);
            }
        }
        return $filearr;
    }
}
?>