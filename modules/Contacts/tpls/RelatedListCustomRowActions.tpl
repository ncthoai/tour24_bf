{*
    File RelatedListCustomRowActions.tpl
    Author: Hieu Nguyen
    Date: 2019-12-26
    Purpose: to add custom buttons in related list rows
*}

{strip}
    {if $RELATED_MODULE_NAME eq 'Calendar'}
        {assign var="HAS_RECORDING" value=PBXManager_RecordingPopup_View::hasRecording($RELATED_RECORD->getId())}

        {if $HAS_RECORDING eq true}
            <a class="play-recording" data-call-id="{$RELATED_RECORD->getId()}" data-popup-title="{vtranslate('LBL_RECORDING_POPUP_TITLE', 'PBXManager', ['%call_subject' => $RELATED_RECORD->get('subject')])}">
                <i title="{vtranslate('LBL_RECORDING_POPUP_PLAY_RECORDING', 'PBXManager')}" class="fa fa-play"></i>
            </a>
        {/if}
    {/if}
{/strip}