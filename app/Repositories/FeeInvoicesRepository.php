<?php

namespace App\Repositories;

use App\Interfaces\FeeInvoicesRepositoryInterface;
use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;


class FeeInvoicesRepository implements FeeInvoicesRepositoryInterface
{
    public function index()
    {
        $fee_invoices = FeeInvoice::all();

        return view('pages.fees.invoices.index', compact('fee_invoices'));
    }


    public function store($request)
    {

        $list_fees = $request->list_fees;

        DB::beginTransaction();

        foreach ($list_fees as $list_fee) {


            $fee = FeeInvoice::create([
                'invoice_date' => now(),
                'student_id' => $list_fee['student_id'],
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'fee_id' => $list_fee['fee_id'],
                'amount' => $list_fee['amount'],
                'description' => $list_fee['description'],
            ]);

            StudentAccount::create([
                'date' => now(),
                'type' => 'invoice',
                'fee_invoice_id' => $fee->id,
                'student_id' => $list_fee['student_id'],
                'debit' => $list_fee['amount'],
                'credit' => 0.00,
                'description' => $list_fee['description'],
            ]);
        }

        DB::commit();


        return redirect()->route('fee-invoices.index');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        $fees = Fee::where('classroom_id', $student->classroom_id)->get();

        return view('pages.fees.invoices.create', compact('student', 'fees'));
    }

    public function edit($id)
    {
        $fee_invoice = FeeInvoice::findOrFail($id);

        $fees = Fee::where('classroom_id', $fee_invoice->classroom_id)->get();

        return view('pages.fees.invoices.edit', compact('fee_invoice', 'fees'));
    }

    public function update($request, $id)
    {

        DB::beginTransaction();

        $feeInvoice = FeeInvoice::find($id);

        $feeInvoice->update([
            'invoice_date' => now(),
            'fee_id' => $request->fee_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        $studentAccount = StudentAccount::where('fee_invoice_id', $feeInvoice->id)->first();

        $studentAccount->update([
            'debit' => $request->amount,
            'description' => $request->description,
        ]);

        DB::commit();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $fee = FeeInvoice::find($id);

        $fee->delete();

        return redirect()->back();
    }


}
