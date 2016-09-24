<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) {YEAR} {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Database\Schema\Schema;

/**
 * Migration class, version: 20160808020528
 */
class InitLocations extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
        $this->createTable('locations', function(Schema $schema){
            $schema->primary('id');
            $schema->varchar('title');
            $schema->text('description');
            $schema->datetime('created');
        });

        $this->updateTable('mocha', function(Schema $schema){
            $schema->integer('location_id')->signed(false)->position('AFTER id');

            //$schema->addIndex(['location_id','id']);
            $schema->addIndex(['location_id']);
        });
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
        $this->drop('locations');
	}
}
