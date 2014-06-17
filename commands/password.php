<?php
$commands["password"] = function(&$conn, $event, $params) {
	$words = array('Airplane','Air','Airforce','Airport','Album','Alphabet','Apple','Arm','Army','Baby','Baby','Backpack','Balloon','Banana','Bank','Barbecue','Bathroom','Bathtub','Bed','Bed','Bee','Bible','Bible','Bird','Bomb','Book','Boss','Bottle','Bowl','Box','Boy','Brain','Bridge','Butterfly','Button','Cappuccino','Car','Carpet','Carrot','Cave','Chair','Chess','Chief','Child','Chisel','Chocolates','Church','Church','Circle','Circus','Circus','Clock','Clown','Coffee','Coffee-shop','Comet','Compact','Compass','Computer','Crystal','Cup','Cycle','Database','Desk','Disc','Diamond','Dress','Drill','Drink','Drum','Dung','Ears','Earth','Egg','Electricity','Elephant','Eraser','Explosive','Eyes','Family','Fan','Feather','Festival','Film','Finger','Fire','Floodlight','Flower','Foot','Fork','Freeway','Fruit','Fungus','Game','Garden','Gas','Gate','Gemstone','Girl','Gloves','God','Grapes','Guitar','Hammer','Hat','Hieroglyph','Highway','Horoscope','Horse','Hose','Ice','Icecream','Insect','Jet','Junk','Kaleidoscope','Kitchen','Knife','Leather','Library','Liquid','Magnet','Man','Map','Maze','Meat','Meteor','Microscope','Milk','Milkshake','Mist','Money','Monster','Mosquito','Mouth','Nail','Navy','Necklace','Needle','Onion','Paintbrush','Pants','Parachute','Passport','Pebble','Pendulum','Pepper','Perfume','Pillow','Plane','Planet','Pocket','Pool','Office','Potato','Printer','Prison','Pyramid','Radar','Rainbow','Record','Restaurant','Rifle','Ring','Robot','Rock','Rocket','Roof','Room','Rope','Saddle','Salt','Sandpaper','Sandwich','Satellite','School','Ship','Shoes','Shop','Shower','Signature','Skeleton','Snail','Software','Solid','Space','Shuttle','Spectrum','Sphere','Spice','Spiral','Spoon','Sports','Spotlight','Square','Staircase','Star','Stomach','Sun','Sunglasses','Surveyor','Swimming','Sword','Table','Tapestry','Teeth','Telescope','Television','Tennis','Thermometer','Tiger','Toilet','Tongue','Torch','Torpedo','Train','Treadmill','Triangle','Tunnel','Typewriter','Umbrella','Vacuum','Vampire','Videotape','Vulture','Water','Weapon','Web','Wheelchair','Window');
	$chars = "!@#$%^&*()_-=+;:,.?";
	$nums = range(0,9);

	shuffle($words);
	shuffle($chars);
	shuffle($nums);

	$pass = strtolower($words[0]);
	if(strlen($pass) <= 7) {
		$pass .= $words[1] . $nums[0];
	} else {
		$pass .= $nums[0] . $chars[0];
	}

	$conn->message($event["from"], $pass, $event["type"]);
}
?>
