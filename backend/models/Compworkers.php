<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "compworkers".
 *
 * @property int $id
 * @property int $companies_id
 * @property int $workers_id
 *
 * @property Companies $companies
 * @property Workers $workers
 */
class Compworkers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compworkers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['companies_id', 'workers_id'], 'required'],
            [['companies_id', 'workers_id'], 'integer'],
            [['companies_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['companies_id' => 'id']],
            [['workers_id'], 'exist', 'skipOnError' => true, 'targetClass' => Workers::class, 'targetAttribute' => ['workers_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companies_id' => 'Companies ID',
            'workers_id' => 'Workers ID',
        ];
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\query\CompaniesQuery
     */
    public function getCompanies()
    {
        return $this->hasOne(Companies::class, ['id' => 'companies_id']);
    }

    /**
     * Gets query for [[Workers]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\query\WorkersQuery
     */
    public function getWorkers()
    {
        return $this->hasOne(Workers::class, ['id' => 'workers_id']);
    }

    /**
     * {@inheritdoc}
     * @return \backend\models\query\CompworkersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\CompworkersQuery(get_called_class());
    }
}
