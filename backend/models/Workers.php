<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "workers".
 *
 * @property int $id
 * @property int $cities_id
 * @property string|null $name
 * @property string|null $surname
 *
 * @property Cities $cities
 * @property Compworkers[] $compworkers
 */
class Workers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cities_id'], 'required'],
            [['cities_id'], 'integer'],
            [['surname'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['cities_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['cities_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cities_id' => 'Cities ID',
            'name' => 'Name',
            'surname' => 'Surname',
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\query\CitiesQuery
     */
    public function getCities()
    {
        return $this->hasOne(Cities::class, ['id' => 'cities_id']);
    }

    /**
     * Gets query for [[Compworkers]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\query\CompworkersQuery
     */
    public function getCompworkers()
    {
        return $this->hasMany(Compworkers::class, ['workers_id' => 'id']);
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\query\CompaniesQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Compworkers::class, ['id' => 'workers_id'])
            ->viaTable('companies', ['companies_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \backend\models\query\WorkersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\WorkersQuery(get_called_class());
    }
}
