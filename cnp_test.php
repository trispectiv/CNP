<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require('cnp.php');

final class cnp_test extends TestCase {

    public function test_isCnpValid() {
        global $argc, $argv;
        if ($argc > 2) {
            $this->assertTrue(isCnpValid($argv[2]) == true);
        }
    }

}

?>