<?php 
declare(strict_types=1);

use Terraphorm\Terraphorm;
use PHPUnit\Framework\TestCase;
use Composer\Semver\Comparator;

final class InitTest extends TestCase
{
    protected $cwd = './tests/terraform';
    
    /** @test */
    public function it_tests_running_an_init()
    {
        $this->assertTrue((new Terraphorm(realpath($this->cwd)))
            ->init());
    }
}
