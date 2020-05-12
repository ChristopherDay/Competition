<?php

    class mainTemplate {

        public function __construct() {
            global $db, $page;


            $usersOnline = $db->prepare("
                SELECT COUNT(*) as 'count' FROM userTimers WHERE UT_desc = 'laston' AND UT_time > ".(time()-900)."
            ");
            $usersOnline->execute();
            $users = $db->prepare("
                SELECT COUNT(*) as 'count' FROM users
            ");
            $users->execute();

            $page->addToTemplate("usersOnlineNow", number_format($usersOnline->fetch(PDO::FETCH_ASSOC)["count"]));
            $page->addToTemplate("registeredUsers", number_format($users->fetch(PDO::FETCH_ASSOC)["count"]));

        }
        
        public $pageMain =  '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{game_name} - {page}</title>
    <link rel="stylesheet" href="themes/{_theme}/css/bootstrap.min.css">
    <link rel="stylesheet" href="themes/{_theme}/css/style.css">
    <link rel="shortcut icon" href="themes/{_theme}/images/icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {#if moduleCSSFile}
        <link href="{moduleCSSFile}" rel="stylesheet" />
    {/if}
</head>

<body>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">{game_name}</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="?page=home">Home</a></li>
                    <li><a href="?page=competitions">Competitions</a></li>
                    <li><a href="?page=previous">Previous Draws</a></li>
                    <li><a href="?page=FAQ">FAQ</a></li>
                    <li><a href="?page=contact">Contact Us</a></li>
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="?page=login">Login / Register</a></li>
                    <li>
                        <a href="?page=cart">
                            <i class="glyphicon glyphicon-shopping-cart"></i> {cartQty} (&pound;{cartTotal})
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="page">
        <div class="container">
            <{alerts}>
            <{game}>
        </div>
    </div>

    <div class="container text-center page-footer">
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="?page=home">Home</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="?page=forum">Forum</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="?page=about">About Us</a></li>       
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="?page=FAQ">FAQ</a></li>
                    </ul>
                </div>  
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="/">© 2020 Company Name.</a></li>
                    <li><a href="?page=TOS">Terms of Service</a></li>
                    <li><a href="?page=privacy">Privacy</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script src="themes/{_theme}/js/jquery.js"></script>
    <!--<script src="themes/{_theme}/js/bootstrap.min.js"></script>-->
    <script src="themes/{_theme}/js/timer.js"></script>
    <script src="themes/{_theme}/js/mobile.js"></script>
    {#if moduleJSFile}
        <script src="{moduleJSFile}"></script>
    {/if}
</body>
</html>';
    
    }

?>