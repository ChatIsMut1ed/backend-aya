<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotifiactionController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = Notification::all();

        return $all_instances;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     * @param int $Notification_id
     */
    public function GetInstanceById(int $Notification_id)
    {
        $instance = Notification::where('id', $Notification_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$Notification_id Not Found",
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
                //     'unique:Notification_translations,title'
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
        $Notification =  Notification::create([
            // 'title'    => $validator->validated()['title'],
        ]);
        $Notification->save();

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
     * @param int $Notification_id
     */
    public function UpdateInstance(Request $request, int $Notification_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:Notification_translations,title'
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
        $Notification = Notification::where('id', $Notification_id)->first();
        if (!$Notification) {
            return response(
                [
                    'message' => "$Notification_id Not Found"
                ],
                400
            );
        }
        $Notification->name = $validator->validated()['title'];
        $Notification->save();

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
     * @param int $Notification_id
     */
    public function DeleteInstance(int $Notification_id)
    {
        $Notification = Notification::where('id', $Notification_id)->first();
        if (!$Notification) {
            return response(
                [
                    'message' => "$Notification_id Not Found"
                ],
                400
            );
        };
        $Notification->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}
