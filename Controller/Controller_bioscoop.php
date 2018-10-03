<?php
    /**
     *
     */
    class Controller_bioscoop
    {
        function __construct($method, $params = FALSE) {
            $this->method = $method;
            if ($params != FALSE) {
                $this->params = $params;
            }

            $this->DataHandler = new DataHandler(DB_NAME, DB_USERNAME, DB_PASS, DB_SERVER_ADRESS, DB_TYPE);
            $this->TemplatingSystem = new TemplatingSystem("View/bios_view.tpl");
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

                default:
                    return $this->read();
                    break;
            }
        }

        public function create() {
            return "The method create is called";
        }

        public function read() {
            $sql = "SELECT * FROM bioscopen";
            $result = $this->DataHandler->ReadData($sql);

            $return = "";
            for ($i=0; $i < count($result); $i++) {
                $return .= "<div class='col-xs-12 col-s-6 col-m-4 col-m-3 float-l border'>";
                $row = $result[$i];
                foreach ($row as $key => $value) {
                    $return .= "<div>";
                    $return .= "$value";
                    $return .= "</div>";
                }

                $return .= "</div>";
            }

            $this->TemplatingSystem->setTemplateData("grid", $return);
            $return = $this->TemplatingSystem->GetParsedTemplate();

            return $return;
        }

        public function update() {
            return "The method update is called";
        }

        public function delete() {

            return "The method delete is called";
        }
    }
?>
