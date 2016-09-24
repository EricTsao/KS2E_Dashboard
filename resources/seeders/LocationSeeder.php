<?php

/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/8/8
 * Time: 上午 10:17
 */
class LocationSeeder extends \Windwalker\Core\Seeder\AbstractSeeder
{

    /**
     * doExecute
     *
     * @return  void
     */
    public function doExecute()
    {
        $faker = \Faker\Factory::create();

        $mapper = new \Windwalker\DataMapper\DataMapper('locations');

        foreach (range(1,10) as $i)
        {
            $data = [];

            $data['title'] = $faker->locale;
            $data['description'] = $faker->sentence(3);
            $data['created'] = $faker->dateTimeThisYear->format('Y-m-d H:i:s');

            $mapper->createOne($data);

            $this->outCounting();
        }
    }

    /**
     * doClear
     *
     * @return  void
     */
    public function doClear()
    {
        $this->truncate('locations');
    }
}