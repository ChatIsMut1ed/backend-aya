<?php

namespace App\Http\Controllers;

use App\Models\DemandeExpertiseSol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemandeExperController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = DemandeExpertiseSol::all();

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
     * @param int $DemandeDemandeExpertiseSol_id
     */
    public function GetInstanceById(int $DemandeDemandeExpertiseSol_id)
    {
        $instance = DemandeExpertiseSol::where('id', $DemandeDemandeExpertiseSol_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$DemandeDemandeExpertiseSol_id Not Found",
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
                //     'unique:DemandeDemandeExpertiseSol_translations,title'
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
        $DemandeDemandeExpertiseSol = DemandeExpertiseSol::create([
            // 'title'    => $validator->validated()['title'],
        ]);
        $DemandeDemandeExpertiseSol->save();

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
     * @param int $DemandeDemandeExpertiseSol_id
     */
    public function UpdateInstance(Request $request, int $DemandeDemandeExpertiseSol_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:DemandeDemandeExpertiseSol_translations,title'
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
        $DemandeDemandeExpertiseSol = DemandeExpertiseSol::where('id', $DemandeDemandeExpertiseSol_id)->first();
        if (!$DemandeDemandeExpertiseSol) {
            return response(
                [
                    'message' => "$DemandeDemandeExpertiseSol_id Not Found"
                ],
                400
            );
        }
        $DemandeDemandeExpertiseSol->name = $validator->validated()['title'];
        $DemandeDemandeExpertiseSol->save();

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
     * @param int $DemandeDemandeExpertiseSol_id
     */
    public function DeleteInstance(int $DemandeDemandeExpertiseSol_id)
    {
        $DemandeDemandeExpertiseSol = DemandeExpertiseSol::where('id', $DemandeDemandeExpertiseSol_id)->first();
        if (!$DemandeDemandeExpertiseSol) {
            return response(
                [
                    'message' => "$DemandeDemandeExpertiseSol_id Not Found"
                ],
                400
            );
        };
        $DemandeDemandeExpertiseSol->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}