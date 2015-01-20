<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\PhotoForm */

$this->title = Yii::t('pg.photo', 'Create photo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('pg.photo', 'Photos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-create center-block col-lg-5 col-md-4 col-sm-6" style="float: none;">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="photo-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'file')->fileInput() ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('pg.photo', 'Create'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
