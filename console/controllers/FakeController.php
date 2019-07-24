<?php
/**
 * Created by PhpStorm.
 * User: anvik
 * Date: 26.05.2019
 * Time: 10:32
 */


namespace console\controllers;
use common\models\Cities;
use common\models\Entities;
use common\models\ExchangePoints;
use common\models\ExchangeRates;
use common\models\OpeningHours;
use common\models\Pairs;;
use common\models\Regions;
use common\models\services\GoogleGeolocation;
use Faker\Factory;
use yii\db\Expression;

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


    public function actionGeocode()
    {
        $address = 'Киев крещатик  д 1';
        $google = new GoogleGeolocation($address);
        $google->handle();

        if ($google->status) {
            foreach ($google->getResponses() as $response) {
                print_r($response);
                echo $response->getFullAddress();
            }
        }


    }

    public function actionReference()
    {

        /** @var Cities $city */
        Regions::deleteAll();
        Entities::deleteAll();

        foreach (Cities::map() as $city_id => $city) {
            foreach (['Западный', 'Восточный', 'Центральный', 'Северный'] as $region) {
                $region = new Regions(['city_id' => $city_id, 'name' => $region]);
                if (!$region->save()) print_r($region->errors);
            }
        }

        foreach (range(1, 50) as $key => $entity) {
            $entity = new Entities(['name' => 'Сеть обменников №' . ($entity)]);
            $entity->user_id = 1;
            $entity->status = 1;
            if (!$entity->save()) print_r($entity->errors);
        }


    }

    public function actionData()
    {

        $geoRange = [
            1 => [50.45466, 30.5238],
            2 => [49.98081, 36.25272],
            3 => [46.47747, 30.73262],
            4 => [49.83826, 24.02324]
        ];

        ExchangePoints::deleteAll();
        OpeningHours::deleteAll();
        ExchangePoints::deleteAll();

        foreach (range(1, 100) as $item) {
            $point1 = new ExchangePoints(['name' => 'Обменник номер ' . $item]);
            $point1->entity_id = Entities::find()->orderBy(new Expression('rand()'))->one()->id;
            $point1->city_id = Cities::find()->orderBy(new Expression('rand()'))->one()->id;
            $point1->region_id = Regions::find()->andWhere(['city_id' => $point1->city_id])->orderBy(new Expression('rand()'))->one()->id;
            $point1->address = "Улица № " . $item;
            $point1->longitude = $geoRange[$point1->city_id][1] + round(rand(-34, 34) / 1000, 6);
            $point1->latitude = $geoRange[$point1->city_id][0] + round(rand(-34, 34) / 1000, 6);
            if ($point1->save()) {

                foreach (range(1, 7) as $day) {
                    $openingHours = new OpeningHours(['exchange_point_id' => $point1->id]);
                    $openingHours->day = $day;
                    $openingHours->time_start = array_rand(array_slice(OpeningHours::map(), 8 * 12, 2 * 12,true));
                    $openingHours->time_end = array_rand(array_slice(OpeningHours::map(), 17 * 12, 2 * 12,true));
                    $openingHours->break_time_start = array_rand(array_slice(OpeningHours::map(), 13 * 12, 1 * 12,true));
                    $openingHours->break_time_end = array_rand(array_slice(OpeningHours::map(), 14 * 12, 1 * 12,true));

                    if ($openingHours->save()) {

                        foreach (Pairs::find()->all() as $pair) {
                            $exchangeRate = new ExchangeRates(['pair_id' => $pair->id, 'point_id' => $point1->id]);
                            $exchangeRate->buy = round(rand(50, 100) / 10, 2);
                            $exchangeRate->sell = round($exchangeRate->buy * 0.89, 2);
                            if (!$exchangeRate->save()) {
                                print_r($exchangeRate->errors);
                            };

                        }
                    } else print_r($openingHours->errors);

                }
            } else {
                print_r(" ОШИБКА СОХРАНЕНИЯ ТОЧКИ CITY " . $point1->city_id . " " . $point1->region_id);
                print_r($point1->errors);
                break;
            }


        }
    }

    public function actionTimes()
    {
        print_r(OpeningHours::map());
    }

}