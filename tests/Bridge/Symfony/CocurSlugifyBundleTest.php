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

use XisoDev\Slugify\Bridge\Symfony\XisoDevSlugifyBundle;
use XisoDev\Slugify\Bridge\Symfony\XisoDevSlugifyExtension;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * XisoDevSlugifyBundleTest
 *
 * @category   test
 * @package    xisodev/slugify
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 * @group      unit
 */
class XisoDevSlugifyBundleTest extends MockeryTestCase
{
    /**
     * @covers \XisoDev\Slugify\Bridge\Symfony\XisoDevSlugifyBundle::getContainerExtension()
     */
    public function testGetContainerExtension()
    {
        $bundle = new XisoDevSlugifyBundle();

        static::assertInstanceOf(XisoDevSlugifyExtension::class, $bundle->getContainerExtension());
    }
}
