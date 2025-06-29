<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $fio
 * @property string $description
 * @property boolean $status
 * @property string|null $date
 * @property int $service_id
 *
 * @property Service $service
 */
class Request extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'default', 'value' => null],
            [['fio', 'description', 'service_id'], 'required'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['service_id'], 'integer'],
            [['fio'], 'string', 'max' => 255],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО владельца',
            'description' => 'Описание изделия',
            'date' => 'Дата приёма заказа',
            'service_id' => 'Услуга',
            'status' => 'Выполнен',
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

}
