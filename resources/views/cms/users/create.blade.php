@extends('cms.parent')

@section('title',__('cms.distributors'))
@section('page-lg',__('cms.create'))
@section('main-pg-md',__('cms.distributors'))
@section('page-md',__('cms.create'))

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
            <h3 class="card-title">{{__('cms.distributors')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="create-form">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>{{__('cms.car')}}</label>
                <select class="form-control" id="car_id">
                  @foreach ($cars as $car )
                  <option value="{{$car->id}}">{{$car->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name">{{__('cms.name')}}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('cms.name')}}" value="{{old('cms.name')}}">
              </div>
              <div class="form-group">
                <label for="email">{{__('cms.email')}}</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="{{__('cms.email')}}" value="{{old('cms.email')}}">
              </div>
              <div class="form-group">
                <label for="mobile">{{__('cms.mobile')}}</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="{{__('cms.mobile')}}" value="{{old('cms.mobile')}}">
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
    axios.post('/cms/admin/users', {
       name: document.getElementById('name').value,
       email_address: document.getElementById('email').value,
       car_id: document.getElementById('car_id').value,
       mobile: document.getElementById('mobile').value,
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