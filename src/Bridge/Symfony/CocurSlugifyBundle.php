<?php

/**
 * This file is part of xisodev/slugify.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace XisoDev\Slugify\Bridge\Symfony;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * XisoDevSlugifyBundle
 *
 * @package    xisodev/slugify
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 */
class XisoDevSlugifyBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new XisoDevSlugifyExtension();
    }
}
