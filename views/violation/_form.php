<?php

use app\models\Car;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Violation $model */
/** @var app\models\Car $car */
/** @var yii\widgets\ActiveForm $form */

$cars = Car::find()
    ->select(['number'])
    ->indexBy('id')
    ->column();
?>

<div class="violation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->input('date') ?>

    <?= $form->field($model, 'type')->dropDownList([ 'Превышение скорости' => 'Превышение скорости', 'Проезд на красный' => 'Проезд на красный', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'price')->input('number') ?>

    <?= $form->field($model, 'car_id')->dropDownList(['' => 'Нет', ...$cars])->label('<h3>Выбрать существующего нарушителя</h3>') ?>

    <h3>Добавить нового: </h3>

    <?= $form->field($car, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($car, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($car, 'owner')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
