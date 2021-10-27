<?php
  require '../../vendor/autoload.php';
  use Mailjet\Resources;
 
class Email{
public function sendEmail($from,$to,$cc,$bcc,$subject,$body){
  $mj = new \Mailjet\Client('c2d4ca8ae6a367f89e2f76e29b9efd51','31a9364091de7806c991e1f75782e8a9',true,['version' => 'v3.1']);
  $body = [
    'Messages' => [
      [
        'From' => [
          'Email' => $from,
          'Name' => ""
        ],
        'To' => [
          [
            'Email' => $to,
            'Name' => ""
          ]
        ],
        'Cc' => [
            [
              'Email' => $cc,
              'Name' => ""
            ]
          ],
        'Bcc' => [
            [
              'Email' => $bcc,
              'Name' => ""
            ]
          ],
        'Subject' => $subject,
        'TextPart' => $body,
        'HTMLPart' =>"",
        'CustomID' =>""
      ]
    ]
  ];
  $response = $mj->post(Resources::$Email, ['body' => $body]);
  return $response->success();
}


//function to send comfirmation email with login credentail to secondary merchant
public function accountConfirmation($from,$to,$subject,$body){
  $mj = new \Mailjet\Client('c2d4ca8ae6a367f89e2f76e29b9efd51','31a9364091de7806c991e1f75782e8a9',true,['version' => 'v3.1']);
  $body = [
    'Messages' => [
      [
        'From' => [
          'Email' => $from,
          'Name' => ""
        ],
        'To' => [
          [
            'Email' => $to,
            'Name' => ""
          ]
        ],
        'Subject' => $subject,
        'TextPart' => $body,
        'HTMLPart' =>"",
        'CustomID' =>""
      ]
    ]
  ];
  $response = $mj->post(Resources::$Email, ['body' => $body]);
  //$response->success() && var_dump($response->getData());

  return $response->success();
}
}
?>