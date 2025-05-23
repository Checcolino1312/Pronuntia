<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;



/**
 * This is the model class for table "logopedista".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $email
 * @property string $password
 * @property string $conferma_password
 * @property Caregiver[] $caregivers
 */
class Logopedista extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 2;


    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function getCognome()
    {
        return $this->cognome;
    }
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
            [['nome', 'cognome','cellulare','indirizzo_studio', 'email', 'password'], 'required'],
            [['nome', 'cognome', 'email','cellulare','indirizzo_studio', 'password'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique'],

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
        'cellulare' => 'Cellulare',
        'indirizzo_studio' => 'Indirizzo studio',
        'email' => 'Email',
        'password' => 'Password',
    ];
}

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord && !empty($this->password)) {
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
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
    public function getCaregivers()
    {
        return $this->hasMany(Caregiver::class, ['logopedista_id' => 'id']);
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