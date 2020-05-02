<?php

namespace XisoDev\Slugify\Bridge\ZF2;

use XisoDev\Slugify\SlugifyInterface;
use Zend\View\Helper\AbstractHelper;

/**
 * Class SlugifyViewHelper
 * @package    xisodev/slugify
 * @subpackage bridge
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 */
class SlugifyViewHelper extends AbstractHelper
{
    /**
     * @var SlugifyInterface
     */
    protected $slugify;

    /**
     * @param SlugifyInterface $slugify
     *
     * @codeCoverageIgnore
     */
    public function __construct(SlugifyInterface $slugify)
    {
        $this->slugify = $slugify;
    }

    /**
     * @param string      $string
     * @param string|null $separator
     *
     * @return string
     */
    public function __invoke($string, $separator = null)
    {
        return $this->slugify->slugify($string, $separator);
    }
}
