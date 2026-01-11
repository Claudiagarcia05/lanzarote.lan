<?php

    class Elemento {   
        function __construct($datos=[]) {
            $this->nombre        = $datos['nombre']        ?? '';
            $this->type          = $datos['type']          ?? 'text';
            $this->literal_error = $datos['literal_error'] ?? '';
            $this->style_error   = $datos['style_error']   ?? '';
            $this->disabled      = $datos['disabled']      ?? '';
            $this->esqueleto     = $datos['esqueleto']     ?? true;
            $this->options       = $datos['options']       ?? false;
        }

        protected function previo_pintar() {
            if ($this->disabled)
                $this->disabled = ' readonly="readonly" ';

            if (!empty($this->error)) {
                $this->literal_error = ' <span class="error">'. Idioma::lit('valor_obligatorio') .'</span>';
                $this->style   = 'error';
            }

            if ($this->disabled) {
                $this->disabled = ' readonly="readonly" ';
                $this->style   = ' disabled';
            }

            if ($this->esqueleto) {
                $this->previo_envoltorio = "
                <div class=\"mb-3\">
                    <label for=\"id{$this->nombre}\" class=\"form-label\">". Idioma::lit($this->nombre)."</label>
                ";
                $this->post_envoltorio = "</div>";
            }
        }

        function pintar() {
            $this->previo_pintar();

            return "
                {$this->previo_envoltorio}
                    {$this->literal_error}
                    <input {$this->disabled} value=\"". Campo::val($this->nombre) ."\" name=\"{$this->nombre}\" type=\"{$this->type}\" class=\"{$this->style} form-control\" id=\"id{$this->nombre}\" placeholder=\"". Idioma::lit('placeholder'.$this->nombre)."\">
                {$this->post_envoltorio}
            ";
        }

        function validar() {
            
        }
    }