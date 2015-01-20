<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CommentForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-form row" style="margin-top: 60px;">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <?php $form = ActiveForm::begin(); ?>

        <?php if(!Yii::$app->user->identity) { ?>

            <div class="form-group">
                <?= $form->field($model, 'username')->textInput() ?>
            </div>

            <div class="form-group">
                <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
            </div>

        <?php } ?>

        <div class="form-group">
            <?= $form->field($model, 'text')->textInput() ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'rating')->dropDownList(['1' => '+1', '2' => '+2', '3' => '+3', '4' => '+4', '5' => '+5']) ?>
        </div>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('pg.photo', 'Create'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-4"></div>
</div>