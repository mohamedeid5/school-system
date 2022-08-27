<?php

namespace App\Repositories;

use App\Interfaces\ProcessingFeesRepositoryInterface;
use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;


class ProcessingFeesRepository implements ProcessingFeesRepositoryInterface
{
    public function index()
    {
        $processingFees = ProcessingFee::all();

        return view('pages.fees.processing.index', compact('processingFees'));
    }


    public function store($request)
    {

        DB::beginTransaction();

        $processingFee = new ProcessingFee();
        $processingFee->date = now();
        $processingFee->student_id = $request->student_id;
        $processingFee->amount = $request->debit;
        $processingFee->description = $request->description;
        $processingFee->save();

        $studentAccount = new StudentAccount();
        $studentAccount->date = now();
        $studentAccount->type = 'processing';
        $studentAccount->processing_id = $processingFee->id;
        $studentAccount->student_id = $request->student_id;
        $studentAccount->debit = 0.00;
        $studentAccount->credit = $request->debit;
        $studentAccount->description = $request->description;
        $studentAccount->save();

        DB::commit();

        return redirect()->route('processing-fees.index');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('pages.fees.processing.add', compact('student'));
    }

    public function edit($id)
    {

        $processingFee = ProcessingFee::findOrFail($id);

        return view('pages.fees.processing.edit', compact('processingFee'));
    }

    public function update($request, $id)
    {

        DB::beginTransaction();

        $processingFee = ProcessingFee::findOrFail($id);
        $processingFee->date = now();
        $processingFee->student_id = $request->student_id;
        $processingFee->amount = $request->debit;
        $processingFee->description = $request->description;
        $processingFee->save();

        $studentAccount = StudentAccount::where('processing_id', $processingFee->id)->first();
        $studentAccount->date = now();
        $studentAccount->type = 'processing';
        $studentAccount->processing_id = $processingFee->id;
        $studentAccount->student_id = $request->student_id;
        $studentAccount->debit = 0.00;
        $studentAccount->credit = $request->debit;
        $studentAccount->description = $request->description;
        $studentAccount->save();

        DB::commit();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $fee = ProcessingFee::find($id);

        $fee->delete();

        return redirect()->back();
    }


}
