<?php

namespace app\models;

use app\common\Auth;
use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $service_id
 * @property string $address
 * @property string $contact_phone
 * @property string $desired_datetime
 * @property string|null $custom_service_description
 * @property string $payment_method
 * @property string $other_request;
 * @property string|null $status
 * @property string|null $cancellation_reason
 *
 * @property Service $service
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    public $other_request;

    /**
     * ENUM field values
     */
    const PAYMENT_METHOD_CASH = 'cash';
    const PAYMENT_METHOD_CARD = 'card';
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

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
        if (!Auth::isAdmin()) {
            return [
                [['service_id', 'custom_service_description', 'cancellation_reason'], 'default', 'value' => null],
                [['status'], 'default', 'value' => 'new'],
                ['status', 'in', 'range' => array_keys(self::optsStatus())],
                [['user_id'], 'default', 'value' => Auth::id()],
                [['user_id', 'address', 'contact_phone', 'desired_datetime', 'payment_method'], 'required'],
                [['user_id', 'service_id'], 'integer'],
                [['desired_datetime'], 'safe'],
                [['other_request'], 'safe'],
                [['payment_method', 'status'], 'string'],
                [['address', 'contact_phone', 'custom_service_description', 'cancellation_reason'], 'string', 'max' => 255],
                ['payment_method', 'in', 'range' => array_keys(self::optsPaymentMethod())],
                [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],
                [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
                [['custom_service_description'], 'required',
                    'when' => function ($model) {
                        return $model->other_request;
                    },
                    'whenClient' => "function (attribute, value) {
                    return $('#request-other_request').is(':checked');
                }",
                    'message' => 'Заполните описание услуги'
                ],
            ];
        } else {
            return [
                [['status'], 'default', 'value' => 'new'],
                ['status', 'in', 'range' => array_keys(self::optsStatus())],
                ['cancellation_reason', 'required', 'when' => function ($model) {
                    return $model->status == 'cancelled';
                },
                    'whenClient' => "function (attribute, value) {
                        return $('select[id*=`request-status`]').val() === 'cancelled';
                    }",
                    'message' => 'Заполните причину отмены'
                ],
            ];
        }

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'service_id' => 'Вид услуги',
            'address' => 'Адрес',
            'contact_phone' => 'Номер телефона',
            'desired_datetime' => 'Желаемое дата и время',
            'custom_service_description' => 'Ваша услуга',
            'payment_method' => 'Предпочтительный тип оплаты',
            'status' => 'Статус',
            'cancellation_reason' => 'Причина отмены',
            'other_request' => 'Иная услуга',
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    /**
     * column payment_method ENUM value labels
     * @return string[]
     */
    public static function optsPaymentMethod()
    {
        return [
            self::PAYMENT_METHOD_CASH => 'cash',
            self::PAYMENT_METHOD_CARD => 'card',
        ];
    }

    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_NEW => 'new',
            self::STATUS_IN_PROGRESS => 'in_progress',
            self::STATUS_COMPLETED => 'completed',
            self::STATUS_CANCELLED => 'cancelled',
        ];
    }

    /**
     * @return string
     */
    public function displayPaymentMethod()
    {
        return self::optsPaymentMethod()[$this->payment_method];
    }

    /**
     * @return bool
     */
    public function isPaymentMethodCash()
    {
        return $this->payment_method === self::PAYMENT_METHOD_CASH;
    }

    public function setPaymentMethodToCash()
    {
        $this->payment_method = self::PAYMENT_METHOD_CASH;
    }

    /**
     * @return bool
     */
    public function isPaymentMethodCard()
    {
        return $this->payment_method === self::PAYMENT_METHOD_CARD;
    }

    public function setPaymentMethodToCard()
    {
        $this->payment_method = self::PAYMENT_METHOD_CARD;
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusNew()
    {
        return $this->status === self::STATUS_NEW;
    }

    public function setStatusToNew()
    {
        $this->status = self::STATUS_NEW;
    }

    /**
     * @return bool
     */
    public function isStatusInprogress()
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    public function setStatusToInprogress()
    {
        $this->status = self::STATUS_IN_PROGRESS;
    }

    /**
     * @return bool
     */
    public function isStatusCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function setStatusToCompleted()
    {
        $this->status = self::STATUS_COMPLETED;
    }

    /**
     * @return bool
     */
    public function isStatusCancelled()
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function setStatusToCancelled()
    {
        $this->status = self::STATUS_CANCELLED;
    }

    public function beforeSave($insert)
    {
        if ($this->other_request) {
            $this->service_id = null;
        }

        return parent::beforeSave($insert);
    }
}
