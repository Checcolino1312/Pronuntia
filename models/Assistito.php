<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assistito".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property int $eta
 * @property string $diagnosi
 * @property int $id_logopedista
 * @property int $id_caregiver
 */
class Assistito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assistito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nome', 'cognome', 'eta', 'diagnosi', 'id_logopedista', 'id_caregiver'], 'required'],
            [['id', 'eta', 'id_logopedista', 'id_caregiver'], 'integer'],
            [['diagnosi'], 'string'],
            [['nome', 'cognome'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'eta' => 'Eta',
            'diagnosi' => 'Diagnosi',
            'id_logopedista' => 'Id Logopedista',
            'id_caregiver' => 'Id Caregiver',
        ];
    }
}
