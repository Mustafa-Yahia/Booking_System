<?php


namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // جلب جميع إشعارات المستخدم الحالي
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
                                     ->orderBy('created_at', 'desc')
                                     ->get();

        return response()->json($notifications);
    }

    // تعيين الإشعار كمقروء
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
                                    ->where('user_id', Auth::id())
                                    ->firstOrFail();

        $notification->update(['is_read' => true]);

        return response()->json(['message' => 'Notification marked as read']);
    }

    // إنشاء إشعار جديد
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Notification::create([
            'user_id' => $request->user_id,
            'title'   => $request->title,
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Notification created successfully']);
    }

    // حذف إشعار
    public function destroy($id)
    {
        $notification = Notification::where('id', $id)
                                    ->where('user_id', Auth::id())
                                    ->firstOrFail();

        $notification->delete();

        return response()->json(['message' => 'Notification deleted']);
    }




    public function fetchNotifications()
    {
        return response()->json(auth()->user()->unreadNotifications);
    }

    // public function markAsRead($id)
    // {
    //     $notification = auth()->user()->notifications()->find($id);
    //     if ($notification) {
    //         $notification->markAsRead();
    //     }
    //     return redirect()->back();
    // }

}
