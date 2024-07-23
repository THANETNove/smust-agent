@extends('layouts.app')

@section('content')
    <div class="box-content-background">
        <div id="container">

            <div class="box-content" id="back-home">
                <div class="content-box">
                    <a href="{{ url('/home') }}" class="box-call">
                        กลับ
                    </a>
                </div>
            </div>
            <div class="box-content">


                <div class="content-box background-white mp-16">
                    <p class="add_head-content text-center mt-3">เพิ่ม Admin</p>
                    @if (session('message'))
                        <p class="message-text-color text-center mt-4"> {{ session('message') }}</p>
                    @endif
                    <div class="mt-3 mb-5">
                        <form class="d-flex" role="search" method="POST" action="{{ route('search-user') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input class="form-control me-2" type="search" name="search" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                    @php
                        $i = 1;
                    @endphp
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>

                                    <th scope="col">email</th>
                                    <th scope="col">ชื่อ</th>
                                    <th scope="col">นามสกุล</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">เปลี่ยนสถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->where('status', 1)->sortByDesc('created_at') as $us)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $us->email }}</td>
                                        <td>{{ $us->first_name }}</td>
                                        <td>{{ $us->last_name }}</td>
                                        <td>Admin</td>
                                        <td><a href="{{ url('cancel-admin', $us->id) }}" type="button"
                                                class="btn btn-secondary">ยกเลิก Admin</a>
                                        </td>
                                    </tr>
                                @endforeach

                                @foreach ($user->where('status', 0)->sortByDesc('created_at') as $us)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $us->email }}</td>
                                        <td>{{ $us->first_name }}</td>
                                        <td>{{ $us->last_name }}</td>
                                        <td>นายหน้า</td>
                                        <td>
                                            <a href="{{ url('change-admin', $us->id) }}" type="button"
                                                class="btn btn-primary">เปลี่ยน Admin</a>
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
@endsection
