<?php
$commands["eval"] = function(&$conn, $event, $params) {

	// Ensure Runkit is available before attempting to build a sandbox environment
	if(function_exists("runkit_lint")) {

		$bad_functions = array(
			// Command execution
			"exec",
			"passthru",
			"system",
			"shell_exec",
			"popen",
			"proc_open",
			"pcntl_exec",

			// Code execution
			"eval",
			"assert",
			"preg_replace",
			"create_function",
			"include",
			"include_once",
			"require",
			"require_once",

			// Functions that accept callbacks
			"ob_start",
			"array_diff_uassoc",
			"array_diff_ukey",
			"array_filter",
			"array_intersect_uassoc",
			"array_intersect_ukey",
			"array_map",
			"array_reduce",
			"array_udiff_assoc",
			"array_udiff_uassoc",
			"array_udiff",
			"array_uintersect_assoc",
			"array_uintersect_uassoc",
			"array_uintersect",
			"array_walk_recursive",
			"array_walk",
			"assert_options",
			"uasort",
			"uksort",
			"usort",
			"preg_replace_callback",
			"spl_autoload_register",
			"iterator_apply",
			"call_user_func",
			"call_user_func_array",
			"register_shutdown_function",
			"register_tick_function",
			"set_error_handler",
			"set_exception_handler",
			"session_set_save_handler",
			"sqlite_create_aggregate",
			"sqlite_create_function",

			// Informational
			"phpinfo",
			"posix_mkfifo",
			"posix_getlogin",
			"posix_ttyname",
			"getenv",
			"get_current_user",
			"proc_get_status",
			"get_cfg_var",
			"disk_free_space",
			"disk_total_space",
			"diskfreespace",
			"getcwd",
			"getlastmo",
			"getmygid",
			"getmyinode",
			"getmypid",
			"getmyuid",

			// Filesystem access
			"fopen",
			"tmpfile",
			"bzopen",
			"gzopen",

			// Writes to filesystem
			"chgrp",
			"chmod",
			"chown",
			"copy",
			"file_put_contents",
			"lchgrp",
			"lchown",
			"link",
			"mkdir",
			"move_uploaded_file",
			"rename",
			"rmdir",
			"symlink",
			"tempnam",
			"touch",
			"unlink",
			"imagepng",
			"imagewbmp",
			"image2wbmp",
			"imagejpeg",
			"imagexbm",
			"imagegif",
			"imagegd",
			"imagegd2",
			"iptcembed",
			"ftp_get",
			"ftp_nb_get",

			// Reads from filesystem
			"file_exists",
			"file_get_contents",
			"file",
			"fileatime",
			"filectime",
			"filegroup",
			"fileinode",
			"filemtime",
			"fileowner",
			"fileperms",
			"filesize",
			"filetype",
			"glob",
			"is_dir",
			"is_executable",
			"is_file",
			"is_link",
			"is_readable",
			"is_uploaded_file",
			"is_writable",
			"is_writeable",
			"linkinfo",
			"lstat",
			"parse_ini_file",
			"pathinfo",
			"readfile",
			"readlink",
			"realpath",
			"stat",
			"gzfile",
			"readgzfile",
			"getimagesize",
			"imagecreatefromgif",
			"imagecreatefromjpeg",
			"imagecreatefrompng",
			"imagecreatefromwbmp",
			"imagecreatefromxbm",
			"imagecreatefromxpm",
			"ftp_put",
			"ftp_nb_put",
			"exif_read_data",
			"read_exif_data",
			"exif_thumbnail",
			"exif_imagetype",
			"hash_file",
			"hash_hmac_file",
			"hash_update_file",
			"md5_file",
			"sha1_file",
			"highlight_file",
			"show_source",
			"php_strip_whitespace",
			"get_meta_tags"
		);

		$options = array(
			"safe_mode" => true,
			"open_basedir" => dirname(__FILE__),
			"allow_url_fopen" => "false",
			"disable_functions" => implode(",", $bad_functions),
			"disable_classes" => "myAppClass"
		);
		$sandbox = new Runkit_Sandbox($options);

		// Simple test variable
		$sandbox->hash = "#";

		$eval_str = substr(ltrim($event["message"], "#"), 3);
		$result = $sandbox->eval($eval_str);

		$conn->message($event["from"], $result, $event["type"]);

	} else {

		$conn->message($event["from"], "Sandboxing is not available, please install Runkit extension.", $event["type"]);

	}
}
?>
