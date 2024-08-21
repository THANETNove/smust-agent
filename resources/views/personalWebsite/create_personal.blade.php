@extends('layouts.app')

@section('content')
    <?php
    $data = DB::table('provinces')->orderBy('name_th', 'ASC')->get();
    ?>



    <div class="free-trial-box-nav-web">
        <div class="offcanvasManu-web">
            @include('layouts.offcanvasManu')
        </div>
        <div class="box-nav-web">
            @if (session('success'))
                <a href="{{ url('/home') }}">
                    <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a>
            @else
                <a href="javascript:void(0);" onclick="goBack()">
                    <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a>
            @endif

            <p class="free-trial">
                แก้ไขเว็บไซต์ส่วนตัว
            </p>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="row mb-4">
            <!-- Upload Method Selection -->
            <div class="col-md-6">
                <label for="upload-method">Upload Method:</label>
                <select class="form-control" id="upload-method">
                    <option value="upload">Upload File</option>
                    <option value="url">Enter URL</option>
                </select>
            </div>
        </div>

        <!-- File Upload Section -->
        <div class="row mb-4" id="file-upload-section">
            <div class="col-md-12">
                <label for="select-file">Select File:</label>
                <input type="file" class="form-control" id="select-file">
            </div>
        </div>

        <!-- URL Upload Section (hidden by default) -->
        <div class="row mb-4" id="url-upload-section" style="display: none;">
            <div class="col-md-12">
                <label for="image-url">Enter Image URL:</label>
                <input type="text" class="form-control" id="image-url" placeholder="Enter image URL">
                <button class="btn btn-primary mt-2" id="fetch-image-url">Fetch Image</button>
            </div>
        </div>

        <!-- Image Preview Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <label>Image Preview:</label>
                <div class="box">
                    <img id="image-preview" src="#" alt="No image selected"
                        style="display: none; width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px;">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('upload-method').addEventListener('change', function() {
            var method = this.value;
            if (method === 'upload') {
                document.getElementById('file-upload-section').style.display = 'block';
                document.getElementById('url-upload-section').style.display = 'none';
            } else if (method === 'url') {
                document.getElementById('file-upload-section').style.display = 'none';
                document.getElementById('url-upload-section').style.display = 'block';
            }
        });

        document.getElementById('select-file').addEventListener('change', function(event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').style.display = 'block';
                    document.getElementById('image-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('fetch-image-url').addEventListener('click', function() {
            var url = document.getElementById('image-url').value;
            if (url) {
                document.getElementById('image-preview').style.display = 'block';
                document.getElementById('image-preview').src = url;
            }
        });
    </script>
@endsection
