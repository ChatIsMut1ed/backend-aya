<?php

namespace App\Http\Controllers;

use App\Models\VariableChangeante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaribleChangController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = VariableChangeante::all();

        return $all_instances;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $VariableChangeante_id
     */
    public function GetInstanceById(int $VariableChangeante_id)
    {
        $instance = VariableChangeante::where('id', $VariableChangeante_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$VariableChangeante_id Not Found",
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
                //     'unique:VariableChangeante_translations,title'
                // ],
                'tva' => 'required|integer',
                'timbre' => 'required|integer'
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
        $VariableChangeante =  VariableChangeante::create([
            'tva'    => $validator->validated()['tva'],
            'timbre'    => $validator->validated()['timbre'],
        ]);
        $VariableChangeante->save();

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
     * @param int $VariableChangeante_id
     */
    public function UpdateInstance(Request $request, int $VariableChangeante_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tva' => 'required|integer',
                'timbre' => 'required|integer'
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
        $VariableChangeante = VariableChangeante::where('id', $VariableChangeante_id)->first();
        if (!$VariableChangeante) {
            return response(
                [
                    'message' => "$VariableChangeante_id Not Found"
                ],
                400
            );
        }
        $VariableChangeante->tva = $validator->validated()['tva'];
        $VariableChangeante->timbre = $validator->validated()['timbre'];
        $VariableChangeante->save();

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
     * @param int $VariableChangeante_id
     */
    public function DeleteInstance(int $VariableChangeante_id)
    {
        $VariableChangeante = VariableChangeante::where('id', $VariableChangeante_id)->first();
        if (!$VariableChangeante) {
            return response(
                [
                    'message' => "$VariableChangeante_id Not Found"
                ],
                400
            );
        };
        $VariableChangeante->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}