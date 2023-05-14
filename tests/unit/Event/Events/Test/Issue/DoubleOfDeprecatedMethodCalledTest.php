<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Test;

use PHPUnit\Event\AbstractEventTestCase;
use PHPUnit\Event\Code\ClassMethod;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

#[CoversClass(DoubleOfDeprecatedMethodCalled::class)]
#[Small]
final class DoubleOfDeprecatedMethodCalledTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo = $this->telemetryInfo();
        $test          = $this->testValueObject();
        $method        = new ClassMethod('ClassName', 'methodName');
        $message       = 'message';

        $event = new DoubleOfDeprecatedMethodCalled(
            $telemetryInfo,
            $test,
            $method,
            $message,
        );

        $this->assertSame($telemetryInfo, $event->telemetryInfo());
        $this->assertSame($test, $event->test());
        $this->assertSame($method, $event->method());
        $this->assertSame($message, $event->message());
    }

    public function testCanBeRepresentedAsString(): void
    {
        $event = new DoubleOfDeprecatedMethodCalled(
            $this->telemetryInfo(),
            $this->testValueObject(),
            new ClassMethod('ClassName', 'methodName'),
            'message',
        );

        $this->assertSame(
            <<<'EOT'
Double of Deprecated Method Called (ClassName::methodName)
message
EOT,
            $event->asString()
        );
    }
}
