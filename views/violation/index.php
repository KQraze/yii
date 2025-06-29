<?php

use app\models\Violation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список нарушений';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="violation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Зарегистрировать нарушение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'type',
            'price',
            'car_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Violation $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
