<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.01.2015
 * Time: 4:02
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\GalleryImageValidator;

class PhotoForm extends Model
{
    /**
     * @var UploadedFile - file attribute
     */
    public $file;

    /**
     * @var $name - file name
     */
    public $name;

    /**
     * @var $description - file description
     */
    public $description;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'app\models\GalleryImage', 'skipOnEmpty' => false, 'extensions' => 'jpg, png, gif, tiff', 'mimeTypes' => 'image/jpeg, image/png, image/gif, image/tiff'],
            [['description'], 'string', 'max' => 255],
            [['description'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file' => Yii::t('pg.photo', 'Upload photo'),
            'description' => Yii::t('pg.photo', 'Description'),
        ];
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        $this->file = UploadedFile::getInstance($this, 'file');
        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function afterValidate()
    {
        $this->name = md5($this->file->baseName . time()) . '.' . $this->file->extension;
        $this->file->saveAs(Yii::$app->params['galleryPath'] . $this->name );
        return parent::afterValidate();
    }
} 