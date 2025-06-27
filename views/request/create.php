<?php

use yii\helpers\Html;
use app\common\Auth;

/** @var yii\web\View $this */
/** @var app\models\Request $model */

$this->title = 'Создание заявки';
$this->params['breadcrumbs'][] = ['label' => Auth::isAdmin() ? 'Заявки' : 'Мои заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
