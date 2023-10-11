<div class="row dynamic-parameter">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline">Publisher List</h3>
                <button type="button" class="btn btn-sm btn-primary float-right d-inline add-button" data-action="{{route('publisher.store')}}">
                 <i class="fa fa-plus-circle mr-1"></i>Add New Publisher
                </button>
            </div>
            <div class="card-body">
                <div class="card-block text-center">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach(App\Publisher::orderBy('id','desc')->get() as $key=>$publisher)
                        <tr>
                          <th>{{$key+1}}</th>
                          <td>{{$publisher->name}}</td>
                          <td><a class="btn btn-sm btn-primary edit-button" data-action="{{ route('publisher.update', $publisher->id)}}" data-id="{{$publisher->id}}" data-name="{{$publisher->name}}" title="edit" href="javascript:void(0)"><i class="fa fa-edit"></i></a> | 
                          <a onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" title = "delete" href="{{route('publisher.delete', [$publisher->id])}}"><i class="fa fa-trash"></i></a>
                          </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline">Publisher Country List</h3>
                <button type="button" class="btn btn-sm btn-primary float-right d-inline add-button" data-action="{{route('publishercountry.store')}}">
                 <i class="fa fa-plus-circle mr-1"></i>Add New Publisher Country
                </button>
            </div>
            <div class="card-body">
                <div class="card-block text-center">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach(App\PublisherCountry::orderBy('id','desc')->get() as $key=>$publishercountry)
                        <tr>
                          <th>{{$key+1}}</th>
                          <td>{{$publishercountry->name}}</td>
                          <td><a class="btn btn-sm btn-primary edit-button" data-action="{{ route('publishercountry.update', $publishercountry->id)}}" data-id="{{$publishercountry->id}}" data-name="{{$publishercountry->name}}" title="edit" href="javascript:void(0)"><i class="fa fa-edit"></i></a> | 
                          <a onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" title = "delete" href="{{route('publishercountry.delete', [$publishercountry->id])}}"><i class="fa fa-trash"></i></a>
                          </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline">Profession List</h3>
                <button type="button" class="btn btn-sm btn-primary float-right d-inline add-button" data-action="{{route('profession.store')}}">
                 <i class="fa fa-plus-circle mr-1"></i>Add New Profession
                </button>
            </div>
            <div class="card-body">
                <div class="card-block text-center">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach(App\Profession::orderBy('id','desc')->get() as $key=>$profession)
                        <tr>
                          <th>{{$key+1}}</th>
                          <td>{{$profession->name}}</td>
                          <td><a class="btn btn-sm btn-primary edit-button" data-action="{{ route('profession.update', $profession->id)}}" data-id="{{$profession->id}}" data-name="{{$profession->name}}" title="edit" href="javascript:void(0)"><i class="fa fa-edit"></i></a> | 
                          <a onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" title = "delete" href="{{route('profession.delete', [$profession->id])}}"><i class="fa fa-trash"></i></a>
                          </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline">Language List</h3>
                <button type="button" class="btn btn-sm btn-primary float-right d-inline add-button" data-action="{{route('language.store')}}">
                 <i class="fa fa-plus-circle mr-1"></i>Add New Language
                </button>
            </div>
            <div class="card-body">
                <div class="card-block text-center">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach(App\Language::orderBy('id','desc')->get() as $key=>$language)
                        <tr>
                          <th>{{$key+1}}</th>
                          <td>{{$language->name}}</td>
                          <td><a class="btn btn-sm btn-primary edit-button" data-action="{{ route('language.update', $language->id)}}" data-id="{{$language->id}}" data-name="{{$language->name}}" title="edit" href="javascript:void(0)"><i class="fa fa-edit"></i></a> | 
                          <a onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" title = "delete" href="{{route('language.delete', [$language->id])}}"><i class="fa fa-trash"></i></a>
                          </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>

<!-- Add & update Modal -->
<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="" autocomplete="off" id="form">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" id="name" value="" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    $('.add-button').click(function() {
        $('#form-modal').modal('show');
        $('#name').val('');
          var action = $(this).data('action');
          $("#form").attr("action",action);
    });
    
    $('.edit-button').click(function() {
        $('#form-modal').modal('show');
        // var id = $(this).data('id');
        var action = $(this).data('action');
        $('#name').val($(this).data('name'));
        // var url = "{{url('admin/publisher/update/')}}"+ id;
        $("#form").attr("action",action);
    });
</script>