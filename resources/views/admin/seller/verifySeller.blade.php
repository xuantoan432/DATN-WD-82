@extends('admin.layouts.master')



@section('content')
<div class="main-wrapper">
    <div class="main-content">
        <div class="col-xl-12">
            <h3 class="mb-0 text-uppercase">Danh sách xác thực</h3>
            <hr>
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <script>
         window.userId = @json(auth()->user()->id);
                  </script>
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên người dùng</th>

                                <th scope="col">Tên cửa haàng</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id=data>
                            @foreach ($seller as $se)
                                <tr>
                                    <td>{{ $se->id }}</td>

                                    <td>{{ $se->user->name }}</td>

                                    <td>{{ $se->store_name }}</td>
                                    <td>{{ $se->store_email }}</td>
                                    {{-- <td>{{ $se->address[0]->full_address }}</td> --}}
                                    <td>
                                        <form action="{{ route('admin.seller-approve', $se->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Phê duyệt</button>
                                        </form>
                                        <form action="{{ route('admin.seller-reject', $se->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Từ chối</button>
                                        </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{$seller->links()}} --}}
                </div>
            </div>
        </div>
    </div>
    @section('js_new')


    @vite('resources/js/public.js')


    @endsection
