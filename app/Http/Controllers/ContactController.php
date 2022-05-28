<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $all_instances = Contact::all();

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
     * @param int $Contact_id
     */
    public function GetInstanceById(int $Contact_id)
    {
        $instance = Contact::where('id', $Contact_id)->first();

        if (!$instance) {
            return response(
                [
                    'data' => [],
                    'message' => "$Contact_id Not Found",
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
                //     'unique:Contact_translations,title'
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
        $Contact =  Contact::create([
            // 'title'    => $validator->validated()['title'],
        ]);
        $Contact->save();

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
     * @param int $Contact_id
     */
    public function UpdateInstance(Request $request, int $Contact_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'title-en' => [
                //     'required',
                //     'string',
                //     'max:191',
                //     'unique:Contact_translations,title'
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
        $Contact = Contact::where('id', $Contact_id)->first();
        if (!$Contact) {
            return response(
                [
                    'message' => "$Contact_id Not Found"
                ],
                400
            );
        }
        $Contact->name = $validator->validated()['title'];
        $Contact->save();

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
     * @param int $Contact_id
     */
    public function DeleteInstance(int $Contact_id)
    {
        $Contact = Contact::where('id', $Contact_id)->first();
        if (!$Contact) {
            return response(
                [
                    'message' => "$Contact_id Not Found"
                ],
                400
            );
        };
        $Contact->delete();

        return response(
            [
                'message' => 'successfull'
            ],
            200
        );
    }
}