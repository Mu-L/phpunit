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

use function sprintf;
use PHPUnit\Event\Code\ClassMethod;
use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class DoubleOfDeprecatedMethodCalled implements Event
{
    private readonly Telemetry\Info $telemetryInfo;
    private readonly ClassMethod $method;
    private readonly string $message;

    public function __construct(Telemetry\Info $telemetryInfo, ClassMethod $method, string $message)
    {
        $this->telemetryInfo = $telemetryInfo;
        $this->method        = $method;
        $this->message       = $message;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function method(): ClassMethod
    {
        return $this->method;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function asString(): string
    {
        $message = $this->message;

        if (!empty($message)) {
            $message = PHP_EOL . $message;
        }

        return sprintf(
            'Double of Deprecated Method Called (%s::%s)%s',
            $this->method->className(),
            $this->method->methodName(),
            $message,
        );
    }
}
