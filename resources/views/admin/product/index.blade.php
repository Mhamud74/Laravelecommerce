 @extends('layouts.backend.app')
@section('title','Product')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Product Data Table</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                 <a href="{{ route('admin.product.create') }}">
                  
                <button type="button" class="btn btn-block btn-info btn-sm"><i class="fas fa-plus-circle"></i> Add New Product
               
       
            </button>

            </a>
            </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>serial</th>
                  <th>name</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>View</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($product as $key=>$prodct)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{str_limit($prodct->product_name,'15')}}</td>
                  <td>{{$prodct->categories->categroy_name}}</td>
                  <td>
                   <img height="50" width="70" src="{{ asset('storage/product/'.$prodct->image) }}">
                  </td>
                  <td>{{$prodct->price}}</td>
                  <td>{{$prodct->view_count}}</td>
                  <td>
                    @if($prodct->status ==true)
                        <a href="{{route('admin.unactive',$prodct->id)}}" class="btn btn-warning waves-effect">
                            <i class="material-icons">Active</i></a>
                              @else
                              <a href="{{route('admin.active',$prodct->id)}}" class="btn btn-warning waves-effect">
                             <i class="material-icons">Inactive</i>
                              @endif
                  </td>
                    <td>
                      <a href="{{ route('admin.product.show',$prodct->id) }}" class="btn btn-primary waves-effect">
                     <i class="fa fa-eye" aria-hidden="true"></i>
                   </a>
                      <a href="{{ route('admin.product.edit',$prodct->id) }}" class="btn btn-info waves-effect">
                     <i class="far fa-edit"></i>
                   </a>
                    <a href="" class="btn btn-danger waves-effect" type="button" onclick="if(confirm('Are you Sure, You want to delete this?')){
                  event.preventDefault();
                  document.getElementById('delete-form-{{ $prodct->id }}').submit();
                  }else{
                  event.preventDefault();
                  }">
                     <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                  <form method="POST" id="delete-form-{{ $prodct->id }}" action="{{ route('admin.product.destroy',$prodct->id) }}" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    
                  </form>
                                            </td>

                  
                </tr>
                @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection
  @push('js')
  <!-- DataTables -->
<script src="{{asset('assets/backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
    @endpush