<?php
namespace XisoDev\Slugify\Tests\Bridge\ZF2;

use XisoDev\Slugify\Bridge\ZF2\Module;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * Class ModuleTest
 * @package    xisodev/slugify
 * @subpackage bridge
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 */
class ModuleTest extends MockeryTestCase
{
    /**
     * @var Module
     */
    private $module;

    protected function setUp()
    {
        $this->module = new Module();
    }

    /**
     * @covers \XisoDev\Slugify\Bridge\ZF2\Module::getServiceConfig()
     */
    public function testGetServiceConfig()
    {
        $smConfig = $this->module->getServiceConfig();
        $this->assertTrue(is_array($smConfig));
        $this->assertArrayHasKey('factories', $smConfig);
        $this->assertArrayHasKey('XisoDev\Slugify\Slugify', $smConfig['factories']);
        $this->assertArrayHasKey('aliases', $smConfig);
        $this->assertArrayHasKey('slugify', $smConfig['aliases']);
    }

    /**
     * @covers \XisoDev\Slugify\Bridge\ZF2\Module::getViewHelperConfig()
     */
    public function testGetViewHelperConfig()
    {
        $vhConfig = $this->module->getViewHelperConfig();
        $this->assertTrue(is_array($vhConfig));
        $this->assertArrayHasKey('factories', $vhConfig);
        $this->assertArrayHasKey('slugify', $vhConfig['factories']);
    }
}
