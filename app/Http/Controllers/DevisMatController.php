<?php

namespace App\Http\Controllers;

use App\Models\DevisMat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DevisMatController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = DevisMat::all();

        return $all_instances;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $DevisMat_id
     */
    public function GetInstanceById(int $DevisMat_id)
    {
        $instance = DevisMat::where('id', $DevisMat_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$DevisMat_id Not Found",
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
                //     'unique:DevisMat_translations,title'
                // ],
                'nom' => 'required|string',
                'responsable' => 'required|string',
                'superficie' => 'required|integer',
                'qts' => 'required|integer',
                'mat_id' => 'required|integer',
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
        $DevisMat =  DevisMat::create([
            // 'title'    => $validator->validated()['title'],
            'nom' => $validator->validated()['nom'],
            'responsable' => $validator->validated()['responsable'],
            'superficie' => $validator->validated()['superficie'],
            'qts' => $validator->validated()['qts'],
            'mat_id' => $validator->validated()['mat_id'],
        ]);
        $DevisMat->save();

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
     * @param int $DevisMat_id
     */
    public function UpdateInstance(Request $request, int $DevisMat_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nom' => 'required|string',
                'responsable' => 'required|string',
                'superficie' => 'required|integer',
                'qts' => 'required|integer',
                'mat_id' => 'required|integer',
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
        $DevisMat = DevisMat::where('id', $DevisMat_id)->first();
        if (!$DevisMat) {
            return response(
                [
                    'message' => "$DevisMat_id Not Found"
                ],
                400
            );
        }
        $DevisMat->nom = $validator->validated()['nom'];
        $DevisMat->responsable = $validator->validated()['responsable'];
        $DevisMat->superficie = $validator->validated()['superficie'];
        $DevisMat->qts = $validator->validated()['qts'];
        $DevisMat->mat_id = $validator->validated()['mat_id'];
        $DevisMat->save();

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
     * @param int $DevisMat_id
     */
    public function DeleteInstance(int $DevisMat_id)
    {
        $DevisMat = DevisMat::where('id', $DevisMat_id)->first();
        if (!$DevisMat) {
            return response(
                [
                    'message' => "$DevisMat_id Not Found"
                ],
                400
            );
        };
        $DevisMat->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}