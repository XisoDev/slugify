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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * XisoDevSlugifyExtension
 *
 * @package    xisodev/slugify
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 */
class XisoDevSlugifyExtension extends Extension
{
    /**
     * {@inheritDoc}
     *
     * @param mixed[]          $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (empty($config['rulesets'])) {
            unset($config['rulesets']);
        }

        // Extract slugify arguments from config
        $slugifyArguments = array_intersect_key($config, array_flip(['lowercase', 'trim', 'strip_tags', 'separator', 'regexp', 'rulesets']));

        $container->setDefinition('xisodev_slugify', new Definition('XisoDev\Slugify\Slugify', [$slugifyArguments]));
        $container
            ->setDefinition(
                'xisodev_slugify.twig.slugify',
                new Definition(
                    'XisoDev\Slugify\Bridge\Twig\SlugifyExtension',
                    [new Reference('xisodev_slugify')]
                )
            )
            ->addTag('twig.extension')
            ->setPublic(false);
        $container->setAlias('slugify', 'xisodev_slugify');
        $container->setAlias('XisoDev\Slugify\SlugifyInterface', 'xisodev_slugify');
    }
}
