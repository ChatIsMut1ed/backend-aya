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
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:ObjObjet_translations,title'
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
        $ObjObjet = Objet::create([
            // 'title'    => $validator->validated()['title'],
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
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:ObjObjet_translations,title'
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
        $ObjObjet = Objet::where('id', $ObjObjet_id)->first();
        if (!$ObjObjet) {
            return response(
                [
                    'message' => "$ObjObjet_id Not Found"
                ],
                400
            );
        }
        $ObjObjet->name = $validator->validated()['title'];
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