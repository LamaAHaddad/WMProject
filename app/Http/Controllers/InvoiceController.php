<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Invoice::class,'invoice');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = Invoice::all();
        return response()->view('cms.invoices.index',['invoices'=>$invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.invoices.create');
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
        ]);

        if (!$validator->fails()) {
            $invoices = new Invoice();
            $invoices->name = $request->input('name');
            $isSaved = $invoices->save();
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
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
        return response()->view('cms.invoices.edit',['invoice' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
        $validator = Validator($request->all(),[
            'name'=>'required|string|min:3|max:50',
        ]);

        if(!$validator->fails()){
            $invoice->name=$request->input('name');
            $isSaved=$invoice->save();
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
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
        $deleted = $invoice->delete();
        return response()->json([
            'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
            'text' => $deleted ? 'Store Deleted Successfully' : 'Store Deleting Failed',
            'icon' => $deleted ? 'success' : 'error',
        ],
            $deleted ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST
        );
    }
}
