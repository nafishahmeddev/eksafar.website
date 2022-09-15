@extends('admin.layouts.admin')

@section('subnav')
    @include('admin.event.manage.partials.subnav', ['active' => 'tickets'])
@endsection

@section('content')
    <h4>Tickets</h4>
    <p class="text-muted">Manage your tickets here.</p>
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>


    <div class="mt-4">
        <form>
            <div class="row">
                <input type="hidden" name="page" value="{{ app('request')->input('page') }}" />
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                        <input class="form-control" placeholder="Search ticket name" name="keyword"
                            value="{{ app('request')->input('keyword') }}" />
                    </div>
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
                <th>Description</th>
                <th>Persons</th>
                <th>Price</th>
                <th width="3%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($event_tickets as $key => $event_ticket)
                <tr class="data-row" data-row-id="{{ $event_ticket->id }}">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $event_ticket->id }}</td>
                    <td>{{ $event_ticket->name }}</td>
                    <td>{{ $event_ticket->description }}</td>
                    <td>{{ $event_ticket->persons }}</td>
                    <td>₹{{ $event_ticket->price }}</td>
                    <td><a class="btn btn-small btn-default" onclick="openForm('{{$event_ticket->id}}')">F</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex mt-4">
        @include('admin.common.pagination', ['paginator' => $event_tickets])
    </div>


    <div class="modal fade" tabindex="-1" id="form-modal">
        <div class="modal-dialog">
    
        </div>
    </div>
    <script>
        function openForm(event_ticket_id) {
            jQuery.ajax({
                url: "{{ url('/admin/event/'.$event->id.'/tickets/form') }}",
                method: 'post',
                data: {
                    event_ticket_id: event_ticket_id
                },
                success: function(result) {
                    $("#form-modal .modal-dialog").html(result.html);
                    new bootstrap.Modal(document.getElementById('form-modal'), {}).show();
                }
            });
        }

        function handleOnSubmitTicketForm(event) {
            jQuery.ajax({
                url: "{{ url('/admin/event/'.$event->id.'/tickets/') }}",
                method: 'post',
                data: $(event.target).serialize(),
                success: function(result) {
                    new bootstrap.Modal(document.getElementById('form-modal'), {}).hide();
                }
            });
        }
    </script>
@endsection
