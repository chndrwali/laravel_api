<?php

namespace App\Http\Controllers;

use App\Models\BiodataUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BiodataUserController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except:['index', 'show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BiodataUser::with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $fields = $request->validate([
            'position' => 'required',
            'name' => 'required',
            'birthday' => 'required',
            'no_ktp' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'blood_type' => 'required',
            'status' => 'required',
            'address_ktp' => 'required',
            'current_address' => 'required',
            'email_address' => 'required',
            'phone_number' => 'required',
            'emergency_phone_number' => 'required',
            'trainings' => 'array',
            'educations' => 'array',
            'works' => 'array',
            'skill' => 'required'
        ]);

        $biodata = $request->user()->biodataUser()->create($fields);

        if (!empty($fields['education'])) {
            $biodata->education()->createMany($fields['education']);
        }
        if (!empty($fields['training'])) {
            $biodata->training()->createMany($fields['training']);
        }
        if (!empty($fields['work'])) {
            $biodata->work()->createMany($fields['work']);
        }

        return [
            'biodata' => $biodata, 'user' => $biodata->user 
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(BiodataUser $biodataUser)
    {
        return [
            'biodata' => $biodataUser, 'user' => $biodataUser->user 
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BiodataUser $biodataUser)
    {
        $fields = $request->validate([
            'position' => 'sometimes',
            'name' => 'sometimes',
            'birthday' => 'sometimes',
            'no_ktp' => 'sometimes',
            'gender' => 'sometimes',
            'religion' => 'sometimes',
            'blood_type' => 'sometimes',
            'status' => 'sometimes',
            'address_ktp' => 'sometimes',
            'current_address' => 'sometimes',
            'email_address' => 'sometimes',
            'phone_number' => 'sometimes',
            'emergency_phone_number' => 'sometimes',
        ]);

        $biodataUser->update($fields);

        return [
            'biodata' => $biodataUser, 'user' => $biodataUser->user 
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BiodataUser $biodataUser)
    {
        $biodataUser->delete();

        return [ 'message' => 'biodata sudah di hapus' ];
    }
}
