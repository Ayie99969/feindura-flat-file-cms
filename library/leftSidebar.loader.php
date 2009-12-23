<?php
/*
    feindura - Flat File Content Management System
    Copyright (C) 2009 Fabian Vogelsteller [frozeman.de]

    This program is free software;
    you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
    without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along with this program;
    if not,see <http://www.gnu.org/licenses/>.
*/
// sidebar.loader.php version 0.59

// -> GET FUNCTIONS
require_once(dirname(__FILE__)."/backend.include.php");

echo ' '; // hack for safari, otherwise it throws an error that he could not find htmlentities like &ouml;

// -----------------------------------------------------------------------------------
// if page ID is given, it LOAD THE EDITOR
// or if $_GET['site'] == 'pages'
if((!empty($_GET['page']) && empty($_GET['site'])) || $_GET['site'] == 'pages') {
 
  // ----  show QUICKMENU for the NONE-CATEGORY PAGES
  if($_GET['category'] !== 0 || empty($categories)) {

    // slide the categories menu IN, when a category is open
    if(empty($_GET['category']))
      $hidden = '';
    else $hidden = ' hidden';
    
    echo '<div class="sidebarMenu fixed'.$hidden.'">
    <div class="top brown"><img src="library/image/sign/pageIcon_middle.png" class="icon" alt="icon" /><span>'.$langFile['categories_nocategories_name'].'</span><a href="#" class="toolTip" title="'.$langFile['categories_nocategories_name'].'::'.$langFile['categories_nocategories_hint'].'">&nbsp;</a></div>
    <div class="content brown">
      <ul class="verticalButtons">';
            
      if($pages = $generalFunctions->loadPages(0)) {
          
        foreach($pages as $page) {
          if($_GET['page'] == $page['id'])
            $pageSelected = ' class="active"';
          else
            $pageSelected = '';
               
          echo '<li><a href="?category=0&amp;page='.$page['id'].'"'.$pageSelected.'><span>'.$page['title'].'</span></a></li>';
        }        
      } else {
        echo '<li><a href="#"><span>'.$langFile['sortablePageList_categoryEmpty'].'</span></a></li>';
      }
        
    echo '</ul>          
      </div>
      <div class="bottom"><a href="#">&nbsp;</a></div>
    </div>';
  }
  
  // ----  show QUICKMENU for the CATEGORIES
  if(!empty($categories)) {
    
    // SPACER
    echo '<div class="spacer"></div>';

    // slide the categories menu OUT, when a category is open
    if($_GET['site'] != 'pages' && $_GET['category'] == 0) // 
      $hidden = ' hidden';
    else $hidden = '';
  
    echo '<div class="sidebarMenu free'.$hidden.'">
    <div class="top blue"><!--<img src="library/image/bg/sidebarMenu_fixedFade.png" alt="fade"/>--><img src="library/image/sign/categoryIcon_middle.png" class="icon" alt="icon" /><span>'.$langFile['btn_quickmenu_categories'].'</span><a href="#" class="toolTip" title="'.$langFile['btn_quickmenu_categories'].'::">&nbsp;</a></div>
    <div class="content blue">
      <ul class="verticalButtons">';      
        
      foreach($categories as $category) {
        if($_GET['category'] == $category['id'])
            $categorySelected = ' class="active"';
          else
            $categorySelected = '';                  
        echo '<li><a href="?site=pages&amp;category='.$category['id'].'" onclick="requestLeftSidebar(\''.$category['id'].'\',\''.$_GET['page'].'\',\''.$_GET['site'].'\');return false;"'.$categorySelected.'><span>'.$category['name'].'</span></a></li>';        
      }        
    echo '</ul>          
      </div>
      <div class="bottom"><a href="#">&nbsp;</a></div>
    </div>';
  }
  
  // ----  show QUICKMENU for the CATEGORY PAGES
  if(!empty($_GET['category'])) {
    
    // SPACER
    echo '<div class="spacer"></div>';
    
    echo '<div class="sidebarMenu free">
    <div class="top blue"><img src="library/image/sign/pageIcon_middle.png" class="icon" alt="icon" /><span>'.$categories['id_'.$_GET['category']]['name'].'</span><a href="#" class="toolTip" title="'.$langFile['btn_quickmenu_pages'].' '.$categories['id_'.$_GET['category']]['name'].'::">&nbsp;</a></div>
    <div class="content white">
      <ul class="verticalButtons">';      
      
      if($pages = $generalFunctions->loadPages($_GET['category'])) { 
  
        foreach($pages as $page) {
          if($_GET['page'] == $page['id'])
            $pageSelected = ' class="active"';
          else
            $pageSelected = '';
               
          echo '<li><a href="?category='.$page['category'].'&amp;page='.$page['id'].'"'.$pageSelected.'><span>'.$page['title'].'</span></a></li>';
        }       
      } else {
        echo '<li><a href="#"><span>'.$langFile['sortablePageList_categoryEmpty'].'</span></a></li>';
      }        
    echo '</ul>          
      </div>
      <div class="bottom"><a href="#">&nbsp;</a></div>
    </div>';
  }

// -----------------------------------------------------------------------------------
// SWITCH SITE
} else {

  // SWITCH the &_GET['site'] var
  switch($_GET['site']) {
    // ***** home -------------------------------------------- **********
    case 'home': case '':
      
      echo '<div class="sidebarInfo"><div class="content">';
      
      // -> SHOW TASK LOG
      echo '<h1>'.$langFile['home_taskLog_h1'].'</h1>';
      
      if(file_exists(DOCUMENTROOT.$adminConfig['basePath'].'statistic/log_tasks.txt') &&
         $logContent = file(DOCUMENTROOT.$adminConfig['basePath'].'statistic/log_tasks.txt')) {
         
         echo '<div id="sidbarTaskLogScrollUp" class="scrollUpDown" style="background: url(library/image/bg/sidebarScrollUp.png) no-repeat;margin-bottom:-30px;"></div>';
         echo '<div id="sidebarTaskLog"><br />
              <ul>
              <br />';
         foreach($logContent as $logRow) {
          $logRow = explode('|-|',$logRow);
          $logDate = $statisticFunctions->formatDate($generalFunctions->dateDayBeforeAfter($logRow[0]));
          $logTime = $statisticFunctions->formatTime($logRow[0]);
          // finds the "<br />" in the log row
          if(isset($logRow[3]))            
            echo '<li><span class="blue" style="font-weight:bold;">'.$logRow[2].'</span><br /><span>'.$logRow[3].'</span><br /><span class="brown">'.$logDate.' '.$logTime.'</span><br /><span>'.$langFile['home_user_h1'].': <b>'.$logRow[1].'</b></span></li>';         
          else
            echo '<li><span class="blue" style="font-weight:bold;">'.$logRow[2].'</span><br /><span class="brown">'.$logDate.' '.$logTime.'</span><br /><span>'.$langFile['home_user_h1'].': <b>'.$logRow[1].'</b></span></li>';
         }
         echo '</ul>
              <br /></div>';
         echo '<div id="sidbarTaskLogScrollDown" class="scrollUpDown" style="background: url(library/image/bg/sidebarScrollDown.png) no-repeat;margin-top:-30px;"></div>';
      // no log
      } else
        echo $langFile['home_taskLog_nolog'];
      
      echo '<hr />';
      
      // -> SHOW USERs
      echo '<h1><img src="library/image/sign/userIcon_small.png" alt="icon" style="position:relative;top:5px;" /> '.$langFile['home_user_h1'].'</h1><br />';
        if(file_exists(dirname(__FILE__).'/../.htpasswd')) {
          $users = file(dirname(__FILE__).'/../.htpasswd');
          natsort($users);
          // list user
          echo '<ul>';
          foreach($users as $user) {
            $user = substr($user,0,strpos($user,':'));
            
            // set the style for the active user
            if($user == $_SERVER['PHP_AUTH_USER'])
              $activeUserStyle = ' class="blue toolTip" style="font-weight:bold;" title="'.$langFile['user_currentuser'].'::"';
            else
              $activeUserStyle = '';
              
            // list users
            echo '<li><span'.$activeUserStyle.'>'.$user.'</span></li>';
          }
          echo '</ul>';
        // no users
        } else
          echo '<span style="color:#9E0000;">'.$langFile['user_nousers'].'</span>';
      
      echo '</div></div>';
      
      break;
    // ***** adminSetup sideBar -------------------------------------------- **********
    case 'adminSetup':
      
      echo '<div class="sidebarInfo"><div class="content">';
      
      // FMS INFO
      echo '<h1>'.$langFile['adminSetup_version'].'</h1>
            <p>'.$version[2].' - '.$version[3].'</p>';            
      echo '<hr />';
      
      if(substr(phpversion(),0,3) >= '4.3') {
           echo '<h1>'.$langFile['adminSetup_phpVersion'].'</h1>
            <p>'.phpversion().'</p>';
      } else {
          echo '<h1 style="color:#B70000;">'.$langFile['adminSetup_phpVersion'].'</h1>
            <p style="color:#B70000;">'.phpversion().'<br /><br /><b>'.$langFile['adminSetup_warning_phpversion'].' PHP 4.3.0</b></p>'; 
      }
      
      echo '<h1>'.$langFile['adminSetup_srvRootPath'].'</h1>';   
      echo '<p class="toolTip" title="'.$langFile['adminSetup_srvRootPath'].'::'.DOCUMENTROOT.'">'.DOCUMENTROOT.'</p>
          </div></div>';
      
      break;
    // ***** websiteSetup -------------------------------------------- **********
    case 'websiteSetup':     
      
      break;
    // ***** categorySetup -------------------------------------------- **********
    case 'categorySetup':
      
      // -> CATEGORY ANCHOR LINKS
      echo '<div style="position:fixed; top:150px;">';
      
      echo '<a href="?site=categorySetup&amp;status=createCategory#category'.getNewCatgoryId().'" class="createCategory toolTip" style="float:none; margin:10px 0px 0px 15px;" title="'.$langFile['categorySetup_createCategory'].'::"></a>'; 
      
      if(!empty($categories)) {
        echo '<div class="sidebarInfo"><div class="content">';     
        echo '<h1>'.$langFile['btn_quickmenu_categories'].'</h1>';
        echo '<ul>';      
        
        // -> show a anchor link to each category
        foreach($categories as $category) {
          echo '<li><a href="#category'.$category['id'].'" class="standardLink smoothAnchor">'.$category['name'].'</a></li>';
        
        }
        echo '</ul>';
        echo '</div></div>';
      }
      echo '</div>';

      break;
    // ***** userSetup -------------------------------------------- **********
    case 'userSetup':

      break;
    // ***** search -------------------------------------------- **********
    case 'search':

      break;
    // ***** deletePage -------------------------------------------- **********
    case 'deletePage':

      break;     
  } //switch END

}

?>