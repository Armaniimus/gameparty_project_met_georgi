<!DOCTYPE html>
<html lang="nl">
    <head>
        <link rel="stylesheet" type="text/css" href="../View/css/master.css">
        <link rel="stylesheet" type="text/css" href="../View/css/grid-v1.3.1.css">        
    </head>
    <body>
        <header class="headerBiosToevoegen">
            Bioscoop Toevoegen
        </header>
        <main>
            <div class="float-l col-xs-2"><br></div>
            <div class="float-l col-xs-8 login--center" style="border: 1px solid">
                
                <form action="index.php/{page}" method="post" class="form-blok">

                    <label for="biosNaam">Bioscoop naam: </label>
                    <input type="text" name="biosNaam" id="biosNaam" placeholder="Bioscoop Naam"><br><br>

                    <label for="provincie">Provincie: </label>
                    <input type="text" name="provincie" id="provincie" placeholder="Provincie"><br><br>

                    <label for="adres">Adres: </label>
                    <input type="text" name="adres" id="adres" placeholder="Jaarbeursboulevard 300"><br><br>

                    <label for="telefoonnummer">telefoonnummer: </label>
                    <input type="text" name="telefoonnummer" id="telefoonnummer" placeholder="030-1234567"><br><br>
                    <div class="knopjes">
                        <input class="toevoeg-knop" type="submit" name="submit" value="Toevoegen" class="formulier-buttons">
                        
                        <a href="../Redacteur/overzicht" class="formulier-buttons">
                        
                        	cancel
                    	
                        </a>
                    </div>
                </form>
            
            </div>
            <div class="float-l col-xs-2"><br></div>
        
        </main>
    
    </body>

</html>
