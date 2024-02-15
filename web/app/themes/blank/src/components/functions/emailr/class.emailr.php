<?php
//////////////////////////////////////////
// EmailR								//
//////////////////////////////////////////
// SEND AN EMAIL TO CONTACT ARRAY ==============================
//
// Create the contact array with additionnal fields for emailR
// $emails[] = array( 'Email' => $_POST['email_1'], 'data1'=> 'Hello', 'data2' => 'World');
//
// Initiate emailR object
// $emailR = new EmailR( 'UID', 'LOGIN', 'PASSWORD', 'PROFILE UID' );
//
// Send the mails
// $sendMail = $emailR->sendEmail( 'Email_UID', array( 'contacts' => $emails ) );
//
// Print result
// print_r( $sendMail );
//
// SEND AN EMAIL TO CONTACT ARRAY ==============================
////////////////////////////////////////

class EmailR
{

	private		$_UID;
	private		$_login;
	private		$_pasword;
	private		$_profileUID;
	//private 	$_SOAPUrl = 'http://extranet.emailr.com/integration/CampaignSvc.asmx?WSDL';
	private 	$_SOAPUrl = 'http://by.emailr.com/integration/CampaignSvc.asmx?WSDL';

	public function __construct( $UID, $login, $pasword, $profileUID ){

		$this->_UID = $UID;
		$this->_login = $login;
		$this->_pasword = $pasword;
		$this->_profileUID = $profileUID;

	}


////////////////////////////////////////////////////////////////
// CREATES THE ACCOUNT PART OF XML
///////////////////////////////////////////////////////////////

	private function getAccountXML()
	{
		$XMLcontent  = '<Account>';
		$XMLcontent .= '<UID>' . $this->_UID . '</UID>';
		$XMLcontent .= '<Login>' . $this->_login . '</Login>';
		$XMLcontent .= '<Password>' . $this->_pasword . '</Password>';
		$XMLcontent .= '</Account>';

		return 	$XMLcontent;
	}

////////////////////////////////////////////////////////////////
// CREATES THE PROFILE PART OF XML
// $profileArray = array( displayName => '', replyAddress  => '', testEmail => '' );
///////////////////////////////////////////////////////////////

	private function getProfileXML( $array )
	{

		if( isset($array['displayName'] ) )		{ 	$displayName = 	$array['displayName']; }
		if( isset($array['replyAddress'] ) )	{ 	$replyAddress = $array['replyAddress']; }
		if( isset($array['testEmail'] ) )		{ 	$testEmail = 	$array['testEmail']; }


		$XMLcontent  = '<Profile>';
		$XMLcontent .= '<UID>' . $this->_profileUID . '</UID>';

			isset( $displayName ) 	? $XMLcontent .= '<DisplayName><![CDATA[' . $displayName . ']]></DisplayName>' : '';
			isset( $replyAddress )	? $XMLcontent .= '<ReplyAddress>' . $replyAddress . '</ReplyAddress>' : '';
			isset( $testEmail ) 	? $XMLcontent .= '<TestEmails>' . $testEmail . '</TestEmails>' : '';

		$XMLcontent .= '</Profile>';

		return 	$XMLcontent;

	}

////////////////////////////////////////////////////////////////
// CREATES THE CAMPAIGN PART OF XML - CONTACTS GENERATED FROM HERE
// $campaignArray = array( campaignName => '', campaignDate => 'yyyymmddhhmm', campaignSubject => '', bodyHTML => '', bodyText => '', testFirstRow => '', 'contacts' => $contactsArray)
// $contactsArray =
///////////////////////////////////////////////////////////////

	private function getCampaignXML( $array )
	{

		if( isset($array['campaignName'] ) )		{ 	$campaignName = 	$array['campaignName']; }
		if( isset($array['campaignDate'] ) )		{ 	$campaignDate = 	$array['campaignDate']; }
		if( isset($array['subject'] ) )				{ 	$campaignSubject = 	$array['subject']; }
		if( isset($array['bodyHTML'] ) )			{ 	$bodyHTML = 		$array['bodyHTML']; }
		if( isset($array['bodyText'] ) )			{ 	$bodyText =			$array['bodyText']; }
		if( isset($array['testFirstRow'] ) )		{ 	$testFirstRow = 	$array['testFirstRow']; }
		if( isset($array['IsReflex'] ) )			{ 	$IsReflex = 		$array['IsReflex']; }

		if( isset($array['UID'] ) )					{ 	$UID = 				$array['UID']; }
		if( isset($array['Mode'] ) )				{ 	$Mode = 			$array['Mode']; }
		if( isset($array['Send'] ) )				{ 	$Send = 			$array['Send']; }
		if( isset($array['Duplicate'] ) )			{ 	$Duplicate = 		$array['Duplicate']; }


		$XMLcontent = '<Campaign>';

			isset( $UID )				? $XMLcontent .= '<UID>' . $UID . '</UID>' : '';
			isset( $Mode )				? $XMLcontent .= '<Mode>' . $Mode . '</Mode>' : '';
			isset( $Send )				? $XMLcontent .= '<Send>' . $Send . '</Send>' : '';
			isset( $Duplicate )			? $XMLcontent .= '<Duplicate>' . $Duplicate . '</Duplicate>' : '';

			isset( $campaignName )		? $XMLcontent .= '<Name><![CDATA[' . $campaignName . ']]></Name>' : '';
			isset( $campaignDate )		? $XMLcontent .= '<ScheduleDate>' . $campaignDate . '</ScheduleDate>' : '';
			isset( $campaignSubject )	? $XMLcontent .= '<Subject><![CDATA[' . $campaignSubject . ']]></Subject>' : '';
			isset( $bodyHTML )			? $XMLcontent .= '<BodyHtml><![CDATA[' . $bodyHTML . ']]></BodyHtml>' : '';
			isset( $bodyText )			? $XMLcontent .= '<BodyText><![CDATA[' . $bodyText . ']]></BodyText>' : '';
			isset( $testFirstRow )		? $XMLcontent .= '<TestFirstRow>' . $testFirstRow . '</TestFirstRow>' : '';
			isset( $IsReflex )			? $XMLcontent .= '<IsReflex>' . $IsReflex . '</IsReflex>' : '';

			if( isset( $array['contacts'] ) && $array['contacts'] != '')
			{

				$XMLcontent .= $this->createContactXML( $array['contacts'] );

			}

		$XMLcontent .= '</Campaign>';

		return 	$XMLcontent;

	}

////////////////////////////////////////////////////////////////
// CREATES CONTACT XML
//
///////////////////////////////////////////////////////////////

	private function createContactXML( $array )
	{

		if( is_array( $array ) )
		{

			$contacts = '<Contacts>';

			foreach( $array as $contactDetail )
			{
				$contacts.= '<Contact>';

					foreach( $contactDetail as $key => $subValue )
					{
						if( $key != 'Email' && $key != 'UID' && $key != 'DisplayName' )
						{
							$contacts.= "<$key>$subValue</$key>";

						}else{

							$contacts.= "<$key>$subValue</$key>";
						}

					}

				$contacts.= '</Contact>';
			}

			$contacts .= '</Contacts>';

			return $contacts;

		}


	}


////////////////////////////////////////////////////////////////
// CREATES A NEW CAMPAIGN AND RETURN THE CAMPAIGN UID
// $profileArray = array( displayName => '', replyAddress  => '', testEmail => '' );
// $campaignArray = array( campaignName => '', campaignDate => 'yyyymmddhhmm', subject => '', bodyHTML => '', bodyText => '', testFirstRow => '', 'contacts' => $contactsArray)
///////////////////////////////////////////////////////////////

	public function createCampaign( $profileArray, $campaignArray )
	{

		$XMLcontent  = '<ROOT>';

		// ACCOUNT
		$XMLcontent .= $this->getAccountXML();

		// PROFILE
		$XMLcontent .= $this->getProfileXML( $profileArray );

		// CAMPAIGN
		$XMLcontent .= $this->getCampaignXML( $campaignArray );

		$XMLcontent .= '</ROOT>';

		$result = $this->SOAPcall( 'CreateCampaign', $XMLcontent );

		return  $this->xmlstr_to_array( $result->CreateCampaignResult );

	}


////////////////////////////////////////////////////////////////
// UPDATE A CAMPAIGN
///////////////////////////////////////////////////////////////

	public function updateCampaign( $campaignUID, $profileArray = '', $campaignArray = '' )
	{

		$XMLcontent  = '<ROOT>';

		// ACCOUNT
		$XMLcontent .= $this->getAccountXML();

		// PROFILE // OPTIONAL
		if( is_array( $profileArray ) ){

			$XMLcontent .=	$this->getProfileXML( $profileArray );

		}

		// CAMPAIGN // OPTIONAL
		if( is_array( $campaignArray ) ){

			$XMLcontent .=	$this->getCampaignXML( $campaignArray );

		}

		$XMLcontent .= '</ROOT>';

	}

////////////////////////////////////////////////////////////////
// ADD CONTACTS AND SEND THE NEW EMAIL
///////////////////////////////////////////////////////////////

	public function sendEmail( $campaignUID, $campaignArray = '' )
	{

		$XMLcontent  = '<ROOT>';

		// ACCOUNT
		$XMLcontent .= $this->getAccountXML();

		// CAMPAIGN // OPTIONAL
		if( is_array( $campaignArray ) ){

			$campaignArray['UID'] = $campaignUID;
			$campaignArray['Mode'] = 'APPEND';
			$campaignArray['Send'] = 1;
			$campaignArray['Duplicate'] = 1;

			$XMLcontent .=	$this->getCampaignXML( $campaignArray );

		}

		$XMLcontent .= '</ROOT>';
		$result = $this->SOAPcall( 'AddContacts', $XMLcontent );

		return  $result;

	}


////////////////////////////////////////////////////////////////
// USE SOAP TO CALL FUNCTION
///////////////////////////////////////////////////////////////

	private function SOAPcall( $function, $XML = '' )
	{
		if( $XML == '' )
		{

			return 'XML not complete';

		}else{

			$params = array(
				'xml' => $XML
			);

		}

		$client = new SoapClient( $this->_SOAPUrl );

		return $client->$function($params);

	}

	/**
	 * convert xml string to php array - useful to get a serializable value
	 *
	 * @param string $xmlstr
	 * @return array
	 * @author Adrien aka Gaarf
	 */
	private function xmlstr_to_array($xmlstr) {
	  $doc = new DOMDocument();
	  $doc->loadXML($xmlstr);
	  return $this->domnode_to_array($doc->documentElement);
	}

	private function domnode_to_array($node) {
	  $output = array();
	  switch ($node->nodeType) {
	   case XML_CDATA_SECTION_NODE:
	   case XML_TEXT_NODE:
		$output = trim($node->textContent);
	   break;
	   case XML_ELEMENT_NODE:
		for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
		 $child = $node->childNodes->item($i);
		 $v = $this->domnode_to_array($child);
		 if(isset($child->tagName)) {
		   $t = $child->tagName;
		   if(!isset($output[$t])) {
			$output[$t] = array();
		   }
		   $output[$t][] = $v;
		 }
		 elseif($v) {
		  $output = (string) $v;
		 }
		}
		if(is_array($output)) {
		 if($node->attributes->length) {
		  $a = array();
		  foreach($node->attributes as $attrName => $attrNode) {
		   $a[$attrName] = (string) $attrNode->value;
		  }
		  $output['@attributes'] = $a;
		 }
		 foreach ($output as $t => $v) {
		  if(is_array($v) && count($v)==1 && $t!='@attributes') {
		   $output[$t] = $v[0];
		  }
		 }
		}
	   break;
	  }
	  return $output;
	}

}

?>
