<?php

namespace App\Http\Controllers;

use App\Models\DemandeForageEau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemandeForagController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = DemandeForageEau::all();

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
     * @param int $DemandeForageEau_id
     */
    public function GetInstanceById(int $DemandeForageEau_id)
    {
        $instance = DemandeForageEau::where('id', $DemandeForageEau_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$DemandeForageEau_id Not Found",
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
                //     'unique:DemandeForageEau_translations,title'
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
        $DemandeForageEau =  DemandeForageEau::create([
            // 'title'    => $validator->validated()['title'],
        ]);
        $DemandeForageEau->save();

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
     * @param int $DemandeForageEau_id
     */
    public function UpdateInstance(Request $request, int $DemandeForageEau_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:DemandeForageEau_translations,title'
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
        $DemandeForageEau = DemandeForageEau::where('id', $DemandeForageEau_id)->first();
        if (!$DemandeForageEau) {
            return response(
                [
                    'message' => "$DemandeForageEau_id Not Found"
                ],
                400
            );
        }
        $DemandeForageEau->name = $validator->validated()['title'];
        $DemandeForageEau->save();

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
     * @param int $DemandeForageEau_id
     */
    public function DeleteInstance(int $DemandeForageEau_id)
    {
        $DemandeForageEau = DemandeForageEau::where('id', $DemandeForageEau_id)->first();
        if (!$DemandeForageEau) {
            return response(
                [
                    'message' => "$DemandeForageEau_id Not Found"
                ],
                400
            );
        };
        $DemandeForageEau->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}