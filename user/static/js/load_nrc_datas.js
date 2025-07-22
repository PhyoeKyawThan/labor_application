document.addEventListener('DOMContentLoaded', () => {
    let nrcData = [];
    let paired_datas = {};
    const nrc_code = document.getElementById("nrc-code");
    const regions = document.getElementById('region');
    if (nrc_code != 'null' && regions) {
        const fetchNRCData = async () => {
            try {
                const response = await fetch('/labor_application/user/static/js/nrc.json');
                if (response.ok) {
                    nrcData = await response.json();
                    console.log('Stored NRC data:', nrcData);
                    populateNRCOptions(nrcData.data);
                } else {
                    console.error('Failed to fetch NRC data');
                }
            } catch (err) {
                console.error('Error:', err);
            }
        };

        const populateNRCOptions = (datas) => {
            generate_code_state_pair(datas);
            const burmese_number = {
                0: '၀',
                1: '၁',
                2: '၂',
                3: '၃',
                4: '၄',
                5: '၅',
                6: '၆',
                7: '၇',
                8: '၈',
                9: '၉',
                10: '၁၀',
                11: '၁၁',
                12: '၁၂',
                13: '၁၃',
                14: '၁၄'
            };
            for (let i = 1; i <= 14; i++) {
                nrc_code.innerHTML += `<option value="${burmese_number[i]}" ${i === 1 ? "selected" : ""}>${burmese_number[i]}</option>`;
            }
            updateRegionsDropdown(1);
        };

        nrc_code.addEventListener('change', (e) => {
            let code = e.target.value;
            const english_number = {
                '၀': 0,
                '၁': 1,
                '၂': 2,
                '၃': 3,
                '၄': 4,
                '၅': 5,
                '၆': 6,
                '၇': 7,
                '၈': 8,
                '၉': 9,
                '၁၀': 10,
                '၁၁': 11,
                '၁၂': 12,
                '၁၃': 13,
                '၁၄': 14
            };
            code = english_number[code];
            console.log('Selected NRC code:', code);
            updateRegionsDropdown(code);
        });

        function generate_code_state_pair(datas) {
            datas.forEach(data => {
                if (paired_datas[data.nrc_code]) {
                    paired_datas[data.nrc_code].push(data.name_mm);
                } else {
                    paired_datas[data.nrc_code] = [data.name_mm];
                }
            });
        }

        function updateRegionsDropdown(code) {
            regions.innerHTML = '';

            if (paired_datas[code]) {
                paired_datas[code].forEach(region => {
                    regions.innerHTML += `<option value="${region}">${region}</option>`;
                });
            } else {
                regions.innerHTML = `<option value="">No regions found</option>`;
            }
        }

        fetchNRCData();
    }
})