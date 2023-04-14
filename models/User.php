<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $email
 * @property string $password
 * @property int $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $check;
    public $password_repeat;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['check'],'compare','compareValue'=>1],
            [['password_repeat'],'compare','compareAttribute'=>'password'],
            [['username'],'unique'],
            [['username'],'match','pattern'=>'/^[a-zA-Z0-9]*$/u'],
            [['name','surname','patronymic'],'match','pattern'=>'/^[а-яА-Я]*$/u'],
            [['email'],'email'],
            [['username', 'name', 'surname', 'patronymic', 'email', 'password'], 'required'],
            [['role'], 'integer'],
            [['number'], 'required'],
            [['role'], 'default','value'=>0],
            [['username', 'name', 'surname', 'patronymic'], 'string', 'max' => 50],
            [['email', 'password'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'role' => 'роль',
            'number' => 'номер',
            'check' => 'Принятие',
            'password_repeat' => 'Повтор пароля',
        ];
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
    public static function findByUsername($username)
    {
        return User::findOne(['username' => $username]);
    }
    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
    public function isAdmin()
    {
        return $this->role == '1';
    }
}
