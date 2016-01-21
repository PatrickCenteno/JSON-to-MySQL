<?php 
	include( 'database_utlities.php' );

	$link = get_database();

	$card_db = json_decode( file_get_contents('AllSets.json'), true);
	$set_key = "";
	$test = 0;

	/*
	 * Iterating through the whole JSON array
	 * preg_replacing all set keys 
	 */
	foreach ($card_db as $set_key => $field) {
		echo '<pre>';
		echo "entered the set loop ";
		echo $test;
		echo '</pre>';
		try{
			/*
			 * Iterating through the sets 
			 * and setting the values
			 */

			// Define any arrays
			$booster = array();

			$set_name = set_val($field['name'], true);

			$set_code = set_val($field['code'], true);

			$gatherer_code = set_val($field['gathererCode'], true);

			$magic_cards_info_code = set_val($field['magicCardsInfoCode'], true);

			$release_date= set_val($field['releaseDate'], true);

			$border = set_val($field['border'], true);

			$type = set_val($field['type'], true);

			$booster = set_array($field['booster'], true);
		} catch (Excepion $e){
			die ($e -> getMessage());
		}

		// Add info to set datbase here

		/*
		 * Iterating through the cards of the specific set
		 * preg_replacing all set keys 
		 */
		for($i = 0; $i < count($field['cards']); $i++){
			try{
				echo '<pre>';
				echo "entered card loop";
				echo $i;
				echo '</pre>';

				// Define the arrays
				$supertypes = array();
				$types = array();
				$colors = array();
				$subtypes = array();
				$variations = array();

				$layout = set_val($field['cards'][$i]['layout'], true);

				$supertypes = set_array($field['cards'][$i]['supertypes'], true);

				$type = set_val($field['cards'][$i]['type'], true);
				$type = preg_replace('â€”', ' ', $type);
				
				$types = set_array($field['cards'][$i]['types'], true);
				
				$colors = set_array($field['cards'][$i]['colors'], true);

				$multiverseid = set_val($field['cards'][$i]['multiverseid'], true);

				$name = set_val($field['cards'][$i]['name'], true);
				
				$subtypes = set_array($field['cards'][$i]['subtypes'], true);

				$power = set_val($field['cards'][$i]['power'], true);

				$toughness = set_val($field['cards'][$i]['toughness'], true);

				$mana_cost = set_val($field['cards'][$i]['manaCost'], true);

				$text = set_val($field['cards'][$i]['text'], true);

				$flavor = set_val($field['cards'][$i]['flavor'], true);
				
				$variations = set_array($field['cards'][$i]['variations'], true);

				$image_name = set_val($field['cards'][$i]['imageName'], true);

				$cmc = set_val($field['cards'][$i]['cmc'], true);

				$rarity = set_val($field['cards'][$i]['rarity'], true);

				$artist = set_val($field['cards'][$i]['artist'], true);

				$reserved = set_val($field['cards'][$i]['reserved'], true);


				// Adding the cards to the database table
				// Implode all dis shiittt boii
				$imploded_supertypes = implode(',', $supertypes);
				$imploded_types = implode(',', $types);
				$imploded_colors = implode(',', $colors);
				$imploded_subtypes = implode(',', $subtypes);
				$imploded_variations = implode(',', $variations);    
				$sql = "INSERT INTO card_database (layout, supertypes, type, types, colors,
							multiverseid, name, subtypes, power, toughness, manaCost, text, flavor,
							variations, imageName, cmc, rarity, artist, reserved) 
						VALUES ('$layout',
								'$imploded_supertypes', 
								'$type', 
								'$imploded_types', 
								'$imploded_colors',
							 	'$multiverseid',
							 	'$name', 
							 	'$imploded_subtypes',
								'$power', 
								'$toughness', 
								'$mana_cost', 
								'$text', 
								'$flavor', 
								'$imploded_variations', 
								'$image_name', 
								'$cmc', 
								'$rarity',
							    '$artist', 
							    '$reserved')";
				
				//$set_query = mysqli_query($link, $sql);
				if(mysqli_query($link, $sql)){
		    		echo "New record created successfully";
				} else {
					echo "Error: " . $sql_set . "<br>" . mysqli_error($link);
				}

			}catch (Excepion $e){
				die ($e -> getMessage());
			}
		}
		 	// Adding set into set table
			$imploded_booster = implode(',', $booster);
			$sql_set = "INSERT INTO set_database (name, code, gathererCode, magicCardsInfoCode, 
							releaseDate, border, booster, type)
					VALUES ('$set_name', 
							'$set_code', 
							'$gatherer_code', 
							'$magic_cards_info_code',
							'$release_date', 
							'$border', 
							'$imploded_booster',
							'$type')";

			//$set_query = mysqli_query($link, $sql_set);
			if(mysqli_query($link, $sql_set)){
	    		echo "New record created successfully";
			} else {
				echo "Error: " . $sql_set . "<br>" . mysqli_error($link);
			}
		$test ++;
		
	}
	
			
	
	

 ?>