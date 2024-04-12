<?php

namespace App\Console\Commands;

use App\Mail\RenewAlertMail;
use App\Models\Backend\Order;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SendRenewalAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:renew_once_daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alert has been sent to the coustomer.';

    /**
     * Execute the console command.
     */
    public function handle(){ 
        $orders = Order::with('getOrderProduct')->get();
        foreach($orders as $order){
            $user = User::where('id', $order->user_id)->first();
            foreach ($order->getOrderProduct as $product){
                if($order->delivery_date !=  null){ 
                    // // <p>Alert before 15 days</p> 
                    $alertDate15 = Carbon::parse($order->delivery_date)->addMonths($product->month)->subDays(15); 
                    $order_id = $order->id; //Order Id
                    $product_id = $product->id; //Product Id
                    $selected_month = $product->month; //Month 
                    $delivery_date = Carbon::parse($order->delivery_date)->format('d M, Y'); //Delivery Date
                    $renew_date = Carbon::parse($order->delivery_date)->addMonths($product->month)->format('d M, Y '); //Renew Date
                    $alert_date = Carbon::parse($alertDate15)->format('d M, Y'); //Alert Date
                    $renew_alert_data = [
                        "user_name" => $user->name,
                        "product_name" => $product->product_name,
                        "selected_month" => $selected_month,
                        "renew_date" => $renew_date
                    ];
                    if (Carbon::now()->isSameDay($alertDate15)) {
                        Mail::to($user->email)->send(new RenewAlertMail($renew_alert_data));
                    }

                    // <p>Alert before 7 days</p> 
                    $alertDate7 = Carbon::parse($order->delivery_date)->addMonths($product->month)->subDays(7); 
                    $order_id = $order->id; //Order Id
                    $product_id = $product->id; //Product Id
                    $selected_month = $product->month; //Month 
                    $delivery_date = Carbon::parse($order->delivery_date)->format('d M, Y'); //Delivery Date
                    $renew_date = Carbon::parse($order->delivery_date)->addMonths($product->month)->format('d M, Y '); //Renew Date
                    $alert_date = Carbon::parse($alertDate7)->format('d M, Y'); //Alert Date
                    $renew_alert_data = [
                        "user_name" => $user->name,
                        "product_name" => $product->product_name,
                        "selected_month" => $selected_month,
                        "renew_date" => $renew_date
                    ];
                    if (Carbon::now()->isSameDay($alertDate7)) {
                        Mail::to($user->email)->send(new RenewAlertMail($renew_alert_data));
                    }

                      // <p>Alert before 3 days</p> 
                      $alertDate3 = Carbon::parse($order->delivery_date)->addMonths($product->month)->subDays(3); 
                      $order_id = $order->id; //Order Id
                      $product_id = $product->id; //Product Id
                      $selected_month = $product->month; //Month 
                      $delivery_date = Carbon::parse($order->delivery_date)->format('d M, Y'); //Delivery Date
                      $renew_date = Carbon::parse($order->delivery_date)->addMonths($product->month)->format('d M, Y '); //Renew Date
                      $alert_date = Carbon::parse($alertDate3)->format('d M, Y'); //Alert Date
                      $renew_alert_data = [
                          "user_name" => $user->name,
                          "product_name" => $product->product_name,
                          "selected_month" => $selected_month,
                          "renew_date" => $renew_date
                      ];
                      if (Carbon::now()->isSameDay($alertDate3)) {
                          Mail::to($user->email)->send(new RenewAlertMail($renew_alert_data));
                      }

                       // <p>Alert before 1 days</p> 
                       $alertDate1 = Carbon::parse($order->delivery_date)->addMonths($product->month)->subDays(1); 
                       $order_id = $order->id; //Order Id
                       $product_id = $product->id; //Product Id
                       $selected_month = $product->month; //Month 
                       $delivery_date = Carbon::parse($order->delivery_date)->format('d M, Y'); //Delivery Date
                       $renew_date = Carbon::parse($order->delivery_date)->addMonths($product->month)->format('d M, Y '); //Renew Date
                       $alert_date = Carbon::parse($alertDate1)->format('d M, Y'); //Alert Date
                       $renew_alert_data = [
                           "user_name" => $user->name,
                           "product_name" => $product->product_name,
                           "selected_month" => $selected_month,
                           "renew_date" => $renew_date
                       ];
                       if (Carbon::now()->isSameDay($alertDate1)) {
                           Mail::to($user->email)->send(new RenewAlertMail($renew_alert_data));
                       }
                } 
            }
        }
        echo "Alert Sent Successfully";
    }
}
