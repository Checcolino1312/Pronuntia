<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

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
 *
 *
 * @property Assegnazione[] $assegnazioni
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
            [['nome', 'cognome', 'eta', 'diagnosi', 'id_logopedista', 'id_caregiver'], 'required'],
            [['eta', 'id_logopedista', 'id_caregiver'], 'integer'],
            [['nome', 'cognome'], 'string', 'max' => 255],
            [['id_logopedista'], 'exist', 'skipOnError' => true, 'targetClass' => Logopedista::class, 'targetAttribute' => ['id_logopedista' => 'id']],
            [['id_caregiver'], 'exist', 'skipOnError' => true, 'targetClass' => Caregiver::class, 'targetAttribute' => ['id_caregiver' => 'id']],


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

    public function getAssegnazioni()
    {
        return $this->hasMany(Assegnazione::class, ['id_assistito' => 'id']);
    }


}
