<?php

namespace Slowlyo\SlowAdmin\Libs;

class Captcha
{
    private $width;
    private $height;
    private $codeNum;
    private $code;
    private $im;

    public function __construct($width = 80, $height = 25, $codeNum = 4)
    {
        $this->width   = $width;
        $this->height  = $height;
        $this->codeNum = $codeNum;
    }

    public function showImg()
    {
        //创建图片
        $this->createImg();
        //设置干扰元素
        $this->setDisturb();
        //设置验证码
        $this->setCaptcha();
        //输出图片
        return $this->outputImg();
    }

    public function getCaptcha()
    {
        return $this->code;
    }

    private function createImg()
    {
        $this->im = imagecreatetruecolor($this->width, $this->height);
        $bgColor  = imagecolorallocate($this->im, 240, 242, 245);
        imagefill($this->im, 0, 0, $bgColor);
    }

    private function setDisturb()
    {
        $area       = ($this->width * $this->height) / 90;
        $disturbNum = ($area > 250) ? 250 : $area;
        //加入点干扰
        for ($i = 0; $i < $disturbNum; $i++) {
            $color = imagecolorallocate($this->im, rand(0, 255), rand(0, 255), rand(0, 255));
            imagesetpixel($this->im, rand(1, $this->width - 2), rand(1, $this->height - 2), $color);
        }
    }

    private function createCode()
    {
        $str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ";

        for ($i = 0; $i < $this->codeNum; $i++) {
            $this->code .= $str[rand(0, strlen($str) - 1)];
        }
    }

    private function setCaptcha()
    {
        $this->createCode();

        for ($i = 0; $i < $this->codeNum; $i++) {
            $color = imagecolorallocate($this->im, rand(0, 150), rand(0, 150), rand(0, 150));
            $size  = rand(floor($this->height / 5), floor($this->height / 3));
            $x     = floor($this->width / $this->codeNum) * $i + 5;
            $y     = rand(0, $this->height - 20);
            imagechar($this->im, $size, $x, $y, $this->code[$i], $color);
        }
    }

    private function outputImg()
    {
        $tempPath = tempnam(sys_get_temp_dir(), 'temp');

        imagepng($this->im, $tempPath);
        if ($fp = fopen($tempPath, "rb", 0)) {
            $gambar = fread($fp, filesize($tempPath));
            fclose($fp);

            $base64 = base64_encode($gambar);
            @unlink($tempPath);
        }

        return 'data:image/png;base64,' . $base64;
    }

}
