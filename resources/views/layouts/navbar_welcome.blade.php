<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a href="{{ url('/') }}" style="margin-left: 5%;">
            <img class="agentlogo-navbar" src="{{ URL::asset('/assets/image/home/SMUSTAgentlogo.png') }}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if (session('message'))
            <p class="text-center mt-4" style="color: green"> {{ session('message') }}</p>
        @endif
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-nav-white">
                <li class="nav-item">
                    <a class="nav-link apply-job-with-us" aria-current="page"
                        href="{{ url('house-condo') }}">หาบ้าน/คอนโดที่ถูกใจ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  apply-job-with-us" aria-current="page"
                        href="{{ url('skilled-brokers') }}">ศูนย์รวมนายหน้าฝีมือดี</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link apply-job-with-us" href="{{ url('interested-more') }}">สมัครงานกับเรา</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link owner-allows-free" aria-disabled="true"
                        href="{{ url('co-create') }}">เจ้าของให้เราช่วยขายได้ ฟรี</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
