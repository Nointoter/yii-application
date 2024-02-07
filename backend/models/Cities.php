<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 * @property int $region_number
 *
 * @property Companies[] $companies
 * @property Workers[] $workers
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'region_number'], 'required'],
            [['region_number'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'region_number' => 'Region Number',
        ];
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\query\CompaniesQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Companies::class, ['cities_id' => 'id']);
    }

    /**
     * Gets query for [[Workers]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\query\WorkersQuery
     */
    public function getWorkers()
    {
        return $this->hasMany(Workers::class, ['cities_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \backend\models\query\CitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\CitiesQuery(get_called_class());
    }
}
