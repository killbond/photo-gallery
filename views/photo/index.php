<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('pg.photo', 'Photos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('pg.photo', 'Create {modelClass}', [
    'modelClass' => 'Photo',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'file_location',
            'description',
            'uploaded_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
