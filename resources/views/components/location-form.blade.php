      <!-- Province -->
    <div class="row g-1 mb-3">
        <div class="col-md-12 col-12">
            <label for="province" id="label-province" class="form-label"></label>
            <select class="form-select select3" id="province" name="province_code" required>
                <option value="">-- Select Province --</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->code }}">
                        {{ $province->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Regency -->
    <div class="row g-1 mb-3">
        <div class="col-md-12 col-12">
            <label for="regency" id="label-regency" class="form-label"></label>
            <select class="form-select select3" id="regency" name="regency_code" required disabled>
                <option value="">-- Select Regency --</option>
            </select>
        </div>
    </div>

    <!-- District -->
    <div class="row g-1 mb-3">
        <div class="col-md-12 col-12">
            <label for="district" id="label-district" class="form-label"></label>
            <select class="form-select select3" id="district" name="district_code" required disabled>
                <option value="">-- Select District --</option>
            </select>
        </div>
    </div>
 

    <!-- Postal -->
    <div class="row g-1 mb-3">
        <div class="col-md-12 col-12">
            <label for="postal" id="label-postal" class="form-label"></label>
            <input type="text" class="form-control" id="postal" name="postal" required />
        </div>
    </div> 



    <style>
        /* Style untuk loading indicator di select3 */
.select3-loading {
    position: absolute;
    right: 30px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    display: none;
}

.select3-container--default .select3-selection--single {
    padding-right: 50px;
}

/* Style untuk select3 yang disabled */
.select3-container--disabled .select3-selection--single {
    background-color: #f8f9fa;
    opacity: 0.7;
}
    </style>