<?php	

error_reporting();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Report runtime errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Report all errors
error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);

// Report all errors except E_NOTICE

error_reporting(E_ALL & ~E_NOTICE);
// =============================================================

	session_start();
	require_once("php/main_library.php");
	require_once("php/user.php");
	require_once("php/academics.php");
	require_once("php/join_library.php");
	require_once("php/alert.php");
	if(isset($_REQUEST["signout"])){
		session_destroy();
		header("Location:pages/authentication/login.php");
	}else {
    	if(isset($_SESSION["user_email"]) && isset($_REQUEST["page"])) {
    
    		//include main php library to call all type functions and retrive data.
    		require_once("./php/main_library.php");
    		
    		// all section/parts of main admin dashboard
    		require_once("pages/head.php");
    		if($_SESSION["user_type"] == "admin") {
    			require_once("pages/body/admin_body.php");
    		}else if($_SESSION["user_type"] == "parents") {
    			require_once("pages/body/parents_body.php");
    		}else if ($_SESSION["pages/body/students_body.php"]) {
    			require_once("pages/body/students_body.php");
    		}
    		else {
    			echo 'Error in loading sidebar.';
    		}
    		
    		
    		if(isset($_REQUEST["page"])) {
    			$pages=$_REQUEST["page"];
    				require_once("pages/$pages.php");
    		}
    		else {
    			if($_SESSION["user_type"] == "admin") {
    				require_once("pages/content/admin_content.php");	
    			}else if($_SESSION["user_type"] == "parents") {
    				require_once("pages/content/parents_content.php");	
    			}else if($_SESSION["user_type"] == "student") {
    				require_once("pages/content/students_content.php");	
    			}else {
    				echo "Content Loading Error, Conntact to Arsalan";
    			}
    		}
    		require_once("pages/copyright.php");
    		require_once("pages/footer.php");
    	}else if(isset($_SESSION["user_email"])) {
    		header("Location:welcome.php");	
    	}
    	else {
    		header("Location:pages/authentication/login.php");
    	}
	}
