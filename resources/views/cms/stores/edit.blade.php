@extends('cms.parent')

@section('title',__('cms.stores'))
@section('page-lg',__('cms.edit'))
@section('main-pg-md',__('cms.stores'))
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
            <h3 class="card-title">{{__('cms.edit_store')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="create-form">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>{{__('cms.city')}}</label>
                <select class="form-control" id="city_id">
                  @foreach ($cities as $city )
                  <option value="{{$city->id}}">{{$city->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name">{{__('cms.name')}}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('cms.name')}}" value="{{$store->name}}">
              </div>
              <div class="form-group">
                <label for="mobile">{{__('cms.mobile')}}</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="{{__('cms.mobile')}}" value="{{$store->mobile}}">
              </div>
              <div class="form-group">
                <label for="location">{{__('cms.location')}}</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="{{__('cms.location')}}" value="{{$store->location}}">
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="button" onclick="performUpdate('{{$store->id}}')" class="btn btn-primary">{{__('cms.save')}}</button>
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
   function performUpdate()
   {
    axios.put('/cms/admin/stores/{{$store->id}}', {
       name: document.getElementById('name').value,
       location:document.getElementById('location').value,
       mobile: document.getElementById('mobile').value,
       city_id: document.getElementById('city_id').value
      })
      .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/stores';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection