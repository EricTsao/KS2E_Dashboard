<?php

/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/8/8
 * Time: 上午 10:27
 */
class MochaSeeder extends \Windwalker\Core\Seeder\AbstractSeeder
{

    /**
     * doExecute
     *
     * @return  void
     */
    public function doExecute()
    {
        $faker = \Faker\Factory::create();

        $mochaMapper = new \Windwalker\DataMapper\DataMapper('mocha');
        $locationMapper = new \Windwalker\DataMapper\DataMapper('locations');

        $loctationId = $locationMapper->findColumn('id');

        /*
            $schema->primary('id')->comment('Primary Key');
            $schema->varchar('title')->length(255)->allowNull(false);
            $schema->text('description');
            $schema->datetime('created');
        */

        foreach (range(1,100) as $i)
        {
            $data = [];

            $data['title'] = $faker->sentence(2);
            $data['location_id'] = $faker->randomElement($loctationId);
            $data['description'] = $faker->sentence(3);
            $data['created'] = $faker->dateTimeThisYear->format('Y-m-d H:i:s');

            $mochaMapper->createOne($data);

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
        $this->truncate('mocha');
    }
}