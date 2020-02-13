<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

//Same as Accounts Detail View
class Contacts_DetailView_Model extends Accounts_DetailView_Model {

    // Added by Hieu Nguyen on 2019-07-16
    public function getDetailViewLinks($linkParams) {
        require_once('libraries/ArrayUtils/ArrayUtils.php');
        $detailViewLinks = parent::getDetailViewLinks($linkParams);

        if(CPSocialIntegration_Config_Helper::isZaloMessageAllowed()) {
            $zaloMessageLink = array(
                'linktype' => 'DETAILVIEW',
                'linklabel' => 'LBL_SOCIAL_INTEGRATION_SEND_ZALO_MESSAGE',
                'linkurl' => 'javascript:SocialHandler.composeSocialMessage("Zalo");',
                'linkicon' => ''
            );

            // Insert button send zalo message right after button send sms
            array_insert_after_index($detailViewLinks['DETAILVIEW'], 2, Vtiger_Link_Model::getInstanceFromValues($zaloMessageLink));
        }

        if(CPSocialIntegration_Config_Helper::isZaloMessageAllowed()) {
            $shareZaloContactInfoRequestLink = array(
                'linktype' => 'DETAILVIEW',
                'linklabel' => 'LBL_SOCIAL_INTEGRATION_REQUEST_SHARE_ZALO_CONTACT_INFO',
                'linkurl' => 'javascript:SocialHandler.triggerRequestShareZaloContactInfo();',
                'linkicon' => ''
            );

            // Insert button send zalo message right after button send zalo message
            array_insert_after_index($detailViewLinks['DETAILVIEW'], 3, Vtiger_Link_Model::getInstanceFromValues($shareZaloContactInfoRequestLink));
        }

        // Added by Phuc on 2019.10.04 to hide Campaign tab
		$removedLinks = [
			'Campaigns', 
		];

		$detailRelatedLinks = [];

		foreach ($detailViewLinks['DETAILVIEWRELATED'] as $index => $link) {
			if (!in_array($link->linklabel, $removedLinks)) {
				$detailRelatedLinks[] = $detailViewLinks['DETAILVIEWRELATED'][$index];
			}
		}

		$detailViewLinks['DETAILVIEWRELATED'] = $detailRelatedLinks;
		// Ended by Phuc

        return $detailViewLinks;
    }
	
	// Added by Phu Vo on 2019.08.20 to remove sub panel Social Article Log
	public function getDetailViewRelatedLinks() {
        $relatedLinks = parent::getDetailViewRelatedLinks();

        foreach ($relatedLinks as $key => $relatedLink) {
            if (isset($relatedLink['relatedModuleName']) && $relatedLink['relatedModuleName'] == 'CPSocialArticleLog') {
                unset($relatedLinks[$key]);
                break;
            }
        }

		return $relatedLinks;
	}
	// End Phu Vo
}
