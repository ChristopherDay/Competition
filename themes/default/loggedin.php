<?php


    if (!class_exists("mainTemplate")) {
        class mainTemplate {

            public $globalTemplates = array();

            public function __construct() {
     
                $this->globalTemplates["success"] = '<div class="alert alert-success">
                    <button type="button" class="close">
                        <span>&times;</span>
                    </button>
                    <{text}>
                </div>';
                $this->globalTemplates["error"] = '<div class="alert alert-danger">
                    <button type="button" class="close">
                        <span>&times;</span>
                    </button>
                    <{text}>
                </div>';
                $this->globalTemplates["info"] = '<div class="alert alert-info">
                    <button type="button" class="close">
                        <span>&times;</span>
                    </button>
                    <{text}>
                </div>';
                $this->globalTemplates["warning"] = '<div class="alert alert-warning">
                    <button type="button" class="close">
                        <span>&times;</span>
                    </button>
                    <{text}>
                </div>';

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
                    <li data-toggle="tooltip" data-placement="bottom" title="My Account">
                        <a href="?page=account">
                            <span class="visible-xs">My Account</span>
                            <span class="hidden-xs">
                                &nbsp;<i class="glyphicon glyphicon-user"></i>&nbsp;
                            </span>
                        </a>
                    </li>
                    {#if isAdmin}
                        <li data-toggle="tooltip" data-placement="bottom" title="Admin Panel">
                            <a href="?page=admin">
                                <span class="visible-xs">Admin Panel</span>
                                <span class="hidden-xs">
                                    &nbsp;<i class="glyphicon glyphicon-cog"></i>&nbsp;
                                </span>
                            </a>
                        </li>
                    {/if}
                    <li data-toggle="tooltip" data-placement="bottom" title="Logout">
                        <a href="?page=logout">
                            <span class="visible-xs">Logout</span>
                            <span class="hidden-xs">
                                &nbsp;<i class="glyphicon glyphicon-log-out"></i>&nbsp;
                            </span>
                        </a>
                    </li>
                    <li data-toggle="tooltip" data-placement="bottom" title="Notifications">
                        <a href="?page=notifications">
                            <i class="glyphicon glyphicon-bell"></i> {notificationCount}
                        </a>
                    </li>
                    <li data-toggle="tooltip" data-placement="bottom" title="Cart">
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
    <script src="themes/{_theme}/js/bootstrap.min.js"></script>
    <script src="themes/{_theme}/js/timer.js"></script>
    <script src="themes/{_theme}/js/mobile.js"></script>
    {#if moduleJSFile}
        <script src="{moduleJSFile}"></script>
    {/if}
</body>
</html>';
            
        }
    }
?>
