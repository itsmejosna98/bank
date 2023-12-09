<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function widraw(){
        return view('widraw');
    }

    public function deposite(){
        return view('deposite');
    }

    public function transfer(){
        return view('transfer');
    }

    public function statement(){
        $transactions = Transaction::where('from_user_id',Auth::id())->get();
        return view('statement', compact('transactions'));
    }

    public function depositeAmount(Request $request)
    {
        // dd($request->all());
        $user = User::where('id',Auth::id())->first();
        $new_amount = $user->amount + $request->amount;
        if($new_amount <=0){
            $new_amount = 0;
        }
        User::where('id',Auth::id())->update([
            'amount' => $new_amount,
            'updated_at' => Carbon::now(),
        ]);
        Transaction::create([
            'from_user_id' => Auth::id(),
            'amount' => $request->amount,
            'type' => 'CREDIT',
            'details' => 'DEPOSIT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect('dashboard');
    }

    public function withdrawAmount(Request $request)
    {
        // dd($request->all());
        $user = User::where('id',Auth::id())->first();
        if($user->amount < $request->amount){
            // can not withdraw 
            return redirect('dashboard');
        }
        $new_amount = ($user->amount) - ($request->amount);
        if($new_amount <=0){
            $new_amount = 0;
        }
        User::where('id',Auth::id())->update([
            'amount' => $new_amount,
            'updated_at' => Carbon::now(),
        ]);
        Transaction::create([
            'from_user_id' => Auth::id(),
            'amount' => $request->amount,
            'type' => 'DEBIT',
            'details' => 'Withdraw',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect('dashboard');
    }

    public function transferAmount(Request $request)
    {
        // dd($request->all());
        $from_user = User::where('id',Auth::id())->first();
        $to_user = User::where('email',$request->email)->first();
        // dd($to_user->id);

        if($from_user->amount < $request->amount){
            // can not do this transaction 
            return redirect('dashboard');
        }

        $new_from_user_amount = ($from_user->amount) - ($request->amount);
        if($new_from_user_amount <=0){
            $new_from_user_amount = 0;
        }
        User::where('id',Auth::id())->update([
            'amount' => $new_from_user_amount,
            'updated_at' => Carbon::now(),
        ]);

        $to_user_updated_amount = $to_user->amount + $request->amount;
        User::where('id',$to_user->id)->update([
            'amount' => $to_user_updated_amount,
            'updated_at' => Carbon::now(),
        ]);
        Transaction::create([
            'from_user_id' => Auth::id(),
            'amount' => $request->amount,
            'type' => 'DEBIT',
            'details' => 'Transaction DEPOSIT to ' . $request->email,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
// dd($to_user->id);
        Transaction::create([
            'to_user_id' => $to_user->id,
            'amount' => $request->amount,
            'type' => 'CREDIT',
            'details' => 'Transaction DEPOSIT to ' . $request->email,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect('dashboard');
    }
}
