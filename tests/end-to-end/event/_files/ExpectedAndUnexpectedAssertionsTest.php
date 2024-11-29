<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\TestFixture\Event;

use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\TestCase;

final class ExpectedAndUnexpectedAssertionsTest extends TestCase
{
    #[DoesNotPerformAssertions]
    public function testOne(): void
    {
    }

    public function testTwo(): void
    {
        $this->expectNotToPerformAssertions();
    }

    #[DoesNotPerformAssertions]
    public function testThree(): void
    {
        $this->assertTrue(true);
    }

    public function testFour(): void
    {
        $this->expectNotToPerformAssertions();

        $this->assertTrue(true);
    }
}