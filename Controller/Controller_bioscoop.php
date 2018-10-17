<?php
    /**
     *
     */
    class Controller_bioscoop
    {
        private $templatingSystem;

        function __construct($method, $params = FALSE) {
            $this->method = $method;
            if ($params != FALSE) {
                $this->params = $params;
            }

            $this->DataHandler = new DataHandler(DB_NAME, DB_USERNAME, DB_PASS, DB_SERVER_ADRESS, DB_TYPE);
            $this->TemplatingSystem = new TemplatingSystem("View/bios_view.tpl");
                    $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
        }

        public function runController() {
            switch ($this->method) {
                case 'create':
                    return $this->create();
                    break;

                case 'update':
                    return $this->update();
                    break;

                case 'delete':
                    if (isset($this->params[0]) ) {
                        $id = $this->params[0];
                        return $this->delete($id);
                    } else {
                        return $this->read();
                    }
                    break;
                case 'read_single':
                    return $this->read_single();
                    break;

                default:
                    return $this->read();
                    break;
            }
        }

        public function create() {
            return "The method create is called";
        }

        public function read() {
            $loginBool = $_SESSION["loginBool"];

            if($loginBool == 1){
                $sql = "SELECT bioscoopID,bioscoop_naam,straatnaam,postcode, plaats, provincie FROM bioscopen";
                $result = $this->DataHandler->ReadData($sql);

                   

                $grid = "";

                $grid .= "<table>
                  <thead>
                    <tr>

                      <th>bioscoopID</th>
                      <th>bioscoop_naam</th>
                      <th>straatnaam</th>
                      <th>postcode</th>
                      <th>plaats</th>
                      <th>provincie</th>
                      <th>Read</th>
                      <th><a href=''>delete</a></th>      
                    </tr>
                  </thead><tbody>";

                foreach ($result as $key => $value) {

                    $grid .= "<tr>";

                    foreach ($value as $key => $attributen) {
                        $grid .= "<td>".$attributen."</td>";

                
                    }
                    $grid .= "<td><a href='../bioscoop/read_single/".$value['bioscoopID']."'>Read</a></td>";
                     $grid .= "</tr>";
                }

                $grid .= "</tbody>";

                $grid .= "</table>";


            
            
                $this->TemplatingSystem->setTemplateData("content", $grid);
                $return = $this->TemplatingSystem->GetParsedTemplate();

                return $return;

                
            } else if($loginBool == 0){
               header("Location: {appdir}/gameparty_project_met_georgi");
            }
        }

        public function update() {
            return "The method update is called";
        }

        public function read_single(){
             $loginBool = $_SESSION["loginBool"];

            if($loginBool == 1){

             $id = $this->params[0];

             $sql = "SELECT * FROM bioscopen where bioscoopID = $id";

             $result = $this->DataHandler->ReadData($sql);

             $naam                  = $result[0]['bioscoop_naam'];
             $straat                = $result[0]['straatnaam'];
             $postcode              = $result[0]['postcode'];
             $plaats                = $result[0]['plaats'];
             $provincie             = $result[0]['provincie'];
             $informatie            = $result[0]['informatie'];
             $openingstijden        = $result[0]['openingstijden'];
             $bereikbaarheidauto    = $result[0]['bereikbaarheid_auto'];
             $bereikbaarheidov      = $result[0]['bereikbaarheid_ov'];
             $bereikbaarheidfiets   = $result[0]['bereikbaarheid_fiets'];
             $rolstoel              = $result[0]['rolstoeltoegankelijkheid'];

             // echo "<pre>";
             // print_r($result);
             // echo "<pre>";



            $main = file_get_contents("view/partials/bios_read.html");

            $this->TemplatingSystem->setTemplateData("content", $main);
            $this->TemplatingSystem->setTemplateData("naam", $naam);
            $this->TemplatingSystem->setTemplateData("straat", $straat);
            $this->TemplatingSystem->setTemplateData("postcode", $postcode);
            $this->TemplatingSystem->setTemplateData("plaats", $plaats);
            $this->TemplatingSystem->setTemplateData("provincie", $provincie);
            $this->TemplatingSystem->setTemplateData("informatie", $informatie);
            $this->TemplatingSystem->setTemplateData("openingstijden", $openingstijden);
            $this->TemplatingSystem->setTemplateData("bereikbaarheidauto", $bereikbaarheidauto);
            $this->TemplatingSystem->setTemplateData("bereikbaarheidov", $bereikbaarheidov);
            $this->TemplatingSystem->setTemplateData("bereikbaarheidfiets", $bereikbaarheidfiets);
            $this->TemplatingSystem->setTemplateData("rolstoel", $rolstoel);

            $return = $this->TemplatingSystem->GetParsedTemplate();



            } 

            else if($loginBool == 0){
               header("Location: {appdir}/gameparty_project_met_georgi");
            }


            return $return;
        }

        public function delete() {

            return "The method delete is called";
        }
    }
?>
