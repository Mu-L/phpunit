<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework;

use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

#[CoversMethod(Assert::class, 'assertDirectoryDoesNotExist')]
#[TestDox('assertDirectoryDoesNotExist()')]
#[Small]
final class assertDirectoryDoesNotExistTest extends TestCase
{
    #[DataProviderExternal(assertDirectoryExistsTest::class, 'failureProvider')]
    public function testSucceedsWhenConstraintEvaluatesToTrue(string $directory): void
    {
        $this->assertDirectoryDoesNotExist($directory);
    }

    #[DataProviderExternal(assertDirectoryExistsTest::class, 'successProvider')]
    public function testFailsWhenConstraintEvaluatesToFalse(string $directory): void
    {
        $this->expectException(AssertionFailedError::class);

        $this->assertDirectoryDoesNotExist($directory);
    }
}