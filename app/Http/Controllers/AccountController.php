<?php

namespace App\Http\Controllers;

use App\AccountSector;
use App\Account;
use App\Myclass;
use App\User;
use App\Section;
use Illuminate\Http\Request;

class AccountController extends Controller
{

  public function sectors(){
    $sectors= AccountSector::where('school_id', \Auth::user()->school_id)->get();
    $incomes = Account::where('school_id', \Auth::user()->school_id)
                          ->where('type', 'income')
                          ->orderBy('id', 'desc')
                          ->take(50)
                          ->get();
    $expenses = Account::where('school_id', \Auth::user()->school_id)
                            ->where('type', 'expense')
                            ->orderBy('id', 'desc')
                            ->take(50)
                            ->get();
    $sector = [];
    return view('accounts.sector',[
                                  'sectors'=>$sectors,
                                  'sector'=>$sector,
                                  'incomes'=>$incomes,
                                  'expenses'=>$expenses
                                ]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function storeSector(Request $request){
    $request->validate([
      'name' => 'required|string',
      'type' => 'required|string'
    ]);
    $sector = new AccountSector();
    $sector->name= $request->name;
    $sector->type=$request->type;
    $sector->school_id = auth()->user()->school_id;
    $sector->user_id = auth()->user()->id;
    $sector->save();
    return back()->with("status","Account Sector Created Succesfully.");
  }

  /**
  * Store a newly created resource in storage.
  *
  * @return Response
  */
  public function editSector($id){
    $sector = AccountSector::find($id);
    return view('accounts.edit_sector',['sector'=>$sector]);
  }


  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function updateSector(Request $request){
    $request->validate([
      'name' => 'required|string',
      'type' => 'required|string'
    ]);
    $sector = AccountSector::find($request->id);
    $sector->name = $request->name;
    $sector->type = $request->type;
    $sector->save();
    return back()->with("status","Account Sector Updated Successfully.");
  }

  /**
  * Delete the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function deleteSector($id){
    $sector = AccountSector::find($id);
    $sector->delete();
    return redirect('/accounts/sectors')->with("status","Account Sector Deleted Successfully.");
  }

  public function income(){
    $sectors = AccountSector::where('school_id', \Auth::user()->school_id)
                                ->where('type','income')
                                ->get();
    $classes = Myclass::where('school_id', \Auth::user()->school_id)
                            ->pluck('id')
                            ->toArray();
    $sections = Section::with('class')
                            ->whereIn('class_id', $classes)
                            ->get();
    $students = User::whereIn('section_id',$sections->pluck('id')->toArray())
                          ->get();
    return view('accounts.income',[
      'sectors'=>$sectors,
      'sections'=>$sections,
      'students'=>$students,
    ]);

  }
  public function storeIncome(Request $request){
    $request->validate([
      'name' => 'required|string',
      'amount' => 'required|numeric',
      'description' => 'required'
    ]);
    
    $income = new Account();
    $income->name = $request->name;
    $income->type = "income";
    $income->amount = $request->amount;
    $income->description = $request->description;
    $income->school_id = \Auth::user()->school_id;
    $income->user_id = auth()->user()->id;
    $income->save();
    return back()->with("status","Income saved Successfully.");
  }

  public function listIncome(){
    $incomes = [];
    return view('accounts.income-list',['incomes'=>$incomes]);
  }

  public function postIncome(Request $request){
    $incomes = Account::where('school_id', \Auth::user()->school_id)
                          ->where('type', 'income')
                          ->whereYear('created_at',$request->year)
                          ->get();
    return view('accounts.income-list',['incomes'=>$incomes]);
  }

  public function editIncome($id){
    $income = Account::find($id);
    return view('accounts.income-edit',['income'=>$income]);
  }
  public function updateIncome(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'amount' => 'required|numeric',
    ]);
    $income = Account::find($request->id);
    $income->amount = $request->amount;
    $income->description = $request->description;
    $income->save();

    return back()->with("status","Income Updated Successfully.");
  }

  public function deleteIncome($id){
    $income = Account::find($id);
    $income->delete();

    return back()->with("status","Income Deleted Successfully.");
  }

  public function expense(){
    $sectors = AccountSector::where('school_id', \Auth::user()->school_id)
                                ->where('type','expense')
                                ->get();
    return view('accounts.expense',['sectors'=>$sectors]);

  }
  public function storeExpense(Request $request){
    $request->validate([
      'name' => 'required|string',
      'amount' => 'required|numeric',
      'description' => 'required'
    ]);
    
    $expense = new Account();
    $expense->name = $request->name;
    $expense->type = "expense";
    $expense->amount = $request->amount;
    $expense->description = $request->description;
    $expense->school_id = \Auth::user()->school_id;
    $expense->user_id = auth()->user()->id;
    $expense->save();
    return back()->with("status","expense saved Successfully.");
  }

  public function listExpense(){
    $expenses = [];
    return view('accounts.expense-list',['expenses'=>$expenses]);
  }

  public function postExpense(Request $request){
    $expenses = Account::where('school_id', \Auth::user()->school_id)
                            ->where('type', 'expense')
                            ->whereYear('created_at',$request->year)
                            ->get();
    return view('accounts.expense-list',['expenses'=>$expenses]);
  }

  public function editExpense($id){
    $expense = Account::find($id);
    return view('accounts.expense-edit',['expense'=>$expense]);
  }

  public function updateExpense(Request $request){
    $request->validate([
      'name' => 'required|string',
      'amount' => 'required|numeric',
    ]);
    $expense = Account::find($request->id);
    $expense->amount = $request->amount;
    $expense->description = $request->description;
    $expense->save();

    return back()->with("status","expense Updated Successfully.");
  }

  public function deleteExpense($id){
    $expense = Account::find($id);
    $expense->delete();
    return back()->with("status","expense Deleted Successfully.");
  }
}
