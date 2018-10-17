<!DOCTYPE html>
<html lang="nl" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Bios_view</title>
        <link rel="stylesheet" type="text/css" href="{appdir}/view/css/grid-v1.3.1.css">
        <link rel="stylesheet" type="text/css" href="{appdir}/view/css/master.css">
        <link rel="stylesheet" type="text/css" href="{appdir}/view/css/admin.css">

    </head>
    <body>
        <div class="content">
        
          <header class="siteHeader">
        
            <img  src="{appdir}/view/images/gpp.svg">

               <a href="{appdir}" >

                   <button class="goHomeButton"  type="button" name="button">
                     
                   </button>

               </a></img>

            <div class="headerButtonGroup">

               <a class="headerButtonSingle" href="{appdir}/catalogus/contact">

                 <button class="headerButtonSingle1" type="button" name="button">Contact</button>

               </a>

               <a class="headerButtonSingle " href="{appdir}/redacteur/login">

                 <a class="headerButtonSingle " href="{appdir}/login/logout">

                <!--    <button class="headerButtonSingle2" type="button" name="button"> {loginButtonText} </button> -->

               </a>

               <a class="headerButtonSingle " href="{appdir}/catalogus/catalogus">

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

          </header>

          <header class="siteShadow">
        
          </header>

          <div class="marginner">
          
          </div>

        
          </div>

          <div class="marginner">
          
          </div>
           
        <div class="content">
        
            {content}

        </div>
    </body>
</html>
