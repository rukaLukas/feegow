<?php
namespace App\Http\Controllers;

use App\Jobs\VaccinationReport;
use App\Services\ReportService;
use Illuminate\Support\Facades\Cache;

class ReportController extends ReferenceController
{    
    /**
     * @var RecordService
     */
    protected $service;

    protected $pollingTimeout = 60;

    public function __construct(ReportService $service)
    {        
        parent::__construct();
        $this->service = $service;
    }   

    public function unvaccinatedEmployees()
    {
         VaccinationReport::dispatch();

         return response()->json(['data' => 'Relatório sendo gerado.']);        
    }

    public function checkStatus()
    {
        $report = Cache::get('unvaccinated_report');

        if ($report && $report['status'] === 'completed') {
            return response()->json([
                'status' => 'completed',
                'filename' => $report['filename'],
                'download_link' => url('storage/' . $report['filename'])
            ]);
        }
        
        return response()->json(['status' => 'Relatório sendo gerado']);
    }
}