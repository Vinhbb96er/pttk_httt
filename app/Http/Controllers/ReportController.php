<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Faculty;
use App\Models\Registration;
use App\Models\MedicalRecord;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function showPatient()
    {
        $patients = Patient::paginate(config('settings.paginate_default_val'));
        $faculties = Faculty::all();
        $data = [
            'time_from' => '',
            'time_to' => '',
            'faculty' => config('settings.reports.patients.all_faculty'),
            'kind' => config('settings.reports.patients.all_kind'),
        ];

        return view('reports.patients.index', compact([
            'patients', 
            'faculties',
            'data',
        ]));
    }

    public function statisticPatient(Request $request)
    {
        $data = $request->only([
            'time_from',
            'time_to',
            'faculty',
            'kind',
        ]);
        $faculties = Faculty::all();

        if (!empty($data['time_from'])) {
            $patients = Patient::where('reception_date', '>=', $data['time_from']);
        }

        if (!empty($data['time_to'])) {
            if (isset($patients)) {
                $patients = $patients->where('reception_date', '<=', $data['time_to']);
            } else {
                $patients = Patient::where('reception_date', '<=', $data['time_to']);
            }

        }

        if ($data['faculty'] !== (String)config('settings.reports.patients.all_faculty')) {
            $registrationsId = Registration::where('faculty_id', $data['faculty'])->pluck('patient_id');

            if (isset($patients)) {
                $patients = $patients->whereIn('id', $registrationsId);
            } else {
                $patients = Patient::whereIn('id', $registrationsId);
            }
        }

        if (($data['kind']) != config('settings.reports.patients.all_kind')) {
            if (isset($patients)) {
                $patients = $patients->where('kind', $data['kind']);
            } else {
                $patients = Patient::where('kind', $data['kind']);
            }
        }

        if (isset($patients)) {
            $patients = $patients->paginate(config('settings.paginate_default_val'));
        } else {
            $patients = Patient::paginate(config('settings.paginate_default_val'));
        }

        return view('reports.patients.index', compact([
            'patients', 
            'faculties',
            'data',
        ]));     
    }

    public function exportPatient(Request $request)
    {
        $type = $request->type;
        $data = Patient::all()->toArray();
        
        return Excel::create('Báo cáo Bệnh nhân', function ($excel) use ($data) {
            $excel->sheet('Bệnh nhân', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }


    public function showMedicalRecord()
    {
        $medicalRecords = MedicalRecord::paginate(config('settings.paginate_default_val'));
        $faculties = Faculty::all();
        $data = [
            'time_from' => '',
            'time_to' => '',
            'faculty' => config('settings.reports.medical_record.all_faculty'),
            'status' => config('settings.reports.medical_record.all_status'),
        ];

        return view('reports.medicalrecords.index', compact([
            'medicalRecords', 
            'faculties',
            'data',
        ]));
    }

    public function statisticMedicalRecord(Request $request)
    {
        $data = $request->only([
            'time_from',
            'time_to',
            'faculty',
            'status',
        ]);
        $faculties = Faculty::all();

        if (!empty($data['time_from'])) {
            $medicalRecords = MedicalRecord::where('create_date', '>=', $data['time_from']);
        }

        if (!empty($data['time_to'])) {
            if (isset($medicalRecords)) {
                $medicalRecords = $medicalRecords->where('create_date', '<=', $data['time_to']);
            } else {
                $medicalRecords = MedicalRecord::where('create_date', '<=', $data['time_to']);
            }

        }

        if ($data['faculty'] != (String) config('settings.reports.medical_record.all_faculty')) {
            if (isset($medicalRecords)) {
                $medicalRecords = $medicalRecords->where('faculty_id', $data['faculty']);
            } else {
                $medicalRecords = MedicalRecord::where('faculty_id', $data['faculty']);
            }
        }

        if (($data['status']) != config('settings.reports.medical_record.all_status')) {
            if (isset($medicalRecords)) {
                $medicalRecords = $medicalRecords->where('status', $data['status']);
            } else {
                $medicalRecords = MedicalRecord::where('status', $data['status']);
            }
        }

        if (isset($medicalRecords)) {
            $medicalRecords = $medicalRecords->paginate(config('settings.paginate_default_val'));
        } else {
            $medicalRecords = MedicalRecord::paginate(config('settings.paginate_default_val'));
        }

        return view('reports.medicalrecords.index', compact([
            'medicalRecords', 
            'faculties',
            'data',
        ]));    
    }

    public function exportMedicalRecord(Request $request)
    {
        $type = $request->type;
        $data = MedicalRecord::all()->toArray();
        
        return Excel::create('Báo cáo Bệnh án', function ($excel) use ($data) {
            $excel->sheet('Bệnh án', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
