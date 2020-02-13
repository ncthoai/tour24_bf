<?php

/*
*	HandlersRegister.php
*	Author: Phuc Lu
*	Date: 2019.06.27
*   Purpose: provide handler register for contact
*/

$registeredEvents = array(
    'vtiger.entity.beforesave',
    'vtiger.entity.aftersave',
    'vtiger.entity.beforedelete',
    'vtiger.entity.afterdelete',
    'vtiger.batchevent.save',
    'vtiger.batchevent.beforedelete',
    'vtiger.batchevent.afterdelete',
    'vtiger.batchevent.beforerestore',
    'vtiger.batchevent.afterrestore',
);

$handlerName = 'ContactHandler';
$batchHandlerName = 'ContactBatchHandler';