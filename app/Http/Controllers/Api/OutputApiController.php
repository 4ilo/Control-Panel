<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Output;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\ApiValidationException;
use App\Exceptions\OutputNotFoundException;

class OutputApiController extends Controller
{

    public function __construct()
    {
          $this->middleware('auth:api', ['except' => ['getAccessToken']]);
    }

    /**
     * Validate request and generate api response if fail
     * @param $request
     * @param $rules
     * @throws ApiValidationException
     */
    public function apiValidate($request, $rules)
    {
        $validator = \Validator::make($request->all(), $rules);

        if($validator->fails())
            throw new ApiValidationException($validator->errors());

    }

    /**
     * Prepare api response
     * @param $message
     * @param $data
     * @param array $error
     * @return array
     */
    public function apiResponse($message, $data=[], $error=[])
    {
        if($error != [])
        {
            $response = [
                'status' => false,
                'message' => $message,
                'data' => [],
                'errors' => $error
            ];
        }
        else
        {
            $response = [
                'status' => true,
                'message' => $message,
                'data' => $data,
                'errors' => []
            ];
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return array
     * @throws ApiValidationException
     */
    public function getAccessToken(Request $request)
    {
        $this->apiValidate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if($user)
        {
            if(\Hash::check($request->password, $user->password))
            {
                $token = $user->createToken('Control panel')->accessToken;

                return $this->apiResponse("User verified.", ['accessToken' => $token]);
            }
        }

        return $this->apiResponse("Invalid credentials.", [], ['authentication' => "Invalid credentials."]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Output[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $outputs = Output::all();

        return $this->apiResponse('All results fetched', $outputs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     * @throws ApiValidationException
     */
    public function store(Request $request)
    {
        $this->apiValidate($request, [
            'name' => 'required',
            'pin' => 'required|integer|between:0,40',
        ]);

        $output = Output::create($request->only(['name', 'pin']));

        return $this->apiResponse("Output created", $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Output $output
     * @return array
     */
    public function show(Output $output)
    {
        return $this->apiResponse('Result fetched', $output);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Output $output
     * @return array
     * @throws \Exception
     */
    public function update(Request $request, $output)
    {
        $output = $this->findOutput($output);

        $this->apiValidate($request, [
            'name' => 'required',
            'pin' => 'required|integer|between:0,40',
        ]);

        $output->update($request->only(['name', 'pin']));

        return $this->apiResponse('Output updated', $output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Output $output
     * @return array
     * @throws \Exception
     */
    public function destroy($output)
    {
        $output = $this->findOutput($output);

        $output->delete();

        return $this->apiResponse("Output deleted");
    }

    /**
     * Activate the output
     * @param Output $output
     * @return array
     * @throws OutputNotFoundException
     */
    public function activate($output)
    {
        $output = $this->findOutput($output);

        $output->activate();

        return $this->apiResponse("Output activated", $output);
    }

    /**
     * disable the output
     * @param Output $output
     * @return array
     * @throws OutputNotFoundException
     */
    public function disable($output)
    {
        $output = $this->findOutput($output);

        $output->disable();

        return $this->apiResponse("Output disabled", $output);
    }

    /**
     * Find output or throw exception
     * @param $id
     * @return Output
     * @throws OutputNotFoundException
     */
    private function findOutput($id)
    {
        $output = Output::find($id);

        if(!$output)
            throw new OutputNotFoundException();

        return $output;
    }
}
