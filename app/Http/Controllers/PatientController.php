<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests\PatientRequest;
use App\Traits\ClientProcesser;
use Exception;
use Session;
use DB;

class PatientController extends Controller
{
    use ClientProcesser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::orderBy('created_at', 'desc')->paginate(config('settings.paginate_default_val'));

        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        try {
            $data = $request->only([
                'name',
                'gender',
                'birthday',
                'address',
                'phone',
                'reception_date',
                'insurance_number',
                'kind',
                'expiration_date',
            ]);
            $data['id'] = uniqid();

            if ($request->has('image')) {
                $image = $this->uploadImage(config('settings.upload_path.patients'), $request->image);

                if ($image) {
                    $data['image'] = $image;
                }
            }

            $patient = Patient::create($data);

            if ($patient) {
                $request->session()->flash('successMsg', 'Thêm bệnh nhân thành công');
            } else {
                $request->session()->flash('errorMsg', 'Thêm bệnh nhân thất bại');
            }

            return redirect()->route('patients.index');
        } catch (Exception $e) {
            return redirect()->route('404');
        }
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
            $patient = Patient::findOrFail($id);

            return view('patients.detail', compact('patient'));
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
        try {
            $patient = Patient::findOrFail($id);

            return view('patients.edit', compact('patient'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, $id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $data = $request->only([
                'name',
                'gender',
                'birthday',
                'address',
                'phone',
                'reception_date',
                'insurance_number',
                'kind',
                'expiration_date',
            ]);

            if ($request->has('image')) {
                $image = $this->uploadImage(config('settings.upload_path.patients'), $request->image, $patient->image);

                if ($image) {
                    $data['image'] = $image;
                }
            }

            $patient = $patient->update($data);

            if ($patient) {
                $request->session()->flash('successMsg', 'Cập nhật bệnh nhân thành công');
            } else {
                $request->session()->flash('errorMsg', 'Cập nhật bệnh nhân thất bại');
            }

            return redirect()->route('patients.index');
        } catch (Exception $e) {
            dd($e);
            return redirect()->route('404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $patient = Patient::findOrFail($id);

            DB::transaction(function () use ($patient) {
                $patient->registrations()->delete();
                $patient->medicalRecords()->delete();
                $patient->delete();

                Session::flash('successMsg', 'Xóa bệnh nhân thành công');
            });
        } catch (Exception $e) {
            Session::flash('errorMsg', 'Xóa bệnh nhân thất bại');
        }

        return redirect()->route('patients.index');
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
        $patients = '';

        switch ($condition) {
            case config('settings.condition_search.patients.all'):
                $patients = Patient::where('id', 'like', $searchData)
                    ->orWhere('name', 'like', $searchData)
                    ->orWhere('phone', 'like', $searchData)
                    ->orWhere('address', 'like', $searchData)
                    ->orWhere('insurance_number', 'like', $searchData)
                    ->get();
                break;
            case config('settings.condition_search.patients.name'):
                $patients = Patient::where('name', 'like', $searchData)->get();
                break;
            case config('settings.condition_search.patients.id'):
                $patients = Patient::where('id', 'like', $searchData)->get();
                break;
            case config('settings.condition_search.patients.insurance_number'):
                $patients = Patient::where('insurance_number', 'like', $searchData)->get();
                break;
        }

        return view('patients.search', compact('patients'));
    }

    public function deleteMulti(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $patientsId = $request->dataId;
                $patients = Patient::whereIn('id' ,$patientsId)->get();

                if (!count($patients)) {
                    throw new Exception("Error Processing Request", 1);
                }

                foreach ($patients as $patient) {
                    $patient->registrations()->delete();
                    $patient->medicalRecords()->delete();
                    $patient->delete();
                }

                $request->session()->flash('successMsg', 'Xóa bệnh nhân thành công');
            });
        } catch (Exception $e) {
            $request->session()->flash('errorMsg', 'Xóa bệnh nhân thất bại');
        }
    }
}
