<?php

namespace App\Repositories;

use App\Interfaces\PaymentRepositoryInterface;
use App\Models\Classroom;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\FundAccount;
use App\Models\Grade;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;


class PaymentRepository implements PaymentRepositoryInterface
{
    public function index()
    {
        $payments = Payment::all();

        return view('pages.fees.payments.index', compact('payments'));
    }


    public function store($request)
    {

        DB::beginTransaction();

        $payment = new Payment();
        $payment->date = now();
        $payment->student_id = $request->student_id;
        $payment->amount = $request->debit;
        $payment->description = $request->description;
        $payment->save();

        $fundAccount = new FundAccount();
        $fundAccount->date = now();
        $fundAccount->payment_id = $payment->id;
        $fundAccount->debit = 0.00;
        $fundAccount->credit = $request->debit;
        $fundAccount->description = $request->description;
        $fundAccount->save();

        $studentAccount = new StudentAccount();
        $studentAccount->date = now();
        $studentAccount->type = 'payment';
        $studentAccount->payment_id = $payment->id;
        $studentAccount->student_id = $request->student_id;
        $studentAccount->debit = $request->debit;
        $studentAccount->credit = 0.00;
        $studentAccount->description = $request->description;
        $studentAccount->save();


        DB::commit();

        return redirect()->route('payments.index');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('pages.fees.payments.add', compact('student'));
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);

        $student = Student::where('id', $payment->student_id)->first();

        return view('pages.fees.payments.edit', compact('payment', 'student'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();

        $payment =  Payment::findOrFail($id);
        $payment->date = now();
        $payment->student_id = $request->student_id;
        $payment->amount = $request->debit;
        $payment->description = $request->description;
        $payment->save();

        $fundAccount = FundAccount::where('payment_id', $payment->id)->first();
        $fundAccount->date = now();
        $fundAccount->payment_id = $payment->id;
        $fundAccount->debit = 0.00;
        $fundAccount->credit = $request->debit;
        $fundAccount->description = $request->description;
        $fundAccount->save();

        $studentAccount = StudentAccount::where('payment_id', $payment->id)->first();
        $studentAccount->date = now();
        $studentAccount->type = 'payment';
        $studentAccount->payment_id = $payment->id;
        $studentAccount->student_id = $request->student_id;
        $studentAccount->debit = $request->debit;
        $studentAccount->credit = 0.00;
        $studentAccount->description = $request->description;
        $studentAccount->save();


        DB::commit();

        return redirect()->back();

    }

    public function destroy($id)
    {
        $fee = Payment::find($id);

        $fee->delete();

        return redirect()->back();
    }

}
