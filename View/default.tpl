<!DOCTYPE html>
<html lang="nl" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{appdir}/view/css/master.css">
        <link rel="stylesheet" href="{appdir}/view/css/grid-v1.3.1.css">
        <title>{title}</title>
    </head>
    <body>
        <header class="mainHeader">
            <button class="col-xs-1 float minHeight" type="button" name="menu">Menu</button>
            <h2 class="col-xs-7 float minHeight">GameplayParties</h2>

            <form class="col-xs-4 float minHeight" action="" method="post">
                <input type="text" name="username" placeholder="Gebruikersnaam">
                <input type="password" name="password" placeholder="Wachtwoord">
                <input type="submit" value="Login">
                <input type="submit" name="logout" value="Logout">
            </form>
        </header>

        <main class="main">
            {main}
        </main>

        <footer class="footer">
            &copy;copyright gameplay parties
        </footer>
    </body>
</html>
