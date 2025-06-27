<?php

use app\models\Request;
use app\common\Auth;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Auth::isAdmin() ? 'Заявки' : 'Мои заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Auth::isAdmin()): ?>
        <p>
            <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'label' => 'Ник',
                'value' => function ($model) {
                    return $model->user ? $model->user->username : '(не задано)';
                },
            ],
            [
                'attribute' => 'service_id',
                'label' => 'Услуга',
                'value' => function ($model) {
                    return $model->service ? $model->service->name : '(не задано)';
                },
            ],
            'address',
            'contact_phone',
            //'desired_datetime',
            //'custom_service_description',
            //'payment_method',
            //'status',
            //'cancellation_reason',
            [
                'class' => ActionColumn::className(),
                ...Auth::isAdmin() ? [
                    'template' => '{update}',
                    'buttons' => [
                        'update' => function ($url) {
                            return Html::a('<span class="btn btn-primary" type="button">Ответить на заявку</span>', $url);
                        }
                    ]
                ] : [],
                'urlCreator' => function ($action, Request $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
