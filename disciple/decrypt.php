<?php

// $input = fgets(STDIN);
// $key = hex2bin($argv[1]);

# These are hashed out because we hex2bin the KEY in the auth-link.php file AND the above is for testing via command line and not needed for live files.






function verify($signed_data, $key) {

	# echo '<h2>FUNCTION: "verify($signed_data, $key)"</h2>';
	# echo "<h3>'signed_data' PASSED TO FUNCTION = " . $signed_data . "</h3>";
	# echo "<h3>'key' PASSED TO FUNCTION = " . $key . "</h3>";
	


    $pieces = explode('--', $signed_data);
    $data = $pieces[0]; // echo "<h3>pieces[0] (data) = " . $data . "</h3>";
    $digest = $pieces[1]; // echo "<h3>pieces[1] (digest) = " . $digest . "</h3>";

	# echo "<hr/>";

    if (hash_equals(hash_hmac('sha1', $data, $key), $digest))
		{
		# echo "<h2>HASH CHECK: CORRECT</h2>";
        return $data;
		} 
		else
		{
		# echo "<h2>HASH CHECK: FAIL</h2>";
        return false;
		}
	}

function decrypt($encrypted_data, $key) {
    $pieces = explode("--", base64_decode($encrypted_data));
    $data = $pieces[0];
    $iv = base64_decode($pieces[1], true);

    return openssl_decrypt($data, "AES-256-CBC", $key, 0, $iv);
}






## PASS YOUR URL INFO TO THIS FUNCTION.
function decrypt_and_verify($encrypted_data, $key) {

	# echo '<h2>FUNCTION: "decrypt_and_verify($encrypted_data, $key)"</h2>';
	# echo "<h3>'_dm' PASSED TO FUNCTION = " . $encrypted_data . "</h3>";
	# echo "<h3>'key' PASSED TO FUNCTION = " . $key . "</h3>";
	# echo "<hr/>";

	# verify hash
    $encrypted_data = verify($encrypted_data, $key);

	# decrypt
    if ($encrypted_data)
		{
        return decrypt($encrypted_data, $key);
		}
		else
		{
		# echo '<h3>No Value for "$encrypted_data" was returned from the function "decrypt_and_verify($encrypted_data, $key);<br/>decrypt($encrypted_data, $key) not run...."</h3>';
        return false;
		}
}
?>
