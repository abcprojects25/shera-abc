<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin\AdminNotification;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $notifications = AdminNotification::orderBy('id', 'desc')->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'send_at' => 'required|date',
        ]);

        AdminNotification::create([
            'title' => $request->title,
            'body' => $request->body,
            'send_at' => $request->send_at,
        ]);

        return response()->json(['success' => true, 'message' => 'Notification saved successfully!']);
    }

    // Update existing notification
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'send_at' => 'required|date',
        ]);

        $notification = AdminNotification::findOrFail($id);
        $notification->update([
            'title' => $request->title,
            'body' => $request->body,
            'send_at' => $request->send_at,
        ]);

        return response()->json(['success' => true, 'message' => 'Notification updated successfully!']);
    }

    // Delete a notification
    public function destroy($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->delete();

        return response()->json(['success' => true, 'message' => 'Notification deleted successfully!']);
    }
}
