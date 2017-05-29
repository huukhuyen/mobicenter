<?php

function random_char( $count = 6 )
{
	$random_char = "";
	$char_base = explode( " ", "a b c d e f g h i j k l m n o p q r s t u v w x y z A B C D E F G H I J K L M N O P Q R S T U V W X Y Z 0 1 2 3 4 5 6 7 8 9");
	
	for( $i = 0; $i < $count; $i++ )
	{
		$radom_char = $radom_char.$char_base[rand(9, count($char_base))];
	}
	
	return $radom_char;
}

?>