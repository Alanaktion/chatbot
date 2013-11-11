<?php

// Bot Configuration
$old_auth = true;

// Connection
$server = 'chat.example.com';
$port = 5222;
$user = 'hashbot';
$domain = $server;
$pass = 'letmein';
$clientid = 'hashbot';

// Chat room (optional)
$room = 'roomname';
$room_password = '';
$room_server = 'conference.chat.example.com';
$nick = 'Hashbot';

// Error reporting
$errors = E_ALL & ~E_DEPRECATED & ~E_NOTICE

// Command Aliases
$aliases = array(
	"commands" => "help",
	"yt" => "youtube",
	"=" => "math",
	"leet" => "1337",
	"facepalm" => "fp",
	"lorem" => "ipsum",
);

// Disabled Commands
$disabled = array(
	"scream",
);

// Greetings
$greetings = array(
	"hi hashbot",
	"hey hashbot",
	"hello hashbot",
	"hi hash",
	"hey hash",
);

// Time Zone
$timezone = 'America/Denver';

// Mashape API key
$mash_key = "";

// Wolfram|Alpha App ID
$wa_app = "";

// Windows Azure Account Key (used for #translate)
$azure_key = "";
$azure_clientid = "";
$azure_secret = "";
