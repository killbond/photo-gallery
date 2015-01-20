<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Photo */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('pg.photo', 'Photos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$authorized = (bool)Yii::$app->user->identity;
$ownPhoto = $authorized && $model->user_id == Yii::$app->user->identity->getId();
?>
<div class="photo-view">

    <?php if($ownPhoto) { ?>
        <p>
            <?= Html::a(Yii::t('pg.photo', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('pg.photo', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php } ?>

    <div class="row">
        <div class="col-md-12">
            <table class="table borderless text-center">
                <tr>
                    <td>
                        <?= Html::img(Yii::$app->request->hostInfo.'/'.Yii::$app->params['galleryPath'].$model->file_location) ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <table class="table borderless text-center">
                <tr>
                    <td class="text-center" colspan="2"><h1><?= Html::encode($this->title) ?></h1></td>
                </tr>

                <?php if(!$ownPhoto) { ?>
                    <tr>
                        <td class="text-right"><?= Yii::t('pg.main', 'User name') ?></td>
                        <td class="text-left"><?= $model->getUser()->username; ?></td>
                    </tr>
                    <tr>
                        <td class="text-right"><?= Yii::t('pg.main', 'email') ?></td>
                        <td class="text-left"><?= $model->getUser()->email; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>
