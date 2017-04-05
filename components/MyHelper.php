<?php
namespace app\components;

class MyHelper
{
    public static function specificMatch($bludos, $ingreds) {
        
        $found = array();

	 	if (is_array($bludos)) {
            $cnt=array();
            foreach ($bludos as $bludo) {
                $bn = $bludo['bludo_name'];
                $cnt[$bn] += 1;
            }
         
         	// sort in descending order
            arsort($cnt); 

         	/*  
         		start checking match 
         	*/

            //search fullmatch 100%
         	while ($match = array_search(count($ingreds), $cnt)) {
         		$found[] = $match;
         		array_shift($cnt);
         	};

         	// if no fullmatch found, search match >= 2 
         	if (empty($found)) {
	         	while (reset($cnt) >= 2) {
	         		$found[] = key($cnt);
	         		array_shift($cnt);
	         	};

         	}

		}

		return $found;
    }
}

?>

