<?php

class Review{
	private $con;
	private $userId;
	private $productId;
	private $review;
	public $errorArray;
	private $sentiment;

	public function __construct($userId,$productId,$con){
		$this->con=$con;
		$this->errorArray=array();
		$this->userId=$userId;
		$this->productId=$productId;
	}
	public function getError($error){
		if(!in_array($error,$this->errorArray)){
			$error="";
		}
		return "<span>$error</span>";
	}

	private function validateReviewLength($re){
		if (strlen($re)<10){
			array_push($this->errorArray,Constants::$reviewLength);
			return;
		}
	}
	private function validateUniqueReview($re){
		$query = "SELECT COUNT(*) FROM reviews WHERE userId=? AND productId=? ";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('ss',$this->userId,$this->productId);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
		if ($result!=0){
			array_push($this->errorArray,Constants::$alreadyReviewed);
			return;
		}
	}
	private function insertReview($re){

		$url="http://localhost:5000/predict";
		$ch=curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$data =  array(
      		"review"=> $re
  		);
  		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$reaction= curl_exec($ch);
		curl_close($ch);
		$this->sentiment=$reaction;
		$query = "INSERT INTO reviews (userId,productId,review,sentiment) VALUES (?,?,?,?)";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('ssss',$this->userId,$this->productId,$re,$reaction);
        $stmt->execute();
        $stmt->fetch();
	}
	public function getSentiment(){
		return $this->sentiment;
	}

	public function review($re){
		$this->validateReviewLength($re);
		$this->validateUniqueReview($re);
		if(empty(($this->errorArray))==true){
			return $this->insertReview($re);
		}
		else {
			return false;
		}
	}

}
?>