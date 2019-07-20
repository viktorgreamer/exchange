<?php
/**
 * Created by PhpStorm.
 * User: anvik
 * Date: 26.05.2019
 * Time: 10:32
 */


namespace console\controllers;

use common\models\Categories;
use common\models\CategoryIndustries;
use common\models\ContentArticles;
use common\models\ContentCategories;
use common\models\ContentNews;
use common\models\Developers;
use common\models\Programs;
use common\models\Reviews;
use Faker\Factory;

class FakeController extends \yii\console\Controller
{

    public $errors = [];

    public function actionAddUsers($count = 10)
    {

        $faker = Factory::create('ru');
        // creating fake users
        foreach (range(1, 10) as $item) {
            $user = new \common\models\User();
            $user->username = $faker->userName;
            $user->email = $faker->email;
            $user->setPassword(123456);
            $user->save();
            $user->status = 10;
            if (!$user->save()) $this->errors[] = $user->errors;
        }


    }


    public function actionAddData() {

    }

}