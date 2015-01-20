<?php

namespace app\models;

use Yii;
use auth\models\User;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $photo_id
 * @property string $text
 * @property integer $rating
 * @property string $posted_time
 */
class Comment extends \yii\db\ActiveRecord
{
    protected $_user;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    public function findByPhotoId($photoId)
    {
        $query = Comment::find();
        $query->where(['photo_id' => $photoId]);
        return $query->one();
    }

    public function getUser()
    {
        if(!$this->_user) {
            $this->_user = $this->hasOne(User::className(), ['id' => 'user_id'])->one();
        }
        return $this->_user;
    }

    public function getUsername()
    {
        if($this->getUser()) {
            return $this->getUser()->username;
        }
        return $this->username;
    }

    public function getEmail()
    {
        if($this->getUser()) {
            return $this->getUser()->email;
        }
        return $this->email;
    }

}
