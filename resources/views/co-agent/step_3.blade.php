<p class="step-skipped">ขั้นตอนนี้สามารถข้ามได้</p>
<p class="head-name-co mb-3">ไฮไลท์อสังหา</p>
<div class="mb-3">
    <select class="form-select" aria-label="Default select example" name="electricalAppliance">
        <option selected disabled>สิ่งอำนวยความสะดวก</option>
        @foreach ($electricalAppliance as $ele)
            <option value="{{ $ele->name }}">{{ $ele->name }}</option>
        @endforeach


    </select>
</div>
<div class="mb-3">
    <select class="form-select" aria-label="Default select example" name="facilities">
        <option selected disabled>เครื่องใช้ไฟฟ้า</option>
        @foreach ($facilities as $fac)
            <option value="{{ $fac->name }}">{{ $fac->name }}</option>
        @endforeach

    </select>
</div>
<div class="mb-3">
    <select class="form-select" aria-label="Default select example" name="furniture">
        <option selected disabled>เฟอร์นิเจอร์</option>
        @foreach ($furniture as $fur)
            <option value="{{ $fur->name }}">{{ $fur->name }}</option>
        @endforeach

    </select>
</div>
<p class="head-name-co mb-3 " style="margin-top: 58px">สถานที่สำคัญใกล้เคียง</p>
<p class="shopping-center"> <img class="image-local_mall"
        src="{{ URL::asset('/assets/image/welcome/bed.png') }}">ศูนย์การค้า</p>

<div class="row" id="input-container">
    <div class="col-md-12 mb-3 input_box">
        <input id="shopping_center" type="text" class="form-control @error('shopping_center') is-invalid @enderror"
            name="shopping_center[]" value="{{ old('shopping_center') }}"  autocomplete="shopping_center">
        <label>ศูนย์การค้า</label>
        @error('shopping_center')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="add-circle-btn" onclick="addInputField()">
    <img class="image-add_circle" src="{{ URL::asset('/assets/image/welcome/add_circle.png') }}"> เพิ่ม
</div>

<p class="shopping-center" style="margin-top: 22px"> <img class="image-local_mall"
        src="{{ URL::asset('/assets/image/welcome/school.png') }}">สถานศึกษา</p>

<div class="row" id="input-container-school">
    <div class="col-md-12 mb-3 input_box">
        <input id="shopping_center" type="text" class="form-control @error('school') is-invalid @enderror"
            name="school[]" value="{{ old('school') }}"  autocomplete="school">
        <label>สถานศึกษา</label>
        @error('school')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="add-circle-btn" onclick="addInputFieldSchool()">
    <img class="image-add_circle" src="{{ URL::asset('/assets/image/welcome/add_circle.png') }}"> เพิ่ม
</div>

<p class="shopping-center" style="margin-top: 22px"> <img class="image-local_mall"
        src="{{ URL::asset('/assets/image/welcome/storefront.png') }}">ร้านสะดวกซื้อที่ใกล้ที่สุดห่างกี่เมตร</p>

<div class="row">
    <div class="col-md-12 mb-3 input_box">
        <input id="shopping_center" type="text" class="form-control @error('meters_store') is-invalid @enderror"
            name="meters_store" value="{{ old('meters_store') }}"  autocomplete="meters_store">
        <label>ร้านสะดวกซื้อที่ใกล้ที่สุด</label>
        @error('meters_store')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>



<div class="box-btn-block-center">
    <button type="button" class="btn btn-have-broker-back" onclick="previousStep()">
        กลับ
    </button>
    <button type="button" class="btn btn-have-broker" onclick="nextStep()">
        ถัดไป
    </button>
</div>


<script>
    document.getElementById('add-circle-btn-1').addEventListener('click', function() {
        // Get the last shopping center row's ID
        const lastRow = document.querySelector('.row[id^="shopping_center-"]:last-of-type');
        const lastId = parseInt(lastRow.id.split('-')[1]);

        // Clone the last row
        const newRow = lastRow.cloneNode(true);

        // Increment the ID for the new row and update its ID
        const newId = lastId + 1;
        newRow.id = `shopping_center-${newId}`;

        // Update the input field inside the new row
        const newInput = newRow.querySelector('input');
        newInput.id = `shopping_center_${newId}`;
        newInput.name = `shopping_center_${newId}`;
        newInput.value = '';

        // Append the new row after the last one
        lastRow.after(newRow);
    });

    function addInputField() {
        // สร้าง div ใหม่
        const newInputBox = document.createElement('div');
        newInputBox.classList.add('col-md-12', 'mb-3', 'input_box');

        // สร้าง input ใหม่
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'shopping_center[]';
        newInput.classList.add('form-control');
        newInput. = true;
        newInput.autocomplete = 'shopping_center';

        // สร้าง label ใหม่
        const newLabel = document.createElement('label');
        newLabel.textContent = 'ศูนย์การค้า';

        // เพิ่ม input และ label ลงใน div
        newInputBox.appendChild(newInput);
        newInputBox.appendChild(newLabel);

        // เพิ่ม div ใหม่ลงใน container
        document.getElementById('input-container').appendChild(newInputBox);
    }

    function addInputFieldSchool() {
        // สร้าง div ใหม่
        const newInputBox = document.createElement('div');
        newInputBox.classList.add('col-md-12', 'mb-3', 'input_box');

        // สร้าง input ใหม่
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'school[]';
        newInput.classList.add('form-control');
        newInput. = true;
        newInput.autocomplete = 'school';

        // สร้าง label ใหม่
        const newLabel = document.createElement('label');
        newLabel.textContent = 'สถานศึกษา';

        // เพิ่ม input และ label ลงใน div
        newInputBox.appendChild(newInput);
        newInputBox.appendChild(newLabel);

        // เพิ่ม div ใหม่ลงใน container
        document.getElementById('input-container-school').appendChild(newInputBox);
    }
</script>
