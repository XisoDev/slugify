<?php

/**
 * This file is part of xisodev/slugify.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace XisoDev\Slugify\Tests\Bridge\Symfony;

use XisoDev\Slugify\Bridge\Symfony\XisoDevSlugifyExtension;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * XisoDevSlugifyExtensionTest
 *
 * @category   test
 * @package    xisodev/slugify
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 * @group      unit
 */
class XisoDevSlugifyExtensionTest extends MockeryTestCase
{
    protected function setUp()
    {
        $this->extension = new XisoDevSlugifyExtension();
    }

    /**
     * @covers \XisoDev\Slugify\Bridge\Symfony\XisoDevSlugifyExtension::load()
     */
    public function testLoad()
    {
        $twigDefinition = m::mock('Symfony\Component\DependencyInjection\Definition');
        $twigDefinition
            ->shouldReceive('addTag')
            ->with('twig.extension')
            ->once()
            ->andReturn($twigDefinition);
        $twigDefinition
            ->shouldReceive('setPublic')
            ->with(false)
            ->once();

        $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $container
            ->shouldReceive('setDefinition')
            ->with('xisodev_slugify', m::type('Symfony\Component\DependencyInjection\Definition'))
            ->once();
        $container
            ->shouldReceive('setDefinition')
            ->with('xisodev_slugify.twig.slugify', m::type('Symfony\Component\DependencyInjection\Definition'))
            ->once()
            ->andReturn($twigDefinition);
        $container
            ->shouldReceive('setAlias')
            ->with('slugify', 'xisodev_slugify')
            ->once();
        $container
            ->shouldReceive('setAlias')
            ->with('XisoDev\Slugify\SlugifyInterface', 'xisodev_slugify')
            ->once();

        $this->extension->load([], $container);
    }
}
