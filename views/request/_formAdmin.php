<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin();
    $request = \app\models\Request::findOne($model->id);
    $service = \app\models\Service::findOne($model->service_id);
    ?>

    <h2>Услуга -
        <?= $service
            ? Html::encode($service->name)
            : Html::encode($request->custom_service_description)
        ?>
        (Телефон: <?= Html::encode($model->contact_phone) ?>)
    </h2>

    <p>Адрес: <?= Html::encode($request->address); ?></p>

    <h3><?= $model->getAttributeLabel('desired_datetime') ?></h3>
    <p><?= Html::encode(date('d-m-y H:m', strtotime($request->desired_datetime))) ?></p>

    <h3><?= $model->getAttributeLabel('payment_method') ?></h3>
    <p><?= $request->isPaymentMethodCard() ? 'Банковская карта' : 'Наличные' ?></p>

    <?= $form->field($model, 'status')->dropDownList([
            'in_progress' => 'В работе',
            'completed' => 'Выполнено',
            'cancelled' => 'Отменено',
    ], ['prompt' => ''])
    ?>

    <?= $form->field($model, 'cancellation_reason')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Ответить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
