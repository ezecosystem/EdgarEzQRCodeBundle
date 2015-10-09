<?php

namespace EdgarEz\QRCodeBundle\Twig\Extension;

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
     * @param string $string String used to be generate QRCode
     * @return bool|string false if error, path of QRCode image otherwise
     */
    public function generate($string)
    {
        $fileName   = md5($string) . self::IMAGEXTENSION;
        $filePath   = trim(self::IMAGESDIR, '/') . '/' . $fileName;

        $fs = new Filesystem();

        if (!$fs->exists($this->webRootDir . '/' . $fileName)) {
            QRcode::png($string, $this->webRootDir . '/' . $fileName, 'L', 2, 2);
        }

        if ($fs->exists($this->webRootDir . '/' . $fileName)) {
            return $filePath;
        }

        return false;
    }
}
