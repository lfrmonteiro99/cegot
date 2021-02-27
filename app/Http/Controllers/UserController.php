<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
Use Session;

class UserController extends Controller
{
    public function index()
    {
        return view('private.users.index');
    }

    public function getIndexTable()
    {
        $users = User::all();
        $users = Collection::make($users);

        return Datatables::of($users)
        ->editColumn('number', function($user){
            $route = '/private/user/show/'.$user->id;
            return '<a href="'.$route.'">'.$user->id.'</a>';
        })
        ->editColumn('name', function($user){
            $route = '/private/user/show/'.$user->id;
            return '<a href="'.$route.'">'.$user->name.'</a>';
        })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d/m/Y');
            })
            ->addColumn('action', function ($user) {
                $route = '/private/user/show/'.$user->id;
                return '<a href="'.$route.'" class="btn btn-simple btn-warning btn-icon edit" data-bs-toggle="tooltip" data-bs-placement="left" title="See"><i class="material-icons">dvr</i></a>
                <a onclick="javascript:removeConfirmation('.$user->id.')" class="btn btn-simple btn-danger btn-icon remove" data-bs-toggle="tooltip" data-bs-placement="left" title="Delete"><i class="material-icons">delete</i></a>';
            })
            ->rawColumns(['name', 'created_at', 'action'])
            ->make(true);
    }

    public function create()
    {
        $data['create'] = true;
        return view('private.users.user', $data);
    }

    public function store(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make('passwordbyadmin'),
	    'recovery_code' => GENERATE_RANDOM_STRING(10),
        ]);
	
	$request->request->add(['to' => $user->email]);
    $request->request->add(['template' => 'creation']);


	app('App\Http\Controllers\EmailController')->sendEmail($request);

        Session::flash('message', 'User created successfully!');

        return redirect('/private/user/show/'.$user->id);
    }

    public function show($id)
    {
        try {
            $user = User::whereId($id)->first();
            $data['user'] = $user;
            $data['show'] = true;

            return view('private.users.user', $data);
        } catch (\Throwable $t) {
            return redirect()->back();
        }
    }

    public function update(Request $request, $id){
        
        $user = User::whereId($id)->first();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->save();

        Session::flash('message', 'User updated successfully!');

        return redirect()->action(
            [UserController::class, 'show'], ['id' => $id]
        );
    }

    public function destroy($id){

        try{
        $user = User::whereId($id)->first();

        $user->delete();
        return response()->json('true', 200);

    }catch(\Throwable $t){
        return response()->json('false', 500);
    }
    }

    public function importUsers(){
        $csv = array_map('str_getcsv', file(storage_path()."/equipa_test.csv")); 
        foreach($csv as $line){
            $exploded = explode (';', $line[0]);
            $user = User::create([
                'name' => $exploded[0],
                'email' => $exploded[5],
                'role' => 'user',
                'password' => Hash::make('passwordbyadmin'),
                'recovery_code' => GENERATE_RANDOM_STRING(10),
            ]);

            $details = [
                'title' => 'Mail from ItSolutionStuff.com',
                'body' => 'This is for testing email using smtp',
                'to' => $user->email,
                'template' => 'presentation',
            ];

            \Mail::to($user->email)->send(new \App\Mail\SendEmail($details));
        }

        dd("Fim");
    }

    public function sendEmailPresentationUsers(Request $request){
        try{
            $users = User::all();
            foreach($users as $user){
                
            }
        }catch(\Throwable $t){

        }
    }
}
