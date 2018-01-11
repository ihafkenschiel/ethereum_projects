<?php

	$blockcypher_token = '';
	
	$from_address = json_decode('{
	  "private": "bcd38b503449ed8e8e34e20270e1dab9990f117cddff9660b1485e29aa67f00a",
	  "public": "04dd66c10a097bc3384d4d47458cf39fd880abdbe6498a54cf6473e64cde41f24d7b89d2b97b80b9ce7b96be48f0928f6ddfe078d05026441eac1a23e6c50bd823",
	  "address": "9e64bb9991bbf0d500b54246d6cef004ed818643"
	}');
	
	$amounts = array();
	
	$transactions = array();
	$transactions[0] = array(
		"address" => "c121a9032d770211f12ceee9af6d48d5254bc863", 
		"amount"  => "100000" // in wei
	);
	$transactions[1] = array(
		"address" => "c121a9032d770211f12ceee9af6d48d5254bc863", 
		"amount"  => "200000" 
	);

?>