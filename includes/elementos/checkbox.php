<?php

    class Checkbox extends Elemento {
        public function __construct($nombre) {
            parent::__construct($nombre);
        }

        public function pintar() {
            $checked = ($this->valor == 'S') ? 'checked' : '';
            return "
                <div class=\"mb-3\">
                    <label class=\"form-label\">{$this->nombre}</label><br>
                    <input type=\"checkbox\" name=\"{$this->nombre}\" value=\"S\" {$checked}> Marcar como tutor
                </div>
            ";
        }
    }