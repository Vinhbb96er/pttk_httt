<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ClientProcesser;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use Auth;
use Hash;

class ProfileController extends Controller
{
    use ClientProcesser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Auth::user();

        if (!$staff) {
            return redirect()->route('404');
        }

        return view('profile.index', compact('staff'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('profile.change-password');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChangePasswordRequest $request)
    {
        $staff = Auth::user();

        if (!$staff) {
            return redirect()->route('404');
        }

        if (!Hash::check($request->old_password, $staff->password)) {
            $request->session()->flash('errorMsg', 'Thất bại! Mật khẩu cũ không đúng');

            return redirect()->back();
        } 

        $result = $staff->update([
            'password' => $request->password,
        ]);

        if ($result) {
            $request->session()->flash('successMsg', 'Đổi mật khẩu thành công');
        } else {
            $request->session()->flash('errorMsg', 'Đổi mật khẩu thất bại');
        }

        return redirect()->route('profile.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Auth::user();

        if (!$staff) {
            return redirect()->route('404');
        }

        return view('profile.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        try {
            $staff = Auth::user();

            if (!$staff) {
                throw new Exception("Error Processing Request", 1);
            }

            $data = $request->only([
                'name',
                'address',
                'phone',
                'email',
                'birthday',
                'gender',
            ]);

            if ($request->has('image')) {
                $image = $this->uploadImage(config('settings.upload_path.staffs'), $request->image, $staff->image);

                if ($image) {
                    $data['image'] = $image;
                }
            }

            $result = $staff->update($data);

            if ($result) {
                $request->session()->flash('successMsg', 'Sửa thông tin thành công');
            } else {
                $request->session()->flash('errorMsg', 'Sửa thông tin thất bại');
            }

            return redirect()->route('profile.index');
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }
}
