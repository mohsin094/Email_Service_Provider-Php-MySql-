<?php
require '../../vendor/autoload.php';
require_once '../../config/database.php';
require_once '../../api_response/response.php';
  \Stripe\Stripe::setApiKey(
    'sk_test_51Joui7L1cSJT1UwBVD0ZcLVt3xPFpSXmbA30b9EJDCizXEFSpy4oQ4sbiyg5hsAJ4oMtLfiARPMdejVTaL4pjVQr00LJQMDtcD'
  );
  
  class Recharge{

        public function rechargeAccount($card_num,$exp_month,$exp_year,$cvc,$name,$email,$payer_id,$pay_for){
            $stripe = new \Stripe\StripeClient(
                'sk_test_51Jp5pRKD7233Jqbe7viIRqj4zhzDOwkdBS15t2BAEMI4xal1hIDaoBvekbgzRqd1XgRSeI31cYQcnwrTww5AnidW00UweOa43g'
              );
            $token=$stripe->tokens->create([
            'card' => [
                'number' => $card_num,
                'exp_month' => $exp_month,
                'exp_year' => $exp_year,
                'cvc' => $cvc,
            ],
            ]);

            $customer=$stripe->customers->create([
            'source' => $token->id,
            'name' => $name,
            'email' => $email,

            ]);
            // print_r( $customer->id);

            $transation=$stripe->charges->create([
            'amount' => 2000,
            'currency' => 'usd',
            'customer' => $customer->id,
            'description' => 'My First Test Charge (created for API docs)',
            ]);
            if($transation->captured){
               $database = new Database();
               $res = new Response();
                    // get database connection
                    $conn = $database->get_Connection();
                    $transationID=$transation->id;
                    $query1=" UPDATE merchant SET credit ='50' WHERE merchant_id = $payer_id";
                    $result = $conn->query($query1);
                  if($result){
                    $query="INSERT into payments (payment_id,	payer_id,payer_name,payment_amount) 
                    values('$transationID','$payer_id','$name','50')";
                     $conn->query($query);  
                    $res->set_response(null,'Payment done successfully!',200);
                    $res->respond_api();
                  }
                  else{
                    $res->set_response(null,'Recharge not completed',404);
                    $res->respond_api();
                  }
            }
        }
  }
?>
