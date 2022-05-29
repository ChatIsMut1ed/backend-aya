<?php

namespace App\Http\Controllers;

use App\Models\Mat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatsController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = Mat::all();

        return $all_instances;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index2()
    {
        $all_instances = Mat::all();
        $response = [];
        foreach ($all_instances as $all_instance) {
            array_push($response, [
                'name' => $all_instance->designation,
                'code' => $all_instance->id
            ]);
        }
        return $response;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $Mat_id
     */
    public function GetInstanceById(int $Mat_id)
    {
        $instance = Mat::where('id', $Mat_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$Mat_id Not Found",
                ],
                200
            );
        }
        return response(
            [
                'data' => $instance,
                'message' => "success",
            ],
            200
        );
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function CreateInstance(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'designation' => 'required|string',
                'unite' => 'required|integer',
                'prix_unitaire' => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return response(
                [
                    'data' => $validator->errors(),
                    'errors' => 'Check Data Format'
                ],
                400
            );
        }
        $Mat =  Mat::create([
            'designation'    => $validator->validated()['designation'],
            'unite'    => $validator->validated()['unite'],
            'prix_unitaire'    => $validator->validated()['prix_unitaire'],
        ]);
        $Mat->save();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $Mat_id
     */
    public function UpdateInstance(Request $request, int $Mat_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'designation' => 'required|string',
                'unite' => 'required|integer',
                'prix_unitaire' => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return response(
                [
                    'data' => [],
                    'message' => $validator->errors()
                ],
                400
            );
        }
        $Mat = Mat::where('id', $Mat_id)->first();
        if (!$Mat) {
            return response(
                [
                    'message' => "$Mat_id Not Found"
                ],
                400
            );
        }
        $Mat->designation = $validator->validated()['designation'];
        $Mat->unite = $validator->validated()['unite'];
        $Mat->prix_unitaire = $validator->validated()['prix_unitaire'];
        $Mat->save();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $Mat_id
     */
    public function DeleteInstance(int $Mat_id)
    {
        $Mat = Mat::where('id', $Mat_id)->first();
        if (!$Mat) {
            return response(
                [
                    'message' => "$Mat_id Not Found"
                ],
                400
            );
        };
        $Mat->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}