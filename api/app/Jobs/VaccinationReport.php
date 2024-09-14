<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use App\Services\ReportService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class VaccinationReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $reportService = app()->make(ReportService::class);
        
        $unvaccinatedEmployees = $reportService->unvaccinatedEmployees();  
        $report = "";      
        foreach ($unvaccinatedEmployees as $employee) {
            $report .= "Nome: {$employee->name}, CPF: {$employee->cpf}\n";
        }
        try {
            $filename = 'reports/unvaccinated_report_' . now()->format('Y-m-d_H:i:s') . '.txt';
        
            Storage::disk('public')->put($filename, $report);
           
            Cache::put('unvaccinated_report', ['status' => 'completed', 'filename' => $filename], 3600);
        } catch(Exception $e) {
            Log::error($e->getMessage());
        }
        Log::info("Gerado relatório empregados não vacinados.");
    }
}
