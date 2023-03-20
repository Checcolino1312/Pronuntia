<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assegnazione".
 *
 * @property int $id
 * @property int $id_assistito
 * @property int $id_esercizio
 * @property int|null $eseguito
 * @property int|null $valutazione
 */
class Assegnazione extends \yii\db\ActiveRecord
{
    /**
     * @var mixed|null
     */


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assegnazione';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_assistito', 'id_esercizio'], 'required'],
            [['id_assistito', 'id_esercizio', 'eseguito','valutazione'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_assistito' => 'Id Assistito',
            'id_esercizio' => 'Id Esercizio',
            'eseguito' => 'Eseguito',
            'valutazione' => 'Valutazione',
        ];
    }
}
