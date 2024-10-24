@extends('admin.layouts.master')

@section('content')
    <div class="main-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Danh sách danh mục</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Thêm Danh Mục</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="col-12">
                                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên Danh Mục</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Nhập tên danh mục">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Icon Danh Mục</label>
                                        <input type="file" class="form-control" id="icon" name="icon" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="fee_percentage" class="form-label">Phần trăm phí (%)</label>
                                        <input type="number" class="form-control" id="fee_percentage" name="fee_percentage" min="0" max="100" required>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-grd-primary px-4">Tạo</button>
                                        <button type="reset" class="btn btn-grd-royal px-4">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Danh sách danh mục</h6>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert bg-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên danh mục</th>
                                        <th>Icon</th>
                                        <th>Phần trăm phí</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $model)
                                        <tr>
                                            <td>{{ $model->id }}</td>
                                            <td>{{ $model->name }}</td>
                                            <td>
                                                @if($model->icon)
                                                    <img src="{{ asset('storage/' . $model->icon) }}" alt="Icon" style="width: 50px; height: 50px;">
                                                @else
                                                    Không có icon
                                                @endif
                                            </td>
                                            <td>{{ $model->fee_percentage }}%</td>
                                            <td>
                                                <div class="row row-cols-auto g-3">
                                                    <div class="col">
                                                        <a href="{{ route('admin.category.edit', $model->id) }}" class="btn btn-outline-warning d-flex gap-2">
                                                            <i class="material-icons-outlined">edit</i>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <form action="{{ route('admin.category.destroy', $model->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger d-flex gap-2">
                                                                <i class="material-icons-outlined">delete</i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
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
                "aaSorting": [[ 0, "desc" ]]
            });
        });
    </script>
@endsection
