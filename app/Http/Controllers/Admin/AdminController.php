<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Admin;

class AdminController extends Controller
{
	protected $admin;

	public function __construct(Admin $admin) {
		$this->admin = $admin;
	}

    public function index () {
        //Tuần trước
        $currentDate = \Carbon\Carbon::now();
        $agoDate = $currentDate->subDays($currentDate->dayOfWeek)->subWeek()->toDateString();

        $currentDate = \Carbon\Carbon::now();
        $nowDate = $currentDate->subDays($currentDate->dayOfWeek + 1)->toDateString();

        $LastWeek = \App\Transaction::select('amount')->whereBetween(\DB::raw("date(created_at)"), [$agoDate, $nowDate])
                                        ->where('status', 1)->get();
        $count_money_last_week = 0;
        foreach ($LastWeek  as $money) {
            $count_money_last_week = $count_money_last_week + $money['amount'];
        }

        //ngày trước

        $tillDate = \Carbon\Carbon::now()->subDay()->toDateString();
        $yesterday = \App\Transaction::select('amount')
                                    ->where([[\DB::raw("date(created_at)"), $tillDate],['status', 1]])->get();

        $count_money_yesterday = 0;
        foreach ($yesterday  as $money) {
            $count_money_yesterday = $count_money_yesterday + $money['amount'];
        }

        //tháng

        $currentDate = \Carbon\Carbon::now();
        $lastMonth = $currentDate->startOfMonth()->toDateString();

        $currentDate = \Carbon\Carbon::now();
        $nowMonth = $currentDate->endOfMonth()->toDateString();

        $month = \App\Transaction::select('amount')->whereBetween(\DB::raw("date(created_at)"), [$lastMonth, $nowMonth])
                                        ->where('status', 1)->get();

        $count_money_month = 0;
        foreach ($month  as $money) {
            $count_money_month = $count_money_month + $money['amount'];
        }

        //năm

        $toyear = date("Y");

        $year = \App\Transaction::select('amount')
                                    ->where([[\DB::raw("year(created_at)"), $tillDate],['status', 1]])->get();
        $count_money_year = 0;
        foreach ($year  as $money) {
            $count_money_year = $count_money_year + $money['amount'];
        }

        //all


        $all = \App\Transaction::select('amount')->where('status', 1)->get();
        $count_money = 0;
        foreach ($all  as $money) {
            $count_money = $count_money + $money['amount'];
        }

    	return view('admin.dashboard', compact('count_money_last_week', 'count_money_yesterday', 
                                                'count_money_month', 'count_money_year', 'count_money'));
    }

    public function members() {
    	$members = $this->admin->all();
    	return view('admin.members.index', compact('members'));
    }

    public function edit($id) {
        $member = $this->admin->find($id);
    	return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, $id) {
    	$member = $this->admin->find($id);

        $member->update($request->all());

        return redirect()->route('admin.list')->with(['messages' => 'Cập nhật thành công', 'type' => 'success']);
    }

}
