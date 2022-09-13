@extends('admin.layouts.admin')

@section('content')



<h3>Orders</h3>
<p class="text-muted">Manage your order here.</p>
<div class="mt-2">
    @include('layouts.partials.messages')
</div>


<div class="mt-4">
    <form>
        <div class="row">
            <input type="hidden" name="page" value="{{app('request')->input('page')}}" />
            <div class="col-auto">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                    <input class="form-control" placeholder="Search order" name="keyword" value="{{app('request')->input('keyword')}}" />
                </div>
            </div>

            <div class="col-auto">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">ID</span>
                    <input class="form-control" placeholder="Order ID" name="id" value="{{app('request')->input('id')}}" />
                </div>
            </div>
            <div class="col-auto">
                <select class="form-select" name="status">
                    <option value="">--STATUS--</option>
                    <option {{app('request')->input('status')=="PENDING"?"selected":""}}>PENDING</option>
                    <option {{app('request')->input('status')=="SUCCESS"?"selected":""}}>SUCCESS</option>
                    <option {{app('request')->input('status')=="FAILED"?"selected":""}}>FAILED</option>
                </select>

            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
</div>

<table class="table table-bordered table-striped mt-4 bg-white">
    <thead>
        <tr>
            <th width="1%">#</th>
            <th width="1%">ID</th>

            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Promoter</th>
            <th>Commission</th>
            <th>Date</th>
            <th>Status</th>
            <th>Checked In</th>
            <th width="3%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $key => $order)
        <tr class="data-row" data-row-id="{{$order->id}}">
            <td>{{ $key + 1 }}</td>
            <td>{{ $order->id }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->mobile }}</td>
            <td>{{ $order->email }}</td>
            <td>₹{{ $order->total_price }}</td>
            <td>{{ $order->promoter }}</td>
            <td>₹{{ $order->promoter_commission?$order->promoter_commission:0 }}</td>
            <td>₹{{ $order->date?date('d-m-Y', strtotime($order->date)):""}}</td>
            <td><span class="badge bg-{{$colors[$order->status]}}">{{ $order->status }}</span></td>
            <td class="checked-in"><span class="text-{{ $order->is_checked_in?'success': 'danger' }}">{{ $order->is_checked_in?"Yes": "No" }}</span></td>

            <td>
                <!--<a class="btn btn-info btn-sm" href="{{ route('order.show', $order->id) }}">Show</a>-->
                <a class="btn btn-info btn-sm" onclick="openCheckInDetails('{{$order->id}}')">Show</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex mt-4">
    @include('admin.common.pagination', ["paginator"=>$orders])
</div>

<div class="modal fade" tabindex="-1" id="details-modal">
    <div class="modal-dialog">

    </div>
</div>

<script>
    function openCheckInDetails(order_id) {
        jQuery.ajax({
            url: "{{ url('/admin/order/check-in-details') }}",
            method: 'post',
            data: {
                order_id: order_id
            },
            success: function(result) {
                $("#details-modal .modal-dialog").html(result.html);
                new bootstrap.Modal(document.getElementById('details-modal'), {}).show();
                //checkInDetailsModal.show();
            }
        });
    }

    function checkIn(order_id) {
        jQuery.ajax({
            url: "{{ url('/admin/order/check-in') }}",
            method: 'post',
            data: {
                order_id: order_id
            },
            success: function(result) {
                $(`tr.data-row[data-row-id=${order_id}] .checked-in`).html("<span class='text-success'>Yes</span>");
                new bootstrap.Modal(document.getElementById('details-modal'), {}).hide();
            }
        });
    }
</script>


@endsection