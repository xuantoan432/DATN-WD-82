$(function () {
    "use strict";



    $('#taikhoan').text(FormatPrice(parseInt(data.seller.account_balance)));
    const mau = [

        '#ffd200', '#00c6fb', '#ee0979', '#17ad37', '#ec6ead', '#FFCCFF', '#ff6f61', '#6a1b9a',
        '#03a9f4', '#ffc107', '#795548', '#4caf50', '#ff5722', '#607d8b'
    ];

    const chu = [
        '#ff6a00', "#005bea", '#ee0979', '#17ad37', '#ec6ead', '#FFCCFF', '#d50000', '#aa00ff',
        '#00bfa5', '#ffab00', '#5d4037', '#76ff03', '#ff9100', '#90a4ae'
    ];

    function getRandomColor(colors) {
        return colors[Math.floor(Math.random() * colors.length)];
    }

    function createColorCombinations(mau, chu, count) {
        const combinations = [];
        for (let i = 0; i < count; i++) {
            const gradientColor = getRandomColor(mau);
            const textColor = getRandomColor(chu);
            combinations.push({gradient: gradientColor, text: textColor});
        }
        return combinations;
    }


// chart 1 đơn hàng theo ngày
    $('#tongdon').text(data.orders.today.length + " đơn hàng");

    if (data.orders.percentOder < 0) {
        $('#phamtramdon').append(`<span class="text-danger d-flex align-items-center" >${data.orders.percentOder}%
        <i class="material-icons-outlined">expand_less</i></span>`);
    } else {
        $('#phamtramdon').append(`<span class="text-success d-flex align-items-center" >+${data.orders.percentOder}%
        <i class="material-icons-outlined">expand_less</i></span>`);
    }


    let chart1 = {
        series: [0],
        xaxis: [0],
        tong: [0],
    }
    for (const item of data.orders.ordersByMinute) {
        chart1.series.push(item.total_orders)
        chart1.xaxis.push(item.time)
        chart1.tong.push(item.total_price)
    }
    var options = {
        series: [{
            name: "Số Lượng :",
            data: chart1.series
        }],
        chart: {
            //width:150,
            height: 60,
            type: 'area',
            sparkline: {
                enabled: !0
            },
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 1.5,
            curve: "smooth"
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                gradientToColors: ['#0d6efd'],
                shadeIntensity: 1,
                type: 'vertical',
                opacityFrom: 0.7,
                opacityTo: 0.0,
                //stops: [0, 100, 100, 100]
            },
        },
        colors: ["#0d6efd"],
        tooltip: {
            theme: "dark",
            fixed: {
                enabled: !1
            },
            x: {
                show: !0,

            },
            y: {
                title: {
                    formatter: function (e) {
                        return e;  // Hiển thị số lượng
                    }
                }
            },
            marker: {
                show: !1
            }
        },
        xaxis: {
            categories: chart1.xaxis,
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();


// chart 2 doanh thu theo ngày
    $('#doanhthu').text(FormatPrice(parseInt(data.revenue.percent)));

    if (data.revenue.percentPrice < 0) {
        $('#phantramdoanhthu').append(`<span class="text-danger d-flex align-items-center" >${data.revenue.percentPrice}%
        <i class="material-icons-outlined">expand_less</i></span>`);
    } else {
        $('#phantramdoanhthu').append(`<span class="text-success d-flex align-items-center" >+${data.revenue.percentPrice}%
        <i class="material-icons-outlined">expand_less</i></span>`);
    }
    var options = {
        series: [{
            name: "Tổng :",
            data: chart1.tong
        }],
        chart: {
            //width:150,
            height: 60,
            type: 'area',
            sparkline: {
                enabled: !0
            },
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 1.5,
            curve: "smooth"
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                gradientToColors: ['#17ad37'],
                shadeIntensity: 1,
                type: 'vertical',
                opacityFrom: 0.7,
                opacityTo: 0.0,
                //stops: [0, 100, 100, 100]
            },
        },
        colors: ["#98ec2d"],
        tooltip: {
            theme: "dark",
            fixed: {
                enabled: !1
            },
            x: {
                show: !0
            },
            y: {
                title: {
                    formatter: function (e) {
                        return e
                    }
                }
            },
            marker: {
                show: !1
            }
        },

        xaxis: {
            categories: chart1.xaxis,
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();


    // chart 3  tổng sản phẩm
    let htmlProducts = $('#sanpham').text(data.products.pro.length);
    let chart3 = {
        series: [],
        labels: [],
        gradientToColors: mau,
        colors: chu
    };

    const dataProducts = data.products.category; // Danh sách sản phẩm hoặc danh mục

// Tạo các kết hợp màu sắc tương ứng với số danh mục
    const colorCombinations = createColorCombinations(mau, chu, dataProducts.length);

    let htmlchart3 = dataProducts.map((val, index) => {
        // Thêm vào chart3.series
        chart3.series.push(val.quantity);
        chart3.labels.push(val.name);

        // Thêm màu sắc ngẫu nhiên
        chart3.gradientToColors.push(colorCombinations[index].gradient);
        chart3.colors.push(colorCombinations[index].text);

        // Tạo HTML cho từng danh mục
        return `<div class="d-flex align-items-center justify-content-between">
        <p class="mb-0 d-flex align-items-center gap-2 w-25">
            <span class="material-icons-outlined fs-6">fiber_manual_record</span>
            ${val.name}
        </p>
        <div>
            <p class="mb-0">${val.percent} %</p>
        </div>
    </div>`;
    }).join(''); // Ghép các chuỗi HTML lại với nhau

// Thêm HTML vào phần tử có class categoryproducts
    $('.categoryproducts').append(htmlchart3);

    var options = {
        series: chart3.series,
        chart: {
            height: 290,
            type: 'donut',
        },
        legend: {
            position: 'bottom',
            show: !1
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                gradientToColors: chart3.gradientToColors,
                shadeIntensity: 1,
                type: 'vertical',
                opacityFrom: 1,
                opacityTo: 1,
                //stops: [0, 100, 100, 100]
            },
        },
        colors: chart3.colors,
        labels: chart3.labels,
        dataLabels: {
            enabled: !1
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "85%"
                }
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    height: 270
                },
                legend: {
                    position: 'bottom',
                    show: !1
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart6"), options);
    chart.render();


    // chart 4 doanh thu
    let chart4 = {
        "week": {
            donhang: [],
            doanhthu: [],
            data: [],
        },
        'day': {
            donhang: [],
            doanhthu: [],
            data: [],
        },
        "month": {
            donhang: [],
            doanhthu: [],
            data: [],
        },
        "year": {
            donhang: [],
            doanhthu: [],
            data: [],
        }
    };
    let tongdoanhthu = 0 ;
    for (const val of data.revenue.weeklyStats) {
        chart4.day.donhang.push(val.total_orders);
        chart4.day.doanhthu.push(val.total_price);
        chart4.day.data.push(val.weekday);
    }
    for (const val of data.revenue.monthlyStats) {
        chart4.month.donhang.push(val.total_orders);
        chart4.month.doanhthu.push(val.total_price);
        chart4.month.data.push(val.month);
    }
    for (const val of data.revenue.tuan) {
        chart4.week.donhang.push(val.total_orders);
        chart4.week.doanhthu.push(val.total_price);
        chart4.week.data.push("Tuần " + val.tuan);
    }
    for (const val of data.revenue.nam) {
        chart4.year.donhang.push(val.total_orders);
        chart4.year.doanhthu.push(val.total_price);
        chart4.year.data.push("Năm " + val.year);
    }
    for (const val of chart4.day.doanhthu) {
        tongdoanhthu += parseInt(val)
    }
    $('#thongketong').text('Tổng Tiền : ' + FormatPrice(tongdoanhthu))

    var options = {
        series: [{
            name: "Đơn Hàng",
            data: chart4.day.donhang
        }, {
            name: "Doanh Thu",
            data: chart4.day.doanhthu
        }],
        chart: {
            foreColor: "#9ba7b2",
            height: 235,
            type: 'bar',
            toolbar: {
                show: false,
            },
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 4,
            curve: 'smooth',
            colors: ['transparent']
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                gradientToColors: ['#ffd200', '#00c6fb'],
                shadeIntensity: 1,
                type: 'vertical',
                stops: [0, 100, 100, 100]
            },
        },
        colors: ['#ff6a00', "#005bea"],
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 4,
                columnWidth: '55%',
                dataLabels: {
                    position: 'top', // Hiển thị dữ liệu trên đỉnh cột
                },
                barHeight: '100%',
                distributed: false, // Các cột giữ nguyên màu
            },
        },
        grid: {
            show: false,
            borderColor: 'rgba(0, 0, 0, 0.15)',
            strokeDashArray: 4,
        },
        tooltip: {
            theme: "dark",
            x: {
                show: true
            },
            y: {
                title: {
                    formatter: function (seriesName) {
                        return seriesName;
                    }
                }
            },
        },
        xaxis: {
            categories: chart4.day.data,
            labels: {
                style: {
                    colors: '#9ba7b2',
                },
            },
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toLocaleString();
                }
            },

        },
        legend: {
            show: true,
            position: 'top',
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart5"), options);
    chart.render();

    $('.dropdown-item').on('click', function () {
        var selectedOption = $(this).attr('id');

        if (selectedOption === 'data-ngay') {
            $('#thongketong').text('Tổng Tiền : ' + FormatPrice(tongdoanhthu))
            changeChartData('day');
        } else if (selectedOption === 'data-tuan') {
            tongdoanhthu = 0
            for (const val of chart4.week.doanhthu) {
                tongdoanhthu += parseInt(val)
            }
            $('#thongketong').text('Tổng Tiền : ' + FormatPrice(tongdoanhthu))
            changeChartData('week');
        } else if (selectedOption === 'data-thang') {

            tongdoanhthu = 0
            for (const val of chart4.month.doanhthu) {
                tongdoanhthu += parseInt(val)
            }
            $('#thongketong').text('Tổng Tiền : ' + FormatPrice(tongdoanhthu))
            changeChartData('month');
        } else if (selectedOption === 'data-nam') {
            tongdoanhthu = 0
            for (const val of chart4.year.doanhthu) {
                tongdoanhthu += parseInt(val)
            }
            $('#thongketong').text('Tổng Tiền : ' + FormatPrice(tongdoanhthu))

            changeChartData('year');
        }
    });


    function changeChartData(timeframe) {

        switch (timeframe) {
            case 'day':
                chart.updateOptions({
                    series: [{
                        name: "Đơn Hàng",
                        data: chart4.day.donhang
                    }, {
                        name: "Doanh Thu",
                        data: chart4.day.doanhthu
                    }],
                    xaxis: {
                        categories: chart4.day.data
                    }
                });
                break;
            case 'week':

                chart.updateOptions({
                    series: [{
                        name: "Đơn Hàng",
                        data: chart4.week.donhang
                    }, {
                        name: "Doanh Thu",
                        data: chart4.week.doanhthu
                    }],
                    xaxis: {
                        categories: chart4.week.data
                    }
                });

                break;
            case 'month':
                chart.updateOptions({
                    series: [{
                        name: "Đơn Hàng",
                        data: chart4.month.donhang
                    }, {
                        name: "Doanh Thu",
                        data:  chart4.month.doanhthu
                    }],
                    xaxis: {
                        categories: chart4.month.data
                    }
                });
                break;
            case 'year':
                chart.updateOptions({
                    series: [{
                        name: "Đơn Hàng",
                        data: chart4.year.donhang
                    }, {
                        name: "Doanh Thu",
                        data: chart4.year.doanhthu
                    }],
                    xaxis: {
                        categories: chart4.year.data
                    }
                });
                break;
        }
    }
});


function FormatPrice(value) {
    return value.toLocaleString('vi-VN') + ' VNĐ';
}
