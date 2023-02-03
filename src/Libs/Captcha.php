<?php

namespace Slowlyo\SlowAdmin\Libs;

class Captcha
{
    private $width;
    private $height;
    private $codeNum;
    private $code;
    private $im;
    private $font;

    public function __construct($width = 100, $height = 40, $codeNum = 4)
    {
        $this->width   = $width;
        $this->height  = $height;
        $this->codeNum = $codeNum;
        $this->font    = __DIR__ . '/Facon-2.ttf';
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
        $bgColor  = imagecolorallocate($this->im, 255, 255, 255);
        imagefill($this->im, 0, 0, $bgColor);
    }

    private function setDisturb()
    {
        $codeSet = '2345678abcdefhijkmnpqrstuvwxyz';
        for ($i = 0; $i < 10; $i++) {
            //杂点颜色
            $noiseColor = imagecolorallocate($this->im, mt_rand(150, 180), mt_rand(150, 180), mt_rand(150, 180));
            for ($j = 0; $j < 5; $j++) {
                // 添加干扰字符
                imagettftext($this->im,
                    6,
                    mt_rand(-30, 30),
                    mt_rand(-10, $this->width),
                    mt_rand(-10, $this->height),
                    $noiseColor,
                    $this->font,
                    $codeSet[mt_rand(0, 29)]);
            }
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
            $x     = floor($this->width / $this->codeNum) * $i + 3;
            $y     = rand(15, $this->height - 5);
            // 更大的字体
            imagettftext($this->im, 15, rand(-30, 30), $x, $y, $color, $this->font, $this->code[$i]);
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
