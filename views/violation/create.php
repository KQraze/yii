<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Violation $model */
/** @var app\models\Car $car */
/** @var array $data */

$this->title = 'Регистрация нарушения';
$this->params['breadcrumbs'][] = ['label' => 'Список нарушений', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="violation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'car' => $car,
    ]) ?>

</div>
