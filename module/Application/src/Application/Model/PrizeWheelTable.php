<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\PrizeWheel;

class PrizeWheelTable implements PrizeWheelDataSourceInterface
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	} // ctor
	
	public function fetchAll($page=1, $size=25, &$count)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
				->join(array("pt" => "prizewheel_types"),
					"pt.id = prizewheels.prizewheeltypeid",
					array("prizewheeltypename" => "name")
				)
			   ->order('id DESC')
		       ->offset(($page - 1) * $size)
		       ->limit($size);
		
		$results = $this->tableGateway->selectWith($select);
		
		$count = $this->getCount();
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	} // fetchAll
	
	public function getCount()
	{
		$stmt = $this->tableGateway->getAdapter()->createStatement("SELECT count(id) as count FROM prizewheels");
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function fetchAllByAffiliateId($affiliateid, $page=1, $size=25)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$affiliateid = (int)$affiliateid;
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
			   ->join(array("pt" => "prizewheel_types"),
			   		  "pt.id = prizewheel.prizewheeltypeid",
			   		  array("prizewheeltypename" => "pt.name")
			   	)
			   ->where(array('affiliateid' => $affiliateid))
			   ->order('id DESC')
		       ->offset(($page - 1) * $size)
		       ->limit($size);
	
		$results = $this->tableGateway->selectWith($select);
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	} // fetchAllByAffiliateId
	
	public function fetchAllEnabledByAffiliateId($affiliateid, $page=1, $size=25)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$id = (int)$affiliateid;
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
				->join(array("pt" => "prizewheel_types"),
				       "pt.id = prizewheels.prizewheeltypeid",
				       array("prizewheeltypename" => "name")
				)
		       ->where(array('affiliateid' => $id, 'enabled' => 1))
		       ->order('id DESC')
		       ->offset(($page - 1) * $size)
		       ->limit($size);
		
		$results = $this->tableGateway->selectWith($select);
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	} // fetchAllEnabledByAffiliateId
	
	/**
	 * 
	 * @param unknown $prizewheelid
	 * @return \Application\Model\PrizeWheel
	 */
	public function getPrizeWheel($prizewheelid)
	{
		$prizewheelid = (int)$prizewheelid;
		$results = $this->tableGateway->select(array('id' => $prizewheelid));
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	} // getPrizeWheel
	
	public function getPrizeWheelByPageId($pageid)
	{
		$pageid = (string)$pageid;
		$results = $this->tableGateway->select(array('pageid' => $pageid));
		$result = $results->current();
		
		if(!$results){
			return null;
		} // if
		
		return $result;
	} // getPrizeWheelByPageId
	
	public function save(PrizeWheel $prizeWheel)
	{
		$id = (int)$prizeWheel->id();
		$pageid = (string)$prizeWheel->pageId();
		
		$data = array(
			'prizewheeltypeid' => $prizeWheel->prizeWheelTypeId(),
			'pageid' => $prizeWheel->pageId(),
			'affiliateid' => $prizeWheel->affiliateId(),
			'forcelike' => $prizeWheel->forceLike() ? 1 : 0,
			'forcelikeimage' => $prizeWheel->forceLikeImage(),
			'firsttext' => $prizeWheel->firstText(),
			'validemail' => $prizeWheel->validEmail(),
			'alreadyplayed' => $prizeWheel->alreadyPlayed(),
			'errorsubmit' => $prizeWheel->errorSubmit(),
			'errorprize' => $prizeWheel->errorPrize(),
			'accesserror' => $prizeWheel->accessError(),
			'accesslimit' => $prizeWheel->accessLimit(),
			'textrules' => $prizeWheel->textRules(),
			'prizeonename' => $prizeWheel->prizeOneName(),
			'prizeonecode' => $prizeWheel->prizeOneCode(),
			'prizeonetext' => $prizeWheel->prizeOneText(),
			'prizeonetextsize' => $prizeWheel->prizeOneTextSize(),
			'prizeoneimage' => $prizeWheel->prizeOneImage(),
			'prizeoneurl' => $prizeWheel->prizeOneUrl(),
			'prizeoneweight' => $prizeWheel->prizeOneWeight(),
			'prizetwoname' => $prizeWheel->prizeTwoName(),
			'prizetwocode' => $prizeWheel->prizeTwoCode(),
			'prizetwotext' => $prizeWheel->prizeTwoText(),
			'prizetwotextsize' => $prizeWheel->prizeTwoTextSize(),
			'prizetwoimage' => $prizeWheel->prizeTwoImage(),
			'prizetwourl' => $prizeWheel->prizeTwoUrl(),
			'prizetwoweight' => $prizeWheel->prizeTwoWeight(),
			'prizethreename' => $prizeWheel->prizeThreeName(),
			'prizethreecode' => $prizeWheel->prizeThreeCode(),
			'prizethreetext' => $prizeWheel->prizeThreeText(),
			'prizethreetextsize' => $prizeWheel->prizeThreeTextSize(),
			'prizethreeimage' => $prizeWheel->prizeThreeImage(),
			'prizethreeurl' => $prizeWheel->prizeThreeUrl(),
			'prizethreeweight' => $prizeWheel->prizeThreeWeight(),
			'prizefourname' => $prizeWheel->prizeFourName(),
			'prizefourcode' => $prizeWheel->prizeFourCode(),
			'prizefourtext' => $prizeWheel->prizeFourText(),
			'prizefourtextsize' => $prizeWheel->prizeFourTextSize(),
			'prizefourimage' => $prizeWheel->prizeFourImage(),
			'prizefoururl' => $prizeWheel->prizeFourUrl(),
			'prizefourweight' => $prizeWheel->prizeFourWeight(),
			'prizefivename' => $prizeWheel->prizeFiveName(),
			'prizefivecode' => $prizeWheel->prizeFiveCode(),
			'prizefivetext' => $prizeWheel->prizeFiveText(),
			'prizefivetextsize' => $prizeWheel->prizeFiveTextSize(),
			'prizefiveimage' => $prizeWheel->prizeFiveImage(),
			'prizefiveurl' => $prizeWheel->prizeFiveUrl(),
			'prizefiveweight' => $prizeWheel->prizeFiveWeight(),
			'prizesixname' => $prizeWheel->prizeSixName(),
			'prizesixcode' => $prizeWheel->prizeSixCode(),
			'prizesixtext' => $prizeWheel->prizeSixText(),
			'prizesixtextsize' => $prizeWheel->prizeSixTextSize(),
			'prizesiximage' => $prizeWheel->prizeSixImage(),
			'prizesixurl' => $prizeWheel->prizeSixUrl(),
			'prizesixweight' => $prizeWheel->prizeSixWeight(),
			'prizesevenname' => $prizeWheel->prizeSevenName(),
			'prizesevencode' => $prizeWheel->prizeSevenCode(),
			'prizeseventext' => $prizeWheel->prizeSevenText(),
			'prizeseventextsize' => $prizeWheel->prizeSevenTextSize(),
			'prizesevenimage' => $prizeWheel->prizeSevenImage(),
			'prizesevenurl' => $prizeWheel->prizeSevenUrl(),
			'prizesevenweight' => $prizeWheel->prizeSevenWeight(),
			'prizeeightname' => $prizeWheel->prizeEightName(),
			'prizeeightcode' => $prizeWheel->prizeEightCode(),
			'prizeeighttext' => $prizeWheel->prizeEightText(),
			'prizeeighttextsize' => $prizeWheel->prizeEightTextSize(),
			'prizeeightimage' => $prizeWheel->prizeEightImage(),
			'prizeeighturl' => $prizeWheel->prizeEightUrl(),
			'prizeeightweight' => $prizeWheel->prizeEightWeight(),
			'prizeninename' => $prizeWheel->prizeNineName(),
			'prizeninecode' => $prizeWheel->prizeNineCode(),
			'prizeninetext' => $prizeWheel->prizeNineText(),
			'prizeninetextsize' => $prizeWheel->prizeNineTextSize(),
			'prizenineimage' => $prizeWheel->prizeNineImage(),
			'prizenineurl' => $prizeWheel->prizeNineUrl(),
			'prizenineweight' => $prizeWheel->prizeNineWeight(),
			'prizetenname' => $prizeWheel->prizeTenName(),
			'prizetencode' => $prizeWheel->prizeTenCode(),
			'prizetentext' => $prizeWheel->prizeTenText(),
			'prizetentextsize' => $prizeWheel->prizeTenTextSize(),
			'prizetenimage' => $prizeWheel->prizeTenImage(),
			'prizetenurl' => $prizeWheel->prizeTenUrl(),
			'prizetenweight' => $prizeWheel->prizeTenWeight(),
			'prizeelevenname' => $prizeWheel->prizeElevenName(),
			'prizeelevencode' => $prizeWheel->prizeElevenCode(),
			'prizeeleventext' => $prizeWheel->prizeElevenText(),
			'prizeeleventextsize' => $prizeWheel->prizeElevenTextSize(),
			'prizeelevenimage' =>$prizeWheel->prizeElevenImage(),
			'prizeelevenurl' => $prizeWheel->prizeElevenUrl(),
			'prizeelevenweight' => $prizeWheel->prizeElevenWeight(),
			'prizetwelvename' => $prizeWheel->prizeTwelveName(),
			'prizetwelvecode' => $prizeWheel->prizeTwelveCode(),
			'prizetwelvetext' => $prizeWheel->prizeTwelveText(),
			'prizetwelvetextsize' => $prizeWheel->prizeTwelveTextSize(),
			'prizetwelveimage' => $prizeWheel->prizeTwelveImage(),
			'prizetwelveurl' => $prizeWheel->prizeTwelveUrl(),
			'prizetwelveweight' => $prizeWheel->prizeTwelveWeight(),
			'sponserimage' => $prizeWheel->sponserImage(),
			'sponserlink' => $prizeWheel->sponserLink(),
			'backimage' => $prizeWheel->backImage(),
			'topimage' => $prizeWheel->topImage(),
			'buttonimage' => $prizeWheel->buttonImage(),
			'sendemailnotifications' => $prizeWheel->sendEmailNotifications() ? 1 : 0,
			'notificationemailaddress' => $prizeWheel->notificationEmailAddress(),
			'smtpserver' => $prizeWheel->smtpServer(),
			'smtpusername' => $prizeWheel->smtpUserName(),
			'smtppassword' => $prizeWheel->smtpPassword(),
			'smtpport' => $prizeWheel->smtpPort(),
			'smtpfromaddress' => $prizeWheel->smtpFromAddress(),
			'smtpencryption' => $prizeWheel->smtpEncryption(),
			'smtpauthmethod' => $prizeWheel->smtpAuthMethod(),
			'notificationemailsubject' => $prizeWheel->notificationEmailSubject(),
			'notificationemailbody' => $prizeWheel->notificationEmailBody(),
			'ipaddressfilter' => $prizeWheel->ipAddressFilter() ? 1 : 0,
			'phonefilter' => $prizeWheel->phoneFilter() ? 1 : 0,
			'emailfilter' => $prizeWheel->emailFilter() ? 1 : 0,
			'enabled' => $prizeWheel->enabled() ? 1 : 0
		);

		if($id > 0){
			if(!$this->getPrizeWheel($id)){
				throw new \Exception("Could not locate PrizeWheel with the id $id");
			} // if
			else{
				$this->tableGateway->update($data, array('id' => $id)) <= 0;
 			} // else
 		} // if
		else{
			
			$found = $this->getPrizeWheelByPageId($pageid);
			
			if(!$found){			
				if($this->tableGateway->insert($data) > 0){
					$prizeWheel->id((int)$this->tableGateway->lastInsertValue);
				} // if
				else{
					throw new \Exception("There was an error while attempting to insert a new Prize Wheel into the data-store.");
				} // else
			} // if
			else if($found->enabled() == false){
				$this->tableGateway->update(array('enabled' => 1), array('id' => $found->id()));
			} // else if
			else{
				throw new \Exception("A Prize Wheel has already been installed for that Facebook Page.");
			} // else
		} // else
	} // save
	
	public function delete($id)
	{
		$id = (int)$id;
		
		$this->tableGateway->delete(array('id' => $id));
	} // delete
	
	public function disable($id)
	{
		$id = (int)$id;
		
		$this->tableGateway->update(array('enabled' => 0), array('id' => $id));
	} // disable
} // PrizeWheelTable