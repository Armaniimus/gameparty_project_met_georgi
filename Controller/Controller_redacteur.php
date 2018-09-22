<?php
    /**
     *
     */
    class Controller_redacteur
    {
        function __construct($method, $params = FALSE) {
            $this->method = $method;
            if ($params != FALSE) {
                $this->params = $params;
            }
        }

        public function runController() {
            switch ($this->method) {
                case 'inhoud_toe':
                    return $this->inhoud_toe();
                    break;

                case 'inhoud_aan':
                    return $this->inhoud_aan();
                    break;

                case 'inhoud_del':
                    // if (isset($this->params[0]) ) {
                    //     $id = $this->params[0];
                    //     return $this->delete($id);
                    // } else {
                    return $this->inhoud_del();
                    // }
                    break;

                case 'bios_toe':
                    // if (isset($this->params[0]) ) {
                    //     $id = $this->params[0];
                    //     return $this->delete($id);
                    // } else {
                    return $this->bios_toe();
                    // }
                    break;

                default:
                    return $this->overzicht();
                    break;
            }
        }

        public function inhoud_toe() {
            return "The method inhoud toevoegen is called";
        }

        public function inhoud_aan() {
            return "The method inhoud aanpassen is called";
        }

        public function inhoud_del() {
            return "The method inhoud deleten is called";
        }

        public function bios_toe() {
            return "The method bioscoop toevoegen is called";
        }

        public function overzicht() {
            return "The method overzicht is called";
        }
    }
?>
