<?php
/*
*	ContactsHandler.php
*	Author: Phuc Lu
*	Date: 2019.06.27
*   Purpose: provide handler events for contact
*/

class ContactHandler extends VTEventHandler {

	function handleEvent($eventName, $entityData) {
		if($entityData->getModuleName() != 'Contacts') return;
		
		if($eventName === 'vtiger.entity.beforesave') {
			// Add handler functions here
		}

		if($eventName === 'vtiger.entity.aftersave') {
			$this->syncToMautic($entityData);
		}

		if($eventName === 'vtiger.entity.beforedelete') {
			// Add handler functions here
		}

		if($eventName === 'vtiger.entity.afterdelete') {			
			$this->deleteFromMautic($entityData);
		}

	}

	private function deleteFromMautic($entityData) {
		require_once('include/utils/MauticUtils.php');
		
		if(!empty($entityData->get('mautic_id'))) {
			$contactInstance = MauticUtils::getAPIInstance('contacts');

			if ($contactInstance) $contactInstance->delete($entityData->get('mautic_id')); // Updated by Phuc on 2019.10.31 to fix error if the config is empty
		}
	}

	private function syncToMautic($entityData) {
		require_once('include/utils/MauticUtils.php');
		
		// Logic here
	}
}