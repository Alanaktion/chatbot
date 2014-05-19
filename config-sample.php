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
$errors = E_ALL & ~E_DEPRECATED & ~E_NOTICE;

// Log level
const LEVEL_ERROR  = 0;
const LEVEL_WARNING = 1;
const LEVEL_INFO = 2;
const LEVEL_DEBUG = 3;
const LEVEL_VERBOSE = 4;
$logging = LEVEL_INFO;

// Command Aliases
$aliases = array(
	"commands" => "help",
	"yt" => "youtube",
	"=" => "math",
	"leet" => "1337",
	"facepalm" => "fp",
	"lorem" => "ipsum",
	"movies" => "movie",
);

// Disabled Commands
$disabled = array(
	"scream",
	"recursion",
	"math_b",
);

// Status message
$status_message = "I'm alive!";

// Greetings
$greetings = array(
	"hi " . strtolower($nick),
	"hey " . strtolower($nick),
	"hello " . strtolower($nick),
	"hi hash",
	"hey hash",
);

// Bad Word Filter
$filter_badwords = false;

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

// Amazon Product Advertising API Access Key
$amazon_associate_tag = "";
$amazon_key = "";
$amazon_secret = "";

// Twitter OAuth
$twitterConsumerKey = "";
$twitterConsumerSecret = "";
$twitterOAuthToken = "";
$twitterOAuthSecret = "";

// Show incoming @mentions in the configured chatroom
$enable_mentions = false;

// The Movie Database
$tmdb_key = "";
