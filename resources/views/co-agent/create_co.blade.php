@extends('layouts.app')

@section('content')
    <div class="box-announced-co">
        <div class="smust-co-head-box ">
            <img class="img-ellipse" src="{{ URL::asset('/assets/image/welcome/Ellipse.png') }}">
            <div class="back-co">
                <a href="javascript:void(0);" onclick="goBack()">
                    <img class="co-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a>
                <p class="co-trial">ฝากทรัพย์</p>
            </div>


            <a href="{{ url('/') }}">
                <img class="img-smust" src="{{ URL::asset('/assets/image/welcome/SMUSTLogo.png') }}">
            </a>
        </div>
        <div class="box-announced">

            <div class="progress-bar-co">
                <div class="progress-step" id="step-0"></div>
                <div class="progress-step" id="step-1"></div>
                <div class="progress-step" id="step-2"></div>
                <div class="progress-step" id="step-3"></div>
                <div class="progress-step" id="step-4"></div>
            </div>




            <form id="multiStepForm" class="multi-step-form" method="POST" action="{{ route('co-agent-store') }}"
                enctype="multipart/form-data">
                @csrf
                <!-- Step 1 -->
                <div class="form-step active">
                    @include('co-agent.step_1')

                </div>
                <!-- Step 2 -->
                <div class="form-step">
                    @include('co-agent.step_2')

                </div>
                <!-- Step 3 -->
                <div class="form-step">
                    @include('co-agent.step_3')
                </div>
                <!-- Step 4 -->
                <div class="form-step">
                    @include('co-agent.step_4')
                </div>
                <!-- Step 5 -->
                <div class="form-step">
                    @include('co-agent.step_5')
                </div>

            </form>


        </div>

    </div>

    <script>
        let currentStep = 1; // Start from the first step

        function updateProgress() {
            // Update progress steps
            document.querySelectorAll('.progress-step').forEach((step, index) => {
                // Apply 'completed' class to steps before the current one


                if (index < currentStep) {
                    step.classList.add('completed');
                } else {
                    step.classList.remove('completed');
                }

            });

            // Update step content visibility


            document.querySelectorAll('.step-content').forEach((content, index) => {
                content.style.display = index === (currentStep) ? 'block' :
                    'none'; // Show only the current step
            });
        }

        const steps = document.querySelectorAll('.form-step'); // Get all step elements

        function showStep(step) {
            steps.forEach((element, index) => {
                element.classList.toggle('active', index === (step - 1)); // Adjust for 0-based index
            });
        }

        function nextStep() {


            if (currentStep < steps.length) { // Ensure it does not exceed the number of steps
                console.log("currentStep", currentStep);

                const sellValue = document.getElementById('type-name-sell') ? document.getElementById('type-name-sell')
                    .value : null;
                const hireSellValue = document.getElementById('type-name-hire_sell') ? document.getElementById(
                    'type-name-hire_sell').value : null;
                const hireValue = document.getElementById('type-name-hire') ? document.getElementById('type-name-hire')
                    .value : null;
                const typeCoValue = document.getElementById('property_type-co') ? document.getElementById(
                    'property_type-co').value : null;
                const provincesValue = document.getElementById('provinces-id') ? document.getElementById('provinces-id')
                    .value : null;


                axios.post('/submit-data', {
                        typeNameSell: sellValue,
                        typeNameHireSell: hireSellValue,
                        typeNameHire: hireValue,
                        propertyTypeCo: typeCoValue,
                        provincesId: provincesValue
                    })
                    .then(response => {

                        const peopleCount = response.data.data; // เปลี่ยน peopleCount ให้ตรงกับข้อมูลที่ได้

                        // อัปเดตตัวเลขใน <p> ที่มี id="people-23"
                        document.getElementById('people-23').innerHTML =
                            `${peopleCount} <span class="people">คน</span>`;
                    })
                    .catch(error => {
                        console.error('Error:', error); // ตรวจสอบข้อผิดพลาดถ้ามี
                    });






                currentStep++;
                showStep(currentStep);
                updateProgress();
                if (currentStep == 1) {
                    document.getElementById('cross').value = 0;

                }
            }
        }

        function nextStepCross() {

            if (currentStep <= steps.length - 3) { // Ensure it does not exceed the number of steps
                currentStep += 3; // Update currentStep by adding 3
                showStep(currentStep);
                updateProgress();
                document.getElementById('cross').value = 1;
            }


        }

        function previousStep() {
            if (currentStep > 1) { // Ensure it does not go below 1
                currentStep--;
                showStep(currentStep);
                updateProgress();

            }
            if (currentStep == 1) {
                document.getElementById('cross').value = 0;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
            updateProgress();
        });
    </script>
@endsection
