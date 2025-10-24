<?php

namespace App\Services;

class PyramidService
{
    /**
     * Genera una pirámide de números basada en el valor ingresado por el usuario
     *
     * @param int $numBase Número base para la pirámide
     * @param int $rows Número de filas
     * @return string Pirámide final
     */
    public function generaPiramide(int $numBase, int $rows = 10): string
    {
        $piramide = '';
        
        for ($i = 1; $i <= $rows; $i++) {
            
            // Calcula los espacios para centrarlo
            $espacios = $this->calculaEspacios($i, $rows, $numBase);
            $piramide .= str_repeat(' ', $espacios);
            
            // Generar secuencia de lado izquierdo
            $secuenciaIzq = $this->generaSecuenciaIzq($i, $numBase);
            $piramide .= $secuenciaIzq;
            
            // Generar secuencia del lado derecho
            $secuenciaDer = $this->generaSecuenciaDer($i, $numBase);
            $piramide .= $secuenciaDer;
            
            $piramide .= "\n";
        }
        
        return $piramide;
    }

    /**
     * Calcula los espacios necesarios para centrar las filas
     *
     * @param int $fila Fila actual
     * @param int $filasTotales Total de filas
     * @param int $numBase Número base
     * @return int Número de espacios
     */
    private function calculaEspacios(int $fila, int $filasTotales, int $numBase): int
    {
        // Obtenemos el tam de la fila mas larga
        $tamMaximo = $this->calculaTamFila($filasTotales, $numBase);
        $tamFila = $this->calculaTamFila($fila, $numBase);
        
        return (int)(($tamMaximo - $tamFila) / 2);
    }

    /**
     * Calcula la longitud de una fila específica
     *
     * @param int $numFila Número de fila
     * @param int $numBase Número base
     * @return int Longitud de la fila
     */
    private function calculaTamFila(int $numFila, int $numBase): int
    {
        $tamIzq = $numFila;
        $tamDer = $numFila - 1;
        $tamTotal = 0;
        
        // Obtenemos el tam del lado isquiero
        for ($i = $numFila; $i >= 1; $i--) {
            $tamTotal += strlen((string)($i * $numBase));
        }
        
        // Obtenemos el tam del lado derecho
        for ($i = 2; $i <= $numFila; $i++) {
            $tamTotal += strlen((string)($i * $numBase));
        }
        
        return $tamTotal;
    }

    /**
     * Genera la secuencia del lado izquierdo
     *
     * @param int $numFila Número de fila
     * @param int $numBase Número base
     * @return string Secuencia izquierda
     */
    private function generaSecuenciaIzq(int $numFila, int $numBase): string
    {
        $secuencia = '';
        
        for ($i = $numFila; $i >= 1; $i--) {
            $secuencia .= (string)($i * $numBase);
        }
        
        return $secuencia;
    }

    /**
     * Genera la secuencia del lado derecho
     *
     * @param int $numFila Número de fila
     * @param int $numBase Número base
     * @return string Secuencia derecha
     */
    private function generaSecuenciaDer(int $numFila, int $numBase): string
    {
        $secuencia = '';
        
        for ($i = 2; $i <= $numFila; $i++) {
            $secuencia .= (string)($i * $numBase);
        }
        
        return $secuencia;
    }
}