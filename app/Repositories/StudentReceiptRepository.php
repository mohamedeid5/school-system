<?php

namespace App\Repositories;

use App\Interfaces\StudentReceiptRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\StudentReceipt;
use Illuminate\Support\Facades\DB;

class StudentReceiptRepository implements StudentReceiptRepositoryInterface
{

    public function index()
    {
        $studentReceipts = StudentReceipt::all();

        return view('pages.receipts.index', compact('studentReceipts'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        $studentReceipt = new StudentReceipt();
        $studentReceipt->date = now();
        $studentReceipt->student_id = $request->student_id;
        $studentReceipt->debit = $request->debit;
        $studentReceipt->description = $request->description;
        $studentReceipt->save();

        $fundAccount = new FundAccount();
        $fundAccount->date = now();
        $fundAccount->receipt_id = $studentReceipt->id;
        $fundAccount->debit = $request->debit;
        $fundAccount->credit = 0.00;
        $fundAccount->description = $request->description;
        $fundAccount->save();

        $studentAccount = new StudentAccount();
        $studentAccount->date = now();
        $studentAccount->type = 'receipt';
        $studentAccount->receipt_id = $studentReceipt->id;
        $studentAccount->student_id = $request->student_id;
        $studentAccount->debit = 0.00;
        $studentAccount->credit = $request->debit;
        $studentAccount->description = $request->description;
        $studentAccount->save();

        DB::commit();

        return redirect()->route('student-receipts.index');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('pages.receipts.add', compact('student'));
    }

    public function edit($id)
    {
        $studentReceipt = StudentReceipt::findOrFail($id);

        return view('pages.receipts.edit', compact('studentReceipt'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();

        $studentReceipt =  StudentReceipt::findOrFail($id);
        $studentReceipt->date = now();
        $studentReceipt->student_id = $request->student_id;
        $studentReceipt->debit = $request->debit;
        $studentReceipt->description = $request->description;
        $studentReceipt->save();

        $fundAccount = FundAccount::where('receipt', $id)->first();
        $fundAccount->date = now();
        $fundAccount->receipt = $studentReceipt->id;
        $fundAccount->debit = $request->debit;
        $fundAccount->credit = 0.00;
        $fundAccount->description = $request->description;
        $fundAccount->save();

        $studentAccount = StudentAccount::where('receipt_id', $id)->first();
        $studentAccount->date = now();
        $studentAccount->type = 'receipt';
        $studentAccount->receipt_id = $studentReceipt->id;
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
        $receipt = StudentReceipt::find($id);
        $receipt->delete();

        return redirect()->back();
    }
}
