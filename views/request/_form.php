<?php

use app\models\Service;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin();
    $services = Service::find()
        ->select(['name'])
        ->indexBy('id')
        ->column();
    ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->input('date') ?>

    <?= $form->field($model, 'service_id')->dropDownList($services) ?>

    <div class="form-group">
        <?= Html::submitButton('Оставить заявку', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
