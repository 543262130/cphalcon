<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Test\Integration\Db\Dialect\Mysql;

use Codeception\Example;
use IntegrationTester;
use Phalcon\Db\Dialect\Mysql;

class ViewExistsCest
{
    /**
     * Tests Phalcon\Db\Dialect\Mysql :: viewExists()
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2017-02-26
     *
     * @dataProvider getViewExistsFixtures
     */
    public function dbDialectMysqlViewExists(IntegrationTester $I, Example $example)
    {
        $I->wantToTest('Db\Dialect\Mysql - viewExists()');

        $schema   = $example[0];
        $expected = $example[1];

        $dialect = new Mysql();

        $actual = $dialect->viewExists(
            'view',
            $schema
        );

        $I->assertInternalType(
            'string',
            $actual
        );

        $I->assertEquals($expected, $actual);
    }

    protected function getViewExistsFixtures(): array
    {
        return [
            [
                null,
                'SELECT IF(COUNT(*) > 0, 1, 0) FROM `INFORMATION_SCHEMA`.`VIEWS` ' .
                "WHERE `TABLE_NAME`='view' AND `TABLE_SCHEMA` = DATABASE()",
            ],

            [
                'schema',
                'SELECT IF(COUNT(*) > 0, 1, 0) FROM `INFORMATION_SCHEMA`.`VIEWS` ' .
                "WHERE `TABLE_NAME`= 'view' AND `TABLE_SCHEMA`='schema'",
            ],
        ];
    }
}
