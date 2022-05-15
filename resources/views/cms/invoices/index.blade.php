@extends('cms.parent')

@section('title',__('cms.invoices'))
@section('page-lg',__('cms.index'))
@section('main-pg-md',__('cms.invoices'))
@section('page-md',__('cms.index'))

@section('content')
    
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <h1 class="h3 mb-4 text-gray-800">{{__('cms.index')}}</h1>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-s">
              <h3 class="card-title">{{__('cms.invoices')}}</h3>
            </div>
            <!-- /.invoiced-header -->
            <div class="card-body">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>{{__('cms.product_name')}}</th>
                    <th>{{__('cms.active')}}</th>
                    <th>{{__('cms.quantity')}}</th>
                    <th>{{__('cms.price')}}</th>
                    <th>{{__('cms.total')}}</th>
                    <th>{{__('cms.created_at')}}</th>
                    <th>{{__('cms.updated_at')}}</th>
                    <th style="width: 40px">{{__('cms.settings')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($invoices as $invoice)
                  <tr>
                    <td>{{$invoice->id}}</td>
                    <td>{{$invoice->name}}</td>
                    <td><span class="badge @if($invoice->active) bg-success @else bg-danger @endif">{{$invoice->active_status}}</span></td>
                    <td>{{$invoice->quantity}}</td>
                    <td>{{$invoice->price}}</td>
                    <td>{{$invoice->total}}</td>
                    <td>{{$invoice->created_at}}</td>
                    <td>{{$invoice->updated_at}}</td>
                    <td>
                      <div class="btn-group">
                        <a href="{{route('invoices.edit',$invoice->id)}}" type="button" class="btn btn-warning btn-circle">
                          <i class="fas fa-edit"></i>
                        </a>
                          <a href="#" onclick="confirmDelete('{{$invoice->id}}' , this)" class="btn btn-danger btn-circle">
                            <i class="fas fa-trash"></i>
                          </a>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.invoiced-body -->
            <div class="invoiced-footer clearfix">
            </div>
          </div>
          <!-- /.invoiced -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(id , reference){
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        performDelete(id, reference);
      }
    })
  }
  function performDelete(id , reference){
    axios.delete('/cms/admin/invoices/'+id)
      .then(function (response) {
            console.log(response);
            reference.closest('tr').remove();
            showMessage(response.data);
        })
        .catch(function (error) {
            console.log(error.response);
            showMessage(error.response.data);
        });
  }
  function showMessage(data){
    Swal.fire(
      data.title,
      data.text,
      data.icon
      )
  }
</script>
  
@endsection