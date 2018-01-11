<?php   
	
	include 'settings.php';
	include 'functions.php';
	
	//echo "Generate a one-shot dummy address we're going to send money to<br>";
	//$account1 = json_decode(curl_post('https://api.blockcypher.com/v1/beth/test/addrs'), true); // ['private', 'public', 'address']
	//echo 'New account (1): '.$account1['address']."<br><br>";
	
	//echo 'Fund prior address with faucet, 1 eth in wei<br>';
	//echo 'Funding Transaction: '.curl_post_form("https://api.blockcypher.com/v1/beth/test/faucet?token=".$blockcypher_token, 
	//	"{\"address\": \"".$account1['address']."\", \"amount\": 1000000000000000000}")."<br><br>";
	
	//echo "Wait 15 seconds for account 1 to get funds";
	//sleep(15);
	
	//echo "Create TO address<br>";
	//$account2 = json_decode(curl_post('https://api.blockcypher.com/v1/beth/test/addrs'), true); // ['private', 'public', 'address']
	//echo 'New account (2): '.$account2['address']."<br><br>";
	
	foreach ($transactions as $transaction) {
	
		echo "Sending from: <br>";
		$from_account = json_decode(curl_get("https://api.blockcypher.com/v1/eth/main/addrs/".$from_address->address."/balance") );
		echo "Address: ".$from_account->address."<br>";
		echo "Balance: ".$from_account->balance." wei<br><br>";
	
		echo "Sending ".$transaction['amount']." wei to ".$transaction['address']."<br>";
		$send_json = json_decode(curl_post_form("https://api.blockcypher.com/v1/eth/main/txs/new?token=".$blockcypher_token, 
			"{\"inputs\":[{\"addresses\": [\"".$from_address->address."\"]}],\"outputs\":[{\"addresses\": [\"".$transaction['address']."\"], \"value\": ".$transaction['amount']."}]}"), true);
		$signatures = exec( "./signer ".$send_json['tosign'][0]." ".$from_address->private );
	
		$send_json['signatures'] = array( $signatures );
		$send_json['pubkeys'] = array( $from_address->private );
		$send_encoded = json_encode($send_json);
	
		echo "<pre>".curl_post_json("https://api.blockcypher.com/v1/eth/main/txs/send?token=".$blockcypher_token, $send_encoded)."</pre>";
		
	}
?>