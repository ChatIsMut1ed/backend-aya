<?php

namespace App\Http\Controllers;

use App\Models\DemandeFacture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemandeFactureController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = DemandeFacture::all();

        return $all_instances;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $DemandeFacture_id
     */
    public function GetInstanceById(int $DemandeFacture_id)
    {
        $instance = DemandeFacture::where('id', $DemandeFacture_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$DemandeFacture_id Not Found",
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
                'qts' => 'required|string',
                'date' => 'required|string',
                'doit' => 'required|string',
                'act_id' => 'required|integer',
                // 'des_soc' => 'required|integer',
                // 'var_chang' => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return response(
                [
                    'data' => [],
                    'errors' => $validator->errors()
                ],
                400
            );
        }
        $DemandeFacture =  DemandeFacture::create([
            'qts'    => $validator->validated()['qts'],
            'date'    => $validator->validated()['date'],
            'doit'    => $validator->validated()['doit'],
            'act_id'    => $validator->validated()['act_id'],
            'des_soc'    => 1,
            'var_chang'    => 1,

        ]);
        $DemandeFacture->save();

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
     * @param int $DemandeFacture_id
     */
    public function UpdateInstance(Request $request, int $DemandeFacture_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:DemandeFacture_translations,title'
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
        $DemandeFacture = DemandeFacture::where('id', $DemandeFacture_id)->first();
        if (!$DemandeFacture) {
            return response(
                [
                    'message' => "$DemandeFacture_id Not Found"
                ],
                400
            );
        }
        $DemandeFacture->name = $validator->validated()['title'];
        $DemandeFacture->save();

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
     * @param int $DemandeFacture_id
     */
    public function DeleteInstance(int $DemandeFacture_id)
    {
        $DemandeFacture = DemandeFacture::where('id', $DemandeFacture_id)->first();
        if (!$DemandeFacture) {
            return response(
                [
                    'message' => "$DemandeFacture_id Not Found"
                ],
                400
            );
        };
        $DemandeFacture->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}