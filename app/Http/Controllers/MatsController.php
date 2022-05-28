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

        return response(
            [
                $all_instances
            ],
            200
        );
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
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:Mat_translations,title'
                // ],
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
        $Mat =  Mat::create([
            // 'title'    => $validator->validated()['title'],
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
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:Mat_translations,title'
                // ],
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
        $Mat->name = $validator->validated()['title'];
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