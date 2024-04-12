<?php

namespace App\Console\Commands;

use App\Mail\RenewAlertMail;
use App\Models\Backend\Order;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SameDayAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:renew_twice_daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle() {
        $orders = Order::with('getOrderProduct')->get();
        foreach($orders as $order){
            $user = User::where('id', $order->user_id)->first();
            foreach ($order->getOrderProduct as $product){
                if($order->delivery_date !=  null){ 
                    // // <p>Alert twice in a day days</p> 
                    $alertDate = Carbon::parse($order->delivery_date)->addMonths($product->month); 
                    $order_id = $order->id; //Order Id
                    $product_id = $product->id; //Product Id
                    $selected_month = $product->month; //Month 
                    $delivery_date = Carbon::parse($order->delivery_date)->format('d M, Y'); //Delivery Date
                    $renew_date = Carbon::parse($order->delivery_date)->addMonths($product->month)->format('d M, Y '); //Renew Date
                    $alert_date = Carbon::parse($alertDate)->format('d M, Y'); //Alert Date
                    $renew_alert_data = [
                        "user_name" => $user->name,
                        "product_name" => $product->product_name,
                        "selected_month" => $selected_month,
                        "renew_date" => $renew_date
                    ];
                    if (Carbon::now()->isSameDay($alertDate)) {
                        Mail::to($user->email)->send(new RenewAlertMail($renew_alert_data));
                    }       
                } 
            }
        }
        echo "Alert Sent Successfully";
    }
}
