@extends('seller.layouts.master')

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Seller</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Danh sách thuộc tính</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Thêm Thuộc Tính</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <div class="col-12">
                                    <form action="{{ route('seller.attributes.store') }}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Tên Thuộc
                                                Tính</label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="Nhập tên thuộc tính">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-grd-primary px-4">Tạo</button>
                                            <button type="reset" class="btn btn-grd-royal px-4">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Danh sách thuộc tính</h6>
                    </div>
                    <div class="card-body">
                        <div class="">
                            @if (session('success'))
                                <div class="alert bg-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên thuộc tính</th>
                                    <th>Giá trị thuộc tính</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($attributes as $attribute)
                                        <tr>
                                            <td>{{ $attribute->id }}</td>
                                            <td>
                                                {{ $attribute->name }}
                                                <div class="row row-cols-auto g-3 mt-2">
                                                    <div class="col">
                                                        <form action="{{ route('seller.attributes.destroy', $attribute) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger d-flex gap-2" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i
                                                                    class="material-icons-outlined">delete</i></button>
                                                        </form>

                                                    </div>
                                                    <div class="col">
                                                        <a href="{{ route('seller.attributes.edit', $attribute) }}" class="btn btn-outline-warning d-flex gap-2">
                                                            <i class="material-icons-outlined">edit</i></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="">
                                                <a href="{{ route('seller.attribute.values.index', $attribute) }}" class="btn btn-outline-success">Thêm
                                                    value
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
@section('css_new')
    <link href="{{asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"/>
@endsection
@section('js_new')

    <script src="{{asset('theme/admin/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                // display everything
                "aaSorting": [[ 0, "desc" ]] // Sort by first column descending
            });
        });
    </script>
@endsection
