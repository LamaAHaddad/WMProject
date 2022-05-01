@extends('cms.parent')

@section('title',__('cms.admins'))
@section('page-lg',__('cms.edit'))
@section('main-pg-md',__('cms.admins'))
@section('page-md',__('cms.edit'))

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
            <h3 class="card-title">{{__('cms.edit_admin')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="create-form">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">{{__('cms.name')}}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('cms.name')}}" value="{{$admin->name}}">
              </div>
              <div class="form-group">
                <label for="email">{{__('cms.email')}}</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="{{__('cms.email')}}" value="{{$admin->email}}">
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="button" onclick="performUpdate('{{$admin->id}}')" class="btn btn-primary">{{__('cms.save')}}</button>
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
   function performUpdate(id)
   {
    axios.put('/cms/admin/admins/{{$admin->id}}', {
       name: document.getElementById('name').value,
       email_address: document.getElementById('email').value,
      })
      .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/admins';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection