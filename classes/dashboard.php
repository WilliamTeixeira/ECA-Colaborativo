<?php
/**
 * Description of dashboard
 *
 * @author willi
 */
class dashboard {
    
    private $quantidadePagamentos;
    private $soma;
    private $mes;
    private $media;
    private $totalBenef;
    
    function __construct() {
        
    }
    
    function getQuantidadePagamentos() {
        return $this->quantidadePagamentos;
    }

    function getSoma() {
        return $this->soma;
    }

    function getMes() {
        return $this->mes;
    }

    function getMedia() {
        return $this->media;
    }

    function getTotalBenef() {
        return $this->totalBenef;
    }

    function setQuantidadePagamentos($quantidadePagamentos) {
        $this->quantidadePagamentos = $quantidadePagamentos;
    }

    function setSoma($soma) {
        $this->soma = $soma;
    }

    function setMes($mes) {
        $this->mes = $mes;
    }

    function setMedia($media) {
        $this->media = $media;
    }

    function setTotalBenef($totalBenef) {
        $this->totalBenef = $totalBenef;
    }


}
