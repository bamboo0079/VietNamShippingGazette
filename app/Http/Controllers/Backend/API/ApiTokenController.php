<?php

namespace App\Http\Controllers\Backend\API;

use App\Models\UserNotify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ApiTokenController extends Controller
{
    public $public_key = '';
    public function __construct()
    {
//        $this->middleware('auth:api')->except(['login', 'pushNotify']);
    }

    /**
     * Update the authenticated user's API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    /**
    * Post email and password and you will received the token to authorize via API
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'    => ['required', 'string', 'email', 'max:255'],
            'password'        => 'required|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $token = '';
        $password = $request->get('password');
        $email = $request->get('email');
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            $token = Str::random(60);
            $user = Auth::guard('admin')->user();
            DB::table('admins')->where('id', $user->id)->update(['api_token' => hash('sha256', $token)]);
        }
        return response()->json(['token' => $token], 200);
    }

    public function createUser(Request $request){
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = $this->create($request->all());
        $responseCode = $user->id ? 200 : 201;
        $response = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'register_date' => $user->register_date,
        ];
        return response()->json($response, $responseCode);
    }

    public function deleteUser(Request $request){
        $responseCode = 200;
        $validator = Validator::make($request->all(), [
            'token' => [
                'required',
                Rule::in([$this->public_key]),
            ],
            'user_id' => 'required|max:191'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::where('id', $request->get('user_id'))->first();
        if($user){
            $user->update(['block' => 1]);
            $response = [
                'user_id' => $user->id,
                'deleted' => true,
            ];
            return response()->json($response, $responseCode);
        }else{
            $json_error = [
                'user_id' => [
                    'User does not exist',
                ]
            ];
            return response()->json($json_error, 201);
        }
    }

    public function rules()
    {
        $rules = [
            'token' => [
                'required',
                Rule::in([$this->public_key]),
            ],
            'name' => 'required|max:191',
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'        => 'required|max:191',
//            'register_date'  => ['required','date_format:Y-m-d' ],
        ];

        return $rules;
    }

    public function create(array $data)
    {
        // set default register date
        if(!isset($data['register_date']) || $data['register_date'] == ''){
            $data['register_date'] = date("Y-m-d", time());
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'register_date' => $data['register_date'],
            'email_verified_at' => date("Y-m-d H:i:s", time()),
            'block' => 0,
            'password' => Hash::make($data['password']),
        ]);
    }

    public function pushNotify(Request $request){
        $submit_data = $request->all();
        $return = ['status' => 0];
        if(isset($submit_data['public_key']) && $submit_data['public_key'] == config('const.public_key') && $submit_data['user_id'] && $submit_data['token']){
            $return['status'] = 1;
            $return['data'] = UserNotify::saveData($submit_data);
        }
        echo json_encode($return);
    }

}