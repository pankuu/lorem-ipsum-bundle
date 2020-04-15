<?php

namespace KnpU\LoremIpsumBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class KnpULoremIpsumExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $configs = $this->processConfiguration($configuration, $configs);
        $definition = $container->getDefinition('knpu_lorem_ipsum.knpu_ipsum');

        if (null !== $configs['word_provider']) {
            $container->setAlias('knpu_lorem_ipsum.word_provider', $configs['word_provider']);
        }

        $definition->setArgument(1, $configs['unicorns_are_true']);
        $definition->setArgument(2, $configs['min_sunshine']);
    }

    public function getAlias()
    {
        return 'knpu_lorem_ipsum';
    }
}