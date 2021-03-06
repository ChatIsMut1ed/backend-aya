<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActiviteController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = Activite::all();

        return $all_instances;
    }
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index2()
    {
        $all_instances = Activite::all();
        $response = [];
        foreach ($all_instances as $all_instance) {
            array_push($response, ['name' => $all_instance->lib, 'code' => $all_instance->id]);
        }
        return $response;
    }
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $Activite_id
     */
    public function GetInstanceById(int $Activite_id)
    {
        $instance = Activite::where('id', $Activite_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$Activite_id Not Found",
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
                'lib' => 'required|string',
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
        $Activite =  Activite::create([
            'lib'    => $validator->validated()['lib'],
            'prix_unitaire'    => $validator->validated()['prix_unitaire'],
        ]);
        $Activite->save();

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
     * @param int $Activite_id
     */
    public function UpdateInstance(Request $request, int $Activite_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:Activite_translations,title'
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
        $Activite = Activite::where('id', $Activite_id)->first();
        if (!$Activite) {
            return response(
                [
                    'message' => "$Activite_id Not Found"
                ],
                400
            );
        }
        $Activite->name = $validator->validated()['title'];
        $Activite->save();

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
     * @param int $Activite_id
     */
    public function DeleteInstance(int $Activite_id)
    {
        $Activite = Activite::where('id', $Activite_id)->first();
        if (!$Activite) {
            return response(
                [
                    'message' => "$Activite_id Not Found"
                ],
                400
            );
        };
        $Activite->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}