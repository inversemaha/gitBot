<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Support\Facades\Http;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Search resource from the API.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function searchUser(Request $request)
    {
        $username = $request['name'];

        $exists = User::where('login', $username)->first();
        if(is_null($exists)){
            // User does not exist
            try {
                $client = new \GuzzleHttp\Client(['headers' => ['Accept' => 'application/json']]);
                $res = $client->request('GET', "https://api.github.com/users/$username");
                $data = json_decode($res->getBody()->getContents(), true);
                $userLogin = $data['login'];
                $avatarUrl = $data['avatar_url'];
                if($data['name'] == null){
                    $userFname = $userLogin;
                }else{
                    $userFname = $data['name'];
                }
                $result = array(
                    'login' => $userLogin,
                    'image' => $avatarUrl,
                    'name' => $userFname,
                );
                // dd($result);

                $userId = User::insertGetId($result);

                $resRepos = $client->request('GET', "https://api.github.com/users/$username/repos");
                $reposData = json_decode($resRepos->getBody()->getContents(), true);
                $reposArray = array();
                foreach($reposData as $key =>$items){
                    array_push($reposArray,array(
                        'user_id'=>$userId,
                        'repo_name'=>$items['full_name'],
                        'repo_link'=>$items['html_url'],
                    ));
                }

                //dd($reposArray);
                Repository::insert($reposArray);
                return redirect('/');
            }catch (\Exception $exception){
                return [
                    'code' => 404,
                    'message' => $exception->getMessage(),
                ];

            }

        }else{
            try {

                $userDetails = User::with('repos')->where('login', 'like', '%' . $username . '%')->first();
                // return $userDetails;

                return view('find')->with('userDetails', $userDetails);

            } catch (\Exception $exception){
                return [
                    'code' => 404,
                    'message' => $exception->getMessage(),
                ];

            }


        }

    }


}
