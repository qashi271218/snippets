<div class="col-md-6">
        @component('website.backend.components.box',['title'=>'SMTP Setting'])
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="{{route('admin.update.smtp.setting')}}">
              {{csrf_field()}}
         <div class="form-group">
          <input type="hidden" name="types[]" value="MAIL_MAILER">
          <label class="font-medium">MAIL DRIVER</label>
          <input type="text" class="form-control" name="MAIL_MAILER" value="{{ env('MAIL_MAILER') }}">
          </div>
          <div class="form-group">
          <input type="hidden" name="types[]" value="MAIL_HOST">
          <label class="font-medium">MAIL HOST</label>
          <input type="text" class="form-control" name="MAIL_HOST" value="{{ env('MAIL_HOST') }}">
          </div>
          <div class="form-group">
          <input type="hidden" name="types[]" value="MAIL_PORT">
          <label class="font-medium">MAIL PORT</label>
          <input type="text" class="form-control" name="MAIL_PORT" value="{{ env('MAIL_PORT') }}">
          </div><div class="form-group">
          <input type="hidden" name="types[]" value="MAIL_USERNAME">
          <label class="font-medium">MAIL USERNAME</label>
          <input type="text" class="form-control" name="MAIL_USERNAME" value="{{ env('MAIL_USERNAME') }}">
          </div><div class="form-group">
          <input type="hidden" name="types[]" value="MAIL_PASSWORD">
          <label class="font-medium">MAIL PASSWORD</label>
          <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}">
          </div><div class="form-group">
          <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
          <label class="font-medium">MAIL ENCRYPTION</label>
          <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{ env('MAIL_ENCRYPTION') }}">
          </div><div class="form-group">
          <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
          <label class="font-medium">MAIL FROM ADDRESS</label>
          <input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{ env('MAIL_FROM_ADDRESS') }}" required>
          </div><div class="form-group">
          <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
          <label class="font-medium">MAIL FROM NAME</label>
          <input type="text" class="form-control" name="MAIL_FROM_NAME" value="{{ env('MAIL_FROM_NAME') }}">
          </div>
         <button type="submit" class="btn btn-primary">Update Setting</button>
         </form>
        @endcomponent
    </div>
    <div class="col-md-6">
        @component('website.backend.components.box',['title'=>'Testing Mail'])
            <form method="post" action="{{route('admin.send.testing.mail')}}">
              {{csrf_field()}}
         <div class="form-group">
          <label class="font-medium">Email Id</label>
          <input type="email" class="form-control" name="testing_email" required>
          </div>
          <div class="form-group">
          <label class="font-medium">Message</label>
          <input type="text" class="form-control" name="testing_message" required>
          </div>
         <button type="submit" class="btn btn-primary">Send Testing Mail</button>
         </form>
        @endcomponent
    </div>