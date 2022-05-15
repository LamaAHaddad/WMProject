<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Car::class,'car');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cars=Car::withCount('users')->get();
        return response()->view('cms.cars.index',['cars'=>$cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.cars.create');
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
            'active' => 'nullable|boolean',
        ]);

        if (!$validator->fails()) {
            $car = new Car();
            $car->name = $request->input('name');
            $car->active = $request->has('active');
            $isSaved = $car->save();
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
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
        return response()->view('cms.cars.edit',['car' => $car]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        //
        $validator = Validator($request->all(),[
            'name'=>'required|string|min:3|max:50,'.$car->id,
            'active' => 'nullable|boolean',
        ]);

        if(!$validator->fails()){
            $car->name=$request->input('name');
            $car->active = $request->has('active');
            $isSaved=$car->save();
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
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
        $deleted = $car->delete();
        return response()->json([
            'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
            'text' => $deleted ? 'Store Deleted Successfully' : 'Store Deleting Failed',
            'icon' => $deleted ? 'success' : 'error',
        ],
            $deleted ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST
        );
    }
}
