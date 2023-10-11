public function sendtestingmail()
{
$message= 'Thanks for signing up, we just need you to verify your email address to complete setting up your account.';
$email_data= [
'recipient'=>'qasimsumal@gmail.com',
'fromEmail'=>'baotauction@gmail.com',
'fromName' =>'Boat Bidding',
'subject'=>'Email Verification',
'body'=>$message,
];
\Mail:: send( 'email-template', $email_data, function($message) use ($email_data) {
$message->to($email_data['recipient'])
->from($email_data['fromEmail'], $email_data['fromName'])
->subject($email_data['subject']);
});
return redirect()->route('homepage');
}