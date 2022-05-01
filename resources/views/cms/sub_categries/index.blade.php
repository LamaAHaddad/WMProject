@extends('cms.parent')

@section('title',__('cms.sub_categories'))
@section('page-lg',__('cms.index'))
@section('main-pg-md',__('cms.sub_categories'))
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
              <h3 class="card-title">{{__('cms.sub_categories')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>{{__('cms.name')}}</th>
                    {{-- <th>{{__('cms.active')}}</th> --}}
                    <th>{{__('cms.created_at')}}</th>
                    <th>{{__('cms.updated_at')}}</th>
                    <th style="width: 40px">{{__('cms.settings')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($subCategories as $subCategory)
                  <tr>
                    <td>{{$subCategory->id}}</td>
                    <td>{{$subCategory->name}}</td>
                    {{-- <td><span class="badge @if($car->active) bg-success @else bg-danger @endif">{{$car->active_status}}</span></td> --}}
                    <td>{{$subCategory->created_at}}</td>
                    <td>{{$subCategory->updated_at}}</td>
                    <td>
                      <div class="btn-group">
                        <a href="{{route('categories.edit',$subCategory->id)}}" type="button" class="btn btn-warning btn-circle">
                          <i class="fas fa-edit"></i>
                        </a>
                          <a href="#" onclick="confirmDelete('{{$subCategory->id}}' , this)" class="btn btn-danger btn-circle">
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
            <!-- /.card-body -->
            <div class="card-footer clearfix">
      
            </div>
          </div>
          <!-- /.card -->
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
    axios.delete('/cms/admin/subCategories/'+id)
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