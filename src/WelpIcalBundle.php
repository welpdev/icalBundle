<?php

namespace Welp\IcalBundle;

use Welp\IcalBundle\DependencyInjection\WelpIcalExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class WelpIcalBundle extends Bundle
{
    /**
     * Get container extension
     *
     * @return ExtensionInterface
     */
    public function getContainerExtension()
    {
        if (!$this->extension instanceof ExtensionInterface) {
            $this->extension = new WelpIcalExtension();
        }

        return $this->extension;
    }
}
