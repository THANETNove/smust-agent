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
                    <p class="add_head-content text-center mt-3">เพิ่ม profile</p>
                    @if (session('message'))
                        <p class="message-text-color text-center mt-4"> {{ session('message') }}</p>
                    @endif
                    <div class="flex-direction-row">
                        <div class="box-profile ">ชื่อ</div>
                        <div class="box-profile2">{{ Auth::user()->first_name }}</div>
                    </div>
                    <div class="flex-direction-row mt-01">
                        <div class="box-profile">นามสกุล</div>
                        <div class="box-profile2">{{ Auth::user()->last_name }}</div>
                    </div>
                    <div class="flex-direction-row mt-01">
                        <div class="box-profile">email</div>
                        <div class="box-profile2">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="flex-direction-row mt-01">
                        <div class="box-profile">รหัส Admin </div>
                        <div class="box-profile2">
                            <p>{{ Auth::user()->code }}
                                <span>
                                    <img class="copy-icon ml-16" id="copy-code"
                                        src="{{ URL::asset('/assets/image/home/link.png') }}"
                                        onclick="copyCode('{{ Auth::user()->code }}')">
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="flex-direction-row mt-01">
                        <div class="box-profile">ลิงค์สมัคร </div>
                        <div class="box-profile2">
                            <p> link นายหน้า <span> <img class="copy-icon ml-16" id="copy-url"
                                        src="{{ URL::asset('/assets/image/home/link.png') }}"
                                        onclick="copyUrlCode('{{ Auth::user()->code }}')"></span></p>
                        </div>

                    </div>
                    @php
                        $countUser = count($user);
                    @endphp
                    <div class="flex-direction-row mt-01">

                        @if (Auth::user()->status == '3')
                            <div class="box-profile2">ตอนนี้คุณมีนายหน้าเเล้ว &nbsp;{{ $countUser }}&nbsp; คน </div>
                        @else
                            <div class="box-profile2">ตอนนี้คุณมีนายหน้าเเล้ว &nbsp;{{ $countUser }}/10&nbsp; คน </div>
                        @endif


                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">email</th>
                                    <th scope="col">ชื่อ นามสกุล</th>
                                    <th scope="col">เบอร์โทร</th>
                                    <th scope="col">จังหวัด</th>
                                    <th scope="col">delete</th>
                                </tr>
                            </thead>
                            @php
                                $i = 1;
                            @endphp
                            <tbody>
                                @foreach ($user as $us)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $us->email }}</td>
                                        <td>{{ $us->prefix }} {{ $us->first_name }} {{ $us->last_name }}</td>
                                        <td>{{ $us->phone }}</td>
                                        <td>{{ $us->provinces }}</td>
                                        <td><a href="{{ url('delete-code', $us->id) }}" class="btn btn-danger">delete</a>
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
    <script>
        function copyCode(data) {
            // Create a temporary textarea element
            var textarea = document.createElement('textarea');
            // Set the value of the textarea to the data you want to copy
            textarea.value = data;
            // Append the textarea to the document
            document.body.appendChild(textarea);
            // Select the text in the textarea
            textarea.select();
            try {
                // Execute the copy command
                document.execCommand('copy');
                console.log('Data copied to clipboard:', data);
                alert(" copied to Code: " + data);
            } catch (err) {
                console.error('Unable to copy data to clipboard', err);
            }
            // Remove the temporary textarea from the document
            document.body.removeChild(textarea);



        }

        function copyUrlCode(data) {
            // Get the URL from the address bar
            var urlToCopy = window.location.origin + '/' + 'register-broker/' + data;



            // Create a temporary input element
            var tempInput = document.createElement("input");


            // Set the input value to the URL
            tempInput.value = urlToCopy;

            // Append the input element to the body
            document.body.appendChild(tempInput);

            // Select the input value
            tempInput.select();

            // Copy the selected text
            document.execCommand("copy");

            // Remove the temporary input element
            document.body.removeChild(tempInput);

            // Optional: Provide feedback to the user
            alert("URL copied to clipboard: " + urlToCopy);

        }
    </script>
@endsection
