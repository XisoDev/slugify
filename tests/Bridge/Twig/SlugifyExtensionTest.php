<?php

/**
 * This file is part of xisodev/slugify.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace XisoDev\Slugify\Tests\Bridge\Twig;

use XisoDev\Slugify\Bridge\Twig\SlugifyExtension;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * SlugifyExtensionTest
 *
 * @category   test
 * @package    xisodev/slugify
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 * @group      unit
 */
class SlugifyExtensionTest extends MockeryTestCase
{
    /**
     * @var \XisoDev\Slugify\SlugifyInterface|\Mockery\MockInterface
     */
    protected $slugify;

    /**
     * @var SlugifyExtension
     */
    protected $extension;

    protected function setUp()
    {
        $this->slugify = m::mock('XisoDev\Slugify\SlugifyInterface');
        $this->extension = new SlugifyExtension($this->slugify);
    }

    /**
     * @covers \XisoDev\Slugify\Bridge\Twig\SlugifyExtension::getFilters()
     */
    public function testGetFilters()
    {
        $filters = $this->extension->getFilters();

        $this->assertCount(1, $filters);
        $this->assertInstanceOf('\Twig\TwigFilter', $filters[0]);
    }

    /**
     * @covers \XisoDev\Slugify\Bridge\Twig\SlugifyExtension::slugifyFilter()
     */
    public function testSlugifyFilter()
    {
        $this->slugify->shouldReceive('slugify')->with('hällo wörld', '_')->once()->andReturn('haello_woerld');

        $this->assertEquals('haello_woerld', $this->extension->slugifyFilter('hällo wörld', '_'));
    }
}
