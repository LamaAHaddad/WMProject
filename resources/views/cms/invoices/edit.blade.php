@extends('cms.parent')

@section('title',__('cms.invoices'))
@section('page-lg',__('cms.edit'))
@section('main-pg-md',__('cms.invoices'))
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
            <h3 class="card-title">{{__('cms.edit_invoice')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="create-form">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">{{__('cms.product_name')}}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('cms.product_name')}}" value="{{$invoice->name}}">
              </div>
              <div class="form-group">
                <label for="quantity">{{__('cms.quantity')}}</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="{{__('cms.quantity')}}" value="{{$invoice->quantity}}">
              </div>
              <div class="form-group">
                <label for="price">{{__('cms.price')}}</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="{{__('cms.price')}}" value="{{$invoice->price}}">
              </div>
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="active" name="active">
                <label class="custom-control-label" for="active">{{__('cms.active')}}</label>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="button" onclick="performUpdate('{{$invoice->id}}')" class="btn btn-primary">{{__('cms.save')}}</button>
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
    axios.put('/cms/admin/invoices/{{$invoice->id}}', {
       name: document.getElementById('name').value,
       quantity: document.getElementById('quantity').value,
       price: document.getElementById('price').value,
       active: document.getElementById('active').checked,
      })
      .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/invoices';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection