<?php

namespace App\Console\Commands;

use App\Services\PyramidService;
use Illuminate\Console\Command;

/**
 * Comando Artisan para generar una piramide desde la línea de comandos
 * 
 * @package App\Console\Commands
 */
class GeneratePyramidCommand extends Command
{
    /**
     * Nombre del comando
     *
     * @var string
     */
    protected $signature = 'piramide:genera 
                            {number : numero base para la piramide (1-9)}
                            {--filas=10 : numero de filas (1-20)}';

    /**
     * Descripcion del comando
     *
     * @var string
     */
    protected $description = 'Genera una piramide basada en el numero ingresado';

    protected $pyramidService;


    public function __construct(PyramidService $pyramidService)
    {
        parent::__construct();
        $this->pyramidService = $pyramidService;
    }

    public function handle()
    {
        $numBase = $this->argument('number');
        $filas = $this->option('filas');

        // Validaciones
        if ($numBase < 1 || $numBase > 9) {
            $this->error('El numero debe estar entre 1 y 9');
            return 1;
        }

        if ($filas < 1 || $filas > 20) {
            $this->error('El numero de filas debe estar entre 1 y 20');
            return 1;
        }

        $this->info("Generando piramide con el numero: {$numBase}");
        $this->info("Numero de filas: {$filas}");
        $this->line(str_repeat('-', 50));

        $piramide = $this->pyramidService->generaPiramide($numBase, $filas);
        
        $this->line($piramide);
        
        $this->line(str_repeat('-', 50));
        $this->info('Piramide generada exitosamente!');

        return 0;
    }
}