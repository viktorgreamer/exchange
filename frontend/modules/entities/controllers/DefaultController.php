<?php

namespace frontend\modules\entities\controllers;

use common\models\User;
use yii\web\Controller;

/**
 * Default controller for the `developer` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        /** @var User $user */
        if (($user = \Yii::$app->user->identity) && ($model = $user->entity)) {
            return $this->redirect('/entities/exchange-points/index');
        } else {
            return $this->redirect('login');
        }

    }

}
