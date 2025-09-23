  class AddressForm {
        constructor() {
            // console.log('AddressForm initialized');
            
            // Select utama
            this.provinceSelect = document.getElementById('province');
            this.regencySelect = document.getElementById('regency');
            this.districtSelect = document.getElementById('district');
            
             // console.log('Province select:', this.provinceSelect);
            // console.log('Regency select:', this.regencySelect);
            // console.log('District select:', this.districtSelect);
            
            // Input hidden / value default dari backend
            this.provinceInput = document.getElementById('provincesID');
            this.regencyInput = document.getElementById('regencyID');
            this.districtInput = document.getElementById('districtID');
            
            // Nilai awal dari backend (jika ada)
            this.provincesVal = this.provinceInput ? this.provinceInput.value : '';
            this.regencyVal = this.regencyInput ? this.regencyInput.value : '';
            this.districtVal = this.districtInput ? this.districtInput.value : '';
            
            this.postalCodeInput = document.getElementById('postal');
            this.loadingClass = 'loading';
            
             if (this.provinceSelect && this.regencySelect && this.districtSelect) {
                this.init();
            } else {
                console.error('Some address form elements are missing');
            }
        }

        init() {
            // console.log('Initializing AddressForm with values:', {
            //     province: this.provincesVal,
            //     regency: this.regencyVal,
            //     district: this.districtVal
            // });
            
            this.bindEvents();
            this.loadInitialValues();
        }

        bindEvents() {
            // Province change
            if (this.provinceSelect) {
                this.provinceSelect.addEventListener('change', async (e) => {
                    // console.log('Province changed to:', e.target.value);
                    this.resetDependentSelects(['regency', 'district']);
                    const value = e.target.value;
                    if (this.provinceInput) this.provinceInput.value = value || '';
                    if (value) await this.loadRegencies(value);
                });
            }

            // Regency change
            if (this.regencySelect) {
                this.regencySelect.addEventListener('change', async (e) => {
                    // console.log('Regency changed to:', e.target.value);
                    this.resetDependentSelects(['district']);
                    const value = e.target.value;
                    if (this.regencyInput) this.regencyInput.value = value || '';
                    if (value) await this.loadDistricts(value);
                });
            }

            // District change
            if (this.districtSelect) {
                this.districtSelect.addEventListener('change', (e) => {
                    // console.log('District changed to:', e.target.value);
                    const value = e.target.value;
                    if (this.districtInput) this.districtInput.value = value || '';
                });
            }
        }

        async loadInitialValues() {
            // console.log('Loading initial values');
            
             if (this.provincesVal) {
                // console.log('Loading regencies for province:', this.provincesVal);
                await this.loadRegencies(this.provincesVal);
                if (this.provinceSelect) {
                    this.provinceSelect.value = this.provincesVal;
                    // console.log('Set province select value to:', this.provincesVal);
                }
                
                 if (this.regencyVal) {
                    // console.log('Loading districts for regency:', this.regencyVal);
                    await this.loadDistricts(this.regencyVal);
                    if (this.regencySelect) {
                        this.regencySelect.value = this.regencyVal;
                        // console.log('Set regency select value to:', this.regencyVal);
                    }
                    
                     if (this.districtVal && this.districtSelect) {
                        this.districtSelect.value = this.districtVal;
                        // console.log('Set district select value to:', this.districtVal);
                    }
                }
            } else {
                // console.log('No initial province value found');
            }
        }

        async loadRegencies(provinceCode) {
            try {
                // console.log('Fetching regencies for province:', provinceCode);
                const res = await fetch(`/api/location/regencies?province_code=${provinceCode}`);
                
                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }
                
                const data = await res.json();
                // console.log('Regencies data:', data);
                
                this.populateSelect(this.regencySelect, data, 'Select Regency');
                if (this.regencySelect) this.regencySelect.disabled = false;
            } catch (err) {
                // console.error('Failed to load regencies:', err);
                // Fallback: Buat opsi default jika fetch gagal
                if (this.regencySelect) {
                    this.regencySelect.innerHTML = '<option value="">-- Error loading regencies --</option>';
                }
            }
        }

        async loadDistricts(regencyCode) {
            try {
                // console.log('Fetching districts for regency:', regencyCode);
                const res = await fetch(`/api/location/districts?regency_code=${regencyCode}`);
                
                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }
                
                const data = await res.json();
                // console.log('Districts data:', data);
                
                this.populateSelect(this.districtSelect, data, 'Select District');
                if (this.districtSelect) this.districtSelect.disabled = false;
            } catch (err) {
                // console.error('Failed to load districts:', err);
                // Fallback: Buat opsi default jika fetch gagal
                if (this.districtSelect) {
                    this.districtSelect.innerHTML = '<option value="">-- Error loading districts --</option>';
                }
            }
        }

        populateSelect(select, options, placeholder) {
            if (!select) {
                // console.error('Cannot populate select - element not found');
                return;
            }
            
            select.innerHTML = `<option value="">-- ${placeholder} --</option>`;
            
            if (options && options.length > 0) {
                options.forEach(opt => {
                    const o = document.createElement('option');
                    o.value = opt.code;
                    o.textContent = opt.name;
                    select.appendChild(o);
                });
            } else {
                // console.warn('No options provided for select');
                select.innerHTML += '<option value="">-- No data available --</option>';
            }
            
            // console.log(`Populated ${placeholder} with ${options ? options.length : 0} options`);
        }

        resetDependentSelects(ids) {
            ids.forEach(id => {
                const s = document.getElementById(id);
                if (s) {
                    s.innerHTML = `<option value="">-- Select ${id.charAt(0).toUpperCase() + id.slice(1)} --</option>`;
                    s.disabled = true;
                    // console.log(`Reset ${id} select`);
                }
            });
        }
    }