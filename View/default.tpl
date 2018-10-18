<!DOCTYPE html>
<html lang="nl" dir="ltr">
    <head>
        <link rel="stylesheet" href="{appdir}/view/css/responsive.css">
        <link rel="stylesheet" href="{appdir}/view/css/master.css">
        <link rel="stylesheet" href="{appdir}/view/css/grid-v1.3.1.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <meta charset="utf-8">
        <title>GamePlayParty</title>
    </head>
    <body>
        <div class="content">

            <header class="siteHeader">
                <img  src="{appdir}/view/images/gpp.svg">
                    <a href="{appdir}" >
                        <button class="goHomeButton"  type="button" name="button"></button>
                    </a>
                </img>
                <div class="headerButtonGroup">
                    <a class="headerButtonSingle" href="{appdir}/catalogus/contact">
                        <button class="headerButtonSingle1" type="button" name="button">Contact</button>
                    </a>
                    <a class="headerButtonSingle " href="{appdir}/redacteur/login">
                        <a class="headerButtonSingle " href="{appdir}/login/logout">
                        <button class="headerButtonSingle2" type="button" name="button"> {loginButtonText} </button>
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
            <div class="siteShadow"></div>
            <div class="marginner"></div>

            <main>
                {main-content}
            </main>
        </div>
        <div class="marginner"></div>

        <footer>
            <div class="content">
                <div class="col-xs-4">
                    <ul>
                        <li><a href="{appdir}/catalogus/contact">Contact</a></li>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Reserveren</a></li>
                    </ul>
                </div>

                <div class="col-xs-4">
                    <ul>
                        <li><a href="#">Gebruiksvoorwaarden</a></li>
                        <li><a href="#">Privacybeleid</a></li>
                        <li><a href="#">Cookiebeleid</a></li>
                    </ul>
                </div>

                <div class="col-xs-4">
                    <ul>
                        <li><a href="#">Algemene Verkoopvoorwaarden</a></li>
                        <li><a href="#">Privacy beleid B2B</a></li>
                        <li><a href="#">Sitemap</a></li>
                    </ul>
                </div>
            </div>

        </footer>
    </body>
</html>
