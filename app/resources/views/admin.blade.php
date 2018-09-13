@extends('main')

@section('body')
<div class="container admin-container">
    <div class="row">
        <div class="col col-6">
            <h2>Send a New Message</h2>
        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @elseif (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif
            <form action="/send-message" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="message_body">Message Body</label>
                    <textarea name="body" id="message_body" class="form-control">{{ Session::has('body') ? Session::get('body') : "" }}</textarea>
                </div>

                <h5>Schedule this message</h5>
                <small class="form-text text-muted">Leave blank to send immediately</small>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="datepicker">Date:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="date" id="datepicker" />
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="timepicker">Time:</label>
                        <div class="input-group">
                            <select class="form-control" name="time">
                                <option value="">None</option>
                                <option>12:00am</option>
                                <option>12:15am</option>
                                <option>12:30am</option>
                                <option>12:45am</option>
                                <option>1:00am</option>
                                <option>1:15am</option>
                                <option>1:30am</option>
                                <option>1:45am</option>
                                <option>2:00am</option>
                                <option>2:15am</option>
                                <option>2:30am</option>
                                <option>2:45am</option>
                                <option>3:00am</option>
                                <option>3:15am</option>
                                <option>3:30am</option>
                                <option>3:45am</option>
                                <option>4:00am</option>
                                <option>4:15am</option>
                                <option>4:30am</option>
                                <option>4:45am</option>
                                <option>5:00am</option>
                                <option>5:15am</option>
                                <option>5:30am</option>
                                <option>5:45am</option>
                                <option>6:00am</option>
                                <option>6:15am</option>
                                <option>6:30am</option>
                                <option>6:45am</option>
                                <option>7:00am</option>
                                <option>7:15am</option>
                                <option>7:30am</option>
                                <option>7:45am</option>
                                <option>8:00am</option>
                                <option>8:15am</option>
                                <option>8:30am</option>
                                <option>8:45am</option>
                                <option>9:00am</option>
                                <option>9:15am</option>
                                <option>9:30am</option>
                                <option>9:45am</option>
                                <option>10:00am</option>
                                <option>10:15am</option>
                                <option>10:30am</option>
                                <option>10:45am</option>
                                <option>11:00am</option>
                                <option>11:15am</option>
                                <option>11:30am</option>
                                <option>11:45am</option>
                                <option>12:00pm</option>
                                <option>12:15pm</option>
                                <option>12:30pm</option>
                                <option>12:45pm</option>
                                <option>1:00pm</option>
                                <option>1:15pm</option>
                                <option>1:30pm</option>
                                <option>1:45pm</option>
                                <option>2:00pm</option>
                                <option>2:15pm</option>
                                <option>2:30pm</option>
                                <option>2:45pm</option>
                                <option>3:00pm</option>
                                <option>3:15pm</option>
                                <option>3:30pm</option>
                                <option>3:45pm</option>
                                <option>4:00pm</option>
                                <option>4:15pm</option>
                                <option>4:30pm</option>
                                <option>4:45pm</option>
                                <option>5:00pm</option>
                                <option>5:15pm</option>
                                <option>5:30pm</option>
                                <option>5:45pm</option>
                                <option>6:00pm</option>
                                <option>6:15pm</option>
                                <option>6:30pm</option>
                                <option>6:45pm</option>
                                <option>7:00pm</option>
                                <option>7:15pm</option>
                                <option>7:30pm</option>
                                <option>7:45pm</option>
                                <option>8:00pm</option>
                                <option>8:15pm</option>
                                <option>8:30pm</option>
                                <option>8:45pm</option>
                                <option>9:00pm</option>
                                <option>9:15pm</option>
                                <option>9:30pm</option>
                                <option>9:45pm</option>
                                <option>10:00pm</option>
                                <option>10:15pm</option>
                                <option>10:30pm</option>
                                <option>10:45pm</option>
                                <option>11:00pm</option>
                                <option>11:15pm</option>
                                <option>11:30pm</option>
                                <option>11:45pm</option>
                            </select>
                        </div>
                    </div>
                </div>

                <h5>Recipients</h5>
                <div class="row">
            @if (count($users) > 0)
                @foreach ($users as $user)
                    <div class="form-group col col-md-3">
                        <input id="recipient_{{ $user->id }}" type="checkbox" name="recipients[]" value="{{ $user->id }}" />
                        <label for="recipient_{{ $user->id }}">{{ $user->name }}</label>
                    </div>
                @endforeach
            @else
                <div class="form-group col">
                    <h5 class="no-users">No users currently registered!</h5>
                </div>
            @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Send Message</button>
                </div>
            </form>
        </div>
        <div class="col">
            <h2>Previous Messages</h2>
        @if (count($messages) > 0)
            <table class="table table-striped table-bordered">
                <thead>
                    <th class="text-left">Message</th>
                    <th class="text-center">Recipients</th>
                    <th width="30%" class="text-right">Sent</th>
                </thead>
                <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td valign="top" align="left">{{ $message->body }}</td>
                        <td valign="top" align="center">{{ $message->recipients }}</td>
                        <td valign="top" align="right">{{ date("m-d-Y g:ia", strtotime($message->created_at)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h5>No messages have been sent yet!</h5>
        @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="/js/admin.js"></script>
@endsection
