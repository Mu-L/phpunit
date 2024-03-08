--TEST--
phpunit --list-tests ../../_files/listing-tests-and-groups
--FILE--
<?php declare(strict_types=1);
$_SERVER['argv'][] = '--do-not-cache-result';
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--list-tests';
$_SERVER['argv'][] = __DIR__ . '/../../_files/listing-tests-and-groups';

require_once __DIR__ . '/../../../bootstrap.php';

(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Available test(s):
 - PHPUnit\TestFixture\ListingTestsAndGroups\ExampleTest::testOne
 - PHPUnit\TestFixture\ListingTestsAndGroups\ExampleTest::testTwo
 - %stests/end-to-end/_files/listing-tests-and-groups/example.phpt