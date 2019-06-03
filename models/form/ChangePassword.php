<?php

namespace jx\admin_zhcn\models\form;

use Yii;
use jx\admin_zhcn\models\Master;
use yii\base\Model;

/**
 * Description of ChangePassword
 *
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class ChangePassword extends Model
{
    public $oldPassword;
    public $newPassword;
    public $retypePassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'retypePassword'], 'required'],
            [['oldPassword'], 'validatePassword'],
            [['newPassword'], 'string', 'min' => 6],
            [['retypePassword'], 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'oldPassword' => Yii::t('rbac-admin', 'oldPassword'),
			'newPassword' => Yii::t('rbac-admin', 'newPassword'),
			'retypePassword' => Yii::t('rbac-admin', 'retypePassword'),
		];
	}
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        /* @var $user Master */
        $user = Yii::$app->user->identity;
        if (!$user || !$user->validatePassword($this->oldPassword)) {
            $this->addError('oldPassword', 'Incorrect old password.');
        }
    }

	/**
	 * Change password.
	 *
	 * @return bool the saved model or null if saving fails
	 */
    public function change($id)
    {
        if ($this->validate()) {
            /* @var $user Master */
            $user = Master::findOne($id);
            $user->setPassword($this->newPassword);
            $user->generateAuthKey();
            if ($user->save()) {
                return true;
            }
        }

        return false;
    }
}
