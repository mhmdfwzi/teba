<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Http\Traits\SendWhatsappMessage;
use App\Models\Admin;
use App\Models\Delivery;
use App\Models\Vendor;

use App\Notifications\OrderCreatedNotification;

use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
{
    use SendWhatsAppMessage;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        // Set max execution time
        ini_set('max_execution_time', 300);

        // Get order
        $order = $event->order;

        // Get store vendors of the order item
        $vendors = Vendor::where('store_id', $order->store_id)->get();

        // Get all admins and delivery admin
        $admins = Admin::all();
        $deliveryAdmin = Delivery::whereHas('roles', function ($query) {
            $query->where('name', 'delivery admin');
        })->first();

        // Send notifications and messages to all admins
        foreach ($admins as $admin) {
            $admin->notify(new OrderCreatedNotification($order));
            $this->sendMessage('+2' . $admin->phone_number, $this->generateMessage($order));
        }

        // Send notifications and messages to all vendors of the store
        foreach ($vendors as $vendor) {
            $vendor->notify(new OrderCreatedNotification($order));
            $this->sendMessage('+2' . $vendor->phone, $this->generateMessage($order));
        }

        // Send notification and message to delivery admin if available
        if ($deliveryAdmin) {
            $deliveryAdmin->notify(new OrderCreatedNotification($order));
            $this->sendMessage('+2' . $deliveryAdmin->phone_number, $this->generateMessage($order));
        }
    }

    private function generateMessage($order)
    {
        $message = 'aliafandy';
        $message .= ' طلب رقم  : ' . $order->number . "\n";
        $message .= 'أسم المحل: ' . $order->store->name . "\n";
        return $message;
    }
}
