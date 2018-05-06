<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Faculty;
use Exception;
use Session;
use DB;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicalRecords = MedicalRecord::orderBy('created_at', 'desc')->paginate(config('settings.paginate_default_val'));

        return view('medicalrecords.index', compact('medicalRecords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        $patientDefault = Patient::first();

        return view('medicalrecords.add', compact('patients', 'patientDefault'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $medicalRecord = MedicalRecord::findOrFail($id);

            return view('medicalrecords.detail', compact('medicalRecord'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        try {
            $medicalRecord->delete();

            Session::flash('successMsg', 'Xóa bệnh án thành công');
        } catch (Exception $e) {
            Session::flash('errorMsg', 'Xóa bệnh án thất bại');
        }

        return redirect()->route('medical-records.index');
    }

    public function search(Request $request)
    {
        if(!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }

        $searchData = '%' . $request->searchData . '%';
        $condition = $request->condition;
        $patientsId = Patient::where('name', 'like', $searchData)
            ->orWhere('address', 'like', $searchData)
            ->orWhere('insurance_number', 'like', $searchData)
            ->pluck('id');
        $facultiesId = Faculty::where('name', 'like', $searchData)->pluck('id');
        $medicalRecords = '';

        switch ($condition) {
            case config('settings.condition_search.medical_records.all'):
                $medicalRecords = MedicalRecord::where('id', 'like', $searchData)
                    ->orWhereIn('patient_id', $patientsId)
                    ->orWhereIn('faculty_id', $facultiesId)
                    ->get();
                break;
            case config('settings.condition_search.medical_records.name'):
                $patientsId = Patient::where('name', 'like', $searchData)->pluck('id');
                $medicalRecords = MedicalRecord::whereIn('patient_id', $patientsId)->get();
                break;
            case config('settings.condition_search.medical_records.id'):
                $medicalRecords = MedicalRecord::where('id', 'like', $searchData)->get();
                break;
            case config('settings.condition_search.medical_records.insurance_number'):
                $patientsId = Patient::where('insurance_number', 'like', $searchData)->pluck('id');
                $medicalRecords = MedicalRecord::whereIn('patient_id', $patientsId)->get();
                break;
            case config('settings.condition_search.medical_records.faculty'):
                $medicalRecords = MedicalRecord::whereIn('faculty_id', $facultiesId)->get();
                break;
        }

        return view('medicalrecords.search', compact('medicalRecords'));
    }

    public function deleteMulti(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $medicalRecordsId = $request->dataId;
                $medicalRecords = MedicalRecord::whereIn('id' ,$medicalRecordsId)->get();

                if (!count($medicalRecords)) {
                    throw new Exception("Error Processing Request", 1);
                }

                foreach ($medicalRecords as $medicalRecord) {
                    $medicalRecord->delete();
                }

                $request->session()->flash('successMsg', 'Xóa bệnh án thành công');
            });
        } catch (Exception $e) {
            $request->session()->flash('errorMsg', 'Xóa bệnh án thất bại');
        }
    }
}
