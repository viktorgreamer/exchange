<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {

        //  Yii::$app->db->createCommand()->truncateTable('user')->execute();
      /*  $user = new User();
        $user->username = 'admin';
        $user->email = 'an.viktory@gmail.com';
        $user->status = 10;
        $user->setPassword(123456);
        $user->save();*/

        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // add "managePoint" permission
        $managePoint = $auth->createPermission('managePoint');
        $managePoint->description = 'Manage an exchange point';
        $auth->add($managePoint);

        // add "manager" role and give this role the "managePoint" permission
        $author = $auth->createRole('entity');
        $auth->add($author);
        $auth->addChild($author, $managePoint);

        // add "admin" role and give this role the "managePoint" permission
        // as well as the permissions of the "owner" role


        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $managePoint);
        $auth->addChild($admin, $author);


        $auth->assign($admin,1);
    }
}