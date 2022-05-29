<?php

namespace App\Http\Controllers;

use App\Models\DescriptionSociete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DescriptionSocController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = DescriptionSociete::all();

        return $all_instances;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $DescriptionSociete_id
     */
    public function GetInstanceById(int $DescriptionSociete_id)
    {
        $instance = DescriptionSociete::where('id', $DescriptionSociete_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$DescriptionSociete_id Not Found",
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
                'nom' => 'required|string',
                'adresse' => 'required|string',
                'email' => 'required|string',
                'num_bank' => 'required|integer',
                'tel' => 'required|string',
                'ref_tva' => 'required|string',
            ]
        );
        if ($validator->fails()) {
            return response(
                [
                    'data' => $validator->errors(),
                    'errors' => 'Check Data Form'
                ],
                400
            );
        }
        $DescriptionSociete =  DescriptionSociete::create([
            'nom' => $validator->validated()['nom'],
            'adresse' => $validator->validated()['adresse'],
            'email' => $validator->validated()['email'],
            'num_bank' => $validator->validated()['num_bank'],
            'tel' => $validator->validated()['tel'],
            'ref_tva' => $validator->validated()['ref_tva'],
        ]);
        $DescriptionSociete->save();

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
     * @param int $DescriptionSociete_id
     */
    public function UpdateInstance(Request $request, int $DescriptionSociete_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nom' => 'required|string',
                'adresse' => 'required|string',
                'email' => 'required|string',
                'num_bank' => 'required|integer',
                'tel' => 'required|string',
                'ref_tva' => 'required|string',
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
        $DescriptionSociete = DescriptionSociete::where('id', $DescriptionSociete_id)->first();
        if (!$DescriptionSociete) {
            return response(
                [
                    'message' => "$DescriptionSociete_id Not Found"
                ],
                400
            );
        }
        $DescriptionSociete->nom = $validator->validated()['nom'];
        $DescriptionSociete->adresse = $validator->validated()['adresse'];
        $DescriptionSociete->email = $validator->validated()['email'];
        $DescriptionSociete->num_bank = $validator->validated()['num_bank'];
        $DescriptionSociete->tel = $validator->validated()['tel'];
        $DescriptionSociete->ref_tva = $validator->validated()['ref_tva'];
        $DescriptionSociete->save();

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
     * @param int $DescriptionSociete_id
     */
    public function DeleteInstance(int $DescriptionSociete_id)
    {
        $DescriptionSociete = DescriptionSociete::where('id', $DescriptionSociete_id)->first();
        if (!$DescriptionSociete) {
            return response(
                [
                    'message' => "$DescriptionSociete_id Not Found"
                ],
                400
            );
        };
        $DescriptionSociete->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}