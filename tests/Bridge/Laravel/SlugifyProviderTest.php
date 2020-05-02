<?php

/**
 * This file is part of xisodev/slugify.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace XisoDev\Slugify\Tests\Bridge\Laravel;

use XisoDev\Slugify\Bridge\Laravel\SlugifyServiceProvider;
use Illuminate\Foundation\Application;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * SlugifyServiceProviderTest
 *
 * @category   test
 * @package    xisodev/slugify
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @author     Colin Viebrock
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 * @group      unit
 */
class SlugifyProviderTest extends MockeryTestCase
{
    /** @var Application */
    private $app;

    /** @var SlugifyServiceProvider */
    private $provider;

    protected function setUp()
    {
        $this->app = new Application();
        $this->provider = new SlugifyServiceProvider($this->app);
    }

    /**
     * @covers \XisoDev\Slugify\Bridge\Laravel\SlugifyServiceProvider::register()
     */
    public function testRegisterRegistersTheServiceProvider()
    {
        $this->provider->register();

        // the service provider is deferred, so this forces it to load
        $this->app->make('slugify');

        $this->assertArrayHasKey('slugify', $this->app);
        $this->assertInstanceOf('XisoDev\Slugify\Slugify', $this->app['slugify']);
    }

    /**
     * @covers \XisoDev\Slugify\Bridge\Laravel\SlugifyServiceProvider::provides()
     */
    public function testContainsReturnsTheNameOfThProvider()
    {
        $this->assertContains('slugify', $this->provider->provides());
    }
}
