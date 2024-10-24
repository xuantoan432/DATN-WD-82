import './bootstrap';
document.addEventListener('DOMContentLoaded', function() {

    axios.get('https://provinces.open-api.vn/api/p/')
        .then(function (response) {

            const provinces = response.data;
            let provinceSelect = document.getElementById('province');
            provinces.forEach(function(province) {
                let option = document.createElement('option');
                option.value = province.code;
                option.text = province.name;
                provinceSelect.appendChild(option);
            });
        })
        .catch(function (error) {

            alert('Không thể tải danh sách Tỉnh/Thành phố.');
            console.error(error);
        });
});
function getDistricts(provinceCode) {
    let districtSelect = document.getElementById('district');
    districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
    document.getElementById('ward').innerHTML = '<option value="">Chọn Xã/Phường</option>';

    if (provinceCode) {
        axios.get(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`)
            .then(function (response) {

                const districts = response.data.districts;
                districts.forEach(function(district) {
                    let option = document.createElement('option');
                    option.value = district.code;
                    option.text = district.name;
                    districtSelect.appendChild(option);
                });
            })
            .catch(function (error) {
                alert('Không thể tải danh sách Quận/Huyện.');
                console.error(error);
            });
    }
}
function getWards(districtCode) {
    let wardSelect = document.getElementById('ward');
    wardSelect.innerHTML = '<option value="">Chọn Xã/Phường</option>';

    if (districtCode) {
        axios.get(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`)
            .then(function (response) {
                const wards = response.data.wards;
                wards.forEach(function(ward) {
                    let option = document.createElement('option');
                    option.value = ward.code;
                    option.text = ward.name;
                    wardSelect.appendChild(option);
                });
            })
            .catch(function (error) {
                alert('Không thể tải danh sách Xã/Phường.');
                console.error(error);
            });
    }
}
