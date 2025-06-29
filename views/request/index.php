<?php

use app\models\Request;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оставить заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fio',
            'description:ntext',
            [
                'attribute' => 'date',
                'label' => 'Дата услуги',
                'value' => function (Request $model) {
                    return date('d.m.Y', strtotime($model->date));
                }
            ],
            [
                'attribute' => 'service_id',
                'label' => 'Оказанная услуга',
                'value' => function (Request $model) {
                    return $model->service->name . ' (' . $model->service->price . 'руб.)';
                }
            ],
            'status:boolean',
            [
                'class' => ActionColumn::className(),
                'template' => '{update}',
                'buttons' => [
                        'update' => function ($url, $model) {
                            return $model->status ? '' : Html::a('<span class="btn btn-success">Выполнить</span>', $url);
                        }
                ]
            ],
        ],
    ]); ?>


</div>
