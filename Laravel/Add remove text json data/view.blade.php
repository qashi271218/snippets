@component('website.backend.components.box',['title'=>'Achievements'])
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAchievement">Add New</button>
        @if($athlete_achievements)
        @foreach($athlete_achievements as $key=>$row)
        <div class="form-group" style="display: flex;align-items: center;margin-top:14px;">
            <label></label><br>
        <input type="text" class="form-control" value="{{$row->name}}" readonly>
        <form action="{{ route('athlete.delete.pofile.functionality',[$row->name]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="type" value="achievement">
        <input type="hidden" name="achievement" value="{{$row->name}}"> 
        <button type="submit" class="delete"><i class="fa fa-trash text-danger"></i></button>
        </form>
        </div>
        @endforeach
        @endif
        @endcomponent
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Achievement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" action="{{route('athlete.add.pofile.functionality')}}">
              {{csrf_field()}}
              <input type="hidden" name="type" value="achievement">
        @if($athlete_achievements)
        @foreach($athlete_achievements as $key=>$row)
        <input type="hidden" class="form-control" name="achievement[]" value="{{$row->name}}" readonly>
        @endforeach
        @endif
        <div class="form-group">
            <label>Add Achievement</label>
        <input type="text" class="form-control" name="achievement[]" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>