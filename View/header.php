<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>GameplayParties</title>
    <link rel="stylesheet" href="../View/css/responsive.css">
    <link rel="stylesheet" href="../View/css/master.css">
     <link rel="stylesheet" href="../View/css/grid-v1.3.1.css">
  </head>
  <body>

    <div class="content">

      <header class="siteHeader">

        <img  src="<?php echo APP_DIR?>/view/images/gpp.svg"><a href="<?php echo APP_DIR?>" ><button class="goHomeButton"  type="button" name="button"></button></a></img>
        <div class="headerButtonGroup">
      <a class="headerButtonSingle" href="<?php echo APP_DIR?>/catalogus/contact">
      <button class="headerButtonSingle1" type="button" name="button">Contact</button>
      </a>
      <a class="headerButtonSingle " href="<?php echo APP_DIR?>/login/logout">
      <button class="headerButtonSingle2" type="button" name="button"><?php if($_SESSION["loginBool"]==1){echo "Loguit";}else{
        echo "Login";
      } ?></button>
      </a>
      <a class="headerButtonSingle " href="<?php echo APP_DIR?>/catalogus/catalogus">
      <button class="headerButtonSingle3" type="button" name="button">Catalogus</button>
      </a>
      <button class="headerButtonDropdown headerButtonSingle4" href="#">
      <div class="dropdown-home">
      <span>Wees hier voor meer!</span>
      <div class="dropdown-home-content">
      <p class="dropdown-home-link">Een toekomstige destinatie</p>
      <p class="dropdown-home-link dropdown-home-border">Een prachtige link</p>
      <p class="dropdown-home-link dropdown-home-border">Een verwachten functie</p>
      </div>
      </div>
      </button>
        </div>

        
        <!-- <div class="adminMenuTriangle">
          <label class="col-xs-12 adminMenuContent"></label>
          <label class="col-xs-12 adminMenuContent"></label>
          <label class="col-xs-9 adminMenuContent"></label>
          <label class="col-xs-3 adminMenuContent">{adminContent0}</label>
          <label class="col-xs-7 adminMenuContent"></label>
          <label class="col-xs-5 adminMenuContent">{adminContent1}</label>
          <label class="col-xs-5 adminMenuContent"></label>
          <label class="col-xs-7 adminMenuContent">{adminContent2}</label>
          <label class="col-xs-3 adminMenuContent"></label>
          <label class="col-xs-9 adminMenuContent">{adminContent3}</label>
        </div> -->
      </header>





      <header class="siteShadow">

      </header>
