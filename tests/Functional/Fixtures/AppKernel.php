<?php


if (!class_exists('\\AppKernel')) {

    /**
     * Class AppKernel
     */
    class AppKernel extends \Symfony\Component\HttpKernel\Kernel
    {
        /**
         * @return array
         */
        public function registerBundles()
        {
            $bundles = [
                new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
                new Tests\Functional\Fixtures\TestBundle\TestBundle()
            ];

            return $bundles;
        }

        /**
         * @param \Symfony\Component\Config\Loader\LoaderInterface $loader
         */
        public function registerContainerConfiguration(\Symfony\Component\Config\Loader\LoaderInterface $loader)
        {
            $currentDir = __DIR__;

            $configs = [
                //"{$currentDir}/../../../vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/config/services.xml",
                //"{$currentDir}/../../../vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/config/web.xml",
            ];

            foreach ($configs as $configFile) {
                if (!($realPath = realpath($configFile))) {
                    trigger_error("file {$configFile} doesn't exist", E_USER_ERROR);
                    return;
                }
                $loader->load(realpath($configFile));
            }

            $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
        }
    }
}