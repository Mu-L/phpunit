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

use const PHP_EOL;
use function sprintf;
use PHPUnit\Event\Code;
use PHPUnit\Event\Code\Throwable;
use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class Skipped implements Event
{
    private Telemetry\Info $telemetryInfo;

    private Code\TestMethod $test;

    private Throwable $throwable;

    public function __construct(Telemetry\Info $telemetryInfo, Code\TestMethod $test, Throwable $throwable)
    {
        $this->telemetryInfo = $telemetryInfo;
        $this->test          = $test;
        $this->throwable     = $throwable;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function test(): Code\TestMethod
    {
        return $this->test;
    }

    public function throwable(): Throwable
    {
        return $this->throwable;
    }

    public function asString(): string
    {
        $message = $this->throwable->message();

        if (!empty($message)) {
            $message = PHP_EOL . $message;
        }

        return sprintf(
            'Test Skipped (%s::%s)%s',
            $this->test->className(),
            $this->test->methodName(),
            $message
        );
    }
}
