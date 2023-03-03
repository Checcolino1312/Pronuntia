<?php
namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;

class RegistrationForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_repeat'], 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'Questo indirizzo email è già in uso.'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Le password non coincidono.'],
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if (!$user->save()) {
            Yii::error('Errore durante la registrazione: ' . print_r($user->getErrors(), true));
            return false;
        }

        return true;
    }
}
