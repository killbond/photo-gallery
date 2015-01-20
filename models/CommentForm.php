<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20.01.2015
 * Time: 17:36
 */

namespace app\models;

use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $username;
    public $email;
    public $rating;
    public $text;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rating'], 'integer', 'on' => ['user', 'guest']],
            [['text'], 'string', 'max' => 255, 'on' => ['user', 'guest']],
            ['username', 'required', 'on' => 'guest'],
            ['email', 'required', 'on' => 'guest'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('pg.comment', 'User name'),
            'email' => Yii::t('pg.comment', 'email'),
            'text' => Yii::t('pg.comment', 'Comment text'),
            'rating' => Yii::t('pg.comment', 'Rating'),
        ];
    }

    protected function _loggedIn()
    {
        return (bool)Yii::$app->user->identity;
    }

    public function validateEmail($attribute, $params)
    {
        if(!$this->_loggedIn() && !$this->email) {
            $this->addError($attribute, [Yii::t('yii', '{attribute} cannot be blank.'), $this->getAttributeLabel($attribute)]);
        }
    }

    public function validateUsername($attribute, $params)
    {
        if(!$this->_loggedIn() && !$this->username) {
            $this->addError($attribute, [Yii::t('yii', '{attribute} cannot be blank.'), $this->getAttributeLabel($attribute)]);
        }
    }
} 