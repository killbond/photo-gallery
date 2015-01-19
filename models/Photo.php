<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $file_location
 * @property string $description
 * @property string $uploaded_time
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['uploaded_time'], 'safe'],
            [['file_location', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('pg.photo', 'ID'),
            'user_id' => Yii::t('pg.photo', 'User ID'),
            'file_location' => Yii::t('pg.photo', 'File Location'),
            'description' => Yii::t('pg.photo', 'Description'),
            'uploaded_time' => Yii::t('pg.photo', 'Uploaded Time'),
        ];
    }
}
