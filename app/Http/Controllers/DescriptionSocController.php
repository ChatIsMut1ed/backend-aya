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
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:DescriptionSociete_translations,title'
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
        $DescriptionSociete =  DescriptionSociete::create([
            // 'title'    => $validator->validated()['title'],
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
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:DescriptionSociete_translations,title'
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
        $DescriptionSociete = DescriptionSociete::where('id', $DescriptionSociete_id)->first();
        if (!$DescriptionSociete) {
            return response(
                [
                    'message' => "$DescriptionSociete_id Not Found"
                ],
                400
            );
        }
        $DescriptionSociete->name = $validator->validated()['title'];
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