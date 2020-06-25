<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Pawn;
use Excel;
use App\Cost;
use App\PawnCustomer;
use App\PawnPhoto;
use App\Bank;
use DateTime;

class PawnController extends Controller
{  

    public function index()
    {
        $bank = Bank::find(1);
        return view('pawn.index', \compact('bank'));
    }
    
    public function pawn(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'voucher' => ['required', 'unique:pawn'],
            'name' => ['required'],
            'date' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'items' => ['required'],
            'quantity' => ['required'],
            'weight' => ['required'],
            'stone_weight' => ['required'],
            'price' => ['required'],
            'cash' => ['required'],
            'cashier_name' => ['required'],
        ]);

        $customer = PawnCustomer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        $y = date('y');
        $m = date('m');
        $d = date('d');
        $h = date('h');
        $i = date('i');
        $s = date('s');
        $random = $y.$m.$d.$h.$i.$s;
        $shuffled = str_shuffle($random);
       $pawn = Pawn::create([

        //    'name' => $request->name,
        //    'date' => $request->date,
        //    'voucher' => $request->voucher,
        //    'amount' => $request->amount,
        //    'status' => 1,
            'customer_id' => $customer->id,
            'auto_voucher' => $shuffled,
            'voucher' => $request->voucher,
            'date' => $request->date,
            'name' => $request->items,
            'quantity' => $request->quantity,
            'weight' => $request->weight,
            'stone_weight' => $request->stone_weight,
            'price' => $request->price,
            'amount' => $request->cash,
            'cashier_name' => $request->cashier_name,
            'status' => 1
       ]);

        
        if($request->file('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = $photo->getClientOriginalName();
                Storage::disk('public')->put($filename, file_get_contents($photo));
                PawnPhoto::create([
                    'pawn_id' => $pawn->id,
                    'filename' => $filename
                ]);
            }
        }
       $bank = Bank::find(1);
       $bank->update([
            'min' => $bank->min - $request->cash,
        ]);
        return redirect()->route('pawn', \compact('bank'))->with('success', 'Successful');
    }

    public function yawe(Request $request)
    {

        $pawn = Pawn::where('voucher', $request->search)->where('status', 1)->first();
        if($pawn == null) {
            return redirect()->back()->with('notfount', 'No Found!');
        }
        $d1 = new DateTime($pawn->date);
        $d2 = new DateTime();
        $d3 = $d1->diff($d2);

        if($d3->m == 0) {
            $yawe_price = $pawn->amount * 0.03 + $pawn->amount;
        }
        if($d3->m > 0 && $d3->d == 0) {
            $yawe_price = $pawn->amount * 0.03 * $d3->m + $pawn->amount;
        }

        if($d3->m > 0 && $d3->d > 0) {
            $yawe_price = $pawn->amount * 0.03 * ($d3->m + 1) + $pawn->amount;
        }

        // dd($d3,$d3->m, $d3->d, $d3->h,$d1,$d2);

    //    dd((strtotime('2020-04-10') - strtotime($pawn->date))/60/60/24);
        
        return view('pawn.yawe', \compact('pawn', 'yawe_price'));
    }
    public function yawe_update(Request $request, $id)
    {
        // dd($request->all());
        // $validatedData = $request->validate([
        //     'discount' => 'required',
        // ]);
        $pawn = Pawn::find($id);
        $date = date('Y-m-d');
        $pawn->update([
            'status' => 2,
            'discount' => $request->discount,
            'yawe_status' => $request->yawe_status,
            'real_price' => $request->cash,
            'interest' => $request->cash - $pawn->amount - $request->discount,
            'total' => $request->cash - $request->discount,
            'repayDate' => $date,
        ]);
        $bank = Bank::find(1);
        $bank->update([
            'min' => $bank->min + $request->cash - $request->discount,
        ]);
        return redirect()->route('pawn', 'bank')->with('success', 'Successful');
    }

    public function edit(Request $request, $id) 
    {
        // dd($request->all());
        $pawn = Pawn::find($id);
        $interest = $pawn->interest;
        $pawn->update([
            'interest' => $pawn->real_price - $pawn->amount - $request->discount,
            'dicount' => $request->discount,
            'total' => $request->cash - $request->discount,
            'yawe_status' => $request->yawe_status
        ]);
        $bank = Bank::find(1);
        $bank->update([
            'min' => $bank->min - $interest + $pawn->interest,
        ]);
        return redirect()->route('yawe_report', 'bank')->with('success', 'Successful');
    }

    public function pawn_edit(Request $request, $id) 
    {
        // dd($request->file('photos'));
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'items' => 'required',
            'quantity' => 'required',
            'weight' => 'required',
            'stone_weight' => 'required',
            'price' => 'required',
            'cash' => 'required',
            'cashier_name' => 'required',
        ]);
        // if($request->photos) {
        //     foreach ($request->photos as $photo) {
        //         $extension = $photo->getClientOriginalName();
        //         dd($extension);
        //         // $check = \in_array($extension,['jpg']);
        //         dd($check);
        //     }
        // }
        $pawn = Pawn::find($id);
        $customer = PawnCustomer::find($pawn->customer_id);
        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        $amount = $pawn->amount;
        $pawn->update([
            'name' => $request->items,
            'quantity' => $request->quantity,
            'weight' => $request->weight,
            'stone_weight' => $request->stone_weight,
            'price' => $request->price,
            'amount' => $request->cash,
            'cashier_name' => $request->cashier_name,
        ]);
        if($request->file('photos')) {
            foreach($pawn->photos as $pawn_photo) {
                Storage::disk('public')->delete($pawn_photo->filename);
            }
            $pawn_photos = PawnPhoto::where('pawn_id', $pawn->id);
            $pawn_photos->delete();
            
            foreach ($request->file('photos') as $photo) {
                $filename = $photo->getClientOriginalName();
                Storage::disk('public')->put($filename, file_get_contents($photo));
                PawnPhoto::create([
                    'pawn_id' => $pawn->id,
                    'filename' => $filename
                ]);
            }
        }
        $bank = Bank::find(1);
        $bank->update([
            'min' => $bank->min + $amount - $request->cash,
        ]);
        return redirect()->route('pawn_report', 'bank')->with('success', 'Successful');
    }

    public function costs(Request $request)
    {
        Cost::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'reason' => $request->reason,
            'date' => date('Y-m-d'),
        ]);
        $bank = Bank::find(1);
        $bank->update([
            'min' => $bank->min - $request->amount,
            'cost' => $bank->cost + $request->amount,
        ]);
        return redirect()->route('pawn', \compact('bank'))->with('success', 'Successful');
    }
    public function pawn_report(Request $request)
    {
        $bank = Bank::find(1);
        $pawn = Pawn::where('status', 1)->latest()->get();
        return view('pawn.report', \compact('pawn', 'bank'));
    }
    public function yawe_report(Request $request)
    {
        $pawn = Pawn::where('status', 2)->latest()->get();
        return view('pawn.yawe_report', \compact('pawn'));
    }

    public function py_search(Request $request)
    {
        $pawn = Pawn::where('status', 1)
                ->where('voucher', 'LIKE', "%{$request->search}%")
                ->orWhere('name', 'LIKE', "%{$request->search}%")
                ->where('status', 1)
                ->latest()->get();
        $yawe = Pawn::where('status', 2)->where('yawe_status', 'finished')
                ->where('voucher', 'LIKE', "%{$request->search}%")
                ->orWhere('name', 'LIKE', "%{$request->search}%")
                ->where('status', 2)
                ->latest()->get();
        $loss = Pawn::where('status', 2)->where('yawe_status', 'loss')
                ->where('voucher', 'LIKE', "%{$request->search}%")
                ->orWhere('name', 'LIKE', "%{$request->search}%")
                ->where('status', 2)
                ->latest()->get();
        $search = 1;        
        return view('pawn.search', \compact('search', 'pawn', 'yawe', 'loss'));
    }

    public function cost_index(Request $request)
    {
       $costs = Cost::latest()->get();                
        return view('pawn.costs', \compact('costs'));
    }

    public function p_search(Request $request)
    {
        $bank = Bank::find(1); 
         $pawn = Pawn::whereBetween('date', [$request->from, $request->to])
                    ->where('status', 1)
                    ->latest()->get();                
        return view('pawn.report', \compact('pawn', 'bank'));
    }
    public function y_search(Request $request)
    {
        $pawn = Pawn::whereBetween('repayDate', [$request->from, $request->to])
                    ->where('status', 2)
                    ->latest()->get();                
        return view('pawn.yawe_report', \compact('pawn'));
    }
    public function c_search(Request $request)
    {
        $costs = Cost::whereBetween('date', [$request->from, $request->to])
                    ->latest()->get();                
        return view('pawn.costs', \compact('costs'));
    }

    public function bank(Request $request)
    {
        $bank = Bank::find(1);              
        return view('pawn.bank', \compact('bank'));
    }

    public function bankedit(Request $request)
    {
        $bank = Bank::find($request->id); 
        $bank->update([
            'investment' => $request->investment,
            'date' => date('Y-m-d'),
            'min' => $request->investment,
            'cost' => 0,
        ]);       
        return redirect()->route('bank')->with('Success', 'Success!');
    }

    public function searchall(Request $request)
    {
        // dd($request->all());
        $bank = Bank::find(1); 
        
        $search = 1;
        if($request->search == 'all') {
            $pawn = Pawn::whereBetween('date', [$request->from, $request->to])
                    ->where('status', 1)
                    ->latest()->get();   
        
            $yawe = Pawn::whereBetween('repayDate', [$request->from, $request->to])
                        ->where('yawe_status', 'finished')
                        ->where('status', 2)
                        ->latest()->get();
            $loss = Pawn::whereBetween('repayDate', [$request->from, $request->to])
                        ->where('yawe_status', 'loss')
                        ->where('status', 2)
                        ->latest()->get();

            $costs = Cost::whereBetween('date', [$request->from, $request->to])
                        ->latest()->get(); 

            return view('pawn.bank', compact('search','bank','pawn', 'yawe', 'costs', 'loss'));
        }
        if($request->search == 'allpawn') {
            $allpawn = Pawn::whereBetween('date', [$request->from, $request->to])
                    ->latest()->get();
            $allloss = Pawn::whereBetween('date', [$request->from, $request->to])
                    ->where('yawe_status', 'loss')
                    ->where('status', 2)
                    ->latest()->get();
            $allyawe = Pawn::whereBetween('date', [$request->from, $request->to])
                    ->where('yawe_status', 'finished')
                    ->where('status', 2)
                    ->latest()->get();
            
            $allcount = count($allpawn);
            $alllosscount = count($allloss);
            $allyawecount = count($allyawe);
            return view('pawn.bank', compact('search','bank','allpawn', 'allyawe', 'allloss', 'allcount', 'allyawecount', 'alllosscount'));
        }
        if($request->search == 'expense') {

            $costs = Cost::whereBetween('date', [$request->from, $request->to])
                        ->latest()->get(); 

            return view('pawn.bank', compact('search','bank', 'costs'));
        }

        if($request->search == 'discount') {

            $discount = Pawn::whereBetween('repayDate', [$request->from, $request->to])
                        ->whereNotNull('discount') 
                        ->where('status', 2)
                        ->latest()->get();

            return view('pawn.bank', compact('search','bank', 'discount'));
        }
        if($request->search == 'loss') {

            $loss = Pawn::whereBetween('repayDate', [$request->from, $request->to])
                        ->where('yawe_status', 'loss')
                        ->where('status', 2)
                        ->latest()->get();

            return view('pawn.bank', compact('search','bank', 'loss'));
        }
        if($request->search == 'yawe') {
        
            $yawe = Pawn::whereBetween('repayDate', [$request->from, $request->to])
                        ->where('yawe_status', 'finished')
                        ->where('status', 2)
                        ->latest()->get();

            return view('pawn.bank', compact('search','bank', 'yawe'));
        }
        if($request->search == 'pawn') {
            $pawn = Pawn::whereBetween('date', [$request->from, $request->to])
                    ->where('status', 1)
                    ->latest()->get(); 

            return view('pawn.bank', compact('search','bank','pawn'));
        }
        
    }

    public function pawn_excel()
    {
        $products = Pawn::where('status', 1)
                    ->select('pawn.name as Name',
                        'pawn.date as PawnDate',
                        'pawn.voucher as VoucherNo',
                        'pawn.amount as Amount'
                    )->get()->toArray(); 
        return Excel::create('PawnShop(Pawn)', function($excel) use ($products) {
            $excel->sheet('PawnShop', function($sheet) use ($products) {
                $sheet->fromArray($products);
            });
        })->download('xlsx');
    }
    public function yawe_excel()
    {
        $products = Pawn::where('status', 2)
                    ->select('pawn.name as Name',
                        'pawn.date as PawnDate',
                        'pawn.repayDate as RepayDate',
                        'pawn.voucher as VoucherNo',
                        'pawn.amount as Amount',
                        'pawn.interest as Interest',
                        'pawn.total as Total'
                    )->get()->toArray(); 
        return Excel::create('PawnShop(Yawe)', function($excel) use ($products) {
            $excel->sheet('PawnShop', function($sheet) use ($products) {
                $sheet->fromArray($products);
            });
        })->download('xlsx');
    }
    public function expense_excel()
    {
        $products = Cost::latest()
                    ->select('costs.name as Name',
                    'costs.date as Date',
                    'costs.reason as Reason',
                    'costs.amount as Amount'
                    )->get()->toArray(); 
        return Excel::create('PawnShop(Expense)', function($excel) use ($products) {
            $excel->sheet('PawnShop', function($sheet) use ($products) {
                $sheet->fromArray($products);
            });
        })->download('xlsx');
    }
}
