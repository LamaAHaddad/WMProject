<?php

namespace App\Http\Controllers;

use App\Mail\UserWelcomEmail;
use App\Models\Car;
use App\Models\City;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\FlareClient\Http\Response as HttpResponse;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::with('car')->withCount('permissions')->get();
        return response()->view('cms.users.index', ['users' => $users]);
    }

    public function editUserPermissions(Request $request,User $user){
        $permissions = Permission::where('guard_name', '=' , $user->guard_name)->get();

        $rolePermissions = $user->permissions;
        if (count($rolePermissions) > 0) {
            foreach ($permissions as $permission) {
                $permission->setAttribute('assigned', false);
                foreach ($rolePermissions as $rolePermission) {
                    if ($permission->id == $rolePermission->id) {
                        $permission->setAttribute('assigned', true);
                    }
                }
            }
        }
        return response()->view('cms.users.user-permission', ['user'=>$user, 'permissions'=>$permissions]);
    }

    public function updateRolePermissions(Request $request,User $user){
        $validator = Validator($request->all(),[
            'permission_id'=>'required|numeric|exists:permissions,id',
        ]);

        if(! $validator->fails()){
            $permission= Permission::findOrFail($request->input('permission_id'));
            if($user->hasPermissionTo($permission)){
                $user->revokePermissionTo($permission);
            }
            else{
                $user->givePermissionTo($permission);
            }
            return response()->json(
                ['message'=>'User Updated Successfully'],
                Response::HTTP_OK
            );
        }else{
            return response()->json(
                ['message'=>$validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cars=Car::where('active','=',true)->get();
        return response()->view('cms.users.create',['cars'=>$cars]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email_address' => 'required|email|unique:users,email',
            'car_id' => 'required|numeric|exists:cars,id',
            'mobile'=>'required|numeric',
        ]);

        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email_address');
            $user->password = Hash::make('password');
            $user->car_id = $request->input('car_id');
            $user->mobile=$request->input('mobile');
            $isSaved = $user->save();
            if($isSaved){
                Mail::to($user)->send(new UserWelcomEmail($user));
            }
            return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $cars = Car::where('active', '=', true)->get();
        return response()->view('cms.users.edit', ['user' => $user, 'cars' => $cars]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validator = Validator($request->all(),[
            'name'=>'required|string|min:3|max:50',
            'email_address'=>'required|email|max:40|unique:users,email,'.$user->id,
            'car_id'=>'required|numeric|exists:cars,id',
            'mobile'=>'required|numeric',
            
        ]);

        if(!$validator->fails()){
            $user->name=$request->input('name');
            $user->email=$request->input('email_address');
            $user->car_id=$request->input('car_id');
            $user->mobile=$request->input('mobile');
            $isSaved=$user->save();
            return response()->json(
                ['message'=>$isSaved ? 'Updated Successfully' : 'Update Failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        }
        else{
            return response()->json(['message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $deleted = $user->delete();
        return response()->json([
            'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
            'text' => $deleted ? 'Store Deleted Successfully' : 'Store Deleting Failed',
            'icon' => $deleted ? 'success' : 'error',
        ],
            $deleted ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST
        );
    }
}
