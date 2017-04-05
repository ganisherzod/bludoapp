<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%bludo_ingredient}}".
 *
 * @property integer $bludo_id
 * @property integer $ingred_id
 *
 * @property Bludo $bludo
 * @property Ingredient $ingredient
 */
class BludoIngredient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bludo_ingredient}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bludo_id', 'ingred_id'], 'integer'],
            [['bludo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bludo::className(), 'targetAttribute' => ['bludo_id' => 'id']],
            [['ingred_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredient::className(), 'targetAttribute' => ['ingred_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bludo_id' => 'Bludo ID',
            'ingred_id' => 'Ingredient ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBludo()
    {
        return $this->hasOne(Bludo::className(), ['id' => 'bludo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngred()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'ingred_id']);
    }


    public static function getBludoWithIngreds($ids)
    {
        $bludos = BludoIngredient::find()
            ->select('bludo_ingredient.*, b.bludo_name, i.ingred_name')
            ->leftJoin('bludo b', 'b.id = bludo_ingredient.bludo_id')
            ->leftJoin('ingredient i', 'i.id = bludo_ingredient.ingred_id')
            ->where(['b.hidden' => Bludo::STATUS_VISIBLE, 'i.id' => $ids])
            ->asArray()->all();

        return $bludos;

    }
}
