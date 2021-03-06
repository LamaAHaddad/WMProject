@extends('cms.parent')

@section('title',__('cms.cars'))
@section('page-lg',__('cms.edit'))
@section('main-pg-md',__('cms.cars'))
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
            <h3 class="card-title">{{__('cms.edit_car')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="create-form">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">{{__('cms.name')}}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('cms.name')}}" value="{{old('cms.name') ?? $car->name}}">
              </div>
              <div class="form-group">
                <label for="color">{{__('cms.color')}}</label>
                <input type="text" class="form-control" id="color" name="color" placeholder="{{__('cms.color')}}" value="{{old('cms.color') ?? $car->color}}">
              </div>
              <div class="form-group">
                <label for="number_car">{{__('cms.number_car')}}</label>
                <input type="number" class="form-control" id="number_car" name="number_car" placeholder="{{__('cms.number_car')}}" value="{{old('cms.number_car') ?? $car->number_car}}">
              </div>
              <div class="form-group">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="active" name="active">
                <label class="custom-control-label" for="active">{{__('cms.active')}}</label>
              </div>
            </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="button" onclick="performUpdate('{{$car->id}}')" class="btn btn-primary">{{__('cms.save')}}</button>
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
    axios.put('/cms/admin/cars/{{$car->id}}', {
       name: document.getElementById('name').value,
       color: document.getElementById('color').value,
       number_car: document.getElementById('number_car').value,
       active: document.getElementById('active').checked,
      })
      .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/cars';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection