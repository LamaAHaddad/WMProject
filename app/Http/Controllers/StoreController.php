<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Store::class,'store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stores=Store::with('city')->get();
        return response()->view('cms.stores.index', ['stores' => $stores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities=City::where('active','=',true)->get();
        return response()->view('cms.stores.create',['cities'=>$cities]);
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
            'name' => 'required|string|min:3',
            'mobile'=>'required|numeric',
            'city_id' => 'required|numeric|exists:cities,id',
        ]);

        if (!$validator->fails()) {
            $store = new Store();
            $store->name = $request->input('name');
            $store->location=$request->input('location');
            $store->mobile=$request->input('mobile');
            $store->city_id = $request->input('city_id');
            $isSaved = $store->save();
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
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
        $cities = City::where('active', '=', true)->get();
        return response()->view('cms.stores.edit', ['store' => $store, 'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
        $validator = Validator($request->all(),[
            'name'=>'required|string|min:3|max:50',
            'name' => 'required|string|min:3',
            'mobile'=>'required|numeric',
            'city_id'=>'required|numeric|exists:cities,id',
        ]);

        if(!$validator->fails()){
            $store->name=$request->input('name');
            $store->location=$request->input('location');
            $store->mobile=$request->input('mobile');
            $store->city_id=$request->input('city_id');
            $isSaved=$store->save();
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
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
        $deleted = $store->delete();
        return response()->json([
            'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
            'text' => $deleted ? 'Store Deleted Successfully' : 'Store Deleting Failed',
            'icon' => $deleted ? 'success' : 'error',
        ],
            $deleted ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST
        );

    }
}
