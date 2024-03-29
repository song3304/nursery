<?php
namespace App\Drivers;

use App\Log;

//see OwenIt\Auditing\Auditors\DatabaseAuditor
class DatabaseAuditor {
	/**
     * Audit the model auditable.
     *
     * @param mixed $auditable
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function audit($auditable)
    {
        if(!config('auditing.is_enabled',false)) return true;
		$data = $auditable->toAudit();
		unset($data['id']);
        $report = Log::create(
			$data
        );

        //if ($report) {
        //    $auditable->clearOlderAudits();
        //}

        return $report;
    }
}