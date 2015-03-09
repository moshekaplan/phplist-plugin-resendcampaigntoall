<?php
/**
 * ResendCampaignToAll plugin for phplist
 * 
 *
 * This plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * @category  phplist
 * @package   ResendCampaignToAll
 * @author    Moshe Kaplan
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, Version 3
 */
 
class resendcampaigntoall extends phplistPlugin
{
  public $name = "ResendCampaignToAll plugin for phpList";
  public $coderoot = "resendcampaigntoall/";
  public $version = "0.2";
  public $description = 'Enables resending of all messages when a campaign is resent';
  public $settings = array(
    "resendcampaigntoall_enabled" => array (
      'value' => "0",
      'description' => "When a campaign is resent, should all users re-receive the email?",
      'type' => "boolean",
      'allowempty' => 0,
      "max" => 1000,
      "min" => 0,
      'category'=> 'resendcampaigntoall',
    ),
  );
  
    function resendcampaigntoall(){
        parent::phplistplugin();
        $this->coderoot = dirname(__FILE__).'/resendcampaigntoall/';
    }
    
    function activate(){
        return true;
    }
    
    /* messageReQueued
    * called when a message is placed back in the queue
    * @param integer id message id
    * @return null
    */
    function messageReQueued($id) {
        if (getConfig('resendcampaigntoall_enabled')){
            Sql_query(sprintf('delete from %s where messageid = %d', $GLOBALS['tables']['usermessage'],$id));
        }
    }
}
?>