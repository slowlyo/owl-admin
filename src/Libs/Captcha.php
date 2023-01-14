<?php

namespace Slowlyo\SlowAdmin\Libs;

class Captcha
{
    private $width;
    private $height;
    private $codeNum;
    private $code;
    private $im;

    public function __construct($width = 80, $height = 40, $codeNum = 4)
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
        $bgColor  = imagecolorallocate($this->im, 255, 255, 255);
        imagefill($this->im, 0, 0, $bgColor);
    }

    private function setDisturb()
    {
        $codeSet = '2345678abcdefhijkmnpqrstuvwxyz';
        for ($i = 0; $i < 10; $i++) {
            //杂点颜色
            $noiseColor = imagecolorallocate($this->im, mt_rand(210, 240), mt_rand(210, 240), mt_rand(210, 240));
            for ($j = 0; $j < 5; $j++) {
                // 绘杂点
                imagestring($this->im,
                    3,
                    mt_rand(-10, $this->width),
                    mt_rand(-10, $this->height),
                    $codeSet[mt_rand(0, 29)],
                    $noiseColor);
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
            $x     = floor($this->width / $this->codeNum) * $i + 5;
            $y     = rand(0, $this->height - 20);
            imagechar($this->im, 5, $x, $y, $this->code[$i], $color);
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
