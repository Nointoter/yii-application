<?php

namespace backend\models;

use Symfony\Component\DomCrawler\Link;
use Yii;
use yii\web\Link as WebLink;
use yii\web\Linkable;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property int $cities_id
 * @property string|null $name
 * @property string|null $info
 *
 * @property Cities $cities
 * @property Compworkers[] $compworkers
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cities_id'], 'required'],
            [['cities_id'], 'integer'],
            [['info'], 'string'],
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
            'info' => 'Info',
        ];
    }

    public function fields()
    {
        return ['id', 'name', 'info'];
    }

    public function extraFields()
    {
        return [
            'cities_id'
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
        return $this->hasMany(Compworkers::class, ['companies_id' => 'id']);
    } 
    
    /**
     * Gets query for [[Workers]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\query\WorkersQuery
     */
    public function getWorkers()
    {
        return $this->hasMany(Compworkers::class, ['id' => 'companies_id'])
            ->viaTable('workers', ['workers_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \backend\models\query\CompaniesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\CompaniesQuery(get_called_class());
    }
}
