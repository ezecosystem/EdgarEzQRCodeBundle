<?php

namespace EdgarEz\QRCodeBundle\Twig\Extension;

use PHPQRCode\Constants;
use PHPQRCode\QRcode;
use Symfony\Component\Filesystem\Filesystem;

class QRCodeTwigExtension extends \Twig_Extension
{
    const IMAGEXTENSION = '_qrcode.png';
    const IMAGESDIR     = 'bundles/edgarezqrcode/images';

    protected $webRootDir;

    /**
     * Constructor
     *
     * @param string $kernelRootDir path of qrcode images generated
     */
    public function __construct($kernelRootDir)
    {
        $this->webRootDir = '/' . trim($kernelRootDir, '/');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'edgar_ez_qrcode_twig_extension';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'eez_qrcode',
                array($this, 'generate')
            ),
        );
    }

    /**
     * Twig extension aims to generate qrcode image
     *
     * @param string $string string used to generate QRCode
     * @param int $level Level of error correction (3 by default, should be at least 0, maximum 3)
     * @param int $size Size of QRCode image
     * @param int $margin Margin of QRCode image
     * @return bool|string false if error, QRCode image path otherwise
     */
    public function generate($string, $level = Constants::QR_ECLEVEL_L, $size = 3, $margin = 4)
    {
        $level = (abs((int)$level) > 3) ? Constants::QR_ECLEVEL_L : abs((int)$level);

        $fileName = md5($string . $level . $size . $margin) . self::IMAGEXTENSION;
        $filePath = trim(self::IMAGESDIR, '/') . '/' . $fileName;

        $fs = new Filesystem();

        if (!$fs->exists($this->webRootDir . '/' . $fileName)) {
            QRcode::png($string, $this->webRootDir . '/' . $fileName, $level, $size, $margin);
        }

        if ($fs->exists($this->webRootDir . '/' . $fileName)) {
            return $filePath;
        }

        return false;
    }
}
