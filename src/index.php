<?php
/* 
	Nanakshahi API v2
	Copyright (C) 2016-2017 Sarabveer Singh <https://sarabveer.me>
	Licensed under the MIT License
*/

//Includes
require('dispatch.php');

//API
route('GET', '/', function () {
	$homearray = [
		"about" => "Nanakshahi API v2",
		"docs" => "https://github.com/Sarabveer/nanakshahi-api"
	];
	$json = json_encode($homearray, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
	return response($json, 200, ['content-type' => 'application/json; charset=utf-8', 'Access-Control-Allow-Origin' => '*']);
});

route('GET', '/date/:year/:month/:day', function ($args, $holidays) {
	//Format Date From Input
	$date = $args['year']."-".$args['month']."-".$args['day'];
	
	//Check for Leap Year
	if (date('L', strtotime($date)) == 1){
		$leap = true;
	} else {
		$leap = false;
	}
	
	//Make new PHP DateTime
	$dt = new DateTime();
	$dt->setTimestamp(strtotime($date));
	$date_f = $dt->format('m-d');
	$g_month = $dt->format('n');
	$g_date = $dt->format('j');
	$g_year = $dt->format('Y');
	
	//Make Array with the Info
	$gregorian_date = array(
		'month' => $dt->format('F'),
		'date' => $g_date,
		'year' => $g_year,
		'day' => $dt->format('l')
	);

	//Calculate Nanakshahi Year
	if($date_f < "03-14") {
		$year = $g_year - 1469;
	} elseif($date_f > "03-14") {
		$year = ($g_year + 1) - 1469;
	} elseif($date_f == "03-14") {
		$year = ($g_year + 1) - 1469;
	}
	$pa_year = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $year);	

	//Calculate Nanakshahi Date
	if($g_month == 1 && $g_date <= 12) {
		$n_date = $g_date + 18;
		if($n_date > 30) {
			$n_month = 11;
			$n_date = $n_date - 30;
		} else {
			$n_month = 10;
		}
	} elseif($g_month == 1 && $g_date > 12) {
		$n_date = $g_date - 12;
		$n_month = 11;
	} elseif($g_month == 2 && $g_date <= 11) {
		$n_date = $g_date + 19;
		if($n_date > 30) {
			$n_month = 12;
			$n_date = $n_date - 30;
		} else {
			$n_month = 11;
		}
	} elseif($g_month == 2 && $g_date > 11) {
		$n_date = $g_date - 11;
		$n_month = 12;
	} elseif($g_month == 3 && $g_date <= 13) {
		//Check if its not a Leap Year
		if($leap == false) {
			$n_date = $g_date + 17;
			if($n_date > 30) {
				$n_month = 1;
				$n_date = $n_date - 30;
			} else {
				$n_month = 12;
			}
		} else {
			$n_date = $g_date + 18;
			if($n_date > 31) {
				$n_month = 1;
				$n_date = $n_date - 31;
			} else {
				$n_month = 12;
			}
		}
	} elseif($g_month == 3 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 1;
	} elseif($g_month == 4 && $g_date <= 13) {
		$n_date = $g_date + 18;
		if($n_date > 31) {
			$n_month = 2;
			$n_date = $n_date - 31;
		} else {
			$n_month = 1;
		}
	} elseif($g_month == 4 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 2;
	} elseif($g_month == 5 && $g_date <= 14 ) {
		$n_date = $g_date + 17;
		if($n_date > 31) {
			$n_month = 3;
			$n_date = $n_date - 31;
		} else {
			$n_month = 2;
		}
	} elseif($g_month == 5 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 3;
	} elseif($g_month == 6 && $g_date <= 14) {
		$n_date = $g_date + 17;
		if($n_date > 31) {
			$n_month = 4;
			$n_date = $n_date - 31;
		} else {
			$n_month = 3;
		}
	} elseif($g_month == 6 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 4;
	} elseif($g_month == 7 && $g_date <= 15) {
		$n_date = $g_date + 16;
		if($n_date > 31) {
			$n_month = 5;
			$n_date = $n_date - 31;
		} else {
			$n_month = 4;
		}
	} elseif($g_month == 7 && $g_date > 15) {
		$n_date = $g_date - 15;
		$n_month = 5;
	} elseif($g_month == 8 && $g_date <= 15) {
		$n_date = $g_date + 16;
		if($n_date > 31) {
			$n_month = 6;
			$n_date = $n_date - 31;
		} else {
			$n_month = 5;
		}
	} elseif($g_month == 8 && $g_date > 15) {
		$n_date = $g_date - 15;
		$n_month = 6;
	} elseif($g_month == 9 && $g_date <= 14) {
		$n_date = $g_date + 16;
		if($n_date > 30) {
			$n_month = 7;
			$n_date = $n_date - 30;
		} else {
			$n_month = 6;
		}
	} elseif($g_month == 9 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 7;
	} elseif($g_month == 10 && $g_date <= 14) {
		$n_date = $g_date + 16;
		if($n_date > 30) {
			$n_month = 8;
			$n_date = $n_date - 30;
		} else {
			$n_month = 7;
		}
	} elseif($g_month == 10 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 8;
	} elseif($g_month == 11 && $g_date <= 13) {
		$n_date = $g_date + 17;
		if($n_date > 30) {
			$n_month = 9;
			$n_date = $n_date - 30;
		} else {
			$n_month = 8;
		}
	} elseif($g_month == 11 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 9;
	} elseif($g_month == 12 && $g_date <= 13) {
		$n_date = $g_date + 17;
		if($n_date > 30) {
			$n_month = 10;
			$n_date = $n_date - 30;
		} else {
			$n_month = 9;
		}
	} elseif($g_month == 12 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 10;
	} else {
		$n_date = 0;
		$n_month = 0;
	}
	
	//Array of Months
	$months = array("", "Chet", "Vaisakh", "Jeth", "Harh", "Savan", "Bhadon", "Assu", "Katik", "Maghar", "Poh", "Magh", "Phagun");
	$pa_months = array("", "ਚੇਤ", "ਵੈਸਾਖ", "ਜੇਠ", "ਹਾੜ", "ਸਾਵਣ", "ਭਾਦੋਂ", "ਅੱਸੂ", "ਕੱਤਕ", "ਮੱਘਰ", "ਪੋਹ", "ਮਾਘ", "ਫੱਗਣ");
	
	//Date
	$pa_n_date = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $n_date);	
	
	//Array of Weekday Names
	$weekday = str_replace(array("1","2","3","4","5","6","7"), array("Somvaar", "Mangalvaar", "Budhvaar", "Veervaar", "Shukarvaar", "Shanivaar", "Aitvaar"), $dt->format('N'));
	$pa_weekday = str_replace(array("1","2","3","4","5","6","7"), array("ਸੋਮਵਾਰ", "ਮੰਗਲਵਾਰ", "ਬੁੱਧਵਾਰ", "ਵੀਰਵਾਰ", "ਸ਼ੁੱਕਰਵਾਰ", "ਸ਼ਨੀਵਾਰ", "ਐਤਵਾਰ"), $dt->format('N'));
	
	//Sub-array for JSON
	$nanakshahiarray = array(
		'english' => array(
			'month' => $months[$n_month],
			'date' => $n_date,
			'year' => $year,
			'day' => $weekday
		),
		'punjabi' => array(
			'month' => $pa_months[$n_month],
			'date' => $pa_n_date,
			'year' => $pa_year,
			'day' => $pa_weekday
		)
	);
	
	//Bikrami Year
	$bikramiyear = $year + 1525;
	$pa_bikramiyear = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $bikramiyear);
	$bikrami = array(
		'english' => $bikramiyear,
		'punjabi' => $pa_bikramiyear
	);
	
	//Holidays
	if(isset($holidays[$date_f]) == true) {
		$holiday = explode(";", $holidays[$date_f]);
	} else {
		$holiday = [];
	}
	
	//Make JSON
	$json = json_encode(array('gregorian' => $gregorian_date, 'nanakshahi' => $nanakshahiarray, 'holidays' => $holiday, 'leapyear' => $leap, 'bikramiyear' => $bikrami), JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
	return response($json, 200, ['content-type' => 'application/json; charset=utf-8', 'Access-Control-Allow-Origin' => '*']);
});

route('GET', '/timezone/:zone', function ($args, $holidays) {
	//Get Timezone
	$timezone = $args['zone'];
	
	//Check for Leap Year
	if (date('L') == 1){
		$leap = true;
	} else {
		$leap = false;
	}
	
	//Make new PHP DateTime
	$dt = new DateTime("now", new DateTimeZone($timezone));
	$date_f = $dt->format('m-d');
	$g_month = $dt->format('n');
	$g_date = $dt->format('j');
	$g_year = $dt->format('Y');
	
	//Make Array with the Info
	$gregorian_date = array(
		'month' => $dt->format('F'),
		'date' => $g_date,
		'year' => $g_year,
		'day' => $dt->format('l')
	);

	//Calculate Nanakshahi Year
	if($date_f < "03-14") {
		$year = $g_year - 1469;
	} elseif($date_f > "03-14") {
		$year = ($g_year + 1) - 1469;
	} elseif($date_f == "03-14") {
		$year = ($g_year + 1) - 1469;
	}
	$pa_year = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $year);

	//Calculate Nanakshahi Date
	if($g_month == 1 && $g_date <= 12) {
		$n_date = $g_date + 18;
		if($n_date > 30) {
			$n_month = 11;
			$n_date = $n_date - 30;
		} else {
			$n_month = 10;
		}
	} elseif($g_month == 1 && $g_date > 12) {
		$n_date = $g_date - 12;
		$n_month = 11;
	} elseif($g_month == 2 && $g_date <= 11) {
		$n_date = $g_date + 19;
		if($n_date > 30) {
			$n_month = 12;
			$n_date = $n_date - 30;
		} else {
			$n_month = 11;
		}
	} elseif($g_month == 2 && $g_date > 11) {
		$n_date = $g_date - 11;
		$n_month = 12;
	} elseif($g_month == 3 && $g_date <= 13) {
		//Check if its not a Leap Year
		if($leap == false) {
			$n_date = $g_date + 17;
			if($n_date > 30) {
				$n_month = 1;
				$n_date = $n_date - 30;
			} else {
				$n_month = 12;
			}
		} else {
			$n_date = $g_date + 18;
			if($n_date > 31) {
				$n_month = 1;
				$n_date = $n_date - 31;
			} else {
				$n_month = 12;
			}
		}
	} elseif($g_month == 3 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 1;
	} elseif($g_month == 4 && $g_date <= 13) {
		$n_date = $g_date + 18;
		if($n_date > 31) {
			$n_month = 2;
			$n_date = $n_date - 31;
		} else {
			$n_month = 1;
		}
	} elseif($g_month == 4 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 2;
	} elseif($g_month == 5 && $g_date <= 14 ) {
		$n_date = $g_date + 17;
		if($n_date > 31) {
			$n_month = 3;
			$n_date = $n_date - 31;
		} else {
			$n_month = 2;
		}
	} elseif($g_month == 5 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 3;
	} elseif($g_month == 6 && $g_date <= 14) {
		$n_date = $g_date + 17;
		if($n_date > 31) {
			$n_month = 4;
			$n_date = $n_date - 31;
		} else {
			$n_month = 3;
		}
	} elseif($g_month == 6 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 4;
	} elseif($g_month == 7 && $g_date <= 15) {
		$n_date = $g_date + 16;
		if($n_date > 31) {
			$n_month = 5;
			$n_date = $n_date - 31;
		} else {
			$n_month = 4;
		}
	} elseif($g_month == 7 && $g_date > 15) {
		$n_date = $g_date - 15;
		$n_month = 5;
	} elseif($g_month == 8 && $g_date <= 15) {
		$n_date = $g_date + 16;
		if($n_date > 31) {
			$n_month = 6;
			$n_date = $n_date - 31;
		} else {
			$n_month = 5;
		}
	} elseif($g_month == 8 && $g_date > 15) {
		$n_date = $g_date - 15;
		$n_month = 6;
	} elseif($g_month == 9 && $g_date <= 14) {
		$n_date = $g_date + 16;
		if($n_date > 30) {
			$n_month = 7;
			$n_date = $n_date - 30;
		} else {
			$n_month = 6;
		}
	} elseif($g_month == 9 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 7;
	} elseif($g_month == 10 && $g_date <= 14) {
		$n_date = $g_date + 16;
		if($n_date > 30) {
			$n_month = 8;
			$n_date = $n_date - 30;
		} else {
			$n_month = 7;
		}
	} elseif($g_month == 10 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 8;
	} elseif($g_month == 11 && $g_date <= 13) {
		$n_date = $g_date + 17;
		if($n_date > 30) {
			$n_month = 9;
			$n_date = $n_date - 30;
		} else {
			$n_month = 8;
		}
	} elseif($g_month == 11 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 9;
	} elseif($g_month == 12 && $g_date <= 13) {
		$n_date = $g_date + 17;
		if($n_date > 30) {
			$n_month = 10;
			$n_date = $n_date - 30;
		} else {
			$n_month = 9;
		}
	} elseif($g_month == 12 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 10;
	} else {
		$n_date = 0;
		$n_month = 0;
	}
	
	//Array of Months
	$months = array("", "Chet", "Vaisakh", "Jeth", "Harh", "Savan", "Bhadon", "Assu", "Katik", "Maghar", "Poh", "Magh", "Phagun");
	$pa_months = array("", "ਚੇਤ", "ਵੈਸਾਖ", "ਜੇਠ", "ਹਾੜ", "ਸਾਵਣ", "ਭਾਦੋਂ", "ਅੱਸੂ", "ਕੱਤਕ", "ਮੱਘਰ", "ਪੋਹ", "ਮਾਘ", "ਫੱਗਣ");
	
	//Date
	$pa_n_date = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $n_date);	
	
	//Array of Weekday Names
	$weekday = str_replace(array("1","2","3","4","5","6","7"), array("Somvaar", "Mangalvaar", "Budhvaar", "Veervaar", "Shukarvaar", "Shanivaar", "Aitvaar"), $dt->format('N'));
	$pa_weekday = str_replace(array("1","2","3","4","5","6","7"), array("ਸੋਮਵਾਰ", "ਮੰਗਲਵਾਰ", "ਬੁੱਧਵਾਰ", "ਵੀਰਵਾਰ", "ਸ਼ੁੱਕਰਵਾਰ", "ਸ਼ਨੀਵਾਰ", "ਐਤਵਾਰ"), $dt->format('N'));
	
	//Sub-array for JSON
	$nanakshahiarray = array(
		'english' => array(
			'month' => $months[$n_month],
			'date' => $n_date,
			'year' => $year,
			'day' => $weekday
		),
		'punjabi' => array(
			'month' => $pa_months[$n_month],
			'date' => $pa_n_date,
			'year' => $pa_year,
			'day' => $pa_weekday
		)
	);
	
	//Bikrami Year
	$bikramiyear = $year + 1525;
	$pa_bikramiyear = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $bikramiyear);
	$bikrami = array(
		'english' => $bikramiyear,
		'punjabi' => $pa_bikramiyear
	);
	
	//Holidays
	if(isset($holidays[$date_f]) == true) {
		$holiday = explode(";", $holidays[$date_f]);
	} else {
		$holiday = [];
	}
	
	//Make JSON
	$json = json_encode(array('timezone' => $timezone, 'gregorian' => $gregorian_date, 'nanakshahi' => $nanakshahiarray, 'holidays' => $holiday, 'leapyear' => $leap, 'bikramiyear' => $bikrami), JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
	return response($json, 200, ['content-type' => 'application/json; charset=utf-8', 'Access-Control-Allow-Origin' => '*']);
});

route('GET', '/timezone/:reigon/:area', function ($args, $holidays) {
	//Get Timezone
	$timezone = $args['reigon']."/".$args['area'];
	
	//Check for Leap Year
	if (date('L') == 1){
		$leap = true;
	} else {
		$leap = false;
	}
	
	//Make new PHP DateTime
	$dt = new DateTime("now", new DateTimeZone($timezone));
	$date_f = $dt->format('m-d');
	$g_month = $dt->format('n');
	$g_date = $dt->format('j');
	$g_year = $dt->format('Y');
	
	//Make Array with the Info
	$gregorian_date = array(
		'month' => $dt->format('F'),
		'date' => $g_date,
		'year' => $g_year,
		'day' => $dt->format('l')
	);

	//Calculate Nanakshahi Year
	if($date_f < "03-14") {
		$year = $g_year - 1469;
	} elseif($date_f > "03-14") {
		$year = ($g_year + 1) - 1469;
	} elseif($date_f == "03-14") {
		$year = ($g_year + 1) - 1469;
	}
	$pa_year = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $year);

	//Calculate Nanakshahi Date
	if($g_month == 1 && $g_date <= 12) {
		$n_date = $g_date + 18;
		if($n_date > 30) {
			$n_month = 11;
			$n_date = $n_date - 30;
		} else {
			$n_month = 10;
		}
	} elseif($g_month == 1 && $g_date > 12) {
		$n_date = $g_date - 12;
		$n_month = 11;
	} elseif($g_month == 2 && $g_date <= 11) {
		$n_date = $g_date + 19;
		if($n_date > 30) {
			$n_month = 12;
			$n_date = $n_date - 30;
		} else {
			$n_month = 11;
		}
	} elseif($g_month == 2 && $g_date > 11) {
		$n_date = $g_date - 11;
		$n_month = 12;
	} elseif($g_month == 3 && $g_date <= 13) {
		//Check if its not a Leap Year
		if($leap == false) {
			$n_date = $g_date + 17;
			if($n_date > 30) {
				$n_month = 1;
				$n_date = $n_date - 30;
			} else {
				$n_month = 12;
			}
		} else {
			$n_date = $g_date + 18;
			if($n_date > 31) {
				$n_month = 1;
				$n_date = $n_date - 31;
			} else {
				$n_month = 12;
			}
		}
	} elseif($g_month == 3 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 1;
	} elseif($g_month == 4 && $g_date <= 13) {
		$n_date = $g_date + 18;
		if($n_date > 31) {
			$n_month = 2;
			$n_date = $n_date - 31;
		} else {
			$n_month = 1;
		}
	} elseif($g_month == 4 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 2;
	} elseif($g_month == 5 && $g_date <= 14 ) {
		$n_date = $g_date + 17;
		if($n_date > 31) {
			$n_month = 3;
			$n_date = $n_date - 31;
		} else {
			$n_month = 2;
		}
	} elseif($g_month == 5 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 3;
	} elseif($g_month == 6 && $g_date <= 14) {
		$n_date = $g_date + 17;
		if($n_date > 31) {
			$n_month = 4;
			$n_date = $n_date - 31;
		} else {
			$n_month = 3;
		}
	} elseif($g_month == 6 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 4;
	} elseif($g_month == 7 && $g_date <= 15) {
		$n_date = $g_date + 16;
		if($n_date > 31) {
			$n_month = 5;
			$n_date = $n_date - 31;
		} else {
			$n_month = 4;
		}
	} elseif($g_month == 7 && $g_date > 15) {
		$n_date = $g_date - 15;
		$n_month = 5;
	} elseif($g_month == 8 && $g_date <= 15) {
		$n_date = $g_date + 16;
		if($n_date > 31) {
			$n_month = 6;
			$n_date = $n_date - 31;
		} else {
			$n_month = 5;
		}
	} elseif($g_month == 8 && $g_date > 15) {
		$n_date = $g_date - 15;
		$n_month = 6;
	} elseif($g_month == 9 && $g_date <= 14) {
		$n_date = $g_date + 16;
		if($n_date > 30) {
			$n_month = 7;
			$n_date = $n_date - 30;
		} else {
			$n_month = 6;
		}
	} elseif($g_month == 9 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 7;
	} elseif($g_month == 10 && $g_date <= 14) {
		$n_date = $g_date + 16;
		if($n_date > 30) {
			$n_month = 8;
			$n_date = $n_date - 30;
		} else {
			$n_month = 7;
		}
	} elseif($g_month == 10 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 8;
	} elseif($g_month == 11 && $g_date <= 13) {
		$n_date = $g_date + 17;
		if($n_date > 30) {
			$n_month = 9;
			$n_date = $n_date - 30;
		} else {
			$n_month = 8;
		}
	} elseif($g_month == 11 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 9;
	} elseif($g_month == 12 && $g_date <= 13) {
		$n_date = $g_date + 17;
		if($n_date > 30) {
			$n_month = 10;
			$n_date = $n_date - 30;
		} else {
			$n_month = 9;
		}
	} elseif($g_month == 12 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 10;
	} else {
		$n_date = 0;
		$n_month = 0;
	}
	
	//Array of Months
	$months = array("", "Chet", "Vaisakh", "Jeth", "Harh", "Savan", "Bhadon", "Assu", "Katik", "Maghar", "Poh", "Magh", "Phagun");
	$pa_months = array("", "ਚੇਤ", "ਵੈਸਾਖ", "ਜੇਠ", "ਹਾੜ", "ਸਾਵਣ", "ਭਾਦੋਂ", "ਅੱਸੂ", "ਕੱਤਕ", "ਮੱਘਰ", "ਪੋਹ", "ਮਾਘ", "ਫੱਗਣ");
	
	//Date
	$pa_n_date = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $n_date);	
	
	//Array of Weekday Names
	$weekday = str_replace(array("1","2","3","4","5","6","7"), array("Somvaar", "Mangalvaar", "Budhvaar", "Veervaar", "Shukarvaar", "Shanivaar", "Aitvaar"), $dt->format('N'));
	$pa_weekday = str_replace(array("1","2","3","4","5","6","7"), array("ਸੋਮਵਾਰ", "ਮੰਗਲਵਾਰ", "ਬੁੱਧਵਾਰ", "ਵੀਰਵਾਰ", "ਸ਼ੁੱਕਰਵਾਰ", "ਸ਼ਨੀਵਾਰ", "ਐਤਵਾਰ"), $dt->format('N'));
	
	//Sub-array for JSON
	$nanakshahiarray = array(
		'english' => array(
			'month' => $months[$n_month],
			'date' => $n_date,
			'year' => $year,
			'day' => $weekday
		),
		'punjabi' => array(
			'month' => $pa_months[$n_month],
			'date' => $pa_n_date,
			'year' => $pa_year,
			'day' => $pa_weekday
		)
	);
	
	//Bikrami Year
	$bikramiyear = $year + 1525;
	$pa_bikramiyear = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $bikramiyear);
	$bikrami = array(
		'english' => $bikramiyear,
		'punjabi' => $pa_bikramiyear
	);
	
	//Holidays
	if(isset($holidays[$date_f]) == true) {
		$holiday = explode(";", $holidays[$date_f]);
	} else {
		$holiday = [];
	}
	
	//Make JSON
	$json = json_encode(array('timezone' => $timezone, 'gregorian' => $gregorian_date, 'nanakshahi' => $nanakshahiarray, 'holidays' => $holiday, 'leapyear' => $leap, 'bikramiyear' => $bikrami), JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
	return response($json, 200, ['content-type' => 'application/json; charset=utf-8', 'Access-Control-Allow-Origin' => '*']);
});

route('GET', '/timezone/:reigon/:area/:subarea', function ($args, $holidays) {
	//Get Timezone
	$timezone = $args['reigon']."/".$args['area']."/".$args['subarea'];
	
	//Check for Leap Year
	if (date('L') == 1){
		$leap = true;
	} else {
		$leap = false;
	}
	
	//Make new PHP DateTime
	$dt = new DateTime("now", new DateTimeZone($timezone));
	$date_f = $dt->format('m-d');
	$g_month = $dt->format('n');
	$g_date = $dt->format('j');
	$g_year = $dt->format('Y');
	
	//Make Array with the Info
	$gregorian_date = array(
		'month' => $dt->format('F'),
		'date' => $g_date,
		'year' => $g_year,
		'day' => $dt->format('l')
	);

	//Calculate Nanakshahi Year
	if($date_f < "03-14") {
		$year = $g_year - 1469;
	} elseif($date_f > "03-14") {
		$year = ($g_year + 1) - 1469;
	} elseif($date_f == "03-14") {
		$year = ($g_year + 1) - 1469;
	}
	$pa_year = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $year);

	//Calculate Nanakshahi Date
	if($g_month == 1 && $g_date <= 12) {
		$n_date = $g_date + 18;
		if($n_date > 30) {
			$n_month = 11;
			$n_date = $n_date - 30;
		} else {
			$n_month = 10;
		}
	} elseif($g_month == 1 && $g_date > 12) {
		$n_date = $g_date - 12;
		$n_month = 11;
	} elseif($g_month == 2 && $g_date <= 11) {
		$n_date = $g_date + 19;
		if($n_date > 30) {
			$n_month = 12;
			$n_date = $n_date - 30;
		} else {
			$n_month = 11;
		}
	} elseif($g_month == 2 && $g_date > 11) {
		$n_date = $g_date - 11;
		$n_month = 12;
	} elseif($g_month == 3 && $g_date <= 13) {
		//Check if its not a Leap Year
		if($leap == false) {
			$n_date = $g_date + 17;
			if($n_date > 30) {
				$n_month = 1;
				$n_date = $n_date - 30;
			} else {
				$n_month = 12;
			}
		} else {
			$n_date = $g_date + 18;
			if($n_date > 31) {
				$n_month = 1;
				$n_date = $n_date - 31;
			} else {
				$n_month = 12;
			}
		}
	} elseif($g_month == 3 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 1;
	} elseif($g_month == 4 && $g_date <= 13) {
		$n_date = $g_date + 18;
		if($n_date > 31) {
			$n_month = 2;
			$n_date = $n_date - 31;
		} else {
			$n_month = 1;
		}
	} elseif($g_month == 4 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 2;
	} elseif($g_month == 5 && $g_date <= 14 ) {
		$n_date = $g_date + 17;
		if($n_date > 31) {
			$n_month = 3;
			$n_date = $n_date - 31;
		} else {
			$n_month = 2;
		}
	} elseif($g_month == 5 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 3;
	} elseif($g_month == 6 && $g_date <= 14) {
		$n_date = $g_date + 17;
		if($n_date > 31) {
			$n_month = 4;
			$n_date = $n_date - 31;
		} else {
			$n_month = 3;
		}
	} elseif($g_month == 6 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 4;
	} elseif($g_month == 7 && $g_date <= 15) {
		$n_date = $g_date + 16;
		if($n_date > 31) {
			$n_month = 5;
			$n_date = $n_date - 31;
		} else {
			$n_month = 4;
		}
	} elseif($g_month == 7 && $g_date > 15) {
		$n_date = $g_date - 15;
		$n_month = 5;
	} elseif($g_month == 8 && $g_date <= 15) {
		$n_date = $g_date + 16;
		if($n_date > 31) {
			$n_month = 6;
			$n_date = $n_date - 31;
		} else {
			$n_month = 5;
		}
	} elseif($g_month == 8 && $g_date > 15) {
		$n_date = $g_date - 15;
		$n_month = 6;
	} elseif($g_month == 9 && $g_date <= 14) {
		$n_date = $g_date + 16;
		if($n_date > 30) {
			$n_month = 7;
			$n_date = $n_date - 30;
		} else {
			$n_month = 6;
		}
	} elseif($g_month == 9 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 7;
	} elseif($g_month == 10 && $g_date <= 14) {
		$n_date = $g_date + 16;
		if($n_date > 30) {
			$n_month = 8;
			$n_date = $n_date - 30;
		} else {
			$n_month = 7;
		}
	} elseif($g_month == 10 && $g_date > 14) {
		$n_date = $g_date - 14;
		$n_month = 8;
	} elseif($g_month == 11 && $g_date <= 13) {
		$n_date = $g_date + 17;
		if($n_date > 30) {
			$n_month = 9;
			$n_date = $n_date - 30;
		} else {
			$n_month = 8;
		}
	} elseif($g_month == 11 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 9;
	} elseif($g_month == 12 && $g_date <= 13) {
		$n_date = $g_date + 17;
		if($n_date > 30) {
			$n_month = 10;
			$n_date = $n_date - 30;
		} else {
			$n_month = 9;
		}
	} elseif($g_month == 12 && $g_date > 13) {
		$n_date = $g_date - 13;
		$n_month = 10;
	} else {
		$n_date = 0;
		$n_month = 0;
	}
	
	//Array of Months
	$months = array("", "Chet", "Vaisakh", "Jeth", "Harh", "Savan", "Bhadon", "Assu", "Katik", "Maghar", "Poh", "Magh", "Phagun");
	$pa_months = array("", "ਚੇਤ", "ਵੈਸਾਖ", "ਜੇਠ", "ਹਾੜ", "ਸਾਵਣ", "ਭਾਦੋਂ", "ਅੱਸੂ", "ਕੱਤਕ", "ਮੱਘਰ", "ਪੋਹ", "ਮਾਘ", "ਫੱਗਣ");
	
	//Date
	$pa_n_date = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $n_date);	
	
	//Array of Weekday Names
	$weekday = str_replace(array("1","2","3","4","5","6","7"), array("Somvaar", "Mangalvaar", "Budhvaar", "Veervaar", "Shukarvaar", "Shanivaar", "Aitvaar"), $dt->format('N'));
	$pa_weekday = str_replace(array("1","2","3","4","5","6","7"), array("ਸੋਮਵਾਰ", "ਮੰਗਲਵਾਰ", "ਬੁੱਧਵਾਰ", "ਵੀਰਵਾਰ", "ਸ਼ੁੱਕਰਵਾਰ", "ਸ਼ਨੀਵਾਰ", "ਐਤਵਾਰ"), $dt->format('N'));
	
	//Sub-array for JSON
	$nanakshahiarray = array(
		'english' => array(
			'month' => $months[$n_month],
			'date' => $n_date,
			'year' => $year,
			'day' => $weekday
		),
		'punjabi' => array(
			'month' => $pa_months[$n_month],
			'date' => $pa_n_date,
			'year' => $pa_year,
			'day' => $pa_weekday
		)
	);
	
	//Bikrami Year
	$bikramiyear = $year + 1525;
	$pa_bikramiyear = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $bikramiyear);
	$bikrami = array(
		'english' => $bikramiyear,
		'punjabi' => $pa_bikramiyear
	);
	
	//Holidays
	if(isset($holidays[$date_f]) == true) {
		$holiday = explode(";", $holidays[$date_f]);
	} else {
		$holiday = [];
	}
	
	//Make JSON
	$json = json_encode(array('timezone' => $timezone, 'gregorian' => $gregorian_date, 'nanakshahi' => $nanakshahiarray, 'holidays' => $holiday, 'leapyear' => $leap, 'bikramiyear' => $bikrami), JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
	return response($json, 200, ['content-type' => 'application/json; charset=utf-8', 'Access-Control-Allow-Origin' => '*']);
});

route('GET', '/holidays', function ($holidays) {
	//Check for Leap Year
	if (date('L') == 1){
		$leap = true;
	} else {
		$leap = false;
	}

	foreach ($holidays as $key => $value) {
		//Get Month/Day
		$key_day = explode("-", $key);
		$dt = DateTime::createFromFormat('!m', $key_day[0]);
		$g_month = $dt->format('n');
		$g_date = $key_day[1];
		//Calculate Nanakshahi Date
		if($g_month == 1 && $g_date <= 12) {
			$n_date = $g_date + 18;
			if($n_date > 30) {
				$n_month = 11;
				$n_date = $n_date - 30;
			} else {
				$n_month = 10;
			}
		} elseif($g_month == 1 && $g_date > 12) {
			$n_date = $g_date - 12;
			$n_month = 11;
		} elseif($g_month == 2 && $g_date <= 11) {
			$n_date = $g_date + 19;
			if($n_date > 30) {
				$n_month = 12;
				$n_date = $n_date - 30;
			} else {
				$n_month = 11;
			}
		} elseif($g_month == 2 && $g_date > 11) {
			$n_date = $g_date - 11;
			$n_month = 12;
		} elseif($g_month == 3 && $g_date <= 13) {
			//Check if its not a Leap Year
			if($leap == false) {
				$n_date = $g_date + 17;
				if($n_date > 30) {
					$n_month = 1;
					$n_date = $n_date - 30;
				} else {
					$n_month = 12;
				}
			} else {
				$n_date = $g_date + 18;
				if($n_date > 31) {
					$n_month = 1;
					$n_date = $n_date - 31;
				} else {
					$n_month = 12;
				}
			}
		} elseif($g_month == 3 && $g_date > 13) {
			$n_date = $g_date - 13;
			$n_month = 1;
		} elseif($g_month == 4 && $g_date <= 13) {
			$n_date = $g_date + 18;
			if($n_date > 31) {
				$n_month = 2;
				$n_date = $n_date - 31;
			} else {
				$n_month = 1;
			}
		} elseif($g_month == 4 && $g_date > 13) {
			$n_date = $g_date - 13;
			$n_month = 2;
		} elseif($g_month == 5 && $g_date <= 14 ) {
			$n_date = $g_date + 17;
			if($n_date > 31) {
				$n_month = 3;
				$n_date = $n_date - 31;
			} else {
				$n_month = 2;
			}
		} elseif($g_month == 5 && $g_date > 14) {
			$n_date = $g_date - 14;
			$n_month = 3;
		} elseif($g_month == 6 && $g_date <= 14) {
			$n_date = $g_date + 17;
			if($n_date > 31) {
				$n_month = 4;
				$n_date = $n_date - 31;
			} else {
				$n_month = 3;
			}
		} elseif($g_month == 6 && $g_date > 14) {
			$n_date = $g_date - 14;
			$n_month = 4;
		} elseif($g_month == 7 && $g_date <= 15) {
			$n_date = $g_date + 16;
			if($n_date > 31) {
				$n_month = 5;
				$n_date = $n_date - 31;
			} else {
				$n_month = 4;
			}
		} elseif($g_month == 7 && $g_date > 15) {
			$n_date = $g_date - 15;
			$n_month = 5;
		} elseif($g_month == 8 && $g_date <= 15) {
			$n_date = $g_date + 16;
			if($n_date > 31) {
				$n_month = 6;
				$n_date = $n_date - 31;
			} else {
				$n_month = 5;
			}
		} elseif($g_month == 8 && $g_date > 15) {
			$n_date = $g_date - 15;
			$n_month = 6;
		} elseif($g_month == 9 && $g_date <= 14) {
			$n_date = $g_date + 16;
			if($n_date > 30) {
				$n_month = 7;
				$n_date = $n_date - 30;
			} else {
				$n_month = 6;
			}
		} elseif($g_month == 9 && $g_date > 14) {
			$n_date = $g_date - 14;
			$n_month = 7;
		} elseif($g_month == 10 && $g_date <= 14) {
			$n_date = $g_date + 16;
			if($n_date > 30) {
				$n_month = 8;
				$n_date = $n_date - 30;
			} else {
				$n_month = 7;
			}
		} elseif($g_month == 10 && $g_date > 14) {
			$n_date = $g_date - 14;
			$n_month = 8;
		} elseif($g_month == 11 && $g_date <= 13) {
			$n_date = $g_date + 17;
			if($n_date > 30) {
				$n_month = 9;
				$n_date = $n_date - 30;
			} else {
				$n_month = 8;
			}
		} elseif($g_month == 11 && $g_date > 13) {
			$n_date = $g_date - 13;
			$n_month = 9;
		} elseif($g_month == 12 && $g_date <= 13) {
			$n_date = $g_date + 17;
			if($n_date > 30) {
				$n_month = 10;
				$n_date = $n_date - 30;
			} else {
				$n_month = 9;
			}
		} elseif($g_month == 12 && $g_date > 13) {
			$n_date = $g_date - 13;
			$n_month = 10;
		} else {
			$n_date = 0;
			$n_month = 0;
		}
		
		//Array of Months
		$months = array("", "Chet", "Vaisakh", "Jeth", "Harh", "Savan", "Bhadon", "Assu", "Katik", "Maghar", "Poh", "Magh", "Phagun");
		$pa_months = array("", "ਚੇਤ", "ਵੈਸਾਖ", "ਜੇਠ", "ਹਾੜ", "ਸਾਵਣ", "ਭਾਦੋਂ", "ਅੱਸੂ", "ਕੱਤਕ", "ਮੱਘਰ", "ਪੋਹ", "ਮਾਘ", "ਫੱਗਣ");
	
		//Date
		$pa_n_date = str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("੦","੧","੨","੩","੪","੫","੬","੭","੮","੯"), $n_date);	
		
		//Get Holidays
		$holiday = explode(";", $value);
		
		//Generate JSON Array
		$array = array(
			'holidays' => $holiday,
			'date' => array(
				'gregorian' => array(
					'month' => $dt->format('F'),
					'date' => $g_date
				),
				'nanakshahi' => array(
					'english' => array(
						'month' => $months[$n_month],
						'date' => $n_date
					),
					'punjabi' => array(
						'month' => $pa_months[$n_month],
						'date' => $pa_n_date
					)
				)
			)
		);
		
		//Add to Master Array
		$holidaylist[] = $array;
	}
	$json = json_encode(array('holidaylist' => $holidaylist), JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
	return response($json, 200, ['content-type' => 'application/json; charset=utf-8', 'Access-Control-Allow-Origin' => '*']);
});

$holidays = array(
	"01-05" => "Parkash Purab - Guru Gobind Singh Ji",
	"01-06" => "Shaheedi - Bhai Kehar Singh;Shaheedi - Bhai Satwant Singh",
	"01-13" => "ਅਰੰਭ ਮਾਘ;Sangrand Magh;Foundation Day of Sri Harmandir Sahib;Mela Maghi Muktsar",
	"01-19" => "Morcha Chabian",
	"01-26" => "Birthday - Baba Deep Singh Ji",
	"01-31" => "Parkash Purab - Guru Har Rai Sahib Ji",
	"02-06" => "Jor Mela Kotha Sahib",
	"02-08" => "Big Ghallughara",
	"02-11" => "Birthday - Sahibzada Baba Ajit Singh",
	"02-12" => "ਅਰੰਭ ਫੱਗਣ;Sangrand Phagun",
	"02-21" => "Saka Nankana Sahib;Jaito Morcha",
	"03-01" => "Holla Mahalla (2010)",
	"03-02" => "Holla Mahalla (2018)",
	"03-04" => "Holla Mahalla (2007)",
	"03-06" => "Holla Mahalla (2015)",
	"03-07" => "Holla Mahalla (2004)",
	"03-09" => "Holla Mahalla (2012)",
	"03-10" => "Holla Mahalla (2020)",
	"03-11" => "Holla Mahalla (2009)",
	"03-13" => "Holla Mahalla (2017)",
	"03-14" => "ਅਰੰਬ ਨਵਾਂ ਸਾਲ;Nanakshahi New Year;ਅਰੰਭ ਚੇਤ;Sangrand Chet;Gurgaddi - Guru Har Rai Sahib Ji",
	"03-15" => "Delhi Fateh Divas - Bhai Baghel Singh;Holla Mahalla (2006)",
	"03-17" => "Holla Mahalla (2014)",
	"03-19" => "Joti Jot - Guru Hargobind Sahib Ji;Holla Mahalla (2003)",
	"03-20" => "Holla Mahalla (2011)",
	"03-21" => "Holla Mahalla (2019)",
	"03-22" => "Holla Mahalla (2008)",
	"03-24" => "Holla Mahalla (2016)",
	"03-25" => "Shaheedi - Bhai Subeg Singh & Bhai Shahbaz Singh",
	"03-26" => "Holla Mahalla (2005)",
	"03-28" => "Holla Mahalla (2013)",
	"04-09"	=> "Birthday - Sahibzada Baba Jujhar Singh",
	"04-14" => "ਅਰੰਭ ਵੈਸਾਖ;Sangrand Vaisakh;Khalsa Sajna Diwas",
	"04-16" => "Joti Jot - Guru Angad Dev Ji;Gurgaddi - Guru Amar Das Ji;Joti Jot - Guru Harkrishan Sahib Ji;Gurgaddi - Guru Tegh Bahadur Sahib Ji",
	"04-18" => "Parkash Purab - Guru Angad Dev Ji;Parkash Purab - Guru Tegh Bahadur Sahib Ji",
	"05-02"	=> "Parkash Purab - Guru Arjan Dev Ji",
	"05-15"	=> "ਅਰੰਭ ਜੇਠ;Sangrand Jeth",
	"05-17"	=> "Small Ghallughara",
	"05-23"	=> "Parkash Purab - Guru Amar Das Ji",
	"06-01"	=> "Shaheedi - Bhai Mehnga Singh Babbar",
	"06-04"	=> "1984 Ghallughara;Attack on Sri Akal Takht Sahib",
	"06-06"	=> "Shaheedi - Baba Jarnail Singh Ji",
	"06-11"	=> "Gurgaddi - Guru Hargobind Sahib Ji",
	"06-15"	=> "ਅਰੰਭ ਹਾੜ;Sangrand Harh",
	"06-16"	=> "Shaheedi - Guru Arjan Dev Ji",
	"06-25"	=> "Shaheedi - Baba Banda Singh Bahadur",
	"07-02"	=> "Foundation Day of Sri Akal Takht Sahib",
	"07-05"	=> "Parkash Purab - Guru Hargobind Sahib Ji",
	"07-09"	=> "Shaheedi - Bhai Mani Singh",
	"07-16"	=> "ਅਰੰਭ ਸਾਵਣ;Sangrand Sawan;Shaheedi - Bhai Taru Singh",
	"07-21"	=> "Miri-Piri Day",
	"07-23"	=> "Parkash Purab - Guru Harkrishan Sahib Ji",
	"08-16"	=> "ਅਰੰਭ ਭਾਦੋ;Sangrand Bhadon",
	"08-30"	=> "Completion of Sri Guru Granth Sahib",
	"09-01"	=> "First Parkash of Sri Guru Granth Sahib",
	"09-15"	=> "ਅਰੰਭ ਅਸੂ;Sangrand Assu",
	"09-16"	=> "Joti Jot - Guru Amar Das Ji;Gurgaddi - Guru Ram Das Ji;Joti Jot - Guru Ram Das Ji;Gurgaddi - Guru Arjan Dev Ji",
	"09-18"	=> "Gurgaddi - Guru Angad Dev Ji",
	"09-22"	=> "Joti Jot - Guru Nanak Dev Ji",
	"10-05"	=> "Mela Beerh Baba Buddha Ji ",
	"10-09"	=> "Parkash Purab - Guru Ram Das Ji",
	"10-15" => "ਅਰੰਭ ਕੱਤਕ;Sangrand Katik",
	"10-17" => "Bandi Chorh Diwas (2009)",
	"10-19" => "Bandi Chorh Diwas (2017)",
	"10-20" => "Joti Jot - Guru Har Rai Sahib Ji;Gurgaddi -  Guru Harkrishan Sahib Ji;Gurgaddi - Sri Guru Granth Sahib",
	"10-21" => "Joti Jot - Guru Gobind Singh Ji;Bandi Chorh Diwas (2006)",
	"10-23" => "Bandi Chorh Diwas (2014)",
	"10-25" => "Bandi Chorh Diwas (2003)",
	"10-26" => "Bandi Chorh Diwas (2011)",
	"10-27" => "Bandi Chorh Diwas (2019)",
	"10-28" => "Saka Panja Sahib;Bandi Chorh Diwas (2008)",
	"10-30" => "Bandi Chorh Diwas (2016)",
	"10-31" => "Shaheedi - Bhai Beant Singh",
	"11-01"	=> "Birthday - Mata Sahib Kaur Ji;Bandi Chorh Diwas (2005)",
	"11-02"	=> "Parkash Purab - Guru Nanak Dev Ji (2009)",
	"11-03"	=> "Bandi Chorh Diwas (2013)",
	"11-04" => "Parkash Purab - Guru Nanak Dev Ji (2017)",
	"11-05" => "Parkash Purab - Guru Nanak Dev Ji (2006);Bandi Chorh Diwas (2010)",
	"11-06" => "Parkash Purab - Guru Nanak Dev Ji (2014)",
	"11-07" => "Bandi Chorh Diwas (2018)",
	"11-08" => "Parkash Purab - Guru Nanak Dev Ji (2003)",
	"11-09" => "Bandi Chorh Diwas (2007)",
	"11-10" => "Parkash Purab - Guru Nanak Dev Ji (2011)",
	"11-11" => "Bandi Chorh Diwas (2015)",
	"11-12" => "Parkash Purab - Guru Nanak Dev Ji (2019);Bandi Chorh Diwas (2004)",
	"11-13" => "Parkash Purab - Guru Nanak Dev Ji (2008); Shaheedi - Baba Deep Singh Ji;Bandi Chorh Diwas (2012)",
	"11-14" => "ਅਰੰਭ ਮੱਘਰ;Sangrand Maghar;Parkash Purab - Guru Nanak Dev Ji (2016);Bandi Chorh Diwas (2020)",
	"11-15" => "Parkash Purab - Guru Nanak Dev Ji (2005);Shaheedi - Guru Tegh Bahadur Sahib Ji;Gurgaddi - Guru Gobind Singh Ji;Shaheedi - Bhai Mati Das, Bhai Sati Das, Bhai Dyala Ji",
	"11-17" => "Parkash Purab - Guru Nanak Dev Ji (2013)",
	"11-21" => "Parkash Purab - Guru Nanak Dev Ji (2010)",
	"11-23" => "Parkash Purab - Guru Nanak Dev Ji (2018)",
	"11-24" => "Parkash Purab - Guru Nanak Dev Ji (2007)",
	"11-25" => "Parkash Purab - Guru Nanak Dev Ji (2015)",
	"11-26" => "Parkash Purab - Guru Nanak Dev Ji (2004)",
	"11-28" => "Parkash Purab - Guru Nanak Dev Ji (2012);Birthday - Sahibzada Baba Zorawar Singh",
	"11-30" => "Parkash Purab - Guru Nanak Dev Ji (2020)",
	"12-02" => "Shaheedi - Baba Gurbakhsh Singh Ji",
	"12-12" => "Birthday - Sahibzada Baba Fateh Singh",
	"12-14" => "ਅਰੰਭ ਪੋਹ;Sangrand Poh",
	"12-21" => "Shaheedi - Elder Sahibzaade;Shaheeds of Chamkaur;Shaheedi - Bhai Jiwan Singh Ji (Bhai Jaita)",
	"12-22" => "Shaheedi - Baba Sangat Singh Ji",
	"12-26" => "Shaheedi - Younger Sahibzaade;Shaheedi - Mata Gujri Ji"
);

dispatch($holidays);