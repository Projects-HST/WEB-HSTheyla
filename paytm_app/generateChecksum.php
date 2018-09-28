<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
$checkSum = "";

// below code snippet is mandatory, so that no one can use your checksumgeneration url for other purpose .
$findme   = 'REFUND';
$findmepipe = '|';

$paramList = array();

$paramList["MID"] = 'Vision73026199949275';
$paramList["ORDER_ID"] = $_POST["ORDER_ID"];
$paramList["CUST_ID"] = 'CUST0001453';
$paramList["INDUSTRY_TYPE_ID"] = 'Retail109';
$paramList["CHANNEL_ID"] = 'WAP';
$paramList["TXN_AMOUNT"] = $_POST["TXN_AMOUNT"];
$paramList["WEBSITE"] = 'APPPROD';
$paramList["CALLBACK_URL"] = 'https://securegw.paytm.in/theia/paytmCallback?ORDER_ID='.$_POST["ORDER_ID"];
/*
foreach($_POST as $key=>$value)
{  
  $pos = strpos($value, $findme);
  $pospipe = strpos($value, $findmepipe);
  if ($pos === false || $pospipe === false) 
    {
        $paramList[$key] = $value;
    }
}

*/
//Here checksum string will return by getChecksumFromArray() function.
//$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
$paramList["CHECKSUMHASH"] = $checkSum;

//print_r($paramList);

echo json_encode(array("CHECKSUMHASH" => $checkSum,"MID" => "Vision73026199949275","ORDER_ID" => $_POST["ORDER_ID"],"CUST_ID" => "CUST0001453","INDUSTRY_TYPE_ID" => "Retail109","CHANNEL_ID" => "WAP","TXN_AMOUNT" => $_POST["TXN_AMOUNT"], "WEBSITE" => "APPPROD", "CALLBACK_URL" => "https://securegw.paytm.in/theia/paytmCallback?ORDER_ID=".$_POST["ORDER_ID"], "payt_STATUS" => "1"));

//Sample response return to SDK
//  {"CHECKSUMHASH":"GhAJV057opOCD3KJuVWesQ9pUxMtyUGLPAiIRtkEQXBeSws2hYvxaj7jRn33rTYGRLx2TosFkgReyCslu4OUj\/A85AvNC6E4wUP+CZnrBGM=","ORDER_ID":"asgasfgasfsdfhl7","payt_STATUS":"1"} 
 
?>
