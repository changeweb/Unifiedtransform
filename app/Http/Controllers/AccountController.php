<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{

  public function sectors(){
    $sectors= \App\AccountSector::where('school_id', \Auth::user()->school_id)->get();
    $incomes = \App\Account::where('school_id', \Auth::user()->school_id)
                          ->where('type', 'income')
                          ->orderBy('id', 'desc')
                          ->take(50)
                          ->get();
    $expenses = \App\Account::where('school_id', \Auth::user()->school_id)
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
    $sector = new \App\AccountSector();
    $sector->name= $request->name;
    $sector->type=$request->type;
    $sector->school_id = \Auth::user()->school_id;
    $sector->save();
    return back()->with("status","Account Sector Created Succesfully.");
  }

  /**
  * Store a newly created resource in storage.
  *
  * @return Response
  */
  public function editSector($id){
    $sectors= \App\AccountSector::where('school_id', \Auth::user()->school_id)->get();
    $sector = \App\AccountSector::find($id);
    return view('accounts.sector',['sectors'=>$sectors,'sector'=>$sector]);
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
    $sector = \App\AccountSector::find($request->id);
    $sector->name= $request->name;
    $sector->type=$request->type;
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
    $sector = \App\AccountSector::find($id);
    $sector->delete();
    return redirect('/accounts/sectors')->with("status","Account Sector Deleted Successfully.");
  }

  public function income(){
    $sectors = \App\AccountSector::where('school_id', \Auth::user()->school_id)
                                ->where('type','income')
                                ->get();
    $classes = \App\Myclass::where('school_id', \Auth::user()->school_id)
                            ->pluck('id')
                            ->toArray();
    $sections = \App\Section::with('class')
                            ->whereIn('class_id', $classes)
                            ->get();
    $students = \App\User::whereIn('section_id',$sections->pluck('id')->toArray())
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
    
    $income = new \App\Account();
    $income->name = $request->name;
    $income->type = "income";
    $income->amount = $request->amount;
    $income->description = $request->description;
    $income->school_id = \Auth::user()->school_id;
    $income->save();
    return back()->with("status","Income saved Successfully.");
  }

  public function listIncome(){
    $incomes = [];
    return view('accounts.income-list',['incomes'=>$incomes]);
  }

  public function postIncome(Request $request){
    $incomes = \App\Account::where('school_id', \Auth::user()->school_id)
                          ->where('type', 'income')
                          ->whereYear('created_at',$request->year)
                          ->get();
    return view('accounts.income-list',['incomes'=>$incomes]);
  }

  public function editIncome($id){
    $income = \App\Account::find($id);
    return view('accounts.income-edit',['income'=>$income]);
  }
  public function updateIncome(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'amount' => 'required|numeric',
    ]);
    $income = \App\Account::find($request->id);
    $income->amount = $request->amount;
    $income->description = $request->description;
    $income->save();

    return back()->with("status","Income Updated Successfully.");
  }

  public function deleteIncome($id){
    $income = \App\Account::find($id);
    $income->delete();

    return back()->with("status","Income Deleted Successfully.");
  }

  public function expense(){
    $sectors = \App\AccountSector::where('school_id', \Auth::user()->school_id)
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
    
    $expense = new \App\Account();
    $expense->name = $request->name;
    $expense->type = "expense";
    $expense->amount = $request->amount;
    $expense->description = $request->description;
    $expense->school_id = \Auth::user()->school_id;
    $expense->save();
    return back()->with("status","expense saved Successfully.");
  }

  public function listExpense(){
    $expenses = [];
    return view('accounts.expense-list',['expenses'=>$expenses]);
  }

  public function postExpense(Request $request){
    $expenses = \App\Account::where('school_id', \Auth::user()->school_id)
                            ->where('type', 'expense')
                            ->whereYear('created_at',$request->year)
                            ->get();
    return view('accounts.expense-list',['expenses'=>$expenses]);
  }

  public function editExpense($id){
    $expense = \App\Account::find($id);
    return view('accounts.expense-edit',['expense'=>$expense]);
  }

  public function updateExpense(Request $request){
    $request->validate([
      'name' => 'required|string',
      'amount' => 'required|numeric',
    ]);
    $expense = \App\Account::find($request->id);
    $expense->amount = $request->amount;
    $expense->description = $request->description;
    $expense->save();

    return back()->with("status","expense Updated Successfully.");
  }

  public function deleteExpense($id){
    $expense = \App\Account::find($id);
    $expense->delete();
    return back()->with("status","expense Deleted Successfully.");
  }
}
