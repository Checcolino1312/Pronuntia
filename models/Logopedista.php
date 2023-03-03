<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logopedista".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $email
 * @property string $password
 * @property string $conferma_password
 */
class Logopedista extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logopedista';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'email', 'password', 'conferma_password'], 'required'],
            [['nome', 'cognome', 'email', 'password', 'conferma_password'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['conferma_password'], 'compare', 'compareAttribute' => 'password', 'message' => 'Le password non corrispondono'],
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
        'conferma_password' => 'Conferma Password',
    ];
}

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

}