<?php

namespace app\models;

use auth\models\User;
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
    protected $_user;
    protected $_comments;
    protected $_rating;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @return null|\auth\models\User
     */
    public function getUser()
    {
        if(!$this->_user) {
            $this->_user = $this->hasOne(User::className(), ['id' => 'user_id'])->one();
        }
        return $this->_user;
    }

    public function getComments()
    {
        if(!$this->_comments) {
            $this->_comments = $this->hasMany(Comment::className(), ['photo_id' => 'id'])->all();
        }
        return $this->_comments;
    }

    public function getRating()
    {
        if(!$this->_rating) {
            $this->_rating = 0;
            foreach($this->getComments() as $comment) {
                $this->_rating += $comment->rating;
            }
        }
        return $this->_rating;
    }
}
