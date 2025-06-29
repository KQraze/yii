<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Event $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin();
    $contact = \app\models\Contact::find()->select(['name'])->indexBy('id')->column();
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->input('datetime-local') ?>

    <?= $form->field($model, 'contact_id')->dropDownList($contact) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
