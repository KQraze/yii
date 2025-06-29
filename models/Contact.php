<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $phone
 * @property string $address
 * @property string $type
 * @property string $name
 *
 * @property Event[] $events
 */
class Contact extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TYPE_ORGANIZATION = 'organization';
    const TYPE_PERSON = 'person';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'address', 'type', 'name'], 'required'],
            [['type'], 'string'],
            [['phone', 'address', 'name'], 'string', 'max' => 255],
            ['type', 'in', 'range' => array_keys(self::optsType())],
            ['type', 'default', 'value' => self::TYPE_PERSON],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'type' => 'Тип',
        ];
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::class, ['contact_id' => 'id']);
    }


    /**
     * column type ENUM value labels
     * @return string[]
     */
    public static function optsType()
    {
        return [
            self::TYPE_ORGANIZATION => 'Организация',
            self::TYPE_PERSON => 'Физ.лицо',
        ];
    }

    /**
     * @return string
     */
    public function displayType()
    {
        return self::optsType()[$this->type];
    }

    /**
     * @return bool
     */
    public function isTypeOrganization()
    {
        return $this->type === self::TYPE_ORGANIZATION;
    }

    public function setTypeToOrganization()
    {
        $this->type = self::TYPE_ORGANIZATION;
    }

    /**
     * @return bool
     */
    public function isTypePerson()
    {
        return $this->type === self::TYPE_PERSON;
    }

    public function setTypeToPerson()
    {
        $this->type = self::TYPE_PERSON;
    }
}
