<?php

namespace App\Http\Controllers\Operator;

use App\AuthenticateLog;
use App\Book;
use App\BookType;
use App\BookUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Count Data
        $total_users = count(User::all());
        $total_admins = count(User::where('role_id', 1)->get());
        $total_operators = count(User::where('role_id', 2)->get());
        $total_members = count(User::where('role_id', 3)->get());

        // Book Data
        $total_books = Book::count();
        $total_book_types = BookType::count();
        $total_borrowings = BookUser::count();
        $approved_borrowings = BookUser::where('status', 1)->count();
        $pending_borrowings = BookUser::where('status', 2)->count();
        $rejected_borrowings = BookUser::where('status', 3)->count();

        // Authenticate User Log
        $authenticate_logs = AuthenticateLog::latest()->take(10)->get();
        $login_logs = AuthenticateLog::latest()->get();

        return view('operator.dashboard.index', compact('total_users', 'total_books', 'total_book_types', 'total_borrowings', 'approved_borrowings', 'pending_borrowings', 'rejected_borrowings', 'authenticate_logs', 'login_logs'));
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
        $authenticate_logs = AuthenticateLog::with('user')->latest()->take(10)->get()->map(function($log) {
            $log->relative_time = $log->created_at->diffForHumans();
            return $log;
        });
        return response()->json($authenticate_logs);
    }
}
