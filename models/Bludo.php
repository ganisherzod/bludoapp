<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "{{%bludo}}".
 *
 * @property integer $id
 * @property string $bludo_name
 * @property integer $hidden
 *
 * @property BludoIngredient[] $bludoIngreds
 */
class Bludo extends ActiveRecord
{
    const STATUS_VISIBLE = 0;
    const STATUS_HIDDEN = 1;

    /**
     * @var array
     */
    protected $ingreds = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bludo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bludo_name'], 'required'],
            [['hidden'], 'integer'],
            [['bludo_name'], 'string', 'max' => 255],
            [['ingreds'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bludo_name' => 'Bludo Name',
            'hidden' => 'Status',
            'ingreds' => 'Ingredients',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getBludoIngreds()
    {
        return $this->hasMany(BludoIngredient::className(), ['bludo_id' => 'id']);
    }


    public function setIngreds($ingredsId)
    {
        $this->ingreds = (array) $ingredsId;
    }

    public function getIngreds()
    {
        return ArrayHelper::getColumn(
            $this->getBludoIngreds()->all(), 'ingred_id'
        );
    }


    /**
     * @return ActiveDataProvider
     */
    public function getVisibleBludos()
    {
        return new ActiveDataProvider([
            'query' => Bludo::find()
                ->where(['hidden' => self::STATUS_VISIBLE])
        ]);
    }

    /**
     * @param int $id
     * @return Bludo
     */
    public function getBludo($id)
    {
        if (($model = Bludo::findOne($id)) !== null && $model->isVisible()) 
        {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested bludo does not exist.');
        }
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        BludoIngredient::deleteAll(['bludo_id' => $this->id]);

        if (is_array($this->ingreds) && !empty($this->ingreds)) {
            $values = [];
            foreach ($this->ingreds as $id) {
                $values[] = [$this->id, $id];
            }
            self::getDb()->createCommand()
                ->batchInsert(BludoIngredient::tableName(), ['bludo_id', 'ingred_id'], $values)->execute();
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return bool
     */
    protected function isVisible()
    {
        return $this->hidden === self::STATUS_VISIBLE;
    }
}
