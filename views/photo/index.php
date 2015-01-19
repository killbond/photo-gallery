<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('pg.photo', 'Photos');
$i = 0;
?>
<div class="photo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table borderless gallery">
        <?php

        foreach($dataProvider->getModels() as $id => $photo)
        {
            if($i == 0)
            {
                echo '<tr>';
            }

            echo '<td>'.Html::a(Html::img(Yii::$app->request->hostInfo.'/'.Yii::$app->params['galleryPath'].$photo->file_location), ['view', 'id' => $photo->id]).'</td>';
            $i++;

            if($i == 3)
            {
                echo '</tr>';
                $i = 0;
            }
        }

        ?>
    </table>

</div>
