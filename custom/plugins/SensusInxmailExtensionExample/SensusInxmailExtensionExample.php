<?php

namespace SensusInxmailExtensionExample;

use Shopware\Components\Plugin;

/**
 * Class SensusInxmailExtensionExample
 * @package SensusInxmailExtensionExample
 * @author Philipp Mahlow <philipp.mahlow@sensus-media.de>
 *
 * This is an example for extending the transmitted data of the shopware plugin SensusInxmailConnect
 *
 * @see https://store.shopware.com/sensu29411171111/inxmail-connect-fuer-shopware-professionelles-e-mail-marketing.html
 */
class SensusInxmailExtensionExample extends Plugin
{
    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            /*
             * This event will be thrown for each subscriber, that will be transmitted to inxmail via SensusInxmailConnect.
             */
            'Sensus_Inxmail_Connect_Map_Data' => 'addData'
        ];
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     */
    public function addData(\Enlight_Event_EventArgs $args)
    {
        /** @var array $data */
        $data = $args->getReturn();
        /** @var string $email */
        $email = $args->get('email');
        /** @var string $listID */
        $listID = $args->get('listID');
        /** @var string|NULL $customerGroupKey */
        $customerGroupKey = $args->get('customergroup');
        /** @var int|NULL $newsletterGroupID */
        $newsletterGroupID = $args->get('newslettergroup');

        /*
         * $data is an associative array, where the keys are the fields in Inxmail and the values are the actual
         * values for the actual subscriber.
         *
         * Please double check the field definition in the specific inxmail list and if necessary use an if condition,
         * switch statement or something like this to determine which fields should be transmitted for the actual inxmail
         * list ($listID) or the given customer group ($customerGroupKey) or the given newsletter group ($nesletterGroupID)
         */
        $data["foo"] = "bar";

        /*
         * You can use some database queries here or ask whatever api, cache layer for data and add all the special data here.
         * The event will be thrown past the queries in SensusInxmailConnect and just before transmission to the inxmail api.
         */

        $args->setReturn($data);
    }
}