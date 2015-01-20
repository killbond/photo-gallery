<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Photo */
/* @var $commentForm app\models\CommentForm */
/* @var $comment app\models\Comment */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('pg.photo', 'Photos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;

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
            <div class="row">
                <div class="col-md-12 text-center"><h3><?= Html::encode($this->title) ?></h3></div>
            </div>
            <div class="row">
                <div class="col-md-6 text-right"><b><?= Yii::t('pg.comment', 'Photo rating') ?></b>:</div>
                <div class="col-md-6 text-left"><?= $model->getRating(); ?></div>
            </div>
            <?php if(!$ownPhoto) { ?>
                <div class="row">
                    <div class="col-md-6 text-right"><b><?= Yii::t('pg.main', 'User name') ?></b>:</div>
                    <div class="col-md-6 text-left"><?= $model->getUser()->username; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-right"><b><?= Yii::t('pg.main', 'email') ?></b>:</div>
                    <div class="col-md-6 text-left"><?= $model->getUser()->email; ?></div>
                </div>
            <?php } ?>
        </div>
        <div class="col-md-4"></div>
    </div>

    <?php
        if($model->getComments()) { ?>
            <div class="row" style="margin-top: 40px;">
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center"><h3><?= Yii::t('pg.comment', 'Comments') ?></h3></div>
                <div class="col-md-4"></div>
            </div>
            <?php
            foreach($model->getComments() as $comment) {
                ?>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="row">
                        <hr/>
                        <div class="col-md-2"><b><?= $comment->getUsername() ?></b>:</div>
                        <div class="col-md-8">&nbsp<?= $comment->text ?></div>
                        <div class="col-md-2">+<?= $comment->rating ?></div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <?php
            }
        }
    ?>

    <?= $this->render('comment', [
        'model' => $commentForm,
    ]) ?>

</div>
