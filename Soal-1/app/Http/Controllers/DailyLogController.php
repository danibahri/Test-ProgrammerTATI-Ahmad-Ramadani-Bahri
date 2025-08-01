<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DailyLogController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = DailyLog::with('user')
            ->where('user_id', $user->id);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('log_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('log_date', '<=', $request->date_to);
        }

        $logs = $query->orderBy('log_date', 'desc')->paginate(10);

        return view('pages.daily-log.index', compact('logs'));
    }

    public function create()
    {
        return view('pages.daily-log.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'log_date' => 'required|date',
            'activity_description' => 'required|string|max:1000',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'log_date' => $request->log_date,
            'activity_description' => $request->activity_description,
            'status' => 'pending',
        ];

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('attachments', $filename, 'public');
            $data['attachment'] = $path;
        }

        DailyLog::create($data);

        return redirect()->route('daily-log.index')
            ->with('success', 'Log harian berhasil dibuat dan menunggu persetujuan atasan.');
    }

    public function show(DailyLog $dailyLog)
    {
        if ($dailyLog->user_id !== Auth::id() && !$this->canVerifyLog($dailyLog)) {
            abort(403);
        }

        return view('pages.daily-log.show', compact('dailyLog'));
    }

    public function edit(DailyLog $dailyLog)
    {
        if ($dailyLog->user_id !== Auth::id() || $dailyLog->status !== 'pending') {
            abort(403);
        }

        return view('pages.daily-log.edit', compact('dailyLog'));
    }

    public function update(Request $request, DailyLog $dailyLog)
    {
        if ($dailyLog->user_id !== Auth::id() || $dailyLog->status !== 'pending') {
            abort(403);
        }

        $request->validate([
            'log_date' => 'required|date',
            'activity_description' => 'required|string|max:1000',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'log_date' => $request->log_date,
            'activity_description' => $request->activity_description,
        ];

        if ($request->hasFile('attachment')) {
            if ($dailyLog->attachment) {
                Storage::disk('public')->delete($dailyLog->attachment);
            }

            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('attachments', $filename, 'public');
            $data['attachment'] = $path;
        }

        $dailyLog->update($data);

        return redirect()->route('daily-log.index')
            ->with('success', 'Log harian berhasil diperbarui.');
    }

    public function destroy(DailyLog $dailyLog)
    {
        if ($dailyLog->user_id !== Auth::id() || $dailyLog->status !== 'pending') {
            abort(403);
        }

        if ($dailyLog->attachment) {
            Storage::disk('public')->delete($dailyLog->attachment);
        }

        $dailyLog->delete();

        return redirect()->route('daily-log.index')
            ->with('success', 'Log harian berhasil dihapus.');
    }

    public function verification(Request $request)
    {
        $user = Auth::user();
        $subordinateIds = $user->subordinates->pluck('id');

        $query = DailyLog::with('user')
            ->whereIn('user_id', $subordinateIds);

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('log_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('log_date', '<=', $request->date_to);
        }

        $logs = $query->orderBy('log_date', 'desc')->paginate(10);

        return view('pages.daily-log.verification', compact('logs'));
    }

    public function verify(Request $request, DailyLog $dailyLog)
    {
        if (!$this->canVerifyLog($dailyLog)) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'notes' => 'nullable|string|max:500',
        ]);

        // dd($request->all());

        $dailyLog->update([
            'status' => $request->status,
        ]);

        $statusText = $request->status === 'approved' ? 'disetujui' : 'ditolak';

        return redirect()->route('daily-log.verification')
            ->with('success', "Log harian {$dailyLog->user->name} berhasil {$statusText}.");
    }

    private function canVerifyLog(DailyLog $dailyLog)
    {
        $user = Auth::user();

        return $dailyLog->user->supervisor_id === $user->id;
    }
}
