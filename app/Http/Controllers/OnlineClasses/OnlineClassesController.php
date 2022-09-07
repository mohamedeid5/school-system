<?php

namespace App\Http\Controllers\OnlineClasses;

use App\Http\Controllers\Controller;
use App\Interfaces\OnlineClassRepositoryInterface;
use Illuminate\Http\Request;

class OnlineClassesController extends Controller
{

    private OnlineClassRepositoryInterface $onlineClassRepository;

    public function __construct(OnlineClassRepositoryInterface $onlineClassRepository)
    {
        $this->onlineClassRepository = $onlineClassRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->onlineClassRepository->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->onlineClassRepository->create();
    }

    public function indirectCreate()
    {
        return $this->onlineClassRepository->indirectCreate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->onlineClassRepository->store($request);
    }

    public function indirectStore(Request $request)
    {
        return $this->onlineClassRepository->indirectStore($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->onlineClassRepository->destroy($id);
    }
}
