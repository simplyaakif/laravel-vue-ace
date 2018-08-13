<?php

namespace App\Http\Controllers;

use App\Queries;
use App\Http\Resources\QueriesResource;
use App\Http\Requests;
use Illuminate\Http\Request;

class QueriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queries = Queries::orderBy('id', 'desc')->paginate(30);
        return QueriesResource::collection($queries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = $request->isMethod('put') ? Queries::findOrFail($request->qr_id) : new Queries;
        $query->id = $request->input('qr_id');
        $query->qr_name = $request->input('qr_name');
        $query->qr_course = $request->input('qr_course');

        if($query->save()){
            return new QueriesResource($query);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Queries  $queries
     * @return \Illuminate\Http\Response
     */
    public function show(Queries $queries)
    {
        $query = Queries::findOrFail($queries->id);
        return new QueriesResource($query);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Queries  $queries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Queries $queries)
    {
        $query = Queries::findOrFail($queries->id);
        if ($query->delete()){
            return new QueriesResource($query);
        }
    }
}
