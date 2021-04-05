<form method="post" action="{{url('api/auth/update-changed-password')}}"  enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-row">
        @if(Session::has('flash_message'))
            <div>{{session('flash_message')}}</div>
        @endif
        <div class="col-12">
            <input type="hidden" value="{{$user}}" name="email" class="form-control">
        </div>
        <div class="col-12">
            <input type="password" name="password" class="form-control" placeholder="new Password">
        </div>
        <div class="col-12">
            <input type="password" name="confirm-password" class="form-control" placeholder="confirm Password">
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-3 col-sm-9">
            <button type="submit" class="btn btn-primary">Change password</button>
        </div>
    </div>
</form>