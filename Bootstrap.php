<?php

/**
 * Class Shopware_Plugins_Backend_OvipCustomerNamesFix_Bootstrap
 */
class Shopware_Plugins_Backend_OvipCollectEvents_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{

    public $argv = [];

    public function getInfo()
    {
        return array(
            'version' => '1.0.0',
            'copyright' => 'Copyright (c) 2016, Lagardère Sports Germany GmbH',
            'autor' => 'Lagardère Sports Germany GmbH',
            'supplier' => 'Lagardère Sports Germany GmbH',
            'label' => '<sup style="vertical-align:super">ovip</sup>&nbsp;OvipCollectEvents',
            'support' => 'http://www.official-vip.com/',
            'link' => 'http://www.official-vip.com/',
            'revision' => '1'
        );
    }

    public function install()
    {
        $this->subscribeEvent(
            'Shopware_Modules_Order_GetOrdernumber_FilterOrdernumber',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Modules_Order_SaveOrder_FilterParams',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Modules_Order_SaveOrder_FilterDetailsSQL',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Modules_Order_SaveOrder_ProcessDetails',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'product_stock_was_changed',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Modules_Order_SendMail_FilterVariables',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Modules_Order_SendMail_Create',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Modules_Order_SendMail_Filter',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Modules_Order_SendMail_BeforeSend',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Modules_Order_SendMail_Send',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Modules_Order_SaveBilling_FilterSQL',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Modules_Order_SaveBilling_FilterArray',
            'onEventCollectArgs'
        );


        $this->subscribeEvent(
            'Shopware_Modules_Order_SaveShipping_FilterSQL',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Modules_Order_SaveShipping_FilterArray',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Controllers_Backend_OrderState_Send_BeforeSend',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Controllers_Backend_OrderState_Notify',
            'onEventCollectArgs'
        );

        $this->subscribeEvent(
            'Shopware_Controllers_Backend_OrderState_Filter',
            'onEventCollectArgs'
        );

        return ['success' => true, 'invalidateCache' => ['backend']];
    }

    public function onEventCollectArgs(Enlight_Event_EventArgs $args)
    {
        $this->argv [$args->getName()] = $this->removeObjects($args->get('subject'));

        return json_encode($this->argv);

    }


    public function removeObjects(&$array)
    {

        if (!$this->ifForeachable($array) && $array) {
            $array = $this->getVars($array);
        }
        if (!($array instanceof PDO)) {
            foreach ($array as $key => $arr) {
                if (is_object($arr)) {
                    unset($array[$key]);
                }
                if (is_array($arr)) {
                    $this->removeObjects($arr);
                }

            }
            return $array;
        }
        return ['empty' => true];

    }

    public function getVars($notarr)
    {
        return get_object_vars($notarr);
    }

    public function ifForeachable($var)
    {
        return is_array($var) ||
        ($var instanceof ArrayAccess &&
            $var instanceof Traversable &&
            $var instanceof Serializable &&
            $var instanceof Countable);
    }


}



































