<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

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
class Caregiver extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 2;
    /**
     * {@inheritdoc}
     */

    public function getId()
    {
        return $this->getPrimaryKey();
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function getCognome()
    {
        return $this->cognome;
    }
    public function getIdLogopedista()
    {
        return $this->id_logopedista;
    }
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
            [['id_logopedista'], 'exist', 'skipOnError' => true, 'targetClass' => Logopedista::class, 'targetAttribute' => ['id_logopedista' => 'id']],

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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = Yii::$app->security->generatePasswordHash($this->password);

                $this->generateAuthKey(); // aggiungi questa riga
            }
            return true;
        }
        return false;
    }
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByEmail($email) {
        return self::findOne(['email' => $email]);
    }


}
