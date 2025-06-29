<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $date
 * @property string $title
 * @property string $description
 * @property int $contact_id
 *
 * @property Contact $contact
 */
class Event extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'title', 'description', 'contact_id'], 'required'],
            [['date'], 'safe'],
            [['contact_id'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::class, 'targetAttribute' => ['contact_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'date' => 'Дата мероприятия',
            'description' => 'Описание',
            'contact_id' => 'Имя организации/Физ.лица',
        ];
    }

    /**
     * Gets query for [[Contact]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::class, ['id' => 'contact_id']);
    }

}
