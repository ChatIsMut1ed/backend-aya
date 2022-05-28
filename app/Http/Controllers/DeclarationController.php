<?php

namespace App\Http\Controllers;

use App\Models\Declaration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeclarationController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = Declaration::all();

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
     * @param int $Declaration_id
     */
    public function GetInstanceById(int $Declaration_id)
    {
        $instance = Declaration::where('id', $Declaration_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$Declaration_id Not Found",
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
                //     'unique:Declaration_translations,title'
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
        $Declaration =  Declaration::create([
            // 'title'    => $validator->validated()['title'],
        ]);
        $Declaration->save();

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
     * @param int $Declaration_id
     */
    public function UpdateInstance(Request $request, int $Declaration_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:Declaration_translations,title'
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
        $Declaration = Declaration::where('id', $Declaration_id)->first();
        if (!$Declaration) {
            return response(
                [
                    'message' => "$Declaration_id Not Found"
                ],
                400
            );
        }
        $Declaration->name = $validator->validated()['title'];
        $Declaration->save();

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
     * @param int $Declaration_id
     */
    public function DeleteInstance(int $Declaration_id)
    {
        $Declaration = Declaration::where('id', $Declaration_id)->first();
        if (!$Declaration) {
            return response(
                [
                    'message' => "$Declaration_id Not Found"
                ],
                400
            );
        };
        $Declaration->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}