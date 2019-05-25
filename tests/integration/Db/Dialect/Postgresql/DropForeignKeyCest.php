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

namespace Phalcon\Test\Integration\Db\Dialect\Postgresql;

use Codeception\Example;
use IntegrationTester;
use Phalcon\Test\Fixtures\Traits\DialectTrait;

class DropForeignKeyCest
{
    use DialectTrait;

    /**
     * Tests Phalcon\Db\Dialect\Postgresql :: dropForeignKey()
     *
     * @author Sid Roberts <https://github.com/SidRoberts>
     * @since  2019-05-25
     *
     * @dataProvider getDropForeignKeyFixtures
     */
    public function dbDialectPostgresqlDropForeignKey(IntegrationTester $I, Example $example)
    {
        $I->wantToTest('Db\Dialect\Postgresql - dropForeignKey()');

        $schema    = $example[0];
        $reference = $example[1];
        $expected  = $example[2];

        $dialect = $this->getDialectPostgresql();

        $actual = $dialect->dropForeignKey('table', $schema, $reference);

        $I->assertEquals($expected, $actual);
    }

    protected function getDropForeignKeyFixtures(): array
    {
        return [
            [
                '',
                'fk1',
                'ALTER TABLE "table" DROP CONSTRAINT "fk1"',
            ],
            [
                'schema',
                'fk1',
                'ALTER TABLE "schema"."table" DROP CONSTRAINT "fk1"',
            ],
        ];
    }
}
