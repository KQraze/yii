<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $fio
 * @property string $gender
 * @property int $age
 * @property string $family_status
 * @property int|null $children
 * @property string $position
 * @property string $degree
 */
class Employee extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['children'], 'default', 'value' => null],
            [['fio', 'gender', 'age', 'family_status', 'position', 'degree'], 'required'],
            [['age', 'children'], 'integer'],
            [['fio', 'gender', 'family_status', 'position', 'degree'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'gender' => 'Gender',
            'age' => 'Age',
            'family_status' => 'Family Status',
            'children' => 'Children',
            'position' => 'Position',
            'degree' => 'Degree',
        ];
    }

}
