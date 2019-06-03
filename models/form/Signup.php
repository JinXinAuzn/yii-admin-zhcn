<?php
namespace jx\admin_zhcn\models\form;

use Yii;
use jx\admin_zhcn\models\Master;
use yii\base\Model;

/**
 * Signup form
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class Signup extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'jx\admin_zhcn\models\Master', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'jx\admin_zhcn\models\Master', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('rbac-admin', 'ID'),
			'username' => Yii::t('rbac-admin', 'Username'),
			'email' => Yii::t('rbac-admin', 'Email'),
			'password' => Yii::t('rbac-admin', 'Password'),

		];
	}
    /**
     * Signs master up.
     *
     * @return Master|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new Master();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
