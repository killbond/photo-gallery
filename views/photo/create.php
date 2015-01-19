<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PhotoForm */

$this->title = Yii::t('pg.photo', 'Create photo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('pg.photo', 'Photos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-create center-block col-lg-5 col-md-4 col-sm-6" style="float: none;">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
