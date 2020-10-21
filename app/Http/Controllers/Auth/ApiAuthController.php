<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
class ApiAuthController extends Controller
{
   public function login (Request $request) {
      $validator = Validator::make($request->all(), [
          'email' => 'required|string|email|max:255',
          'password' => 'required',
      ]);
    
      if ($validator->fails())
      {
          return response(['errors'=>$validator->errors()->all()], 201);
      }
      $user = User::where('email', $request->email)->first();
      if ($user) {
          if (Hash::check($request->password, $user->password)) {
            // $http = new \GuzzleHttp\Client;

            // $response = $http->post('http://localhost:8000/api/oauth/token', [
            //     'form_params' => [
            //         'grant_type' => 'authorization_code',
            //         'client_id' => $request->client_id,
            //         'client_secret' => $request->secret,
            //         'username' => $request->email,
            //         'password' => $request->password,
            //         'scope' => '',
            //     ],[ 'headers' => [  'Accept' => 'application/json' ] ]
            // ]);
            
            // return $response->getBody();
              $token = $user->createToken('session')->accessToken;
              $authenticated = [];
              $authenticated['name'] = $user->name;
              $authenticated['id'] = $user->id;
              $authenticated['auth_token'] =$token;
              $authenticated['email'] =$user->email;
              $authenticated['email_verified_at'] =$user->email_verified_at;
              $authenticated['timestamp'] ='';
              
              $response = ['user'=>$authenticated];
              return response($response, 200);
          } else {
              return response()->json(['error'=>true,'message'=>'The credentials you supplied does not match on any of our records'], 201);
          }
      } else {
         return response()->json(['error'=>true,'message'=>'The credentials you supplied does not match on any of our records'], 201);
      }
  }

 public function logout(Request $request,User $user){
   //  $user->token()->revoke();
    return response()->json(['success'=>true],207);
 }


}
