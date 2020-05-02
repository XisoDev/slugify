<?php

namespace XisoDev\Slugify\Bridge\ZF2;

use XisoDev\Slugify\Slugify;
use Zend\View\HelperPluginManager;

/**
 * Class SlugifyViewHelperFactory
 * @package    xisodev/slugify
 * @subpackage bridge
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 */
class SlugifyViewHelperFactory
{
    /**
     * @param HelperPluginManager $vhm
     *
     * @return SlugifyViewHelper
     */
    public function __invoke($vhm)
    {
        /** @var Slugify $slugify */
        $slugify = $vhm->getServiceLocator()->get('XisoDev\Slugify\Slugify');

        return new SlugifyViewHelper($slugify);
    }
}
