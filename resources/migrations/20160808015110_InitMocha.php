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
 * Migration class, version: 20160808015110
 */
class InitMocha extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
        $this->createTable('mocha', function(Schema $schema){
            $schema->primary('id')->comment('Primary Key');
            $schema->varchar('title')->length(255)->allowNull(false);
            $schema->text('description');
            $schema->datetime('created');
        });
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
        $this->drop('mocha');
	}
}
