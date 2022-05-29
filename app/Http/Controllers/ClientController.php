<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = Client::all();

        return $all_instances;
    }
    /**
     * @param Illuminate\Http\Requsest $request
     * @return  \Illuminate\Http\Response
     */
    public function index2()
    {
        $all_instances = Client::all();
        $response = [];
        foreach ($all_instances as $all_instance) {
            array_push($response, ['name' => $all_instance->cin, 'code' => $all_instance->id]);
        }
        return $response;
    }
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $Client_id
     */
    public function GetInstanceById(int $Client_id)
    {
        $instance = Client::where('id', $Client_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$Client_id Not Found",
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
     * @param int $Client_id
     */
    public function GetInstanceByCin(int $Client_id)
    {
        $instance = Client::where('cin', $Client_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$Client_id Not Found",
                ],
                200
            );
        }
        return $instance;
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
                //     'unique:Client_translations,title'
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
        $Client =  Client::create([
            // 'title'    => $validator->validated()['title'],
        ]);
        $Client->save();

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
     * @param int $Client_id
     */
    public function UpdateInstance(Request $request, int $Client_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:Client_translations,title'
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
        $Client = Client::where('id', $Client_id)->first();
        if (!$Client) {
            return response(
                [
                    'message' => "$Client_id Not Found"
                ],
                400
            );
        }
        $Client->name = $validator->validated()['title'];
        $Client->save();

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
     * @param int $Client_id
     */
    public function DeleteInstance(int $Client_id)
    {
        $Client = Client::where('id', $Client_id)->first();
        if (!$Client) {
            return response(
                [
                    'message' => "$Client_id Not Found"
                ],
                400
            );
        };
        $Client->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}