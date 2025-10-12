<?php

namespace App\Http\Controllers\Anggota;

use App\BookUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\AuthenticateLog;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book_user = BookUser::where('user_id', auth()->user()->id)->get();
        $book_approved = BookUser::where('user_id', auth()->user()->id)->where('status', 1)->get();
        $book_waiting = BookUser::where('user_id', auth()->user()->id)->where('status', 2)->get();
        $book_rejected = BookUser::where('user_id', auth()->user()->id)->where('status', 3)->get();
        $overdue_books = BookUser::where('user_id', auth()->user()->id)->where('status', 1)->where('date_end', '<', now()->toDateString())->get();

        $recent_activities = BookUser::with('book')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->take(5)->get();

        $monthly_stats = DB::table('book_users')
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
            ->where('user_id', auth()->user()->id)
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $user_logs = AuthenticateLog::with('user')->where('user_id', auth()->user()->id)->latest()->take(10)->get();
        $login_logs = AuthenticateLog::with('user')->where('user_id', auth()->user()->id)->whereDate('last_login_date', today())->latest()->get();

        return view('anggota.dashboard.index', compact('book_user', 'book_approved', 'book_waiting', 'book_rejected', 'overdue_books', 'recent_activities', 'monthly_stats', 'user_logs', 'login_logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get authenticate logs as JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticateLogs()
    {
        $authenticate_logs = AuthenticateLog::with('user')->where('user_id', auth()->user()->id)->latest()->take(10)->get()->map(function($log) {
            $log->relative_time = $log->created_at->diffForHumans();
            return $log;
        });
        return response()->json($authenticate_logs);
    }
}
