@extends('cms.parent')

@section('title',__('cms.edit_password'))
@section('page-lg',__('cms.edit_password'))
@section('main-pg-md',__('cms.edit_password'))
@section('page-md',__('cms.edit_password'))

@section('styles')
  
@endsection

@section('content')
    
 <!-- Main content -->
 <section class="content">
  
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">{{__('cms.edit_password')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="create-form">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="current_password">{{__('cms.current_password')}}</label>
                <input type="password" class="form-control" id="current_password" placeholder="{{__('cms.current_password')}}">
              </div>
              <div class="form-group">
                <label for="new_password">{{__('cms.new_password')}}</label>
                <input type="password" class="form-control" id="new_password" placeholder="{{__('cms.new_password')}}">
              </div>
              <div class="form-group">
                <label for="new_password_confirmation">{{__('cms.new_password_confirmation')}}</label>
                <input type="password" class="form-control" id="new_password_confirmation" placeholder="{{__('cms.new_password_confirmation')}}">
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="button" onclick="performStore()" class="btn btn-primary">{{__('cms.save')}}</button>
          </div>
          </form>
        </div>
      </div>
      <!--/.col (left) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
   function performStore()
   {
    axios.put('/cms/admin/update-password', {
      password: document.getElementById('current_password').value,
      new_password: document.getElementById('new_password').value,
      new_password_confirmation: document.getElementById('new_password_confirmation').value,
      })
      .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-form').reset();
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection