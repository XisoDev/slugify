<?php

/**
 * This file is part of xisodev/slugify.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace XisoDev\Slugify\Tests\Bridge\Plum;

use XisoDev\Slugify\Bridge\Plum\SlugifyConverter;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * SlugifyConverterTest
 *
 * @package   XisoDev\Slugify\Bridge\Plum
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2012-2015 Florian Eckerstorfer
 * @group     unit
 */
class SlugifyConverterTest extends MockeryTestCase
{
    /**
     * @covers \XisoDev\Slugify\Bridge\Plum\SlugifyConverter::__construct()
     * @covers \XisoDev\Slugify\Bridge\Plum\SlugifyConverter::convert()
     */
    public function testConvertSlugifiesString()
    {
        $slugify = Mockery::mock('XisoDev\Slugify\SlugifyInterface');
        $slugify->shouldReceive('slugify')->with('Hello World')->once()->andReturn('hello_world');
        $converter = new SlugifyConverter($slugify);

        $this->assertSame('hello_world', $converter->convert('Hello World'));
    }

    /**
     * @covers \XisoDev\Slugify\Bridge\Plum\SlugifyConverter::__construct()
     * @covers \XisoDev\Slugify\Bridge\Plum\SlugifyConverter::convert()
     */
    public function testConstructorCreatesSlugifyIfNoneIsProvided()
    {
        $converter = new SlugifyConverter();

        $this->assertSame('hello-world', $converter->convert('Hello World'));
    }
}
