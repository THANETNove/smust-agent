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


            <img class="img-smust" src="{{ URL::asset('/assets/image/welcome/SMUSTLogo.png') }}">
        </div>
        <div class="box-announced">

            <div class="progress-bar-co">
                <div class="progress-step" id="step-0"></div>
                <div class="progress-step" id="step-1"></div>
                <div class="progress-step" id="step-2"></div>
                <div class="progress-step" id="step-3"></div>
                <div class="progress-step" id="step-4"></div>
            </div>




            <form id="multiStepForm" class="multi-step-form">
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
                    <input type="text" placeholder="Step 4: Input 1">
                    <input type="text" placeholder="Step 4: Input 2">
                    <button type="button" onclick="nextStep()">ถัดไป</button>
                </div>
                <!-- Step 5 -->
                <div class="form-step">
                    <input type="text" placeholder="Step 5: Input 1">
                    <input type="text" placeholder="Step 5: Input 2">
                    <button type="button" onclick="nextStep()">ถัดไป</button>
                </div>
                <!-- Step 6 -->
                <div class="form-step">
                    <input type="text" placeholder="Step 6: Input 1">
                    <input type="text" placeholder="Step 6: Input 2">
                    <button type="submit">ส่งฟอร์ม</button>
                </div>
            </form>


        </div>

    </div>

    <script>
        let currentStep = 3; // Start from the first step

        function updateProgress() {
            // Update progress steps
            document.querySelectorAll('.progress-step').forEach((step, index) => {
                // Apply 'completed' class to steps before the current one

                let cs = currentStep > 3 ? currentStep - 1 : currentStep;
                if (index < cs) {
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
                currentStep++;
                showStep(currentStep);
                updateProgress();
            }
        }

        function previousStep() {
            if (currentStep > 1) { // Ensure it does not go below 1
                currentStep--;
                showStep(currentStep);
                updateProgress();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
            updateProgress();
        });
    </script>
@endsection
