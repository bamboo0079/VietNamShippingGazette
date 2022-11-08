@extends('layouts.backend')
@section('content')
    <div id="content" xmlns="http://www.w3.org/1999/html">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Danh Sách Đơn Hàng</h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col width="80">
                                <col>
                                <col>
                                <col>
                                <col width="150">
                                <col width="120">
                            </colgroup>
                            <thead>
                            <tr>
                                <th class="text-center">Thứ tự</th>
                                <th class="text-left">Ngày đặt hàng</th>
                                <th class="text-left">Họ tên</th>
                                <th class="text-left">Công ty</th>
                                <th class="text-center">Điện thoại</th>
                                <th class="text-center">Thanh toán</th>
                                <th class="text-center">Tình trạng</th>
                                <th class="text-center" width="10%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($cards as $k => $card)
                                <tr>
                                    <?php
                                        $invoice_export = "Không";
                                        if($card->invoice_export == 1) {
                                            $invoice_export = "Có";
                                        }
                                        $card_info = json_decode($card->card_info);


                                        $data_hidden = array(
                                            "id" => $card->card_id,
                                            "full_name" => $card->full_name,
                                            "company" => $card->company,
                                            "invoice_export" => $invoice_export,
                                            "tax_no" => strlen($card->tax_no) > 0 ? $card->tax_no : "không",
                                            "invoice_address" => strlen($card->invoice_address) > 0 ? $card->invoice_address : "invoice_address",
                                            "product_address" => $card->product_address,
                                            "tel" => strlen($card->tel) > 0 ? $card->tel : "không",
                                            "fax" => strlen($card->fax) > 0 ? $card->fax : "không",
                                            "mobile" => $card->mobile,
                                            "email" => strlen($card->email) > 0 ? $card->email : "không",
                                            "payment" => strlen($card->payment) == 0 ? "Trực tiếp" : "Chuyển khoản",
                                            "order_date" => date('d/m/Y H:i',strtotime($card->car_date)),
                                            "note" => strlen($card->note) > 0 ? $card->note : "không",
                                            "status" => $card->status == 0 ? "Chưa xử lý" : "Đã xử lý",
                                            "status_date" => $card->status == 1 ? date('d/m/Y H:i',strtotime($card->card_update_date)) : "chưa được xử lý",
                                            "product_data" => $card_info,


                                            "card_detail" => $card->card_info,
                                        );
                                        $json = json_encode($data_hidden);
                                    ?>
                                    <input type="hidden" class="data" value="{{ $json }}">
                                    <td class="text-center">{{ (($cards->currentPage()-1)*50)+$k+1 }} </td>
                                    <td class="text-left">{{ date('d/m/Y H:i', strtotime($card->car_date)) }}</td>
                                    <td class="text-left">{{ $card->full_name }}</td>
                                    <td class="text-left">{{ $card->company }}</td>
                                    <td class="text-left">{{ $card->mobile }}</td>
                                    <td class="text-left">@if($card->payment == 1) {{ "Chuyển khoản" }} @else {{ "Khi nhận hàng" }} @endif</td>
                                    <td class="text-left"><strong style="color: red">@if($card->status == 0) {{ "Chưa xử lý" }} @else {{ "Đã xử lý" }} @endif</strong></td>
                                    <td class="text-right">
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm load_card_detail" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-pencil-alt"></i> Chi tiết</a>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="6">Không có dữ liệu</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $cards->appends($_GET)->links('backend.paginations.admin') }}
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Chi Tiết Đơn Hàng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table card_table" id="dataTable" width="100%" cellspacing="0">

                                <tr>
                                    <td width="40%" style="border-top:0px; ">Họ tên: </td>
                                    <td  style="border-top:0px; " class="full_name"></td>
                                </tr>
                                <tr>
                                    <td >Công ty: </td>
                                    <td class="company"></td>
                                </tr>
                                <tr>
                                    <td >Xuất hóa đơn: </td>
                                    <td class="invoice_export"></td>
                                </tr>
                                <tr>
                                    <td >Mã số thuế: </td>
                                    <td class="tax_no"></td>
                                </tr>
                                <tr>
                                    <td >Địa chỉ xuất hóa đơn: </td>
                                    <td class="invoice_address"></td>
                                </tr>

                                <tr>
                                    <td >Địa chỉ giao sản phẩm: </td>
                                    <td class="product_address"></td>
                                </tr>
                                <tr>
                                    <td >Điện thoại bàn: </td>
                                    <td class="tel"></td>
                                </tr>
                                <tr>
                                    <td >Điện thoại di động: </td>
                                    <td class="mobile"></td>
                                </tr>
                                <tr>
                                    <td >Địa chỉ email: </td>
                                    <td class="email"></td>
                                </tr>
                                <tr>
                                    <td >Phương thức thanh toán: </td>
                                    <td class="payment"></td>
                                </tr>
                                <tr>
                                    <td >Ngày mua: </td>
                                    <td class="order_date"></td>
                                </tr>
                                <tr>
                                    <td >Ghi chú: </td>
                                    <td class="note"></td>
                                </tr>
                                <tr>
                                    <td>Tình trạng đơn hàng: </td>
                                    <td class="status"></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid #e3e6f0;">Ngày xử lý: </td>
                                    <td style="border-bottom: 1px solid #e3e6f0;" class="status_date"></td>
                                </tr>

                                <tr>
                                    <style type="text/css">
                                        .table-borderless tr td {
                                            border: 1px solid #e3e6f0;
                                        }
                                    </style>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Tên Sản phẩm</td>
                                            <td>Số lượng</td>
                                            <td>Giá</td>
                                        </tr>
                                        <tbody class="detail_card_info">

                                        </tbody>

                                    </table>
                                </tr>

                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary button_prss" card_id="">Xử lý đơn hàng</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End -->
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ユーザー管理</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>消去してもよろしいですか？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">はい</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#deleteModal').on('show.bs.modal', function(e) {
                $(this).find('.btn-primary').attr('form',$(e.relatedTarget).data('form'));
            });
            $('#deleteModal').on('click', '.btn-primary', function(e) {
                $($(this).attr('form')).submit();
                $(e.delegateTarget).modal('hide');
            });

            $('.load_card_detail').on('click',function() {
                var that = $(this);
               var json = that.parents('tr').find('input').val();
               var data_json = JSON.parse(json);
               console.log(data_json);

                for (var key in data_json){
                    console.log(key);

                    var trs = $('.card_table').find('tr');
                    trs.each(function () {
                        if(key == 'id') {
                            $('.button_prss').attr('card_id',data_json[key]);
                        }
                        if($(this).find('td').hasClass(key)) {
                            if(key == 'status') {
                                $(this).find('td:eq(1)').html('<span style="font-weight: bold; color: red">'+data_json[key]+"</span>");
                                if(data_json[key] === "Đã xử lý") {
                                    $('.button_prss').hide();
                                } else {
                                    $('.button_prss').show();
                                }
                            } else {
                                $(this).find('td:eq(1)').html('<span>'+data_json[key]+"</span>");
                            }
                        }
                    })

                    if(key == 'product_data'){
                        var card_html = "";
                        var product_list = data_json[key]['product'];
                        var total = data_json[key]['total'];
                        console.log(product_list);
                        console.log(product_list[0]['prd_name']);

                        for(var t= 0; t < product_list.length ; t++) {
                            // var json_prd = JSON.parse(product_list[i]);
                            // console.log(json_prd);
                            card_html += "<tr>"
                            card_html += "<td>" + product_list[t]['prd_name'] + "</td>"
                            card_html += "<td>" + product_list[t]['qt'] + "</td>"
                            card_html += "<td>" + product_list[t]['prd_price'] + "</td>"
                            card_html += "</tr>"
                        }
                        card_html += "<tr>"
                        card_html += "<td>Tổng tiền</td>"
                        card_html += "<td colspan='2'> <strong style='color: red'>"+total+"</trong></td>"
                        card_html += "</tr>"

                        $('.detail_card_info').html(card_html);
                    }

                }

            });

            $('.button_prss').on('click',function() {
               var card_id = $(this).attr('card_id');
                let route = "{{ route('admin.processCard') }}";
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    url: route,
                    type: 'POST',
                    data: {
                        id:card_id,

                    },
                    success: function(response) {
                        $('.status_date').html(response);
                        $('.status').html('<span style="font-weight: bold; color: red">Đã xử lý</span>');
                        $('.button_prss').hide();
                        alert('Xử lý thành công');
                        location.reload(true);
                    },
                    error: function(xhr) {
                        $("#err_card").fadeTo(2000, 500).slideUp(500, function(){
                            $("#err_card").slideUp(500);
                        });
                    }});
            });
        })
    </script>
@stop