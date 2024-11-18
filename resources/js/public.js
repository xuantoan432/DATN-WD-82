import './bootstrap';

window.Echo.channel('seller')
.listen('SellerRegistrationRequested', (e) => {
    console.log(e);
    alert(`Bạn có một người đăng ký mới : ${e.user_name}`);
    window.location.href = `/admin/seller-approvals`;


    let html = document.querySelector('#data') ;
    let tr = `  <tr>
                                     <td >${e.user_id }</td>

                                    <td>${e.user_name }</td>

                                    <td>${e.store_name}</td>
                                    <td>${e.email}</td>
                                    <td> ${e.description }</td>
                                    <td>
                                            <button type="submit"   data-id="${e.id }" class="btn btn-success pheduyet">Phê duyệt</button>
                                            <button type="submit"  data-id1="${e.id }" class="btn btn-danger tuchoi">Từ chối</button>

                 </tr>`
 html.insertAdjacentHTML('beforeend' , tr ) ;
// Attach event listeners to the new buttons
document.querySelectorAll('.pheduyet').forEach((btn) => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        window.axios.post(`/admin/seller-approve/${id}`)
            .then((res) => {
                console.log(res);
                alert('Seller approved successfully!');
                // Optionally, remove the row after approval
                btn.closest('tr').remove();
            })
            .catch((err) => {
                console.error(err);
                alert('Error approving seller.');
            });
    });
});

document.querySelectorAll('.tuchoi').forEach((btn) => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        window.axios.post(`/admin/seller-reject/${id }`)
            .then((res) => {
                console.log(res);
                alert('Seller rejected successfully!');
                // Optionally, remove the row after rejection
                btn.closest('tr').remove();
            })
            .catch((err) => {
                console.error(err);
                alert('Error rejecting seller.');
            });
    });
});
});





