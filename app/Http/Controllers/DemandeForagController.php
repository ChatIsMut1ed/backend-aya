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

        return $all_instances;
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
                'nom_postulant' => 'required|string',
                'prenom' => 'required|string',
                'cin' => 'required|integer',
                // 'date'=>'required|string',
                // 'date_disposition'=>'required|string',
                'adresse' => 'required|string',
                'tel' => 'required|string',
                'gouvernorat' => 'required|string',
                'decanat' => 'required|string',
                'superficie' => 'required|integer',
                'type_projet' => 'required|string',
                'remarque' => 'required|string',
                'type_plante' => 'required|string',
                // 'date_signature'=>'required|string',
            ]
        );
        if ($validator->fails()) {
            return response(
                [
                    'data' => $validator->errors(),
                    'message' => "Check Data Format"
                ],
                400
            );
        }
        $DemandeForageEau =  DemandeForageEau::create([
            // 'title'    => $validator->validated()['title'],
            'nom_postulant' => $validator->validated()['nom_postulant'],
            'prenom' => $validator->validated()['prenom'],
            'cin' => $validator->validated()['cin'],
            // 'date'=>$validator->validated()['title'],
            // 'date_disposition'=>$validator->validated()['title'],
            'adresse' => $validator->validated()['adresse'],
            'tel' => $validator->validated()['tel'],
            'gouvernorat' => $validator->validated()['gouvernorat'],
            'decanat' => $validator->validated()['decanat'],
            'superficie' => $validator->validated()['superficie'],
            'type_projet' => $validator->validated()['type_projet'],
            'remarque' => $validator->validated()['remarque'],
            'type_plante' => $validator->validated()['type_plante'],
            // 'date_signature'=>$validator->validated()['title'],
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
                'nom_postulant' => 'required|string',
                'prenom' => 'required|string',
                'cin' => 'required|integer',
                // 'date'=>'required|string',
                // 'date_disposition'=>'required|string',
                'adresse' => 'required|string',
                'tel' => 'required|string',
                'gouvernorat' => 'required|string',
                'decanat' => 'required|string',
                'superficie' => 'required|integer',
                'type_projet' => 'required|string',
                'remarque' => 'required|string',
                'type_plante' => 'required|string',
                // 'date_signature'=>'required|string',
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
        $DemandeForageEau = DemandeForageEau::where('id', $DemandeForageEau_id)->first();
        if (!$DemandeForageEau) {
            return response(
                [
                    'message' => "$DemandeForageEau_id Not Found"
                ],
                400
            );
        }
        $DemandeForageEau->nom_postulant = $validator->validated()['nom_postulant'];
        $DemandeForageEau->prenom = $validator->validated()['prenom'];
        $DemandeForageEau->cin = $validator->validated()['cin'];
        $DemandeForageEau->adresse = $validator->validated()['adresse'];
        $DemandeForageEau->tel = $validator->validated()['tel'];
        $DemandeForageEau->gouvernorat = $validator->validated()['gouvernorat'];
        $DemandeForageEau->decanat = $validator->validated()['decanat'];
        $DemandeForageEau->superficie = $validator->validated()['superficie'];
        $DemandeForageEau->type_projet = $validator->validated()['type_projet'];
        $DemandeForageEau->remarque = $validator->validated()['remarque'];
        $DemandeForageEau->type_plante = $validator->validated()['type_plante'];
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