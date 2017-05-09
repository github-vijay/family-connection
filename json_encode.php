<!-- Example #1 A json_encode() example -->
<?php
// $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

// echo json_encode($arr);
?>

<!--Example #2 A json_encode() example showing some options in use-->
<?php
// $a = array('<foo>',"'bar'",'"baz"','&blong&', "\xc3\xa9");

// echo "Normal: ",  json_encode($a), "\n";
// echo "Tags: ",    json_encode($a, JSON_HEX_TAG), "\n";
// echo "Apos: ",    json_encode($a, JSON_HEX_APOS), "\n";
// echo "Quot: ",    json_encode($a, JSON_HEX_QUOT), "\n";
// echo "Amp: ",     json_encode($a, JSON_HEX_AMP), "\n";
// echo "Unicode: ", json_encode($a, JSON_UNESCAPED_UNICODE), "\n";
// echo "All: ",     json_encode($a, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE), "\n\n";

// $b = array();

// echo "Empty array output as array: ", json_encode($b), "\n";
// echo "Empty array output as object: ", json_encode($b, JSON_FORCE_OBJECT), "\n\n";

// $c = array(array(1,2,3));

// echo "Non-associative array output as array: ", json_encode($c), "\n";
// echo "Non-associative array output as object: ", json_encode($c, JSON_FORCE_OBJECT), "\n\n";

// $d = array('foo' => 'bar', 'baz' => 'long');

// echo "Associative array always output as object: ", json_encode($d), "\n";
// echo "Associative array always output as object: ", json_encode($d, JSON_FORCE_OBJECT), "\n\n";
?>


<!--Example #3 JSON_NUMERIC_CHECK option example-->
<?php
// echo "Strings representing numbers automatically turned into numbers".PHP_EOL;
// $numbers = array('+123123', '-123123', '1.2e3', '0.00001');
// var_dump(
//  $numbers,
//  json_encode($numbers, JSON_NUMERIC_CHECK)
// );
// echo "Strings containing improperly formatted numbers".PHP_EOL;
// $strings = array('+a33123456789', 'a123');
// var_dump(
//  $strings,
//  json_encode($strings, JSON_NUMERIC_CHECK)
// );
?>

<!-- Example #4 Sequential versus non-sequential array example<br> -->
<?php
// echo "Sequential array".PHP_EOL;
// $sequential = array("foo", "bar", "baz", "blong");
// var_dump(
//  $sequential,
//  json_encode($sequential)
// );

// echo PHP_EOL."Non-sequential array".PHP_EOL;
// $nonsequential = array(1=>"foo", 2=>"bar", 3=>"baz", 4=>"blong");
// var_dump(
//  $nonsequential,
//  json_encode($nonsequential)
// );

// echo PHP_EOL."Sequential array with one key unset".PHP_EOL;
// unset($sequential[1]);
// var_dump(
//  $sequential,
//  json_encode($sequential)
// );
?>

<!-- Example #5 JSON_PRESERVE_ZERO_FRACTION option example -->
<?php
// var_dump(json_encode(12.0, JSON_PRESERVE_ZERO_FRACTION));
// var_dump(json_encode(12.0));
?>

<!-- In the event of a failure to encode, json_last_error() can be used to determine the exact nature of the error. -->