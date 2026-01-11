<?php

    class RadioButton extends Elemento {
        private $opciones = [];

        public function __construct($nombre, $opciones = []) {
            parent::__construct($nombre);
            $this->opciones = $opciones;
        }

        public function pintar() {
            $html = "<div class=\"mb-3\">";
            $html .= "<label class=\"form-label\">{$this->nombre}</label><br>";

            foreach ($this->opciones as $valor => $etiqueta) {
                $checked = ($this->valor == $valor) ? 'checked' : '';
                $html .= "<input type=\"radio\" name=\"{$this->nombre}\" value=\"{$valor}\" {$checked}> {$etiqueta}<br>";
            }

            $html .= "</div>";
            return $html;
        }
    }