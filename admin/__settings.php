<?php
// if (!isset($init_common)) exit;

	$lklist["paytype"] = array();
	$lklist["paytype"][1] = "PayPal";
	$lklist["paytype"][2] = "Bank-In";

	$lklist["disctype"] = array("Percent","Reduce");
	$lklist["pstatus"] = array("In Stock","Out of Stock","Restocking","Not Shown");
	$lklist["ostatus"] = array("New","Submitted","Quoted","Paid","Sent/Deliver", "Cancelled");

	$lklist["cmstatus"] = array("New","Pending","Approved");
	$lklist["svcstatus"] = array("New","Pending","Done");
	$lklist["month"] = array("0","1","2","3","4","5","6","7","8","9","10","11","12",);

	$lklist["list1"] = array("Apple","Banana","Cat");
	// $lklist["list2"] = array("where", "who","what");
	// $lklist["list3"] = array("asia", "europe","ocenia","us");
