<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%ingredient}}".
 *
 * @property integer $id
 * @property string $ingred_name
 * @property integer $hidden
 *
 * @property BludoIngredient[] $bludoIngreds
 */
class Ingredient extends ActiveRecord
{

    const STATUS_VISIBLE = 0;
    const STATUS_HIDDEN = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ingredient}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ingred_name'], 'required'],
            [['hidden'], 'integer'],
            [['ingred_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ingred_name' => 'Ingredient Name',
            'hidden' => 'Status',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getBludoIngreds()
    {
        return $this->hasMany(BludoIngredient::className(), ['ingred_id' => 'id']);
    }

    public static function getVisibleIngreds()
    {
        return Ingredient::find()->where(['hidden' => self::STATUS_VISIBLE])->all();
    }

    /**
     * @param int $id
     * @return Ingredient
     * @throws NotFoundHttpException
     */
    public function getIngred($id)
    {
        if (($model = Ingredient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested ingredient does not exist.');
        }
    }

    /**
     * @return bool
     */
    protected function isVisible()
    {
        return $this->hidden === self::STATUS_VISIBLE;
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if (! $insert && array_key_exists('hidden', $changedAttributes)) {
            $bludo_ids = ArrayHelper::getColumn($this->getBludoIngreds()->all(), 'bludo_id');
            Bludo::updateAll(['hidden' => $this->hidden], array('id' => $bludo_ids));
        }
        parent::afterSave($insert, $changedAttributes);
    }

}
