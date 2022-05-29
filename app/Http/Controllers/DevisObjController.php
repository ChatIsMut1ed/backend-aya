<?php

namespace App\Http\Controllers;

use App\Models\DevisObj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DevisObjController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = DevisObj::all();

        return $all_instances;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $DevisObj_id
     */
    public function GetInstanceById(int $DevisObj_id)
    {
        $instance = DevisObj::where('id', $DevisObj_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$DevisObj_id Not Found",
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
                //     'unique:DevisObj_translations,title'
                // ],
                'obj_id' => 'required|integer',
                'nom' => 'required|string',
                'responsable' => 'required|string',
                'ecartement' => 'required|string',
                'ha' => 'required|string',
                'qts_totale' => 'required|integer',

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
        $DevisObj =  DevisObj::create([
            'obj_id'    => $validator->validated()['obj_id'],
            'nom'    => $validator->validated()['nom'],
            'responsable'    => $validator->validated()['responsable'],
            'ecartement'    => $validator->validated()['ecartement'],
            'ha'    => $validator->validated()['ha'],
            'qts_totale'    => $validator->validated()['qts_totale'],
        ]);
        $DevisObj->save();

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
     * @param int $DevisObj_id
     */
    public function UpdateInstance(Request $request, int $DevisObj_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'obj_id' => 'required|integer',
                'nom' => 'required|string',
                'responsable' => 'required|string',
                'ecartement' => 'required|string',
                'ha' => 'required|string',
                'qts_totale' => 'required|integer',
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
        $DevisObj = DevisObj::where('id', $DevisObj_id)->first();
        if (!$DevisObj) {
            return response(
                [
                    'message' => "$DevisObj_id Not Found"
                ],
                400
            );
        }
        $DevisObj->obj_id = $validator->validated()['obj_id'];
        $DevisObj->nom = $validator->validated()['nom'];
        $DevisObj->responsable = $validator->validated()['responsable'];
        $DevisObj->ecartement = $validator->validated()['ecartement'];
        $DevisObj->ha = $validator->validated()['ha'];
        $DevisObj->qts_totale = $validator->validated()['qts_totale'];
        $DevisObj->save();

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
     * @param int $DevisObj_id
     */
    public function DeleteInstance(int $DevisObj_id)
    {
        $DevisObj = DevisObj::where('id', $DevisObj_id)->first();
        if (!$DevisObj) {
            return response(
                [
                    'message' => "$DevisObj_id Not Found"
                ],
                400
            );
        };
        $DevisObj->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}