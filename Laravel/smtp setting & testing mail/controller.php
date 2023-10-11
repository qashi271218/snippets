use Illuminate\Support\Facades\Mail;
use App\Mail\TestingMail;

public function update_smtp_setting(Request $request)
    {
        foreach ($request->types as $key => $type) {
        $this->overWriteEnvFile($type, $request[$type]);
        }
        $message=toastr_message()['updated'];
        $notification=toastr_notification($message,'success');
        return Redirect()->back()->with($notification);
    }
        public function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
        file_put_contents($path, str_replace(
        $type . '=' . env($type), $type . '=' . $val, file_get_contents($path)
        ));
        }
        //Artisan::call('cache:clear');
    }
    
    public function send_testing_mail(Request $request)
    {
        $data = array(
            'message'   =>   $request->testing_message
        );

     Mail::to($request->testing_email)->send(new TestingMail($data));
     $notification=toastr_notification('Mail sent successfully','success');
     return Redirect()->back()->with($notification);
    }