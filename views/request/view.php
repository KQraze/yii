<?php

use app\models\Request;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Request $model */

$this->title = "Квитанция выполнения услуги";
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
