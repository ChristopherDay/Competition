<?php

    $start = microtime();

    session_start();

    if (file_exists("install/index.php")) {
        header("Location: install/");
        exit;
    }

    require 'class/hooks.php';
    include 'dbconn.php';
    require 'class/settings.php'; 
    require 'class/template.php';
    require 'class/templateRender.php';
    require 'class/page.php';
    require 'class/image.php';
    require 'class/user.php';

    $settings = new settings();

    $page->loadModuleMetaData();

    if (!isset($_GET['page'])) {
        $_GET['page'] = $page->landingPage;
    }

    $pageToLoad = $_GET['page'];
    
    if (!isset($page->modules[$pageToLoad])) {
        if (!empty($_SESSION['userID'])) {
            $user = new user($_SESSION['userID']);
            $user->updateTimer('laston', time());
        }
        $page->loadPage("pageNotFound");
    } else {

        $jailPageCheck = $page->modules[$pageToLoad];

        if (!empty($_SESSION['userID'])) {
            
            $user = new user($_SESSION['userID']);
            
            $user->updateTimer('laston', time());

            if ($_GET["page"] == "logout") {
                $page->loadPage('logout');
            } else if ($user->info->U_status == 2 && $jailPageCheck["requireLogin"]) {
                $page->loadPage('users');
            } else if ($user->info->U_userLevel == 3) {
                $bannedPage = "banned";
                $hook = new Hook("bannedPage");
                $bannedPage = $hook->run($bannedPage, true);
                $page->loadPage($bannedPage);
            } else {
                $page->loadPage($pageToLoad);
            }
                
        } else if (!$jailPageCheck["requireLogin"]) {
            $page->loadPage($_GET['page']);
        } else {
            
            $page->loadPage("login");
            
        }
    
    }

    $page->printPage();

    $page->success = true;
    
?>