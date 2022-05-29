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

        return $all_instances;
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
                'nom_postulant' => 'required|string',
                'cin' => 'required|integer',
                'adresse' => 'required|string',
                'tel' => 'required|string',
                'num_frais_im' => 'required|integer',
                'local' => 'required|string',
                'endroit' => 'required|string',
                'decanat' => 'required|string',
                'delegation' => 'required|string',
                'superficie' => 'required|integer',
                'ut_act_sol' => 'required|string',
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
        $DemandeDemandeExpertiseSol = DemandeExpertiseSol::create([
            'nom_postulant'    => $validator->validated()['nom_postulant'],
            'cin'    => $validator->validated()['cin'],
            'adresse'    => $validator->validated()['adresse'],
            'tel'    => $validator->validated()['tel'],
            'num_frais_im'    => $validator->validated()['num_frais_im'],
            'local'    => $validator->validated()['local'],
            'endroit'    => $validator->validated()['endroit'],
            'decanat'    => $validator->validated()['decanat'],
            'delegation'    => $validator->validated()['delegation'],
            'superficie'    => $validator->validated()['superficie'],
            'ut_act_sol'    => $validator->validated()['ut_act_sol'],

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
                'nom_postulant' => 'required|string',
                'cin' => 'required|integer',
                'adresse' => 'required|string',
                'tel' => 'required|string',
                'num_frais_im' => 'required|integer',
                'local' => 'required|string',
                'endroit' => 'required|string',
                'decanat' => 'required|string',
                'delegation' => 'required|string',
                'superficie' => 'required|integer',
                'ut_act_sol' => 'required|string',
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
        $DemandeDemandeExpertiseSol = DemandeExpertiseSol::where('id', $DemandeDemandeExpertiseSol_id)->first();
        if (!$DemandeDemandeExpertiseSol) {
            return response(
                [
                    'message' => "$DemandeDemandeExpertiseSol_id Not Found"
                ],
                400
            );
        }
        $DemandeDemandeExpertiseSol->nom_postulant = $validator->validated()['nom_postulant'];
        $DemandeDemandeExpertiseSol->cin = $validator->validated()['cin'];
        $DemandeDemandeExpertiseSol->adresse = $validator->validated()['adresse'];
        $DemandeDemandeExpertiseSol->tel = $validator->validated()['tel'];
        $DemandeDemandeExpertiseSol->num_frais_im = $validator->validated()['num_frais_im'];
        $DemandeDemandeExpertiseSol->local = $validator->validated()['local'];
        $DemandeDemandeExpertiseSol->endroit = $validator->validated()['endroit'];
        $DemandeDemandeExpertiseSol->decanat = $validator->validated()['decanat'];
        $DemandeDemandeExpertiseSol->delegation = $validator->validated()['delegation'];
        $DemandeDemandeExpertiseSol->superficie = $validator->validated()['superficie'];
        $DemandeDemandeExpertiseSol->ut_act_sol = $validator->validated()['ut_act_sol'];
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