<?php

namespace App\Http\Controllers;

use App\Models\Declaration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeclarationController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = Declaration::all();

        return $all_instances;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $Declaration_id
     */
    public function GetInstanceById(int $Declaration_id)
    {
        $instance = Declaration::where('id', $Declaration_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'errors' => "$Declaration_id Not Found",
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
                //     'unique:Declaration_translations,title'
                // ],
                "agent_de_representation" => 'required|string',
                "siege_social" => 'required|string',
                "enregistrement_commercial" => 'required|string',
                "id_poche_diwani" => 'required|string',
                "capital_social" => 'required|string',
                "nature_juridique" => 'required|string',
                "apport_etranger" => 'required|string',
                "Numéro_immatriculation_caisse_nationale" => 'required|string',
                "tel" => 'required|string',
                "fax" => 'required|string',
                "email" => 'required|string',
                "systeme_investissement" => 'required|string',
                "nature_projet" => 'required|string',
                "secteur" => 'required|string',
                "activite" => 'required|string',
                "activites_secondaires" => 'required|string',
                "Données_detaillees" => 'required|string',
                "numéro_plaque_immatriculation_1" => 'required|string',
                "numéro_plaque_immatriculation_2" => 'required|string',
                "numéro_plaque_immatriculation_3" => 'required|string',
                "etat" => 'required|string',
                "delegation" => 'required|string',
                "decanat" => 'required|string',
                "adresse_emplacement" => 'required|string',
                "servitude" => 'required|string',
                "espace" => 'required|string',
                "formulation_exploitation" => 'required|string',
                "date_signature" => 'required|string',
                "user_id" => 'required|string',
            ]
        );
        if ($validator->fails()) {
            return response(
                [
                    'data' => $validator->errors(),
                    'errors' => "Check Data Format"
                ],
                400
            );
        }
        $res = json_encode($request->all(), true);
        $Declaration =  Declaration::create([
            'resg_Dec' => $res,
            "resg_Enr" => "None",
            "resg_projet" => "None",
            "licence_projet" => "None",
            "lieu_projet" => "None",
            "emplois" => "None",
            "caracte_projet" => "None",
            "struct_finance" => "None",
            "declaration_equip" => "None",
            "mat_per_semi" => "None",
            "calendrier" => "None",
            "resg_inst_droite" => "None",
            "liv_cert_per_inves" => "None",
            "incitation_requises" => "None",
            "repar_capital_social" => "None",

        ]);
        $Declaration->save();

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
     * @param int $Declaration_id
     */
    public function UpdateInstance(Request $request, int $Declaration_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:Declaration_translations,title'
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
        $Declaration = Declaration::where('id', $Declaration_id)->first();
        if (!$Declaration) {
            return response(
                [
                    'message' => "$Declaration_id Not Found"
                ],
                400
            );
        }
        $Declaration->name = $validator->validated()['title'];
        $Declaration->save();

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
     * @param int $Declaration_id
     */
    public function DeleteInstance(int $Declaration_id)
    {
        $Declaration = Declaration::where('id', $Declaration_id)->first();
        if (!$Declaration) {
            return response(
                [
                    'message' => "$Declaration_id Not Found"
                ],
                400
            );
        };
        $Declaration->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}