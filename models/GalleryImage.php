<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.01.2015
 * Time: 20:36
 */

namespace app\models;


use yii\validators\ImageValidator;

class GalleryImage extends ImageValidator
{
    public function init()
    {
        parent::init();
        $this->tooBig = \Yii::t('pg.photo', 'The file "{file}" is too big. Its size cannot exceed {limit} MB.');
    }
    /**
     * @inheritdoc
     */
    public function getSizeLimit()
    {
        $limit = $this->sizeToMegabytes(ini_get('upload_max_filesize'));
        if ($this->maxSize !== null && $limit > 0 && $this->maxSize < $limit) {
            $limit = $this->maxSize;
        }
        if (isset($_POST['MAX_FILE_SIZE']) && $_POST['MAX_FILE_SIZE'] > 0 && $_POST['MAX_FILE_SIZE'] < $limit) {
            $limit = (int) $_POST['MAX_FILE_SIZE'];
        }

        return $limit;
    }

    /**
     * Converts php.ini style size to megabytes
     *
     * @param string $sizeStr $sizeStr
     * @return int
     */
    private function sizeToMegabytes($sizeStr)
    {
        switch (substr($sizeStr, -1)) {
            case 'M':
            case 'm':
                return (int) $sizeStr;
            case 'K':
            case 'k':
                return (int) $sizeStr / 1024;
            case 'G':
            case 'g':
                return (int) $sizeStr * 1024;
            default:
                return (int) $sizeStr / 1048576;
        }
    }
} 