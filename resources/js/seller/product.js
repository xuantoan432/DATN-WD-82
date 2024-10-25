
// content

    CKEDITOR.replace('content', {
        height: 100
    });
    CKEDITOR.replace('content1');

// end contnet
// select 2

// end














document.getElementById('add-item-btn').addEventListener('click', function() {
    const repeater = document.getElementById('repeater');
    const newCard = document.createElement('div');
    newCard.className = 'card mb-2';
    newCard.innerHTML = `
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Biến thể sản phẩm</h5>
                <button class="btn btn-danger remove">Xóa</button>
            </div>
        </div>
    `;
    repeater.appendChild(newCard);
});

document.getElementById('repeater').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove')) {
        e.target.closest('.card').remove();
    }
});
