<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Position;
use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use Exception;
use Session;
use App\Traits\ClientProcesser;
use Auth;
use DB;

class StaffController extends Controller
{
    use ClientProcesser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = User::paginate(config('settings.paginate_default_val'));

        return view('staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = Faculty::all();
        $positions = Position::all();

        return view('staffs.add', compact('faculties', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStaffRequest $request)
    {
        try {
            $data = $request->only([
                'name',
                'address',
                'phone',
                'email',
                'birthday',
                'gender',
                'faculty_id',
                'position_id',
                'role',
                'status',
                'account',
                'password',
            ]);
            $data['id'] = uniqid();

            if ($request->has('image')) {
                $image = $this->uploadImage(config('settings.upload_path.staffs'), $request->image);

                if ($image) {
                    $data['image'] = $image;
                }
            }

            $staff = User::create($data);

            if ($staff) {
                $request->session()->flash('successMsg', 'Thêm nhân viên thành công');
            } else {
                $request->session()->flash('errorMsg', 'Thêm nhân viên thất bại');
            }

            return redirect()->route('staffs.index');
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
            $staff = User::findOrFail($id);

            return view('staffs.detail', compact('staff'));
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
            $staff = User::findOrFail($id);
            $faculties = Faculty::all();
            $positions = Position::all();

            return view('staffs.edit', compact('staff', 'faculties', 'positions'));
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
    public function update(UpdateStaffRequest $request, $id)
    {
        try {
            $staff = User::findOrFail($id);
            $data = $request->only([
                'name',
                'address',
                'phone',
                'email',
                'birthday',
                'gender',
                'faculty_id',
                'position_id',
            ]);

            if ($staff->role != config('settings.staff_role.super_admin')) {
                $data['role'] = $request->role;
                $data['status'] = $request->status;
                $data['account'] = $request->account;
            }

            if (!empty($request->password)) {
                $data['password'] = $request->password;
            }
            
            if ($request->has('image')) {
                $image = $this->uploadImage(config('settings.upload_path.staffs'), $request->image, $staff->image);

                if ($image) {
                    $data['image'] = $image;
                }
            }

            $staff = $staff->update($data);

            if ($staff) {
                $request->session()->flash('successMsg', 'Cập nhật nhân viên thành công');
            } else {
                $request->session()->flash('errorMsg', 'Cập nhật nhân viên thất bại');
            }

            return redirect()->route('staffs.index');
        } catch (Exception $e) {
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
            if ($id == Auth::user()->id) {
                throw new Exception("Error Processing Request", 1);
            }

            $staff = User::findOrFail($id);
            
            if ($staff->role == config('settings.staff_role.super_admin')) {
                throw new Exception("Error Processing Request", 1);
            }

            DB::transaction(function () use ($staff) {
                $staff->medicalRecords()->delete();
                $staff->delete();

                Session::flash('successMsg', 'Xóa nhân viên thành công');
            });
        } catch (Exception $e) {
            Session::flash('errorMsg', 'Xóa nhân viên thất bại');
        }

        return redirect()->route('staffs.index');
    }

    public function changeStatus(Request $request)
    {
        if(!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }

        try {
            $staff = User::findOrFail($request->staffId);
            $staff->update([
                'status' => !$request->status,
            ]);

            return response()->json([
                'success' => true,
                'status' => (int)$staff->status,
                'content' => $staff->role_content,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
            ]);
        }
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
        $positionsId = Position::where('name', 'like', $searchData)->pluck('id');
        $facultiesId = Faculty::where('name', 'like', $searchData)->pluck('id');
        $staffs = '';

        switch ($condition) {
            case config('settings.condition_search.staffs.all'):
                $staffs = User::where('id', 'like', $searchData)
                    ->orWhere('name', 'like', $searchData)
                    ->orWhereIn('faculty_id', $facultiesId)
                    ->orWhereIn('position_id', $positionsId)
                    ->orWhere('phone', 'like', $searchData)
                    ->get();
                break;
            case config('settings.condition_search.staffs.name'):
                $staffs = User::where('name', 'like', $searchData)->get();
                break;
            case config('settings.condition_search.staffs.id'):
                $staffs = User::where('id', 'like', $searchData)->get();
                break;
            case config('settings.condition_search.staffs.faculty'):
                $staffs = User::whereIn('faculty_id', $facultiesId)->get();
                break;
        }

        return view('staffs.search', compact('staffs'));
    }

    public function deleteMulti(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $staffsId = $request->dataId;
                $staffs = User::whereIn('id' ,$staffsId)->get();

                if (!count($staffs)) {
                    throw new Exception("Error Processing Request", 1);
                }

                foreach ($staffs as $staff) {
                    if ($staff->role == config('settings.staff_role.super_admin')) {
                        throw new Exception("Error Processing Request", 1);
                    }

                    $staff->medicalRecords()->delete();
                    $staff->delete();
                }

                $request->session()->flash('successMsg', 'Xóa nhân viên thành công');
            });
        } catch (Exception $e) {
            $request->session()->flash('errorMsg', 'Xóa nhân viên thất bại');
        }
    }
}
