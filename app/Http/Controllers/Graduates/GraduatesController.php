<?php

namespace App\Http\Controllers\Graduates;

use App\Http\Controllers\Controller;
use App\Interfaces\GraduatesRepositoryInterface;
use Illuminate\Http\Request;

class GraduatesController extends Controller
{

    private GraduatesRepositoryInterface $graduatesRepository;

    public function __construct(GraduatesRepositoryInterface $graduatesRepository)
    {
        $this->graduatesRepository = $graduatesRepository;
    }

    public function index()
    {
       return $this->graduatesRepository->index();
    }

    public function create()
    {
        return $this->graduatesRepository->create();
    }

    public function store(Request $request)
    {
        return $this->graduatesRepository->softDelete($request);
    }

    public function update($id)
    {
        return $this->graduatesRepository->returnStudent($id);
    }

    public function destroy($id)
    {
        return $this->graduatesRepository->destroy($id);
    }
}
