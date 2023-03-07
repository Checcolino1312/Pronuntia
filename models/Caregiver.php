<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "caregiver".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $email
 * @property string $password
 * @property string $cellulare
 * @property int $id_logopedista
 */
class Caregiver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caregiver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'email', 'password', 'cellulare', 'id_logopedista'], 'required'],
            [['id_logopedista'], 'integer'],
            [['nome', 'cognome', 'email', 'password', 'cellulare'], 'string', 'max' => 255],
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
            'email' => 'Email',
            'password' => 'Password',
            'cellulare' => 'Cellulare',
            'id_logopedista' => 'Id Logopedista',
        ];
    }
}
