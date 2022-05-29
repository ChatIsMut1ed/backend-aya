<?php

namespace App\Http\Controllers;

use App\Models\Objet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObjController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = Objet::all();

        return $all_instances;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index2()
    {
        $all_instances = Objet::all();
        $response = [];
        foreach ($all_instances as $all_instance) {
            array_push($response, ['name' => $all_instance->designation, 'code' => $all_instance->id]);
        }
        return $response;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $ObjObjet_id
     */
    public function GetInstanceById(int $ObjObjet_id)
    {
        $instance = Objet::where('id', $ObjObjet_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$ObjObjet_id Not Found",
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
                'unite' => 'required|string',
                'prix_unitaire' => 'required|integer',
                'superficie' => 'required|integer',
                'qts_par_h' => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return response(
                [
                    'data' => $validator->errors(),
                    'message' => 'Check Data Format'
                ],
                400
            );
        }
        $ObjObjet = Objet::create([
            'designation'    => $validator->validated()['designation'],
            'unite'    => $validator->validated()['unite'],
            'prix_unitaire'    => $validator->validated()['prix_unitaire'],
            'superficie'    => $validator->validated()['superficie'],
            'qts_par_h'    => $validator->validated()['qts_par_h'],
        ]);
        $ObjObjet->save();

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
     * @param int $ObjObjet_id
     */
    public function UpdateInstance(Request $request, int $ObjObjet_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'designation' => 'required|string',
                'unite' => 'required|string',
                'prix_unitaire' => 'required|integer',
                'superficie' => 'required|integer',
                'qts_par_h' => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return response(
                [
                    'data' => $validator->errors(),
                    'message' => 'Check Data Format'
                ],
                400
            );
        }
        $ObjObjet = Objet::where('id', $ObjObjet_id)->first();
        if (!$ObjObjet) {
            return response(
                [
                    'message' => "$ObjObjet_id Not Found"
                ],
                400
            );
        }
        $ObjObjet->designation = $validator->validated()['designation'];
        $ObjObjet->unite = $validator->validated()['unite'];
        $ObjObjet->prix_unitaire = $validator->validated()['prix_unitaire'];
        $ObjObjet->superficie = $validator->validated()['superficie'];
        $ObjObjet->qts_par_h = $validator->validated()['qts_par_h'];
        $ObjObjet->save();

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
     * @param int $ObjObjet_id
     */
    public function DeleteInstance(int $ObjObjet_id)
    {
        $ObjObjet = Objet::where('id', $ObjObjet_id)->first();
        if (!$ObjObjet) {
            return response(
                [
                    'message' => "$ObjObjet_id Not Found"
                ],
                400
            );
        };
        $ObjObjet->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}