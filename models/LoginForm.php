<?php

namespace app\models;

use Yii;
use yii\base\Model;



/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    public $_user = false;
    /**
     * @var mixed
     */
    public $id_logopedista;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'ATTENZIONE Username o password non corretti.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if($this->getUser() instanceof Logopedista) {
                return Yii::$app->logopedista->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            }
            if($this->getUser() instanceof Caregiver) {
                return Yii::$app->caregiver->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Caregiver
     */
    public function getUser()
    {
        $this->_user = Caregiver::findByEmail($this->email);
        if($this->_user instanceof Caregiver) {
            return $this->_user;
        }

        $this->_user = Logopedista::findByEmail($this->email);
        if($this->_user instanceof Logopedista) {
            return $this->_user;
        }
    }


}
