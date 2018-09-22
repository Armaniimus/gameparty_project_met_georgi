<!DOCTYPE html>
<html lang="nl">
<body>
    <main>
        <form action="index.php/{page}" method="post">

            <div class="float-l col-xs-2"><br></div>
            <div class="float-l col-xs-8 login--center">
                <label for="username">Gebruikersnaam</label><br>
                <input type="text" name="username" id="username" value="{gebruiker}"><br><br>

                <label for="password">Wachtwoord</label><br>
                <input type="text" name="password" id="password"><br><br>

                <input class="inlog-knop" type="submit" name="submit" value="login">
            </div>
            <div class="float-l col-xs-2"><br></div>
        </form>
        <div>{info}</div>
    </main>
</body>
</html>
