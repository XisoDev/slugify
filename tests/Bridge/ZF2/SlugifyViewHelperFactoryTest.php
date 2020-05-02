<?php
namespace XisoDev\Slugify\Tests\Bridge\ZF2;

use XisoDev\Slugify\Bridge\ZF2\SlugifyViewHelperFactory;
use XisoDev\Slugify\Slugify;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * Class SlugifyViewHelperFactoryTest
 * @package    xisodev/slugify
 * @subpackage bridge
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 */
class SlugifyViewHelperFactoryTest extends MockeryTestCase
{
    /**
     * @var SlugifyViewHelperFactory
     */
    private $factory;

    protected function setUp()
    {
        $this->factory = new SlugifyViewHelperFactory();
    }

    /**
     * @covers \XisoDev\Slugify\Bridge\ZF2\SlugifyViewHelperFactory::__invoke()
     */
    public function testCreateService()
    {
        $sm = new ServiceManager();
        $sm->setService('XisoDev\Slugify\Slugify', new Slugify());
        $vhm = new HelperPluginManager();
        $vhm->setServiceLocator($sm);

        $viewHelper = call_user_func($this->factory, $vhm);
        $this->assertInstanceOf('XisoDev\Slugify\Bridge\ZF2\SlugifyViewHelper', $viewHelper);
    }
}
