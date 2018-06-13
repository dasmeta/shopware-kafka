<?php

namespace OvipCustomerNamesFix\Subscriber;

use Enlight\Event\SubscriberInterface;

class OvipCollectevents implements SubscriberInterface
{
    /** @var \Shopware_Components_Plugin_Bootstrap */
    private $bootstrap;

    /**
     * Service constructor.
     * @param \Shopware_Components_Plugin_Bootstrap $bootstrap
     */
    public function __construct(\Shopware_Components_Plugin_Bootstrap $bootstrap)
    {
        $this->bootstrap = $bootstrap;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Bootstrap_InitResource_OvipCollectEvents' => 'onCollectEvents',
        ];
    }

    public function onCollectEvents()
    {
        return new OvipCollectevents();
    }
}
