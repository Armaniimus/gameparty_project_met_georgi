<?php

    /**
     *
     */
    class SessionContextModel
    {

        private $permissions = NULL;
        private $gebruikersNaam = NULL;
        private $gebruikersRol = NULL;
        private $passwordHash = NULL;
        private $password = NULL;

        private $DataHandler;
        private $SessionModel;
        function __construct($dbName, $username, $pass, $serverAdress, $dbType) {
            $this->DataHandler = new DataHandler($dbName, $username, $pass, $serverAdress, $dbType);
            $this->SessionModel = new SessionModel();
        }

        public function SessionSupport() {
            $this->SessionModel->SessionSupport();

            if (!isset($_SESSION["gebruikersNaam"]) ) {
                $_SESSION["gebruikersNaam"] = NULL;
            }

            if (!isset($_SESSION["gebruikersRol"]) ) {
                $_SESSION["gebruikersRol"] = NULL;
            }

            if (!isset($_SESSION["loginBool"]) ) {
                $_SESSION["loginBool"] = NULL;
            }

            if (!isset($_SESSION["permissions"]) ) {
                $_SESSION["permissions"] = NULL;
            }

            $this->login();
        }

        public function login() {
            $this->getPostData();

            // check if there is post data related to login
            if (isset($_POST['password']) && isset($_POST['username'])) {
                // check if its possible to use the post data to get databack
                $this->getDatabaseData();
            }

            $loginInfo = $this->SessionModel->Login($this->gebruikersNaam, $this->password, $this->passwordHash);
            if ($loginInfo[0] === 2) {
                $this->setSessionData();
            }

            // echo "<br>";
            // echo $this->SessionModel->HashPassword($this->password);
            // echo "<br>";

            return [$this->gebruikersNaam, $loginInfo[0]];
        }

        private function getPostData() {
            if (!isset($_POST['password']) ) {
                $_POST['password'] = "";
            }
            $this->password = $_POST['password'];

            if (!isset($_POST['username']) ) {
                $_POST['username'] = "";
            }
            $this->gebruikersNaam = $_POST['username'];
        }

        private function getDatabaseData() {
            $gebruikersNaam = $this->gebruikersNaam;

            $sql = "SELECT `gebruikersNaam`, `passwordHash`, `rolType`, `perm_bios_toevoegen`, `perm_bios_wijzigen`, `perm_bios_verwijderen`, `perm_content_toevoegen`, `perm_content_wijzigen`, `perm_content_verwijderen`
            FROM gebruikers
            INNER JOIN gebruikers_rollen ON gebruikers.gebruikers_rollen_id = gebruikers_rollen.id
            WHERE gebruikersNaam = '$gebruikersNaam'";

            $data = $this->DataHandler->readSingleData($sql);

            if ($data) {
                $this->permissions = [];
                foreach ($data as $key => $value) {
                    switch ($key) {
                        case 'gebruikersNaam':
                            break;
                        case 'passwordHash':
                            $this->passwordHash = $value;
                            break;
                        case 'rolType':
                            $this->gebruikersRol = $value;
                            break;
                        default:
                            array_push($this->permissions, [$key => $value]);
                            break;
                    }
                }
            }
        }

        private function setSessionData() {
            $_SESSION["loginBool"] = 1;
            $_SESSION["gebruikersNaam"] = $this->gebruikersNaam;
            $_SESSION["gebruikersRol"] = $this->gebruikersRol;
            $_SESSION["permissions"] = $this->permissions;
        }
    }
 ?>
