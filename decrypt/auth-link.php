<?php
# ini_set('display_errors', 1);
# ini_set('display_startup_errors', 1);
# error_reporting(E_ALL);

require_once "disciple/decrypt.php";


# This is the Secret Key that Disciple provide to you. It is NOT your API key.
$secret_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");

# Now we hex2bin it
$key = hex2bin($secret_key);

# Get the variable "_dm" passed inthe URL
$input = $_GET['_dm'];

# Call the function (in the file '/disciple/decrypt.php')
$JSN = decrypt_and_verify($input, $key);



# It's done! Simples!


/* NOW RENDER IT OUT - OR DO SOMETHING WITH IT */
echo "<h3>JSN=</h3>";
echo "<pre>";
print_r($JSN);
echo "</pre>";

$decodedJSN = json_decode($JSN);
echo "<h3>DECODED JSN=</h3>";
echo "<pre>";
print_r($decodedJSN);
echo "</pre>";





/* OR DO SOMETHING WITH IT */
echo "<h3>id = " . $decodedJSN->id . "</h3>";
echo "<h3>email = " . $decodedJSN->email . "</h3>";
echo "<h3>display_name = " . $decodedJSN->display_name . "</h3>";
echo "<h3>link_created_at = " . $decodedJSN->link_created_at . "</h3>";


